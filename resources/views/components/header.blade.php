<div x-data="layoutData">
    <header
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 {{ request()->routeIs('home') ? 'bg-transparent py-4' : 'bg-acef-dark shadow-md py-4' }}"
        id="main-header">
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
                    <a href="{{ route('home') }}" class="hover:text-acef-green transition-colors font-medium">Home</a>
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="hover:text-acef-green transition-colors font-medium flex items-center">
                            About
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
                                class="block px-4 py-3 rounded-xl hover:bg-acef-green/5 hover:text-acef-green text-acef-dark transition-all font-bold text-xs uppercase tracking-widest">Who
                                We Are</a>
                            <a href="{{ route('team') }}"
                                class="block px-4 py-3 rounded-xl hover:bg-acef-green/5 hover:text-acef-green text-acef-dark transition-all font-bold text-xs uppercase tracking-widest">Our
                                Team</a>
                            <a href="{{ route('partners') }}"
                                class="block px-4 py-3 rounded-xl hover:bg-acef-green/5 hover:text-acef-green text-acef-dark transition-all font-bold text-xs uppercase tracking-widest">Our
                                Partners</a>
                            <a href="{{ route('accreditations') }}"
                                class="block px-4 py-3 rounded-xl hover:bg-acef-green/5 hover:text-acef-green text-acef-dark transition-all font-bold text-xs uppercase tracking-widest">Accreditations</a>
                        </div>
                    </div>
                    <a href="{{ route('programmes') }}"
                        class="hover:text-acef-green transition-colors font-medium">Programmes</a>
                    <a href="{{ route('projects') }}"
                        class="hover:text-acef-green transition-colors font-medium">Projects</a>
                    <a href="{{ route('impact') }}"
                        class="hover:text-acef-green transition-colors font-medium">Impact</a>
                    <a href="{{ route('news') }}" class="hover:text-acef-green transition-colors font-medium">Media</a>
                    <a href="{{ route('resources') }}"
                        class="hover:text-acef-green transition-colors font-medium">Resources</a>
                </nav>

                <!-- Actions -->
                <div class="flex items-center space-x-4">
                    <div class="hidden sm:flex items-center space-x-4">
                        <!-- Dark Mode Toggle -->
                        <button @click="toggleDarkMode()" 
                                class="p-2 rounded-full text-white hover:text-acef-green hover:bg-white/10 transition-all"
                                :title="darkMode ? 'Switch to Light Mode' : 'Switch to Dark Mode'">
                            <!-- Sun Icon -->
                            <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                            <!-- Moon Icon -->
                            <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                                </path>
                            </svg>
                        </button>

                        <!-- Language Switcher -->
                        <div class="relative" x-data="{ open: false, search: '', languages: window.getAllLanguages() }">
                            <button @click="open = !open; $nextTick(() => $refs.langSearch.focus())"
                                class="text-white hover:text-acef-green transition-colors flex items-center space-x-1 group">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129">
                                    </path>
                                </svg>
                                <span class="font-bold text-sm uppercase notranslate"
                                    x-text="getCookie('googtrans')?.split('/')[2]?.toUpperCase() || 'EN'"></span>
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
                                class="absolute top-full right-0 mt-4 w-64 bg-white dark:bg-acef-dark rounded-2xl shadow-2xl border border-gray-100 dark:border-gray-800 p-4 z-50 origin-top-right">

                                <!-- Search -->
                                <div class="relative mb-3">
                                    <input x-ref="langSearch" x-model="search" type="text"
                                        placeholder="Search language..."
                                        class="w-full bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-acef-green text-acef-dark dark:text-white font-bold placeholder:font-normal placeholder:text-gray-400">
                                    <svg class="w-4 h-4 absolute right-3 top-1/2 -translate-y-1/2 text-gray-400"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>

                                <!-- List -->
                                <div class="max-h-60 overflow-y-auto space-y-1 pr-1 custom-scrollbar">
                                    <template
                                        x-for="lang in languages.filter(l => l.name.toLowerCase().includes(search.toLowerCase()))"
                                        :key="lang.code">
                                        <button @click="setLanguage(lang.code)"
                                            class="w-full text-left px-3 py-2 rounded-lg hover:bg-acef-green/10 dark:hover:bg-acef-green/20 flex items-center justify-between group transition-colors">
                                            <span class="text-sm font-bold text-gray-600 dark:text-gray-300 group-hover:text-acef-dark dark:group-hover:text-white"
                                                x-text="lang.name"></span>
                                            <span
                                                class="text-[10px] font-bold text-gray-300 dark:text-gray-600 uppercase group-hover:text-acef-green"
                                                x-text="lang.code"></span>
                                        </button>
                                    </template>
                                </div>

                                <div class="mt-3 pt-3 border-t border-gray-50 dark:border-white/5 text-center">
                                    <button @click="setLanguage('en')"
                                        class="text-xs font-bold text-gray-400 hover:text-acef-dark dark:hover:text-white mb-2 block w-full">Reset to
                                        English</button>
                                    <div class="flex items-center justify-center space-x-1 opacity-50 scale-90">
                                        <span class="text-[10px] text-gray-400">Powered by</span>
                                        <img src="https://www.gstatic.com/images/branding/googlelogo/svg/googlelogo_clr_74x24px.svg" alt="Google" class="h-4">
                                    </div>
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
                        Donate
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
                    class="block px-4 py-3 text-white hover:text-acef-green hover:bg-white/5 rounded-xl transition-all font-medium">Home</a>

                <!-- About Accordion -->
                <div x-data="{ aboutOpen: false }">
                    <button @click="aboutOpen = !aboutOpen"
                        class="w-full flex justify-between items-center px-4 py-3 text-white hover:text-acef-green hover:bg-white/5 rounded-xl transition-all font-medium">
                        <span>About</span>
                        <svg class="w-5 h-5 transition-transform" :class="aboutOpen ? 'rotate-180' : ''" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="aboutOpen" x-transition class="ml-4 mt-2 space-y-1">
                        <a href="{{ route('about') }}"
                            class="block px-4 py-2 text-white/70 hover:text-acef-green text-sm">Who We Are</a>
                        <a href="{{ route('team') }}"
                            class="block px-4 py-2 text-white/70 hover:text-acef-green text-sm">Our Team</a>
                        <a href="{{ route('partners') }}"
                            class="block px-4 py-2 text-white/70 hover:text-acef-green text-sm">Our Partners</a>
                        <a href="{{ route('accreditations') }}"
                            class="block px-4 py-2 text-white/70 hover:text-acef-green text-sm">Accreditations</a>
                    </div>
                </div>

                <a href="{{ route('programmes') }}"
                    class="block px-4 py-3 text-white hover:text-acef-green hover:bg-white/5 rounded-xl transition-all font-medium">Programmes</a>
                <a href="{{ route('projects') }}"
                    class="block px-4 py-3 text-white hover:text-acef-green hover:bg-white/5 rounded-xl transition-all font-medium">Projects</a>
                <a href="{{ route('impact') }}"
                    class="block px-4 py-3 text-white hover:text-acef-green hover:bg-white/5 rounded-xl transition-all font-medium">Impact</a>
                <a href="{{ route('news') }}"
                    class="block px-4 py-3 text-white hover:text-acef-green hover:bg-white/5 rounded-xl transition-all font-medium">Media</a>
                <a href="{{ route('resources') }}"
                    class="block px-4 py-3 text-white hover:text-acef-green hover:bg-white/5 rounded-xl transition-all font-medium">Resources</a>
                <a href="{{ route('contact') }}"
                    class="block px-4 py-3 text-white hover:text-acef-green hover:bg-white/5 rounded-xl transition-all font-medium">Contact</a>
            </nav>
            
            <!-- Dark Mode Mobile Toggle -->
            <div class="px-4 py-3 flex items-center justify-between text-white border-t border-white/10">
                <span class="font-medium">Theme</span>
                <button @click="toggleDarkMode()" class="p-2 bg-white/10 rounded-lg">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                </button>
            </div>

            <!-- Mobile Actions -->
            <div class="space-y-4 pt-4 border-t border-white/10">
                <a href="{{ route('donate') }}"
                    class="block w-full bg-acef-green text-white px-6 py-4 rounded-full font-bold hover:bg-opacity-90 transition-all shadow-xl text-center">
                    Donate Now
                </a>
                <a href="{{ route('get-involved') }}"
                    class="block w-full bg-white/10 text-white px-6 py-4 rounded-full font-bold hover:bg-white/20 transition-all text-center">
                    Get Involved
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
                    <input type="text" placeholder="Search for programmes, projects, resources..."
                        class="w-full px-6 py-6 text-lg focus:outline-none bg-transparent dark:text-white" x-ref="searchInput">
                    <button @click="searchOpen = false" class="mr-4 text-gray-400 hover:text-acef-dark dark:hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <p class="text-white/60 text-sm text-center mt-4">Press <kbd class="px-2 py-1 bg-white/10 rounded">ESC</kbd>
                to close</p>
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

    // Language Functions
    window.getAllLanguages = () => [
        { code: 'af', name: 'Afrikaans' }, { code: 'sq', name: 'Albanian' }, { code: 'am', name: 'Amharic' }, { code: 'ar', name: 'Arabic' }, { code: 'hy', name: 'Armenian' },
        { code: 'az', name: 'Azerbaijani' }, { code: 'eu', name: 'Basque' }, { code: 'be', name: 'Belarusian' }, { code: 'bn', name: 'Bengali' }, { code: 'bs', name: 'Bosnian' },
        { code: 'bg', name: 'Bulgarian' }, { code: 'ca', name: 'Catalan' }, { code: 'ceb', name: 'Cebuano' }, { code: 'ny', name: 'Chichewa' }, { code: 'zh-CN', name: 'Chinese' },
        { code: 'zh-TW', name: 'Chinese (Trad)' }, { code: 'cs', name: 'Czech' }, { code: 'da', name: 'Danish' },
        { code: 'nl', name: 'Dutch' }, { code: 'en', name: 'English' }, { code: 'eo', name: 'Esperanto' }, { code: 'et', name: 'Estonian' }, { code: 'tl', name: 'Filipino' },
        { code: 'fi', name: 'Finnish' }, { code: 'fr', name: 'French' }, { code: 'de', name: 'German' }, { code: 'el', name: 'Greek' }, { code: 'gu', name: 'Gujarati' },
        { code: 'ht', name: 'Haitian Creole' }, { code: 'ha', name: 'Hausa' }, { code: 'hi', name: 'Hindi' }, { code: 'hu', name: 'Hungarian' },
        { code: 'is', name: 'Icelandic' }, { code: 'ig', name: 'Igbo' }, { code: 'id', name: 'Indonesian' }, { code: 'ga', name: 'Irish' }, { code: 'it', name: 'Italian' },
        { code: 'ja', name: 'Japanese' }, { code: 'jw', name: 'Javanese' }, { code: 'kn', name: 'Kannada' }, { code: 'ko', name: 'Korean' }, { code: 'ku', name: 'Kurdish' },
        { code: 'la', name: 'Latin' }, { code: 'lv', name: 'Latvian' }, { code: 'lt', name: 'Lithuanian' }, { code: 'lb', name: 'Luxembourgish' }, { code: 'mk', name: 'Macedonian' },
        { code: 'mg', name: 'Malagasy' }, { code: 'ms', name: 'Malay' }, { code: 'ml', name: 'Malayalam' }, { code: 'mt', name: 'Maltese' }, { code: 'mi', name: 'Maori' },
        { code: 'mr', name: 'Marathi' }, { code: 'mn', name: 'Mongolian' }, { code: 'my', name: 'Myanmar' }, { code: 'ne', name: 'Nepali' }, { code: 'no', name: 'Norwegian' },
        { code: 'ps', name: 'Pashto' }, { code: 'fa', name: 'Persian' }, { code: 'pl', name: 'Polish' }, { code: 'pt', name: 'Portuguese' }, { code: 'pa', name: 'Punjabi' },
        { code: 'ro', name: 'Romanian' }, { code: 'ru', name: 'Russian' }, { code: 'sm', name: 'Samoan' }, { code: 'gd', name: 'Scots Gaelic' }, { code: 'sr', name: 'Serbian' },
        { code: 'st', name: 'Sesotho' }, { code: 'sn', name: 'Shona' }, { code: 'sd', name: 'Sindhi' }, { code: 'si', name: 'Sinhala' }, { code: 'sk', name: 'Slovak' },
        { code: 'sl', name: 'Slovenian' }, { code: 'so', name: 'Somali' }, { code: 'es', name: 'Spanish' }, { code: 'su', name: 'Sundanese' }, { code: 'sw', name: 'Swahili' },
        { code: 'sv', name: 'Swedish' }, { code: 'tg', name: 'Tajik' }, { code: 'ta', name: 'Tamil' }, { code: 'te', name: 'Telugu' }, { code: 'th', name: 'Thai' },
        { code: 'tr', name: 'Turkish' }, { code: 'uk', name: 'Ukrainian' }, { code: 'ur', name: 'Urdu' }, { code: 'uz', name: 'Uzbek' }, { code: 'vi', name: 'Vietnamese' },
        { code: 'cy', name: 'Welsh' }, { code: 'xh', name: 'Xhosa' }, { code: 'yi', name: 'Yiddish' }, { code: 'yo', name: 'Yoruba' }, { code: 'zu', name: 'Zulu' }
    ];

    window.getCookie = (name) => {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }

    window.setLanguage = (langCode) => {
        document.cookie = `googtrans=/en/${langCode}; path=/; domain=${window.location.hostname}`;
        document.cookie = `googtrans=/en/${langCode}; path=/;`;
        window.location.reload();
    }

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

