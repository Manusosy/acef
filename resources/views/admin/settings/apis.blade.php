<x-app-dashboard-layout>
    <div class="max-w-4xl mx-auto pb-20">
        <div class="mb-10">
            <h1 class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">System Integrations</h1>
            <p class="text-sm text-gray-600 dark:text-gray-300">Centralized management for external APIs, payment gateways, and system utilities</p>
        </div>

        <form method="POST" action="{{ route('admin.settings.apis.update') }}" class="space-y-12">
            @csrf

            <!-- SECTION: MEDIA & UTILITIES -->
            <div class="space-y-6">
                <div class="flex items-center gap-3 px-2">
                    <div class="w-8 h-8 rounded-lg bg-acef-green/10 flex items-center justify-center text-acef-green">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <h2 class="text-xs font-semibold uppercase tracking-wider text-gray-400">Media & Localization</h2>
                </div>

                <!-- YouTube Integration -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-8 shadow-sm">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 rounded-xl bg-red-50 dark:bg-red-900/30 flex items-center justify-center text-red-600">
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h3 class="font-bold text-gray-900 dark:text-white uppercase tracking-wider text-sm">YouTube Data API</h3>
                                <a href="https://console.cloud.google.com/apis/library/youtube.googleapis.com" target="_blank" class="text-[10px] font-bold text-acef-green hover:underline uppercase tracking-widest flex items-center gap-1">
                                    Get Credentials
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                </a>
                            </div>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Enable automated video syncing for the public gallery</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 underline decoration-acef-green/30 dark:text-gray-400 uppercase tracking-wider mb-2">API Secret Key</label>
                            <input type="password" name="youtube_api_key" value="{{ $settings['youtube_api_key'] ?? '' }}" 
                                   class="w-full px-5 py-3 bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-acef-green transition-all outline-none"
                                   placeholder="AIzaSy...">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Channel Unique ID</label>
                            <input type="text" name="youtube_channel_id" value="{{ $settings['youtube_channel_id'] ?? '' }}" 
                                   class="w-full px-5 py-3 bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-acef-green transition-all outline-none"
                                   placeholder="UC...">
                        </div>
                    </div>
                </div>

                <!-- Google Translate -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-8 shadow-sm">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center text-blue-600">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <h3 class="font-bold text-gray-900 dark:text-white uppercase tracking-wider text-sm">Google Cloud Translate</h3>
                                    <a href="https://console.cloud.google.com/apis/library/translate.googleapis.com" target="_blank" class="text-[10px] font-bold text-blue-600 hover:underline uppercase tracking-widest flex items-center gap-1">
                                        Cloud Console
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </a>
                                </div>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Manage site-wide automated translations</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer group">
                            <input type="checkbox" name="google_translate_enabled" value="1" {{ ($settings['google_translate_enabled'] ?? false) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-acef-green"></div>
                            <span class="ml-3 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 group-hover:text-acef-green transition-colors">Enabled</span>
                        </label>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">API Key (v2/v3)</label>
                        <input type="password" name="google_translate_api_key" value="{{ $settings['google_translate_api_key'] ?? '' }}" 
                               class="w-full px-5 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-acef-green transition-all outline-none"
                               placeholder="AIzaSy...">
                    </div>
                </div>
            </div>

            <!-- SECTION: FINANCIAL & DONATIONS -->
            <div class="space-y-6 pt-6">
                <div class="flex items-center gap-3 px-2">
                    <div class="w-8 h-8 rounded-lg bg-acef-green/10 flex items-center justify-center text-acef-green">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h2 class="text-xs font-semibold uppercase tracking-wider text-gray-400">Payment Gateways & Banking</h2>
                </div>

                <!-- PayPal -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-8 shadow-sm">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-600">
                                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M7.076 21.337H2.47a.641.641 0 0 1-.633-.74L4.944 3.32a1.281 1.281 0 0 1 1.264-1.053h8.92c4.405 0 6.07 2.16 5.372 5.513l-.005.025c-.2 1-1.047 3.518-1.5 4.5-.75 1.63-2.097 2.37-3.9 2.37H11.05a1.158 1.158 0 0 0-1.127.91l-.105.474-1.393 6.136a.64.64 0 0 1-.617.514zM16.14 7.02c.38-1.832-.507-3.14-2.822-3.14h-7.6l-2.82 16.17h2.822l1.393-6.138.106-.473a1.158 1.158 0 0 1 1.127-.91h3.1c1.517 0 2.585-.646 3.195-2.18.32-.8.638-1.812.698-3.329z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <h3 class="font-bold text-gray-900 dark:text-white uppercase tracking-wider text-sm">PayPal Checkout</h3>
                                    <a href="https://developer.paypal.com/dashboard/" target="_blank" class="text-[10px] font-bold text-indigo-600 hover:underline uppercase tracking-widest flex items-center gap-1">
                                        Developer Portal
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </a>
                                </div>
                                <p class="text-xs text-gray-600 dark:text-gray-400">International card and account processing</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer group">
                            <input type="checkbox" name="paypal_enabled" value="1" {{ ($settings['paypal_enabled'] ?? false) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600"></div>
                            <span class="ml-3 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 group-hover:text-indigo-600 transition-colors">Enabled</span>
                        </label>
                    </div>

                    <div class="space-y-8">
                        <div class="flex items-center gap-6 p-4 bg-gray-50 dark:bg-gray-900/50 rounded-xl">
                            <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Environment</span>
                            <div class="flex gap-6">
                                <label class="flex items-center gap-2 cursor-pointer group">
                                    <input type="radio" name="paypal_mode" value="sandbox" {{ ($settings['paypal_mode'] ?? 'sandbox') === 'sandbox' ? 'checked' : '' }} class="w-4 h-4 text-indigo-600 focus:ring-indigo-500">
                                    <span class="text-xs text-gray-600 group-hover:text-indigo-600 transition-colors font-bold uppercase tracking-wider">Sandbox</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer group">
                                    <input type="radio" name="paypal_mode" value="live" {{ ($settings['paypal_mode'] ?? '') === 'live' ? 'checked' : '' }} class="w-4 h-4 text-indigo-600 focus:ring-indigo-500">
                                    <span class="text-xs text-gray-900 dark:text-white group-hover:text-indigo-600 transition-colors font-black uppercase tracking-wider">Production</span>
                                </label>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Live Client ID</label>
                                <input type="password" name="paypal_client_id" value="{{ $settings['paypal_client_id'] ?? '' }}" 
                                       class="w-full px-5 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-600 transition-all outline-none"
                                       placeholder="AW...">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Secret Key</label>
                                <input type="password" name="paypal_client_secret" value="{{ $settings['paypal_client_secret'] ?? '' }}" 
                                       class="w-full px-5 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-600 transition-all outline-none"
                                       placeholder="EK...">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- M-Pesa -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-8 shadow-sm">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600">
                                <span class="font-black text-lg">M</span>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <h3 class="font-bold text-gray-900 dark:text-white uppercase tracking-wider text-sm">Safaricom M-Pesa</h3>
                                    <a href="https://developer.safaricom.co.ke/" target="_blank" class="text-[10px] font-bold text-emerald-600 hover:underline uppercase tracking-widest flex items-center gap-1">
                                        Daraaja Portal
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </a>
                                </div>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Mobile money and STK Push integration</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer group">
                            <input type="checkbox" name="mpesa_enabled" value="1" {{ ($settings['mpesa_enabled'] ?? false) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-emerald-600"></div>
                            <span class="ml-3 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 group-hover:text-emerald-600 transition-colors">Enabled</span>
                        </label>
                    </div>

                    <div class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                             <div class="flex items-center gap-6 p-4 bg-gray-50 dark:bg-gray-900 rounded-xl h-fit">
                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Env</span>
                                <div class="flex gap-4">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="mpesa_environment" value="sandbox" {{ ($settings['mpesa_environment'] ?? 'sandbox') === 'sandbox' ? 'checked' : '' }} class="text-emerald-600 focus:ring-emerald-500">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Sandbox</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="mpesa_environment" value="live" {{ ($settings['mpesa_environment'] ?? '') === 'live' ? 'checked' : '' }} class="text-emerald-600 focus:ring-emerald-500">
                                        <span class="text-[10px] font-black uppercase tracking-widest text-gray-900 dark:text-white">Live</span>
                                    </label>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Shortcode / Till</label>
                                <input type="text" name="mpesa_shortcode" value="{{ $settings['mpesa_shortcode'] ?? '' }}" 
                                       class="w-full px-5 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-600 transition-all outline-none"
                                       placeholder="174379">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Consumer Key</label>
                                <input type="password" name="mpesa_consumer_key" value="{{ $settings['mpesa_consumer_key'] ?? '' }}" 
                                       class="w-full px-5 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-600 transition-all outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Consumer Secret</label>
                                <input type="password" name="mpesa_consumer_secret" value="{{ $settings['mpesa_consumer_secret'] ?? '' }}" 
                                       class="w-full px-5 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-600 transition-all outline-none">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">LIPA NA M-PESA PASSKEY</label>
                            <input type="password" name="mpesa_passkey" value="{{ $settings['mpesa_passkey'] ?? '' }}" 
                                   class="w-full px-5 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-600 transition-all outline-none">
                        </div>
                    </div>
                </div>

                <!-- GoFundMe -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-8 shadow-sm">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-orange-50 dark:bg-orange-900/30 flex items-center justify-center text-orange-600">
                                <span class="font-black text-lg">G</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 dark:text-white uppercase tracking-wider text-sm">GoFundMe</h3>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Crowdfunding campaign integration</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer group">
                            <input type="checkbox" name="gofundme_enabled" value="1" {{ ($settings['gofundme_enabled'] ?? false) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-orange-600"></div>
                            <span class="ml-3 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 group-hover:text-orange-600 transition-colors">Enabled</span>
                        </label>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Primary Campaign URL</label>
                        <input type="url" name="gofundme_campaign_url" value="{{ $settings['gofundme_campaign_url'] ?? '' }}" 
                               class="w-full px-5 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-600 transition-all outline-none"
                               placeholder="https://gofundme.com/f/...">
                    </div>
                </div>

                <!-- Bank Transfer -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-8 shadow-sm">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-400 text-lg">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 dark:text-white uppercase tracking-wider text-sm">Direct Bank Transfer</h3>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Wire transfer and cheque instructions</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer group">
                            <input type="checkbox" name="bank_enabled" value="1" {{ ($settings['bank_enabled'] ?? false) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-gray-900 dark:peer-checked:bg-gray-600"></div>
                            <span class="ml-3 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-900 dark:group-hover:text-white transition-colors">Enabled</span>
                        </label>
                    </div>

                    <div class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Banking Institution Name</label>
                                <input type="text" name="bank_name" value="{{ $settings['bank_name'] ?? '' }}" 
                                       class="w-full px-5 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-gray-400 transition-all outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Beneficiary Account Name</label>
                                <input type="text" name="bank_account_name" value="{{ $settings['bank_account_name'] ?? '' }}" 
                                       class="w-full px-5 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-gray-400 transition-all outline-none">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Account Number / IBAN</label>
                                <input type="text" name="bank_account_number" value="{{ $settings['bank_account_number'] ?? '' }}" 
                                       class="w-full px-5 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-gray-400 transition-all outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">SWIFT / BIC Code</label>
                                <input type="text" name="bank_swift_code" value="{{ $settings['bank_swift_code'] ?? '' }}" 
                                       class="w-full px-5 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-gray-400 transition-all outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Public Instructions (Shown to Donors)</label>
                            <textarea name="bank_instructions" rows="4" 
                                      class="w-full px-5 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-gray-400 transition-all outline-none" 
                                      placeholder="e.g., Include your donation purpose as reference...">{{ $settings['bank_instructions'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-10 border-t border-gray-100 dark:border-gray-700">
                <div class="flex items-center gap-3 text-gray-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <p class="text-xs italic font-medium">All credentials are encrypted and stored in the secure system group.</p>
                </div>
                <button type="submit" class="px-10 py-4 bg-acef-dark dark:bg-acef-green text-white dark:text-acef-dark font-black text-xs uppercase tracking-widest rounded-xl hover:bg-emerald-500 dark:hover:bg-emerald-400 transition-all shadow-xl shadow-acef-green/20 transform hover:-translate-y-1 active:scale-95">
                    Save System Configuration
                </button>
            </div>
        </form>
    </div>
</x-app-dashboard-layout>
