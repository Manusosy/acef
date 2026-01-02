@php
    $generalSettings = \App\Models\Setting::getGroup('general');
    $siteName = $generalSettings['site_name'] ?? 'ACEF';
    $siteLogo = $generalSettings['site_logo'] ?? null;
    $siteLogoDark = $generalSettings['site_logo_dark'] ?? null;
@endphp

<footer class="bg-acef-dark text-white pt-20 pb-10" translate="no">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 border-b border-white/10 pb-16">
            <!-- Brand & Social -->
            <div class="space-y-6">
                <a href="/" class="flex items-center space-x-2">
                    @if($siteLogoDark)
                        <img src="{{ Storage::url($siteLogoDark) }}" alt="{{ $siteName }}" class="h-10 w-auto object-contain">
                    @elseif($siteLogo)
                        <img src="{{ Storage::url($siteLogo) }}" alt="{{ $siteName }}" class="h-10 w-auto object-contain grayscale invert brightness-200">
                    @else
                        <span class="text-acef-green font-bold text-3xl tracking-tighter italic">{{ $siteName }}</span>
                    @endif
                </a>
                <p class="text-white/60 leading-relaxed font-light italic">
                    {{ __('pages.layout.footer.desc') }}
                </p>
                <div class="flex space-x-4">
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/share/172ZDMd2dL/" target="_blank" rel="noopener noreferrer"
                        class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-acef-green transition-colors text-white/80 hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </a>
                    <!-- X (Twitter) -->
                    <a href="https://x.com/ACEFngo?t=H00D4LR0XgHHRHS73lQ76A&s=09" target="_blank" rel="noopener noreferrer"
                        class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-acef-green transition-colors text-white/80 hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.045 4.126H5.078z" />
                        </svg>
                    </a>
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/acefngo?igsh=MXE3YXRmd2hvZ2xodg==" target="_blank" rel="noopener noreferrer"
                        class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-acef-green transition-colors text-white/80 hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm0 2h10c1.66 0 3 1.34 3 3v10c0 1.66-1.34 3-3 3H7c-1.66 0-3-1.34-3-3V7c0-1.66 1.34-3 3-3zm10 2a1 1 0 1 0 0 2 1 1 0 0 0 0-2zM12 7c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0 2c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3z"/>
                        </svg>
                    </a>
                    <!-- LinkedIn -->
                    <a href="https://www.linkedin.com/company/acef-africa-climate-and-environment-foundation/" target="_blank" rel="noopener noreferrer"
                        class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-acef-green transition-colors text-white/80 hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                        </svg>
                    </a>
                    <!-- YouTube -->
                    <a href="https://www.youtube.com/@acef-africaclimateandenvir6363" target="_blank" rel="noopener noreferrer"
                        class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-acef-green transition-colors text-white/80 hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-semibold mb-6 uppercase tracking-wider">
                    {{ __('pages.layout.footer.quick_links') }}</h4>
                <ul class="space-y-4 text-white/60 font-medium">
                    <li><a href="{{ route('home') }}"
                            class="hover:text-acef-green transition-colors">{{ __('navigation.home') }}</a></li>
                    <li><a href="{{ route('about') }}"
                            class="hover:text-acef-green transition-colors">{{ __('navigation.about') }}</a></li>
                    <li><a href="{{ route('programmes') }}"
                            class="hover:text-acef-green transition-colors">{{ __('navigation.programmes') }}</a></li>
                    <li><a href="{{ route('projects') }}"
                            class="hover:text-acef-green transition-colors">{{ __('navigation.projects') }}</a></li>
                    <li><a href="{{ route('get-involved') }}"
                            class="hover:text-acef-green transition-colors">{{ __('navigation.get_involved') }}</a></li>
                    <li><a href="{{ route('contact') }}"
                            class="hover:text-acef-green transition-colors">{{ __('navigation.contact') }}</a></li>
                </ul>
            </div>

            <!-- Resources -->
            <div>
                <h4 class="text-lg font-semibold mb-6 uppercase tracking-wider">
                    {{ __('pages.layout.footer.resources') }}</h4>
                <ul class="space-y-4 text-white/60 font-medium">
                    <li><a href="{{ route('impact') }}"
                            class="hover:text-acef-green transition-colors">{{ __('navigation.impact_reports') }}</a></li>
                    <li><a href="{{ route('resources') }}"
                            class="hover:text-acef-green transition-colors">{{ __('navigation.knowledge_hub') }}</a></li>
                    <li><a href="{{ route('news') }}"
                            class="hover:text-acef-green transition-colors">{{ __('navigation.news_insights') }}</a>
                    </li>
                    <li><a href="{{ route('gallery') }}"
                            class="hover:text-acef-green transition-colors">{{ __('navigation.media_gallery') }}</a>
                    </li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h4 class="text-lg font-semibold mb-6 uppercase tracking-wider">
                    {{ __('pages.layout.footer.stay_updated') }}</h4>
                <p class="text-white/60 mb-6 font-light italic">{{ __('pages.layout.footer.newsletter_desc') }}</p>
                <form class="space-y-3">
                    <input type="email" placeholder="{{ __('pages.layout.footer.newsletter_placeholder') }}"
                        class="w-full bg-white/5 border border-white/10 rounded-full px-6 py-3 focus:outline-none focus:border-acef-green transition-colors text-white placeholder:text-white/20">
                    <button
                        class="w-full bg-acef-green py-3 rounded-full font-bold hover:bg-opacity-90 transition-all shadow-lg">{{ __('pages.layout.footer.subscribe_btn') }}</button>
                </form>
            </div>
        </div>

        <div class="pt-10 flex flex-col md:flex-row justify-between items-center text-white/40 text-sm font-light">
            <p>{{ __('pages.layout.footer.copyright', ['year' => '2025']) }}</p>
            <div class="flex space-x-6 mt-4 md:mt-0 font-medium">
                <a href="{{ route('privacy') }}"
                    class="hover:text-white transition-colors">{{ __('pages.layout.footer.privacy') }}</a>
                <a href="{{ route('terms') }}"
                    class="hover:text-white transition-colors">{{ __('pages.layout.footer.terms') }}</a>
                <a href="{{ route('cookies') }}"
                    class="hover:text-white transition-colors">{{ __('pages.layout.footer.cookies') }}</a>
            </div>
        </div>
    </div>
    
    {{-- Cookie Consent Banner --}}
    @include('components.cookie-consent')
</footer>