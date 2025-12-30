<div x-data="layoutData">
    <header
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 {{ request()->routeIs('home') ? 'bg-transparent py-4' : 'bg-acef-dark shadow-md py-4' }}"
        id="main-header" translate="no">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="flex items-center space-x-2">
                        <span class="text-acef-green font-bold text-3xl tracking-tighter">ACEF</span>
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:flex space-x-8 items-center text-white">
                    <a href="{{ route('home') }}"
                        class="hover:text-acef-green transition-colors font-medium">{{ __('navigation.home') }}</a>
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="hover:text-acef-green transition-colors font-medium flex items-center">
                            {{ __('navigation.about') }}
                            <svg class="w-4 h-4 ml-1 transition-transform" :class="open ? 'rotate-180' : ''" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <!-- Dropdown -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute top-full left-0 mt-2 w-56 bg-white rounded-2xl shadow-2xl border border-gray-50 p-3 z-50">
                            <a href="{{ route('about') }}"
                                class="block px-4 py-3 rounded-xl hover:bg-acef-green/5 hover:text-acef-green text-acef-dark transition-all font-bold text-xs uppercase tracking-widest">{{ __('navigation.who_we_are') }}</a>
                            <a href="{{ route('team') }}"
                                class="block px-4 py-3 rounded-xl hover:bg-acef-green/5 hover:text-acef-green text-acef-dark transition-all font-bold text-xs uppercase tracking-widest">{{ __('navigation.our_team') }}</a>
                            <a href="{{ route('partners') }}"
                                class="block px-4 py-3 rounded-xl hover:bg-acef-green/5 hover:text-acef-green text-acef-dark transition-all font-bold text-xs uppercase tracking-widest">{{ __('navigation.our_partners') }}</a>
                            <a href="{{ route('accreditations') }}"
                                class="block px-4 py-3 rounded-xl hover:bg-acef-green/5 hover:text-acef-green text-acef-dark transition-all font-bold text-xs uppercase tracking-widest">{{ __('navigation.accreditations') }}</a>
                        </div>
                    </div>
                    <a href="{{ route('programmes') }}"
                        class="hover:text-acef-green transition-colors font-medium">{{ __('navigation.programmes') }}</a>
                    <a href="{{ route('projects') }}"
                        class="hover:text-acef-green transition-colors font-medium">{{ __('navigation.projects') }}</a>
                    <a href="{{ route('impact') }}"
                        class="hover:text-acef-green transition-colors font-medium">{{ __('navigation.impact') }}</a>
                    <a href="{{ route('news') }}"
                        class="hover:text-acef-green transition-colors font-medium">{{ __('navigation.media') }}</a>
                    <a href="{{ route('get-involved') }}"
                        class="hover:text-acef-green transition-colors font-medium">{{ __('navigation.get_involved') }}</a>
                    <a href="{{ route('resources') }}"
                        class="hover:text-acef-green transition-colors font-medium">{{ __('navigation.resources') }}</a>
                </nav>

                <!-- Actions -->
                <div class="flex items-center space-x-4">
                    <div class="hidden sm:flex items-center space-x-4">
                        <!-- Dark Mode Toggle -->
                        <button @click="toggleDarkMode()"
                            class="p-2 rounded-full text-white hover:text-acef-green hover:bg-white/10 transition-all"
                            :title="darkMode ? '{{ __('pages.layout.header.theme_switch_light') }}' : '{{ __('pages.layout.header.theme_switch_dark') }}'">
                            <!-- Sun Icon -->
                            <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                            <!-- Moon Icon -->
                            <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                                </path>
                            </svg>
                        </button>

                        <!-- Language Switcher -->
                        <div class="relative" x-data="{ open: false, search: '' }">
                            <button @click="open = !open; $nextTick(() => $refs.langSearch.focus())"
                                class="text-white hover:text-acef-green transition-colors flex items-center space-x-1 group">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129">
                                    </path>
                                </svg>
                                <span class="font-bold text-sm uppercase notranslate">
                                    {{ strtoupper(app()->getLocale()) }}
                                </span>
                                <svg class="w-4 h-4 transition-transform group-hover:text-acef-green"
                                    :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <!-- Dropdown -->
                            <div x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                class="absolute top-full right-0 mt-4 w-64 bg-white dark:bg-acef-dark rounded-2xl shadow-2xl border border-gray-100 dark:border-gray-800 p-2 z-50 origin-top-right overflow-hidden">
                                
                                <!-- Search -->
                                <div class="px-2 pb-2 mb-2 border-b border-gray-100 dark:border-gray-700">
                                    <input x-ref="langSearch" x-model="search" type="text" placeholder="{{ __('pages.layout.header.search_language') }}" 
                                           class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-800 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-acef-green text-gray-700 dark:text-gray-200 placeholder-gray-400">
                                </div>

                                <div class="max-h-60 overflow-y-auto space-y-1 custom-scrollbar">
                                    @foreach(config('languages') as $code => $lang)
                                        @if(isset($lang['active']) && $lang['active'])
                                            <a href="{{ route('lang.switch', $code) }}" 
                                               x-show="search === '' || '{{ strtolower($lang['name']) }}'.includes(search.toLowerCase()) || '{{ strtolower($lang['native']) }}'.includes(search.toLowerCase())"
                                               class="w-full text-left px-3 py-2 rounded-lg hover:bg-acef-green/10 dark:hover:bg-acef-green/20 flex items-center justify-between group transition-colors {{ app()->getLocale() === $code ? 'bg-acef-green/5 dark:bg-acef-green/10' : '' }}">
                                                 <div class="flex flex-col notranslate">
                                                     <span class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">{{ $lang['native'] }}</span>
                                                     <span class="text-sm font-bold text-gray-700 dark:text-gray-200 group-hover:text-acef-dark dark:group-hover:text-white">{{ $lang['name'] }}</span>
                                                 </div>
                                                 @if(app()->getLocale() === $code)
                                                     <svg class="w-4 h-4 text-acef-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                 @else
                                                     <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 uppercase group-hover:text-acef-green opacity-0 group-hover:opacity-100 transition-opacity notranslate">{{ $code }}</span>
                                                 @endif
                                             </a>
                                         @endif
                                    @endforeach
                                </div>
                                <div class="mt-2 pt-2 border-t border-gray-100 dark:border-gray-700 text-center">
                                    <span class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest">{{ __('pages.layout.header.powered_by') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Search Button -->
                        <button @click="searchOpen = true" class="text-white hover:text-acef-green transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                    <a href="{{ route('donate') }}"
                        class="hidden sm:block bg-acef-green text-white px-8 py-3 rounded-full font-bold hover:bg-opacity-90 transition-all shadow-xl shadow-acef-green/20">
                        {{ __('buttons.donate') }}
                    </a>
                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenuOpen = true" class="md:hidden text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" @click="mobileMenuOpen = false"
        x-transition:enter="transition-opacity ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 md:hidden" style="display: none;">
    </div>

    <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false"
        x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
        class="fixed top-0 right-0 bottom-0 w-80 bg-acef-dark z-50 md:hidden overflow-y-auto" style="display: none;">
        <div class="p-6 space-y-8">
            <!-- Close Button -->
            <div class="flex justify-between items-center">
                <span class="text-acef-green font-bold text-3xl tracking-tighter">ACEF</span>
                <button @click="mobileMenuOpen = false" class="text-white hover:text-acef-green transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Navigation Links -->
            <nav class="space-y-2">
                <a href="{{ route('home') }}"
                    class="block px-4 py-3 text-white hover:text-acef-green hover:bg-white/5 rounded-xl transition-all font-medium">{{ __('navigation.home') }}</a>

                <!-- About Accordion -->
                <div x-data="{ aboutOpen: false }">
                    <button @click="aboutOpen = !aboutOpen"
                        class="w-full flex justify-between items-center px-4 py-3 text-white hover:text-acef-green hover:bg-white/5 rounded-xl transition-all font-medium">
                        <span>{{ __('navigation.about') }}</span>
                        <svg class="w-5 h-5 transition-transform" :class="aboutOpen ? 'rotate-180' : ''" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="aboutOpen" x-transition class="ml-4 mt-2 space-y-1">
                        <a href="{{ route('about') }}"
                            class="block px-4 py-2 text-white/70 hover:text-acef-green text-sm">{{ __('navigation.who_we_are') }}</a>
                        <a href="{{ route('team') }}"
                            class="block px-4 py-2 text-white/70 hover:text-acef-green text-sm">{{ __('navigation.our_team') }}</a>
                        <a href="{{ route('partners') }}"
                            class="block px-4 py-2 text-white/70 hover:text-acef-green text-sm">{{ __('navigation.our_partners') }}</a>
                        <a href="{{ route('accreditations') }}"
                            class="block px-4 py-2 text-white/70 hover:text-acef-green text-sm">{{ __('navigation.accreditations') }}</a>
                    </div>
                </div>

                <a href="{{ route('programmes') }}"
                    class="block px-4 py-3 text-white hover:text-acef-green hover:bg-white/5 rounded-xl transition-all font-medium">{{ __('navigation.programmes') }}</a>
                <a href="{{ route('projects') }}"
                    class="block px-4 py-3 text-white hover:text-acef-green hover:bg-white/5 rounded-xl transition-all font-medium">{{ __('navigation.projects') }}</a>
                <a href="{{ route('impact') }}"
                    class="block px-4 py-3 text-white hover:text-acef-green hover:bg-white/5 rounded-xl transition-all font-medium">{{ __('navigation.impact') }}</a>
                <a href="{{ route('news') }}"
                    class="block px-4 py-3 text-white hover:text-acef-green hover:bg-white/5 rounded-xl transition-all font-medium">{{ __('navigation.media') }}</a>
                <a href="{{ route('resources') }}"
                    class="block px-4 py-3 text-white hover:text-acef-green hover:bg-white/5 rounded-xl transition-all font-medium">{{ __('navigation.resources') }}</a>
                <a href="{{ route('contact') }}"
                    class="block px-4 py-3 text-white hover:text-acef-green hover:bg-white/5 rounded-xl transition-all font-medium">{{ __('navigation.contact') }}</a>
            </nav>

            <!-- Dark Mode Mobile Toggle -->
            <div class="px-4 py-3 flex items-center justify-between text-white border-t border-white/10">
                <span class="font-medium">{{ __('pages.layout.header.theme_label') }}</span>
                <button @click="toggleDarkMode()" class="p-2 bg-white/10 rounded-lg">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                    <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Actions -->
            <div class="space-y-4 pt-4 border-t border-white/10">
                <a href="{{ route('donate') }}"
                    class="block w-full bg-acef-green text-white px-6 py-4 rounded-full font-bold hover:bg-opacity-90 transition-all shadow-xl text-center">
                    {{ __('buttons.donate_now') }}
                </a>
                <a href="{{ route('get-involved') }}"
                    class="block w-full bg-white/10 text-white px-6 py-4 rounded-full font-bold hover:bg-white/20 transition-all text-center">
                    {{ __('buttons.get_involved') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Search Modal -->
    <div x-show="searchOpen" @click="searchOpen = false" x-transition:enter="transition-opacity ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-acef-dark/95 backdrop-blur-md z-50 flex items-start justify-center pt-32"
        style="display: none;">
        <div @click.stop class="w-full max-w-3xl px-4">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-2">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" placeholder="{{ __('pages.layout.header.search_placeholder') }}"
                        class="w-full px-6 py-6 text-lg focus:outline-none bg-transparent dark:text-white"
                        x-ref="searchInput">
                    <button @click="searchOpen = false"
                        class="mr-4 text-gray-400 hover:text-acef-dark dark:hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <p class="text-white/60 text-sm text-center mt-4">{{ __('pages.common.press_esc_to_close') }}</p>
        </div>
    </div>
</div>

<script>
    const isHome = {{ request()->routeIs('home') ? 'true' : 'false' }};
    const header = document.getElementById('main-header');

    window.addEventListener('scroll', function () {
        if (isHome) {
            if (window.scrollY > 50) {
                header.classList.remove('bg-transparent', 'py-4');
                header.classList.add('bg-acef-dark/95', 'backdrop-blur-sm', 'py-2', 'shadow-xl');
            } else {
                header.classList.add('bg-transparent', 'py-4');
                header.classList.remove('bg-acef-dark/95', 'backdrop-blur-sm', 'py-2', 'shadow-xl');
            }
        } else {
            if (window.scrollY > 50) {
                header.classList.remove('py-4', 'bg-acef-dark');
                header.classList.add('bg-acef-dark/95', 'backdrop-blur-sm', 'py-2', 'shadow-xl');
            } else {
                header.classList.add('py-4', 'bg-acef-dark');
                header.classList.remove('bg-acef-dark/95', 'backdrop-blur-sm', 'py-2', 'shadow-xl');
            }
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            const event = new CustomEvent('close-search');
            window.dispatchEvent(event);
        }
    });

    // Unified Layout Data
    document.addEventListener('alpine:init', () => {
        Alpine.data('layoutData', () => ({
            mobileMenuOpen: false,
            searchOpen: false,
            darkMode: localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),

            init() {
                // Watch for dark mode changes
                this.$watch('darkMode', val => {
                    localStorage.theme = val ? 'dark' : 'light';
                    if (val) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                });

                // Initial check
                if (this.darkMode) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
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