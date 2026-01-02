<x-app-dashboard-layout>
    <x-slot name="header">Payment Settings</x-slot>
    <x-slot name="title">Payment Settings</x-slot>

    <div class="max-w-4xl">
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Payment Gateways</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Configure your payment methods for donations</p>
        </div>

        <form method="POST" action="{{ route('admin.settings.payments.update') }}" class="space-y-6">
            @csrf

            <!-- PayPal -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                            <span class="text-blue-600 dark:text-blue-400 font-bold text-sm">PP</span>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">PayPal</h3>
                    </div>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="paypal_enabled" value="1" {{ ($settings['paypal_enabled'] ?? false) ? 'checked' : '' }} class="w-5 h-5 rounded text-emerald-600">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Enable</span>
                    </label>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Mode</label>
                        <select name="paypal_mode" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="sandbox" {{ ($settings['paypal_mode'] ?? '') === 'sandbox' ? 'selected' : '' }}>Sandbox (Testing)</option>
                            <option value="live" {{ ($settings['paypal_mode'] ?? '') === 'live' ? 'selected' : '' }}>Live</option>
                        </select>
                    </div>
                    <div></div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Client ID</label>
                        <input type="text" name="paypal_client_id" value="{{ $settings['paypal_client_id'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Client Secret</label>
                        <input type="password" name="paypal_client_secret" value="{{ $settings['paypal_client_secret'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>
                </div>
            </div>

            <!-- M-Pesa -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                            <span class="text-green-600 dark:text-green-400 font-bold text-sm">MP</span>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">M-Pesa</h3>
                    </div>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="mpesa_enabled" value="1" {{ ($settings['mpesa_enabled'] ?? false) ? 'checked' : '' }} class="w-5 h-5 rounded text-emerald-600">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Enable</span>
                    </label>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Environment</label>
                        <select name="mpesa_environment" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="sandbox" {{ ($settings['mpesa_environment'] ?? '') === 'sandbox' ? 'selected' : '' }}>Sandbox</option>
                            <option value="live" {{ ($settings['mpesa_environment'] ?? '') === 'live' ? 'selected' : '' }}>Live</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Shortcode</label>
                        <input type="text" name="mpesa_shortcode" value="{{ $settings['mpesa_shortcode'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Consumer Key</label>
                        <input type="text" name="mpesa_consumer_key" value="{{ $settings['mpesa_consumer_key'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Consumer Secret</label>
                        <input type="password" name="mpesa_consumer_secret" value="{{ $settings['mpesa_consumer_secret'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Passkey</label>
                        <input type="password" name="mpesa_passkey" value="{{ $settings['mpesa_passkey'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>
                </div>
            </div>

            <!-- GoFundMe -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center">
                            <span class="text-orange-600 dark:text-orange-400 font-bold text-sm">GF</span>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">GoFundMe</h3>
                    </div>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="gofundme_enabled" value="1" {{ ($settings['gofundme_enabled'] ?? false) ? 'checked' : '' }} class="w-5 h-5 rounded text-emerald-600">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Enable</span>
                    </label>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Campaign URL</label>
                    <input type="url" name="gofundme_campaign_url" value="{{ $settings['gofundme_campaign_url'] ?? '' }}" placeholder="https://www.gofundme.com/f/your-campaign" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                </div>
            </div>

            <!-- Bank Transfer -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                            <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Bank Transfer / Cheque</h3>
                    </div>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="bank_enabled" value="1" {{ ($settings['bank_enabled'] ?? false) ? 'checked' : '' }} class="w-5 h-5 rounded text-emerald-600">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Enable</span>
                    </label>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Bank Name</label>
                        <input type="text" name="bank_name" value="{{ $settings['bank_name'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Account Name</label>
                        <input type="text" name="bank_account_name" value="{{ $settings['bank_account_name'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Account Number</label>
                        <input type="text" name="bank_account_number" value="{{ $settings['bank_account_number'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Branch</label>
                        <input type="text" name="bank_branch" value="{{ $settings['bank_branch'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">SWIFT Code</label>
                        <input type="text" name="bank_swift_code" value="{{ $settings['bank_swift_code'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>
                    <div></div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Additional Instructions</label>
                        <textarea name="bank_instructions" rows="3" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white" placeholder="e.g., Include your name as reference...">{{ $settings['bank_instructions'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-colors">
                    Save Payment Settings
                </button>
            </div>
        </form>
    </div>
</x-app-dashboard-layout>
