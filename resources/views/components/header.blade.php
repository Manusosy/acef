@php
    $generalSettings = \App\Models\Setting::getGroup('general');
    $siteName = $generalSettings['site_name'] ?? 'ACEF';
    $siteLogo = $generalSettings['site_logo'] ?? null;
    $siteLogoDark = $generalSettings['site_logo_dark'] ?? null;
    $siteTagline = $generalSettings['site_tagline'] ?? null;
@endphp

<div x-data="layoutData" x-cloak>
    <header
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 ease-in-out"
        :class="scrolled ? 'bg-acef-dark/90 backdrop-blur-md shadow-lg py-3' : (isHome ? 'bg-transparent py-5' : 'bg-acef-dark py-4')"
        id="main-header" translate="no">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
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
                <nav class="hidden lg:flex items-center gap-6 xl:gap-8 text-white">
                    <a href="{{ route('home') }}"
                        class="relative group py-2 text-sm font-bold uppercase tracking-wider text-white/80 hover:text-white transition-colors">
                        {{ __('navigation.home') }}
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-acef-green transition-all duration-300 group-hover:w-full"></span>
                    </a>

                    <!-- About Dropdown -->
                    <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="relative py-2 text-sm font-bold uppercase tracking-wider text-white/80 hover:text-white transition-colors flex items-center gap-1">
                            {{ __('navigation.about') }}
                            <svg class="w-3 h-3 text-acef-green transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <!-- Premium Dropdown Card -->
                        <div x-show="open" x-cloak
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2"
                             class="absolute top-full -left-4 w-64 pt-4 z-50">
                            <div class="bg-white dark:bg-acef-dark border border-gray-100 dark:border-white/10 rounded-2xl shadow-2xl overflow-hidden backdrop-blur-xl">
                                <div class="px-1 py-1">
                                    <a href="{{ route('about') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                        <div class="w-8 h-8 rounded-lg bg-acef-green/10 flex items-center justify-center text-acef-green group-hover:bg-acef-green group-hover:text-acef-dark transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-black uppercase tracking-wider text-acef-dark dark:text-white">{{ __('navigation.who_we_are') }}</p>
                                        </div>
                                    </a>
                                    <a href="{{ route('team') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                        <div class="w-8 h-8 rounded-lg bg-acef-green/10 flex items-center justify-center text-acef-green group-hover:bg-acef-green group-hover:text-acef-dark transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-black uppercase tracking-wider text-acef-dark dark:text-white">{{ __('navigation.our_team') }}</p>
                                        </div>
                                    </a>
                                    <a href="{{ route('partners') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                        <div class="w-8 h-8 rounded-lg bg-acef-green/10 flex items-center justify-center text-acef-green group-hover:bg-acef-green group-hover:text-acef-dark transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-black uppercase tracking-wider text-acef-dark dark:text-white">{{ __('navigation.our_partners') }}</p>
                                        </div>
                                    </a>
                                    <a href="{{ route('accreditations') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                        <div class="w-8 h-8 rounded-lg bg-acef-green/10 flex items-center justify-center text-acef-green group-hover:bg-acef-green group-hover:text-acef-dark transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-black uppercase tracking-wider text-acef-dark dark:text-white">{{ __('navigation.accreditations') }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('programmes') }}"
                        class="relative group py-2 text-sm font-bold uppercase tracking-wider text-white/80 hover:text-white transition-colors">
                        {{ __('navigation.programmes') }}
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-acef-green transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    
                    <a href="{{ route('projects') }}"
                        class="relative group py-2 text-sm font-bold uppercase tracking-wider text-white/80 hover:text-white transition-colors">
                        {{ __('navigation.projects') }}
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-acef-green transition-all duration-300 group-hover:w-full"></span>
                    </a>

                    <a href="{{ route('impact') }}"
                        class="relative group py-2 text-sm font-bold uppercase tracking-wider text-white/80 hover:text-white transition-colors">
                        {{ __('navigation.impact') }}
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-acef-green transition-all duration-300 group-hover:w-full"></span>
                    </a>

                    <a href="{{ route('get-involved') }}"
                        class="relative group py-2 text-sm font-bold uppercase tracking-wider text-white/80 hover:text-white transition-colors">
                        {{ __('navigation.get_involved') }}
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-acef-green transition-all duration-300 group-hover:w-full"></span>
                    </a>

                     <!-- Resources Dropdown -->
                     <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="relative py-2 text-sm font-bold uppercase tracking-wider text-white/80 hover:text-white transition-colors flex items-center gap-1">
                            {{ __('navigation.resources') }}
                            <svg class="w-3 h-3 text-acef-green transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <!-- Premium Dropdown Card -->
                        <div x-show="open" x-cloak
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2"
                             class="absolute top-full -left-4 w-60 pt-4 z-50">
                            <div class="bg-white dark:bg-acef-dark border border-gray-100 dark:border-white/10 rounded-2xl shadow-2xl overflow-hidden backdrop-blur-xl">
                                <div class="px-1 py-1">
                                    <a href="{{ route('resources') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                        <div class="w-8 h-8 rounded-lg bg-acef-green/10 flex items-center justify-center text-acef-green group-hover:bg-acef-green group-hover:text-acef-dark transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-black uppercase tracking-wider text-acef-dark dark:text-white">{{ __('navigation.knowledge_hub') }}</p>
                                        </div>
                                    </a>
                                    <a href="{{ route('news') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                        <div class="w-8 h-8 rounded-lg bg-acef-green/10 flex items-center justify-center text-acef-green group-hover:bg-acef-green group-hover:text-acef-dark transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-black uppercase tracking-wider text-acef-dark dark:text-white">{{ __('navigation.news_insights') }}</p>
                                        </div>
                                    </a>
                                     <a href="{{ route('gallery') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                        <div class="w-8 h-8 rounded-lg bg-acef-green/10 flex items-center justify-center text-acef-green group-hover:bg-acef-green group-hover:text-acef-dark transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-black uppercase tracking-wider text-acef-dark dark:text-white">{{ __('navigation.media_gallery') }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Actions -->
                <div class="flex items-center gap-4">
                     <!-- Desktop Actions -->
                    <div class="hidden lg:flex items-center gap-2">
                        <!-- Dark Mode Toggle -->
                        <button @click="toggleDarkMode()"
                            class="w-10 h-10 rounded-full flex items-center justify-center text-white/70 hover:text-white hover:bg-white/10 transition-all"
                            :title="darkMode ? '{{ __('pages.layout.header.theme_switch_light') }}' : '{{ __('pages.layout.header.theme_switch_dark') }}'">
                            <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                        </button>

                        <!-- Search Button -->
                         <button @click="searchOpen = true" class="w-10 h-10 rounded-full flex items-center justify-center text-white/70 hover:text-white hover:bg-white/10 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>

                        <!-- Donate Button -->
                        <a href="{{ route('donate') }}"
                            class="ml-2 bg-acef-green text-acef-dark px-6 py-2.5 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-white transition-all shadow-lg hover:shadow-acef-green/50 transform hover:-translate-y-0.5">
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
                    <span class="text-acef-green font-black text-2xl tracking-tighter">{{ $siteName }}</span>
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
                            <a href="{{ route('about') }}" class="block px-4 py-2 text-white/60 hover:text-acef-green text-sm font-medium">{{ __('navigation.who_we_are') }}</a>
                            <a href="{{ route('team') }}" class="block px-4 py-2 text-white/60 hover:text-acef-green text-sm font-medium">{{ __('navigation.our_team') }}</a>
                            <a href="{{ route('partners') }}" class="block px-4 py-2 text-white/60 hover:text-acef-green text-sm font-medium">{{ __('navigation.our_partners') }}</a>
                            <a href="{{ route('accreditations') }}" class="block px-4 py-2 text-white/60 hover:text-acef-green text-sm font-medium">{{ __('navigation.accreditations') }}</a>
                        </div>
                    </div>

                    <a href="{{ route('programmes') }}" class="block px-4 py-3 text-white font-bold hover:bg-white/5 rounded-xl transition-colors">{{ __('navigation.programmes') }}</a>
                    <a href="{{ route('projects') }}" class="block px-4 py-3 text-white font-bold hover:bg-white/5 rounded-xl transition-colors">{{ __('navigation.projects') }}</a>
                    <a href="{{ route('impact') }}" class="block px-4 py-3 text-white font-bold hover:bg-white/5 rounded-xl transition-colors">{{ __('navigation.impact') }}</a>
                    
                    <div x-data="{ expanded: false }" class="space-y-1">
                        <button @click="expanded = !expanded" class="w-full flex justify-between items-center px-4 py-3 text-white font-bold hover:bg-white/5 rounded-xl transition-colors">
                            <span>{{ __('navigation.resources') }}</span>
                            <svg class="w-4 h-4 transition-transform" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="expanded" x-collapse class="pl-4 space-y-1">
                            <a href="{{ route('resources') }}" class="block px-4 py-2 text-white/60 hover:text-acef-green text-sm font-medium">{{ __('navigation.knowledge_hub') }}</a>
                            <a href="{{ route('news') }}" class="block px-4 py-2 text-white/60 hover:text-acef-green text-sm font-medium">{{ __('navigation.news_insights') }}</a>
                            <a href="{{ route('gallery') }}" class="block px-4 py-2 text-white/60 hover:text-acef-green text-sm font-medium">{{ __('navigation.media_gallery') }}</a>
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

                    <a href="{{ route('donate') }}" class="block w-full py-4 bg-acef-green text-acef-dark font-black text-center text-sm uppercase tracking-widest rounded-xl hover:bg-white transition-colors shadow-lg">
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
                           class="w-full bg-transparent border-b-2 border-white/20 px-8 py-6 text-3xl md:text-5xl font-black text-white focus:outline-none focus:border-acef-green placeholder-white/20 transition-colors"
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
</script>


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
        color: #F9FAFB !important;
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