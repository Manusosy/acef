<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            'site_tagline' => 'nullable|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'site_logo' => 'nullable|string|max:2048',
            'site_logo_dark' => 'nullable|string|max:2048',
            'site_favicon' => 'nullable|string|max:1024',
            'dashboard_logo' => 'nullable|string|max:2048',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'contact_address' => 'nullable|string|max:500',
            'social_facebook' => 'nullable|url|max:255',
            'social_twitter' => 'nullable|url|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'social_linkedin' => 'nullable|url|max:255',
            'social_youtube' => 'nullable|url|max:255',
            'annual_report' => 'nullable|string|max:2048',
            'methodology_doc' => 'nullable|string|max:2048',
        ]);

        $imageFields = ['site_logo', 'site_logo_dark', 'site_favicon', 'dashboard_logo', 'annual_report', 'methodology_doc'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->store('settings', 'public');
                $validated[$field] = $path;
            } elseif ($request->filled($field) && !is_object($request->input($field))) {
                // Handle path from media library (string)
                $path = $request->input($field);
                // If it's a full URL, we might want to strip the storage part or keep it as is
                // For consistency with how we store uploads, we prefer relative paths
                if (str_contains($path, '/storage/')) {
                    $path = Str::after($path, '/storage/');
                }
                $validated[$field] = $path;
            } else {
                // If the field is present in the request (even as null/empty), it means we want to clear it
                if ($request->has($field)) {
                    $validated[$field] = null;
                } else {
                    unset($validated[$field]);
                }
            }
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
