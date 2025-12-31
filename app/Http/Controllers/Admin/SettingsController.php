<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function general()
    {
        $settings = Setting::getGroup('general');
        return view('admin.settings.general', compact('settings'));
    }

    public function updateGeneral(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'nullable|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'site_logo' => 'nullable|image|max:2048', // 2MB Max
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'contact_address' => 'nullable|string|max:500',
            'social_facebook' => 'nullable|url|max:255',
            'social_twitter' => 'nullable|url|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'social_linkedin' => 'nullable|url|max:255',
            'social_youtube' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('site_logo')) {
            $path = $request->file('site_logo')->store('settings', 'public');
            $validated['site_logo'] = $path;
        }

        Setting::setMany($validated, 'general');

        return redirect()->route('admin.settings.general')
            ->with('success', 'General settings updated successfully.');
    }

    public function payments()
    {
        $settings = Setting::getGroup('payments');
        return view('admin.settings.payments', compact('settings'));
    }

    public function updatePayments(Request $request)
    {
        $validated = $request->validate([
            // PayPal
            'paypal_enabled' => 'nullable|boolean',
            'paypal_mode' => 'nullable|in:sandbox,live',
            'paypal_client_id' => 'nullable|string|max:255',
            'paypal_client_secret' => 'nullable|string|max:255',

            // M-Pesa
            'mpesa_enabled' => 'nullable|boolean',
            'mpesa_environment' => 'nullable|in:sandbox,live',
            'mpesa_consumer_key' => 'nullable|string|max:255',
            'mpesa_consumer_secret' => 'nullable|string|max:255',
            'mpesa_shortcode' => 'nullable|string|max:50',
            'mpesa_passkey' => 'nullable|string|max:255',

            // GoFundMe
            'gofundme_enabled' => 'nullable|boolean',
            'gofundme_campaign_url' => 'nullable|url|max:255',

            // Bank Details
            'bank_enabled' => 'nullable|boolean',
            'bank_name' => 'nullable|string|max:255',
            'bank_account_name' => 'nullable|string|max:255',
            'bank_account_number' => 'nullable|string|max:100',
            'bank_branch' => 'nullable|string|max:255',
            'bank_swift_code' => 'nullable|string|max:50',
            'bank_instructions' => 'nullable|string|max:1000',
        ]);

        // Convert checkboxes
        $validated['paypal_enabled'] = $request->boolean('paypal_enabled');
        $validated['mpesa_enabled'] = $request->boolean('mpesa_enabled');
        $validated['gofundme_enabled'] = $request->boolean('gofundme_enabled');
        $validated['bank_enabled'] = $request->boolean('bank_enabled');

        Setting::setMany($validated, 'payments');

        return redirect()->route('admin.settings.payments')
            ->with('success', 'Payment settings updated successfully.');
    }
}
