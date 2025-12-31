<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DonationController extends Controller
{
    public function index()
    {
        $settings = Setting::getGroup('payments');
        return view('donate', compact('settings'));
    }

    public function processPaypal(Request $request)
    {
        // This is called via AJAX after PayPal JS SDK success
        $validated = $request->validate([
            'order_id' => 'required|string',
            'amount' => 'required|numeric',
            'details' => 'required|array',
            'donor_name' => 'nullable|string',
            'donor_email' => 'nullable|email',
        ]);

        Donation::create([
            'donor_name' => $validated['donor_name'] ?? ($validated['details']['payer']['name']['given_name'] ?? 'Anonymous'),
            'donor_email' => $validated['donor_email'] ?? ($validated['details']['payer']['email_address'] ?? null),
            'amount' => $validated['amount'],
            'currency' => 'USD', // PayPal usually USD
            'payment_method' => 'paypal',
            'transaction_reference' => $validated['order_id'],
            'status' => 'completed',
            'gateway_response' => $validated['details'],
            'message' => $request->message,
            'is_anonymous' => $request->boolean('is_anonymous'),
        ]);

        return response()->json(['success' => true]);
    }

    public function processMpesa(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string', // Format: 2547...
            'amount' => 'required|integer|min:1',
            'donor_name' => 'nullable|string',
            'donor_email' => 'nullable|email',
        ]);

        $settings = Setting::getGroup('payments');

        if (!($settings['mpesa_enabled'] ?? false)) {
            return response()->json(['success' => false, 'message' => 'M-Pesa is disabled.']);
        }

        // 1. Get Access Token
        $consumerKey = $settings['mpesa_consumer_key'];
        $consumerSecret = $settings['mpesa_consumer_secret'];
        $env = ($settings['mpesa_environment'] ?? 'sandbox') === 'sandbox' 
            ? 'https://sandbox.safaricom.co.ke' 
            : 'https://api.safaricom.co.ke';

        try {
            $tokenResponse = Http::withBasicAuth($consumerKey, $consumerSecret)
                ->get("$env/oauth/v1/generate?grant_type=client_credentials");
            
            if (!$tokenResponse->successful()) {
                throw new \Exception('Failed to generate token');
            }

            $accessToken = $tokenResponse->json()['access_token'];

            // 2. Initiate STK Push
            $shortcode = $settings['mpesa_shortcode'];
            $passkey = $settings['mpesa_passkey'];
            $timestamp = Carbon::now()->format('YmdHis');
            $password = base64_encode($shortcode . $passkey . $timestamp);
            $callbackUrl = route('api.mpesa.callback'); // We need to define this route

            $stkResponse = Http::withToken($accessToken)
                ->post("$env/mpesa/stkpush/v1/processrequest", [
                    'BusinessShortCode' => $shortcode,
                    'Password' => $password,
                    'Timestamp' => $timestamp,
                    'TransactionType' => 'CustomerPayBillOnline',
                    'Amount' => (int)$validated['amount'],
                    'PartyA' => $validated['phone'],
                    'PartyB' => $shortcode,
                    'PhoneNumber' => $validated['phone'],
                    'CallBackURL' => $callbackUrl,
                    'AccountReference' => 'ACEF Donation',
                    'TransactionDesc' => 'Donation to ACEF',
                ]);

            if ($stkResponse->successful()) {
                // Record pending donation
                Donation::create([
                    'donor_name' => $validated['donor_name'],
                    'donor_email' => $validated['donor_email'],
                    'donor_phone' => $validated['phone'],
                    'amount' => $validated['amount'],
                    'currency' => 'KES',
                    'payment_method' => 'mpesa',
                    'transaction_reference' => $stkResponse->json()['CheckoutRequestID'],
                    'status' => 'pending',
                    'gateway_response' => $stkResponse->json(),
                ]);

                return response()->json([
                    'success' => true, 
                    'message' => 'STK Push initiated. Check your phone.',
                    'checkout_request_id' => $stkResponse->json()['CheckoutRequestID']
                ]);
            } else {
                return response()->json(['success' => false, 'message' => 'M-Pesa Request Failed', 'error' => $stkResponse->json()]);
            }

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
