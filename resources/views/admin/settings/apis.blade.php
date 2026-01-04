<x-app-dashboard-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">API Configuration</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Manage external service integrations and API credentials</p>
        </div>

        <form method="POST" action="{{ route('admin.settings.apis.update') }}" class="space-y-8">
            @csrf

            <!-- YouTube Integration -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-red-50 dark:bg-red-900/30 flex items-center justify-center text-red-600">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 dark:text-white uppercase tracking-wider text-sm">YouTube API</h3>
                        <p class="text-xs text-gray-500">Connect your channel to display videos in the gallery</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">API Key</label>
                        <input type="password" name="youtube_api_key" value="{{ $settings['youtube_api_key'] ?? '' }}" 
                               class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-acef-green transition-all"
                               placeholder="AIzaSy...">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Channel ID</label>
                        <input type="text" name="youtube_channel_id" value="{{ $settings['youtube_channel_id'] ?? '' }}" 
                               class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-acef-green transition-all"
                               placeholder="UC...">
                    </div>
                </div>
                <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-100 dark:border-blue-800">
                    <p class="text-[11px] text-blue-700 dark:text-blue-300 leading-relaxed font-medium">
                        <span class="font-black uppercase mr-1">Note:</span> 
                        Enable the "YouTube Data API v3" in your Google Cloud Console to use this feature.
                    </p>
                </div>
            </div>

            <!-- Google Translate Integration -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 dark:text-white uppercase tracking-wider text-sm">Google Translate</h3>
                        <p class="text-xs text-gray-500">Enable automatic site-wide translations</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-900 rounded-xl">
                        <div>
                            <p class="text-sm font-bold text-gray-900 dark:text-white">Enable Translations</p>
                            <p class="text-xs text-gray-500">Show translation widget to visitors</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="google_translate_enabled" value="1" {{ ($settings['google_translate_enabled'] ?? false) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-acef-green"></div>
                        </label>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">API Key (Advanced)</label>
                        <input type="password" name="google_translate_api_key" value="{{ $settings['google_translate_api_key'] ?? '' }}" 
                               class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-acef-green transition-all"
                               placeholder="AIzaSy...">
                    </div>
                </div>
            </div>

            <!-- PayPal Integration -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-600">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M7.076 21.337H2.47a.641.641 0 0 1-.633-.74L4.944 3.32a1.281 1.281 0 0 1 1.264-1.053h8.92c4.405 0 6.07 2.16 5.372 5.513l-.005.025c-.2 1-1.047 3.518-1.5 4.5-.75 1.63-2.097 2.37-3.9 2.37H11.05a1.158 1.158 0 0 0-1.127.91l-.105.474-1.393 6.136a.64.64 0 0 1-.617.514zM16.14 7.02c.38-1.832-.507-3.14-2.822-3.14h-7.6l-2.82 16.17h2.822l1.393-6.138.106-.473a1.158 1.158 0 0 1 1.127-.91h3.1c1.517 0 2.585-.646 3.195-2.18.32-.8.638-1.812.698-3.329z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 dark:text-white uppercase tracking-wider text-sm">PayPal Checkout</h3>
                        <p class="text-xs text-gray-500">Configure credentials for accepting card and PayPal donations</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    <div class="flex items-center gap-4 mb-2">
                        <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Environment:</span>
                        <div class="flex gap-4">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="paypal_mode" value="sandbox" {{ ($settings['paypal_mode'] ?? 'sandbox') === 'sandbox' ? 'checked' : '' }} class="text-acef-green focus:ring-acef-green">
                                <span class="text-sm text-gray-700 dark:text-gray-300">Sandbox</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="paypal_mode" value="live" {{ ($settings['paypal_mode'] ?? '') === 'live' ? 'checked' : '' }} class="text-acef-green focus:ring-acef-green">
                                <span class="text-sm text-gray-900 dark:text-white font-bold">Live</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Client ID</label>
                        <input type="password" name="paypal_client_id" value="{{ $settings['paypal_client_id'] ?? '' }}" 
                               class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-acef-green transition-all"
                               placeholder="AW...">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Secret Key</label>
                        <input type="password" name="paypal_client_secret" value="{{ $settings['paypal_client_secret'] ?? '' }}" 
                               class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-acef-green transition-all"
                               placeholder="EK...">
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-6 border-t border-gray-100 dark:border-gray-700">
                <p class="text-xs text-gray-500 italic">Sensitive credentials are stored securely and never exposed in the front-end source.</p>
                <button type="submit" class="px-8 py-3 bg-acef-green text-acef-dark font-black text-xs uppercase tracking-widest rounded-xl hover:bg-emerald-400 transition-all shadow-lg hover:shadow-emerald-500/20 transform hover:-translate-y-0.5">
                    Save API Configuration
                </button>
            </div>
        </form>
    </div>
</x-app-dashboard-layout>