<!-- Google Translate Hidden Element -->
<div id="google_translate_element" style="display:none"></div>
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({ pageLanguage: 'en', autoDisplay: false }, 'google_translate_element');
    }
</script>
<script type="text/javascript"
    src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script>
    // GOOGLE BANNER REMOVAL: display: none is the safer "hide"
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            const frames = document.getElementsByClassName('goog-te-banner-frame');
            if (frames.length > 0) {
                Array.from(frames).forEach(frame => {
                    frame.style.setProperty('display', 'none', 'important');
                });
            }
            if (document.body.style.top !== '0px') {
                document.body.style.setProperty('top', '0px', 'important');
            }
        });
    });

    observer.observe(document.body, { childList: true, subtree: true, attributes: true });
    
    // Backup interval
    setInterval(() => {
        if (document.body.style.top !== '0px') {
             document.body.style.setProperty('top', '0px', 'important');
        }
        const frames = document.getElementsByClassName('goog-te-banner-frame');
        if (frames.length > 0) {
            Array.from(frames).forEach(frame => {
                frame.style.setProperty('display', 'none', 'important');
            });
        }
    }, 500);
</script>

<style>
    /* AGGRESSIVE GOOGLE TRANSLATE HIDING */
    
    /* 1. Hide the top banner iframe */
    .goog-te-banner-frame.skiptranslate,
    .goog-te-banner-frame,
    iframe.goog-te-banner-frame,
    #goog-gt-tt,
    .goog-te-balloon-frame {
        display: none !important;
    }

    /* 2. Reset body position (Google pushes it down) */
    body {
        top: 0px !important; 
        position: relative !important; 
    }

    /* 3. Hide tooltips and hover effects */
    .goog-tooltip,
    .goog-tooltip:hover {
        display: none !important;
    }

    /* 4. Remove highlight from translated text */
    .goog-text-highlight {
        background-color: transparent !important;
        border: none !important;
        box-shadow: none !important;
        color: inherit !important;
    }
    
    /* 5. Hide the original widget element just in case */
    #google_translate_element {
        display: none !important;
    }

    /* Custom Scrollbar for Language List */
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #ccc; border-radius: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #1B4D3E; }
    
    /* DARK MODE GLOBAL OVERRIDES */
    /* This allows the site to look dark without editing every file */
    html.dark body {
        background-color: #111827; /* gray-900 */
        color: #F3F4F6; /* gray-100 */
    }
    
    html.dark .bg-white {
        background-color: #1F2937; /* gray-800 */
        color: #F3F4F6;
    }

    html.dark .text-acef-dark {
        color: #F9FAFB !important; /* gray-50 */
    }

    html.dark .bg-acef-gray {
        background-color: #111827; /* gray-900 */
        border-color: #374151; /* gray-700 */
    }

    html.dark .text-gray-600, 
    html.dark .text-gray-500,
    html.dark .text-gray-800 {
        color: #9CA3AF; /* gray-400 */
    }
    
    html.dark .border-gray-100,
    html.dark .border-gray-200 {
        border-color: #374151;
    }
    
    html.dark .shadow-xl {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5), 0 10px 10px -5px rgba(0, 0, 0, 0.5);
    }
</style>