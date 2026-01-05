@php
    $generalSettings = \App\Models\Setting::getGroup('general');
    $apiSettings = \App\Models\Setting::getGroup('apis');
    $siteName = $generalSettings['site_name'] ?? 'ACEF';
    $siteLogo = $generalSettings['site_logo'] ?? null;
    $siteLogoDark = $generalSettings['site_logo_dark'] ?? null;
    $siteTagline = $generalSettings['site_tagline'] ?? null;
    $googleTranslateEnabled = $apiSettings['google_translate_enabled'] ?? false;
@endphp

<div x-data="layoutData" x-cloak>
    <header
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 ease-in-out"
        :class="scrolled ? 'bg-acef-dark/95 backdrop-blur-md shadow-lg py-2' : (isHome ? 'bg-gradient-to-b from-black/80 to-transparent py-4' : 'bg-acef-dark/90 backdrop-blur-sm py-3')"
        id="main-header" translate="no">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="flex flex-col lg:flex-row lg:items-center group">
                        <div class="flex items-center space-x-3">
                            @if($siteLogo)
                                <img src="{{ Storage::url($siteLogo) }}" alt="{{ $siteName }}" 
                                     x-show="!darkMode" class="h-10 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
                                @if($siteLogoDark)
                                    <img src="{{ Storage::url($siteLogoDark) }}" alt="{{ $siteName }}" 
                                         x-show="darkMode" class="h-10 w-auto object-contain transition-transform duration-300 group-hover:scale-105" style="display: none;">
                                @else
                                    <img src="{{ Storage::url($siteLogo) }}" alt="{{ $siteName }}" 
                                         x-show="darkMode" class="h-10 w-auto object-contain grayscale invert transition-transform duration-300 group-hover:scale-105" style="display: none;">
                                @endif
                            @else
                                <span class="text-acef-green font-black text-3xl tracking-tighter">{{ $siteName }}</span>
                            @endif
                        </div>
                        
                        @if($siteTagline)
                            <div class="hidden xl:block border-l border-white/20 pl-4 ml-4">
                                <p class="text-[9px] leading-tight text-white/50 font-bold uppercase tracking-[0.2em] max-w-[150px]">{{ $siteTagline }}</p>
                            </div>
                        @endif
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center gap-1 xl:gap-2 text-white">
                    <a href="{{ route('home') }}"
                        class="relative group px-3 py-2 text-xs xl:text-sm font-serif font-black uppercase tracking-[0.15em] text-white hover:text-acef-light-green transition-all">
                        {{ __('navigation.home') }}
                        <span class="absolute bottom-0 left-3 right-3 h-0.5 bg-acef-light-green transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></span>
                    </a>

                    <!-- Who We Are Dropdown -->
                    <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="relative px-3 py-2 text-xs xl:text-sm font-serif font-black uppercase tracking-[0.15em] text-white hover:text-acef-light-green transition-all flex items-center gap-1">
                            {{ __('navigation.about') }}
                            <svg class="w-3 h-3 text-acef-light-green transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div x-show="open" x-cloak
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2"
                             class="absolute top-full -left-4 w-56 pt-4 z-50">
                            <!-- Pointer Tip -->
                            <div class="absolute top-2 left-10 w-4 h-4 bg-white dark:bg-[#0A260A] border-t border-l border-gray-100 dark:border-white/10 rotate-45 translate-y-1"></div>
                            
                            <div class="relative bg-white dark:bg-[#0A260A] border border-gray-100 dark:border-white/10 rounded-xl shadow-2xl overflow-hidden backdrop-blur-xl">
                                <div class="py-2">
                                    <a href="{{ route('about') }}" class="block px-6 py-3 text-[17px] font-bold text-[#0A260A] dark:text-white hover:bg-acef-light-green hover:text-[#0A260A] transition-colors">
                                        {{ __('navigation.who_we_are') }}
                                    </a>
                                    <a href="{{ route('team') }}" class="block px-6 py-3 text-[17px] font-bold text-[#0A260A] dark:text-white hover:bg-acef-light-green hover:text-[#0A260A] transition-colors">
                                        {{ __('navigation.our_team') }}
                                    </a>
                                    <a href="{{ route('partners') }}" class="block px-6 py-3 text-[17px] font-bold text-[#0A260A] dark:text-white hover:bg-acef-light-green hover:text-[#0A260A] transition-colors">
                                        {{ __('navigation.our_partners') }}
                                    </a>
                                    <a href="{{ route('accreditations') }}" class="block px-6 py-3 text-[17px] font-bold text-[#0A260A] dark:text-white hover:bg-acef-light-green hover:text-[#0A260A] transition-colors">
                                        {{ __('navigation.accreditations') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Our Work Mega Menu -->
                    <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="relative px-3 py-2 text-xs xl:text-sm font-serif font-black uppercase tracking-[0.15em] text-white hover:text-acef-light-green transition-all flex items-center gap-1">
                            OUR WORK
                            <svg class="w-3 h-3 text-acef-light-green transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div x-show="open" x-cloak
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2"
                             class="absolute top-full -left-20 w-[600px] pt-4 z-50">
                            <!-- Pointer Tip -->
                            <div class="absolute top-2 left-28 w-4 h-4 bg-white dark:bg-[#0A260A] border-t border-l border-gray-100 dark:border-white/10 rotate-45 translate-y-1"></div>
                            
                            <div class="relative bg-white dark:bg-[#0A260A] border border-gray-100 dark:border-white/10 rounded-2xl shadow-2xl overflow-hidden backdrop-blur-xl">
                                <div class="grid grid-cols-3 divide-x divide-gray-100 dark:divide-white/5">
                                    <!-- Programmes -->
                                    <div class="p-6 h-full flex flex-col">
                                        <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-acef-green dark:text-acef-light-green mb-4">Focus Areas</h4>
                                        <div class="space-y-3 flex-1 text-left">
                                            <a href="{{ route('programmes') }}" class="block text-[17px] font-bold text-[#0A260A] dark:text-white hover:text-acef-green dark:hover:text-acef-light-green transition-colors">
                                                {{ __('navigation.programmes') }}
                                            </a>
                                            <p class="text-[10px] text-gray-500 dark:text-gray-400 font-medium leading-relaxed">Systemic initiatives driving continental change.</p>
                                        </div>
                                    </div>

                                    <!-- Projects -->
                                    <div class="p-6 h-full flex flex-col">
                                        <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-acef-green dark:text-acef-light-green mb-4">On the Ground</h4>
                                        <div class="space-y-3 flex-1 text-left">
                                            <a href="{{ route('projects') }}" class="block text-[17px] font-bold text-[#0A260A] dark:text-white hover:text-acef-green dark:hover:text-acef-light-green transition-colors">
                                                {{ __('navigation.projects') }}
                                            </a>
                                            <p class="text-[10px] text-gray-500 dark:text-gray-400 font-medium leading-relaxed">Direct community interventions and conservation projects.</p>
                                        </div>
                                    </div>

                                    <!-- Impact -->
                                    <div class="p-6 h-full flex flex-col">
                                        <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-acef-green dark:text-acef-light-green mb-4">Our Achievement</h4>
                                        <div class="space-y-3 flex-1 text-left">
                                            <a href="{{ route('impact') }}" class="block text-[17px] font-bold text-[#0A260A] dark:text-white hover:text-acef-green dark:hover:text-acef-light-green transition-colors">
                                                {{ __('navigation.impact') }}
                                            </a>
                                            <p class="text-[10px] text-gray-500 dark:text-gray-400 font-medium leading-relaxed">Measuring our success and field results across Africa.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('get-involved') }}"
                        class="relative group px-3 py-2 text-xs xl:text-sm font-serif font-black uppercase tracking-[0.15em] text-white hover:text-acef-light-green transition-all">
                        {{ __('navigation.get_involved') }}
                        <span class="absolute bottom-0 left-3 right-3 h-0.5 bg-acef-light-green transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></span>
                    </a>

                    <!-- Resources Dropdown -->
                    <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="relative px-3 py-2 text-xs xl:text-sm font-serif font-black uppercase tracking-[0.15em] text-white hover:text-acef-light-green transition-all flex items-center gap-1">
                            {{ __('navigation.resources') }}
                            <svg class="w-3 h-3 text-acef-light-green transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div x-show="open" x-cloak
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2"
                             class="absolute top-full -left-4 w-56 pt-4 z-50">
                            <!-- Pointer Tip -->
                            <div class="absolute top-2 left-10 w-4 h-4 bg-white dark:bg-[#0A260A] border-t border-l border-gray-100 dark:border-white/10 rotate-45 translate-y-1"></div>
                            
                            <div class="relative bg-white dark:bg-[#0A260A] border border-gray-100 dark:border-white/10 rounded-xl shadow-2xl overflow-hidden backdrop-blur-xl">
                                <div class="py-2">
                                    <a href="{{ route('resources') }}" class="block px-6 py-3 text-[17px] font-bold text-[#0A260A] dark:text-white hover:bg-acef-light-green hover:text-[#0A260A] transition-colors">
                                        {{ __('navigation.knowledge_hub') }}
                                    </a>
                                    <a href="{{ route('news') }}" class="block px-6 py-3 text-[17px] font-bold text-[#0A260A] dark:text-white hover:bg-acef-light-green hover:text-[#0A260A] transition-colors">
                                        {{ __('navigation.news_insights') }}
                                    </a>
                                    <a href="{{ route('gallery') }}" class="block px-6 py-3 text-[17px] font-bold text-[#0A260A] dark:text-white hover:bg-acef-light-green hover:text-[#0A260A] transition-colors">
                                        {{ __('navigation.media_gallery') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Actions -->
                <div class="flex items-center gap-4">
                     <!-- Desktop Actions -->
                    <div class="hidden lg:flex items-center gap-1 xl:gap-2">
                        @if($googleTranslateEnabled)
                            <!-- Google Translate Widget -->
                            <div class="relative flex items-center h-10 px-2 group">
                                <div id="google_translate_element" class="opacity-0 absolute inset-0 z-10 w-full h-full cursor-pointer"></div>
                                <div class="flex items-center gap-2 text-white/70 group-hover:text-white transition-colors pointer-events-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 9.97 9.273 13.911 6 17" />
                                    </svg>
                                    <span class="text-[10px] font-bold uppercase tracking-widest hidden xl:block">Translate</span>
                                </div>
                            </div>
                        @endif

                        <!-- Dark Mode Toggle -->
                        <button @click="toggleDarkMode()"
                            class="w-8 h-8 xl:w-10 xl:h-10 rounded-full flex items-center justify-center text-white/70 hover:text-white hover:bg-white/10 transition-all"
                            :title="darkMode ? '{{ __('pages.layout.header.theme_switch_light') }}' : '{{ __('pages.layout.header.theme_switch_dark') }}'">
                            <svg x-show="!darkMode" class="w-4 h-4 xl:w-5 xl:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            <svg x-show="darkMode" class="w-4 h-4 xl:w-5 xl:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                        </button>

                        <!-- Search Button -->
                         <button @click="searchOpen = true" class="w-8 h-8 xl:w-10 xl:h-10 rounded-full flex items-center justify-center text-white/70 hover:text-white hover:bg-white/10 transition-all">
                            <svg class="w-4 h-4 xl:w-5 xl:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>

                        <!-- User Account Dropdown -->
                        <div class="relative" x-data="{ userMenuOpen: false }" @click.away="userMenuOpen = false">
                            @auth
                                <button @click="userMenuOpen = !userMenuOpen" 
                                    class="w-8 h-8 xl:w-10 xl:h-10 rounded-full flex items-center justify-center text-white/70 hover:text-white hover:bg-white/10 transition-all">
                                    <svg class="w-4 h-4 xl:w-5 xl:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </button>


                                <!-- Dropdown Menu -->
                                <div x-show="userMenuOpen" 
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"
                                    class="absolute right-0 mt-4 w-64 bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden z-50"
                                    style="display: none;">
                                    
                                    <!-- User Info -->
                                    <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
                                        <p class="text-sm font-bold text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                                    </div>

                                    <!-- Menu Items -->
                                    <div class="py-1">
                                        <a href="{{ route('admin.dashboard') }}" 
                                            class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                            </svg>
                                            Dashboard
                                        </a>
                                        
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" 
                                                class="w-full flex items-center px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                                </svg>
                                                Sign Out
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <button @click="userMenuOpen = !userMenuOpen" 
                                    class="w-10 h-10 rounded-full flex items-center justify-center text-white/70 hover:text-white hover:bg-white/10 transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </button>

                                <!-- Guest Dropdown -->
                                <div x-show="userMenuOpen" 
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"
                                    class="absolute right-0 mt-4 w-48 bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden z-50"
                                    style="display: none;">
                                    
                                    <div class="py-1">
                                        <a href="{{ route('login') }}" 
                                            class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                            </svg>
                                            Login
                                        </a>
                                        <a href="{{ route('register') }}" 
                                            class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                            </svg>
                                            Register
                                        </a>
                                    </div>
                                </div>
                            @endauth
                        </div>

                        <!-- Donate Button -->
                        <a href="{{ route('donate') }}"
                            class="ml-2 xl:ml-4 bg-acef-gold text-[#0A260A] px-4 xl:px-6 py-2.5 rounded-xl font-black text-[10px] xl:text-xs uppercase tracking-widest hover:bg-white hover:text-acef-green transition-all shadow-lg hover:shadow-acef-gold/50 transform hover:-translate-y-0.5">
                            {{ __('buttons.donate') }}
                        </a>
                    </div>
                    
                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenuOpen = true" class="lg:hidden text-white p-2">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" x-cloak
        class="fixed inset-0 z-[60] lg:hidden">
        
        <!-- Backdrop -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition-opacity ease-out duration-300" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100" 
             x-transition:leave="transition-opacity ease-in duration-200" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0"
             @click="mobileMenuOpen = false"
             class="absolute inset-0 bg-black/80 backdrop-blur-md">
        </div>

        <!-- Sidebar -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-300 transform" 
             x-transition:enter-start="translate-x-full" 
             x-transition:enter-end="translate-x-0" 
             x-transition:leave="transition ease-in duration-200 transform" 
             x-transition:leave-start="translate-x-0" 
             x-transition:leave-end="translate-x-full"
             class="absolute right-0 top-0 bottom-0 w-80 bg-acef-dark border-l border-white/10 shadow-2xl overflow-y-auto">
            
            <div class="p-6 space-y-8">
                <!-- Header -->
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-3">
                        @if($siteLogo)
                            <img src="{{ Storage::url($siteLogo) }}" alt="{{ $siteName }}" 
                                 x-show="!darkMode" class="h-10 w-auto object-contain">
                            @if($siteLogoDark)
                                <img src="{{ Storage::url($siteLogoDark) }}" alt="{{ $siteName }}" 
                                     x-show="darkMode" class="h-10 w-auto object-contain" style="display: none;">
                            @else
                                <img src="{{ Storage::url($siteLogo) }}" alt="{{ $siteName }}" 
                                     x-show="darkMode" class="h-10 w-auto object-contain grayscale invert" style="display: none;">
                            @endif
                        @else
                            <span class="text-acef-green font-black text-2xl tracking-tighter">{{ $siteName }}</span>
                        @endif
                    </div>
                    <button @click="mobileMenuOpen = false" class="text-white/70 hover:text-white transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <!-- Nav -->
                <nav class="space-y-1">
                    <a href="{{ route('home') }}" class="block px-4 py-3 text-white font-bold hover:bg-white/5 rounded-xl transition-colors">{{ __('navigation.home') }}</a>
                    
                    <div x-data="{ expanded: false }" class="space-y-1">
                        <button @click="expanded = !expanded" class="w-full flex justify-between items-center px-4 py-3 text-white font-bold hover:bg-white/5 rounded-xl transition-colors">
                            <span>{{ __('navigation.about') }}</span>
                            <svg class="w-4 h-4 transition-transform" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="expanded" x-collapse class="pl-4 space-y-1">
                            <a href="{{ route('about') }}" class="block px-4 py-2 text-white/60 hover:text-acef-light-green text-sm font-medium">{{ __('navigation.who_we_are') }}</a>
                            <a href="{{ route('team') }}" class="block px-4 py-2 text-white/60 hover:text-acef-light-green text-sm font-medium">{{ __('navigation.our_team') }}</a>
                            <a href="{{ route('partners') }}" class="block px-4 py-2 text-white/60 hover:text-acef-light-green text-sm font-medium">{{ __('navigation.our_partners') }}</a>
                            <a href="{{ route('accreditations') }}" class="block px-4 py-2 text-white/60 hover:text-acef-light-green text-sm font-medium">{{ __('navigation.accreditations') }}</a>
                        </div>
                    </div>

                    <div x-data="{ expanded: false }" class="space-y-1">
                        <button @click="expanded = !expanded" class="w-full flex justify-between items-center px-4 py-3 text-white font-bold hover:bg-white/5 rounded-xl transition-colors">
                            <span>OUR WORK</span>
                            <svg class="w-4 h-4 transition-transform" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="expanded" x-collapse class="pl-4 space-y-1">
                            <a href="{{ route('programmes') }}" class="block px-4 py-2 text-white/60 hover:text-acef-light-green text-sm font-medium">{{ __('navigation.programmes') }}</a>
                            <a href="{{ route('projects') }}" class="block px-4 py-2 text-white/60 hover:text-acef-light-green text-sm font-medium">{{ __('navigation.projects') }}</a>
                            <a href="{{ route('impact') }}" class="block px-4 py-2 text-white/60 hover:text-acef-light-green text-sm font-medium">{{ __('navigation.impact') }}</a>
                        </div>
                    </div>
                    
                    <div x-data="{ expanded: false }" class="space-y-1">
                        <button @click="expanded = !expanded" class="w-full flex justify-between items-center px-4 py-3 text-white font-bold hover:bg-white/5 rounded-xl transition-colors">
                            <span>{{ __('navigation.resources') }}</span>
                            <svg class="w-4 h-4 transition-transform" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="expanded" x-collapse class="pl-4 space-y-1">
                            <a href="{{ route('resources') }}" class="block px-4 py-2 text-white/60 hover:text-acef-light-green text-sm font-medium">{{ __('navigation.knowledge_hub') }}</a>
                            <a href="{{ route('news') }}" class="block px-4 py-2 text-white/60 hover:text-acef-light-green text-sm font-medium">{{ __('navigation.news_insights') }}</a>
                            <a href="{{ route('gallery') }}" class="block px-4 py-2 text-white/60 hover:text-acef-light-green text-sm font-medium">{{ __('navigation.media_gallery') }}</a>
                        </div>
                    </div>

                    <a href="{{ route('get-involved') }}" class="block px-4 py-3 text-white font-bold hover:bg-white/5 rounded-xl transition-colors">{{ __('navigation.get_involved') }}</a>
                    <a href="{{ route('contact') }}" class="block px-4 py-3 text-white font-bold hover:bg-white/5 rounded-xl transition-colors">{{ __('navigation.contact') }}</a>
                </nav>

                <!-- Actions -->
                <div class="space-y-3 pt-6 border-t border-white/10">
                     <div class="flex items-center justify-between px-4 pb-4">
                        <span class="text-sm font-medium text-white/60">Theme</span>
                        <button @click="toggleDarkMode()" class="p-2 bg-white/5 rounded-lg text-white">
                             <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                             <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                        </button>
                    </div>

                    <a href="{{ route('donate') }}" class="block w-full py-4 bg-acef-gold text-[#0A260A] font-black text-center text-sm uppercase tracking-widest rounded-xl hover:bg-white hover:text-acef-green transition-colors shadow-lg">
                        {{ __('buttons.donate') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    
     <!-- Search Modal (Same as before but refined) -->
    <div x-show="searchOpen" x-cloak
        class="fixed inset-0 bg-acef-dark/95 backdrop-blur-xl z-[70] flex items-start justify-center pt-32"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        
        <div class="w-full max-w-4xl px-4" @click.away="searchOpen = false">
            <div class="relative">
                <form action="{{ route('search') }}" method="GET">
                    <input type="text" name="q" 
                           class="w-full bg-transparent border-b-2 border-white/20 px-8 py-6 text-3xl md:text-5xl font-black text-white focus:outline-none focus:border-acef-light-green placeholder-white/20 transition-colors"
                           placeholder="{{ __('pages.layout.header.search_placeholder') }}"
                           x-ref="searchInput"
                           @keydown.escape.window="searchOpen = false">
                </form>
                <button @click="searchOpen = false" class="absolute right-0 top-1/2 -translate-y-1/2 text-white/40 hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <p class="mt-4 text-center text-white/40 font-mono text-sm uppercase tracking-widest">{{ __('pages.common.press_esc_to_close') }}</p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('layoutData', () => ({
            mobileMenuOpen: false,
            searchOpen: false,
            darkMode: localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
            scrolled: false,
            isHome: {{ request()->routeIs('home') ? 'true' : 'false' }},

            init() {
                // Scroll handler
                window.addEventListener('scroll', () => {
                    this.scrolled = window.scrollY > 20;
                });

                // Dark mode watcher
                this.$watch('darkMode', val => {
                    localStorage.theme = val ? 'dark' : 'light';
                    document.documentElement.classList.toggle('dark', val);
                });

                // Initial dark mode set
                document.documentElement.classList.toggle('dark', this.darkMode);

                // Watch search open to focus
                this.$watch('searchOpen', value => {
                    if (value) {
                         this.$nextTick(() => {
                            this.$refs.searchInput.focus();
                        });
                    }
                });
            },

            toggleDarkMode() {
                this.darkMode = !this.darkMode;
            }
        }));
    });

    @if($googleTranslateEnabled)
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'fr,sw,es,de,pt,ar,zh-CN',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                autoDisplay: false
            }, 'google_translate_element');
        }
    @endif
</script>

@if($googleTranslateEnabled)
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
@endif


<style>
    /* DARK MODE GLOBAL OVERRIDES */
    html.dark body {
        background-color: #111827;
        /* gray-900 */
        color: #F3F4F6;
        /* gray-100 */
    }

    html.dark .bg-white {
        background-color: #1F2937;
        /* gray-800 */
        color: #F3F4F6;
    }

    html.dark .text-acef-dark {
        color: #F9FAFB;
        /* gray-50 */
    }

    html.dark .bg-acef-gray {
        background-color: #111827;
        /* gray-900 */
        border-color: #374151;
        /* gray-700 */
    }

    html.dark .text-gray-600,
    html.dark .text-gray-500,
    html.dark .text-gray-800 {
        color: #9CA3AF;
        /* gray-400 */
    }

    html.dark .border-gray-100,
    html.dark .border-gray-200 {
        border-color: #374151;
    }

    html.dark .shadow-xl {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5), 0 10px 10px -5px rgba(0, 0, 0, 0.5);
    }
</style>