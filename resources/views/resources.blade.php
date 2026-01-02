<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" content="notranslate">
    <title>{{ __('pages.resources.hero_title') }} - ACEF</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans bg-gray-50 overflow-x-hidden">
    @include('components.header')

    <!-- Knowledge Hub Hero -->
    <section class="pt-40 pb-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8">
            <h1 class="text-6xl md:text-8xl font-black text-acef-dark tracking-tighter">
                {{ __('pages.resources.hero_title') }}</h1>
            <p class="text-gray-400 max-w-3xl mx-auto text-lg md:text-xl font-light leading-relaxed italic">
                {{ __('pages.resources.hero_desc') }}
            </p>
        </div>
    </section>

    <main class="pb-24">

        <div x-data="{
            search: '',
            filter: 'all',
            view: 'grid',
            openFilter: false,
            resources: {{ json_encode($allResources) }},
            categories: {{ json_encode($categories) }},
            checkVisible(item) {
                const searchLower = this.search.toLowerCase();
                const matchesSearch = item.title.toLowerCase().includes(searchLower) || (item.description && item.description.toLowerCase().includes(searchLower));
                const matchesFilter = this.filter === 'all' || item.category === this.filter;
                return matchesSearch && matchesFilter;
            }
        }">
            <!-- Filter Hub -->
            <div
                class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 sticky top-20 z-30 bg-white/95 dark:bg-gray-900/95 backdrop-blur-xl py-6 border-b border-gray-100 dark:border-gray-800 shadow-sm transition-all duration-300">
                <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4">
                    <!-- Search Input -->
                    <div class="relative w-full lg:w-96 shrink-0">
                        <input type="text" x-model="search" placeholder="{{ __('pages.resources.search_placeholder') }}"
                            class="w-full pl-12 pr-6 py-3.5 bg-gray-50 dark:bg-gray-800 border border-transparent focus:bg-white dark:focus:bg-gray-900 rounded-2xl text-sm focus:ring-2 focus:ring-acef-green focus:border-acef-green transition-all dark:text-white dark:placeholder-gray-500">
                        <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>

                    <div class="flex items-center gap-3">
                        <!-- Category Dropdown -->
                        <div class="relative relative z-50 w-full lg:w-64" @click.outside="openFilter = false">
                            <button @click="openFilter = !openFilter" 
                                class="w-full flex items-center justify-between px-5 py-3.5 bg-gray-50 dark:bg-gray-800 hover:bg-white dark:hover:bg-gray-700 border border-transparent dark:border-gray-700 rounded-2xl text-sm font-bold text-gray-700 dark:text-gray-200 transition-all group">
                                <span x-text="filter === 'all' ? '{{ __('pages.resources.filters.all') }}' : filter"></span>
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-acef-green transition-colors" :class="openFilter ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div x-show="openFilter" 
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute top-full right-0 mt-2 w-full bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 py-2 max-h-80 overflow-y-auto custom-scrollbar">
                                
                                <button @click="filter = 'all'; openFilter = false" 
                                    class="w-full text-left px-5 py-3 text-sm font-bold hover:bg-acef-green/10 text-gray-700 dark:text-gray-200 transition-colors flex items-center justify-between group">
                                    <span>{{ __('pages.resources.filters.all') }}</span>
                                    <svg x-show="filter === 'all'" class="w-4 h-4 text-acef-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </button>
                                
                                <template x-for="cat in categories" :key="cat">
                                    <button @click="filter = cat; openFilter = false" 
                                        class="w-full text-left px-5 py-3 text-sm font-medium hover:bg-acef-green/10 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors flex items-center justify-between group">
                                        <span x-text="cat"></span>
                                        <svg x-show="filter === cat" class="w-4 h-4 text-acef-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </button>
                                </template>
                            </div>
                        </div>

                        <!-- View Toggle -->
                        <div class="flex bg-gray-50 dark:bg-gray-800 p-1 rounded-xl">
                            <button @click="view = 'grid'" 
                                :class="view === 'grid' ? 'bg-white dark:bg-gray-700 text-acef-green shadow-sm' : 'text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300'"
                                class="p-2.5 rounded-lg transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                </svg>
                            </button>
                            <button @click="view = 'list'" 
                                :class="view === 'list' ? 'bg-white dark:bg-gray-700 text-acef-green shadow-sm' : 'text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300'"
                                class="p-2.5 rounded-lg transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resources Content -->
            <section class="py-12 bg-gray-50 dark:bg-gray-900 min-h-[60vh]">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    
                    <!-- Empty State -->
                     <template x-if="resources.filter(i => checkVisible(i)).length === 0">
                        <div class="text-center py-20">
                            <div class="w-20 h-20 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ __('pages.resources.no_results_title') }}</h3>
                            <p class="text-gray-500 dark:text-gray-400">{{ __('pages.resources.no_results_desc') }}</p>
                            <button @click="filter = 'all'; search = ''" class="mt-6 text-acef-green font-bold hover:underline">
                                {{ __('pages.resources.clear_filters') }}
                            </button>
                        </div>
                    </template>

                    <!-- Grid View -->
                    <div x-show="view === 'grid'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <template x-for="res in resources" :key="res.id">
                            <div x-show="checkVisible(res)" x-transition
                                class="bg-white dark:bg-gray-800 p-8 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all flex flex-col justify-between h-[420px] group relative overflow-hidden">
                                <template x-if="res.is_locked">
                                    <div class="absolute top-8 right-8 text-gray-300 dark:text-gray-600">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </template>

                                <div class="space-y-6">
                                    <span
                                        class="px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-widest inline-block bg-acef-green/10 text-acef-green"
                                        x-text="res.category">
                                    </span>
                                    <div class="space-y-4">
                                        <h3
                                            class="text-2xl font-black text-acef-dark dark:text-white leading-tight group-hover:text-acef-green transition-colors line-clamp-2">
                                            <span x-text="res.title"></span>
                                        </h3>
                                        <p class="text-gray-400 dark:text-gray-500 text-sm leading-relaxed font-light italic line-clamp-3">
                                            <span x-text="res.description"></span>
                                        </p>
                                    </div>
                                </div>

                                <div class="space-y-6">
                                    <div class="flex justify-between items-center text-xs font-bold text-gray-300 dark:text-gray-600">
                                        <span x-text="res.size" class="uppercase"></span>
                                        <span x-text="res.year"></span>
                                    </div>

                                    <template x-if="res.is_locked">
                                        <button
                                            class="w-full py-4 bg-gray-50 dark:bg-gray-900 text-gray-400 dark:text-gray-500 font-bold rounded-xl flex items-center justify-center space-x-2 border border-gray-100 dark:border-gray-700 cursor-not-allowed">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="text-xs uppercase tracking-wider">{{ __('pages.resources.members_only_btn') }}</span>
                                        </button>
                                    </template>
                                    <template x-if="!res.is_locked">
                                        <a :href="'/storage/' + res.file_path" download 
                                            class="w-full py-4 bg-acef-green text-acef-dark font-black rounded-xl flex items-center justify-center space-x-3 hover:bg-white hover:text-acef-green border-2 border-transparent hover:border-acef-green transition-all shadow-lg shadow-acef-green/20 group/btn">
                                            <svg class="w-4 h-4 group-hover/btn:translate-y-1 transition-transform" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                            </svg>
                                            <span class="text-xs uppercase tracking-wider">{{ __('pages.resources.download_btn') }}</span>
                                        </a>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- List View -->
                    <div x-show="view === 'list'" class="space-y-4">
                         <template x-for="res in resources" :key="res.id">
                            <div x-show="checkVisible(res)" x-transition
                                class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-all flex flex-col md:flex-row md:items-center justify-between gap-6 group">
                                
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-3 mb-2">
                                        <span class="px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-widest bg-acef-green/10 text-acef-green"
                                            x-text="res.category">
                                        </span>
                                        <span class="text-xs font-bold text-gray-300 dark:text-gray-600 uppercase" x-text="res.year"></span>
                                        <template x-if="res.is_locked">
                                            <svg class="w-3 h-3 text-gray-300 dark:text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </template>
                                    </div>
                                    <h3 class="text-xl font-bold text-acef-dark dark:text-white group-hover:text-acef-green transition-colors truncate">
                                        <span x-text="res.title"></span>
                                    </h3>
                                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-1 truncate max-w-2xl">
                                        <span x-text="res.description"></span>
                                    </p>
                                </div>

                                <div class="flex items-center gap-4 shrink-0">
                                    <span x-text="res.size" class="text-xs font-bold text-gray-300 dark:text-gray-600 uppercase hidden md:block"></span>
                                    
                                     <template x-if="!res.is_locked">
                                        <a :href="'/storage/' + res.file_path" download 
                                            class="w-10 h-10 rounded-xl bg-gray-50 dark:bg-gray-700 text-acef-dark dark:text-white hover:bg-acef-green hover:text-acef-dark flex items-center justify-center transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                            </svg>
                                        </a>
                                     </template>
                                     <template x-if="res.is_locked">
                                         <div class="w-10 h-10 rounded-xl bg-gray-50 dark:bg-gray-700 text-gray-300 dark:text-gray-500 flex items-center justify-center cursor-not-allowed">
                                             <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                            </svg>
                                         </div>
                                     </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </section>
        </div>
    </main>

    @include('components.footer')
</body>

</html>