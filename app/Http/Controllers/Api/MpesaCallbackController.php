<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MpesaCallbackController extends Controller
{
    /**
     * Handle M-Pesa STK Push callback
     * 
     * This endpoint receives payment notifications from Safaricom M-Pesa
     * and updates the donation status accordingly.
     */
    public function callback(Request $request)
    {
        // Log all callback attempts for audit trail
        Log::info('M-Pesa Callback Received', [
            'ip' => $request->ip(),
            'payload' => $request->all(),
            'timestamp' => now()
        ]);

        try {
            // Validate request origin (optional but recommended)
            // You can add IP whitelist validation here for Safaricom IPs
            
            $callbackData = $request->all();
            
            // Extract callback data
            $body = $callbackData['Body'] ?? null;
            $stkCallback = $body['stkCallback'] ?? null;
            
            if (!$stkCallback) {
                Log::warning('Invalid M-Pesa callback structure', ['data' => $callbackData]);
                return response()->json(['ResultCode' => 1, 'ResultDesc' => 'Invalid callback data']);
            }
            
            $resultCode = $stkCallback['ResultCode'] ?? null;
            $resultDesc = $stkCallback['ResultDesc'] ?? '';
            $checkoutRequestID = $stkCallback['CheckoutRequestID'] ?? null;
            
            if (!$checkoutRequestID) {
                Log::warning('Missing CheckoutRequestID in callback');
                return response()->json(['ResultCode' => 1, 'ResultDesc' => 'Missing CheckoutRequestID']);
            }
            
            // Find the pending donation
            $donation = Donation::where('transaction_reference', $checkoutRequestID)
                ->where('payment_method', 'mpesa')
                ->first();
            
            if (!$donation) {
                Log::warning('Donation not found for CheckoutRequestID', ['id' => $checkoutRequestID]);
                return response()->json(['ResultCode' => 1, 'ResultDesc' => 'Donation not found']);
            }
            
            // Prevent duplicate processing (idempotency)
            if ($donation->status === 'completed') {
                Log::info('Donation already processed', ['id' => $donation->id]);
                return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Already processed']);
            }
            
            // Update donation based on result code
            if ($resultCode == 0) {
                // Success
                $callbackMetadata = $stkCallback['CallbackMetadata']['Item'] ?? [];
                
                // Extract payment details
                $amount = null;
                $mpesaReceiptNumber = null;
                $transactionDate = null;
                $phoneNumber = null;
                
                foreach ($callbackMetadata as $item) {
                    switch ($item['Name']) {
                        case 'Amount':
                            $amount = $item['Value'] ?? null;
                            break;
                        case 'MpesaReceiptNumber':
                            $mpesaReceiptNumber = $item['Value'] ?? null;
                            break;
                        case 'TransactionDate':
                            $transactionDate = $item['Value'] ?? null;
                            break;
                        case 'PhoneNumber':
                            $phoneNumber = $item['Value'] ?? null;
                            break;
                    }
                }
                
                $donation->update([
                    'status' => 'completed',
                    'transaction_reference' => $mpesaReceiptNumber ?? $checkoutRequestID,
                    'gateway_response' => array_merge(
                        $donation->gateway_response ?? [],
                        ['callback' => $stkCallback]
                    ),
                ]);
                
                Log::info('M-Pesa payment completed', [
                    'donation_id' => $donation->id,
                    'amount' => $amount,
                    'receipt' => $mpesaReceiptNumber
                ]);
                
            } else {
                // Failed or cancelled
                $donation->update([
                    'status' => 'failed',
                    'gateway_response' => array_merge(
                        $donation->gateway_response ?? [],
                        [
                            'callback' => $stkCallback,
                            'error' => $resultDesc
                        ]
                    ),
                ]);
                
                Log::info('M-Pesa payment failed', [
                    'donation_id' => $donation->id,
                    'result_code' => $resultCode,
                    'result_desc' => $resultDesc
                ]);
            }
            
            // Return success response to M-Pesa
            return response()->json([
                'ResultCode' => 0,
                'ResultDesc' => 'Accepted'
            ]);
            
        } catch (\Exception $e) {
            Log::error('M-Pesa callback processing error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'ResultCode' => 1,
                'ResultDesc' => 'Internal server error'
            ]);
        }
    }
    
    /**
     * Query M-Pesa transaction status
     * This can be used to manually check payment status
     */
    public function queryStatus(Request $request)
    {
        // Implement transaction status query if needed
        // This would call M-Pesa API to check transaction status
    }
}
