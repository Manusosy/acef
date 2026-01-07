<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" content="notranslate">
    <title>{{ __('pages.news.browse.title') }} - ACEF</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @php
        $newsPage = \App\Models\Page::where('slug', 'news')->first();
        $heroSlides = $newsPage ? $newsPage->activeHeroSlides()->with('media')->get() : collect();
    @endphp
</head>

<body class="antialiased font-sans bg-white overflow-x-hidden">
    @include('components.header')

    <x-hero 
        :page="$newsPage"
        :slides="$heroSlides"
        breadcrumb="{{ __('pages.news.browse.title') }}"
        title="{!! __('pages.news.browse.title') !!}"
        subtitle="{{ __('pages.news.browse.desc') }}"
        image-url="{{ $featuredArticle && $featuredArticle->image ? (str_starts_with($featuredArticle->image, 'http') ? $featuredArticle->image : Storage::url($featuredArticle->image)) : '/hero_marine_ecosystem_1766827540454.png' }}"
    >
        @if($featuredArticle)
            <x-slot name="actions">
                <a href="{{ route('news.show', $featuredArticle->slug) }}"
                    class="bg-acef-green text-acef-dark font-bold px-8 py-4 rounded-xl flex items-center space-x-3 hover:bg-white transition-all w-fit shadow-xl group shadow-acef-green/20">
                    <span>{{ __('pages.news.featured.btn') }}</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </x-slot>
        @endif
    </x-hero>

    <main>
        <!-- Browse Insights -->
        <section x-data="{ shown: false, view: 'grid', categoryOpen: false }" x-intersect.once.margin.0px.0px.-100px.0px="shown = true"
                 class="py-24 bg-gray-50/50 dark:bg-gray-900 transition-colors">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12" :class="{ 'animate-fade-in-up': shown }">
                <div class="flex flex-col lg:flex-row justify-between items-end gap-8 border-b border-gray-200 dark:border-gray-800 pb-8">
                    <div class="space-y-4">
                        <h2 class="text-5xl font-bold text-acef-dark dark:text-white tracking-tighter">
                            {{ __('pages.news.browse.title') }}</h2>
                        <p class="text-gray-400 font-light italic text-lg">{{ __('pages.news.browse.desc') }}</p>
                    </div>
                    <div class="w-full lg:w-auto flex flex-col sm:flex-row gap-4">
                        <!-- Search & Filter Bar -->
                        <div class="flex-1 flex gap-4 bg-white dark:bg-gray-800 p-2 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                            <form action="{{ route('news') }}" method="GET" class="flex-1 relative">
                                @if(request('category'))
                                    <input type="hidden" name="category" value="{{ request('category') }}">
                                @endif
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}" 
                                    class="block w-full pl-10 pr-3 py-2.5 border-none bg-transparent text-gray-900 dark:text-white placeholder-gray-400 focus:ring-0 sm:text-sm" 
                                    placeholder="{{ __('pages.news.browse.search_placeholder') }}">
                            </form>

                            <div class="w-px bg-gray-200 dark:bg-gray-700 my-1"></div>

                            <!-- Category Dropdown -->
                            <div class="relative" @click.away="categoryOpen = false">
                                <button @click="categoryOpen = !categoryOpen" 
                                    class="flex items-center gap-2 px-4 py-2.5 text-sm font-bold text-gray-700 dark:text-gray-200 hover:text-acef-dark dark:hover:text-white transition-colors h-full">
                                    <span>{{ request('category') ? $categories->firstWhere('slug', request('category'))?->name : __('pages.news.browse.filters.all') }}</span>
                                    <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': categoryOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                
                                <div x-show="categoryOpen" 
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="absolute right-0 mt-4 w-56 bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-100 dark:border-gray-700 z-50 overflow-hidden py-1">
                                    
                                    @php
                                        $baseParams = [];
                                        if(request('search')) $baseParams['search'] = request('search');
                                    @endphp

                                    <a href="{{ route('news', $baseParams) }}" 
                                        class="block px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-acef-green dark:hover:text-acef-green font-medium {{ !request('category') ? 'text-acef-green bg-gray-50 dark:bg-gray-700/50' : '' }}">
                                        {{ __('pages.news.browse.filters.all') }}
                                    </a>
                                    
                                    @foreach($categories as $category)
                                        <a href="{{ route('news', array_merge($baseParams, ['category' => $category->slug])) }}" 
                                            class="block px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-acef-green dark:hover:text-acef-green font-medium {{ request('category') == $category->slug ? 'text-acef-green bg-gray-50 dark:bg-gray-700/50' : '' }}">
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- View Toggle -->
                        <div class="flex bg-white dark:bg-gray-800 p-1.5 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 h-fit">
                            <button @click="view = 'grid'" 
                                :class="view === 'grid' ? 'bg-acef-green text-acef-dark shadow-sm' : 'text-gray-400 hover:text-gray-600 dark:hover:text-gray-300'"
                                class="p-3 rounded-xl transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                            </button>
                            <button @click="view = 'list'" 
                                :class="view === 'list' ? 'bg-acef-green text-acef-dark shadow-sm' : 'text-gray-400 hover:text-gray-600 dark:hover:text-gray-300'"
                                class="p-3 rounded-xl transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Article Grid -->
                <div :class="view === 'grid' ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10' : 'flex flex-col gap-6'">
                    <!-- Dynamic Articles -->

                    @forelse($articles as $article)
                        <div class="group bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl transition-all border border-gray-50 dark:border-gray-700 flex w-full"
                             :class="view === 'grid' ? 'flex-col h-full' : 'flex-col md:flex-row h-auto md:h-64'">
                            
                            <!-- Image -->
                            <div class="relative overflow-hidden" 
                                 :class="view === 'grid' ? 'aspect-[16/10] w-full' : 'w-full md:w-1/3 h-64 md:h-full'">
                                <img src="{{ $article->image ? (str_starts_with($article->image, 'http') ? $article->image : Storage::url($article->image)) : asset('img/placeholders/default-news.jpg') }}" alt="{{ $article->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute top-4 left-4" :class="view === 'grid' ? 'top-6 left-6' : ''">
                                    <span
                                        class="bg-white/90 backdrop-blur-md px-3 py-1 rounded-lg text-xs font-semibold uppercase tracking-wider text-acef-dark shadow-sm">
                                        {{ $article->category?->name ?? 'Uncategorized' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="space-y-4 flex-1 flex flex-col justify-between"
                                 :class="view === 'grid' ? 'p-8' : 'p-6 md:p-8 w-full md:w-2/3'">
                                <div class="space-y-3">
                                    <div class="flex items-center text-gray-400 dark:text-gray-500 text-xs font-semibold uppercase tracking-widest">
                                        <span>{{ $article->author->name ?? 'ACEF Team' }}</span>
                                        <span class="mx-2">•</span>
                                        <span>{{ $article->formatted_date }}</span>
                                    </div>
                                    <h3 class="font-bold text-acef-dark dark:text-white leading-tight group-hover:text-acef-green transition-colors"
                                        :class="view === 'grid' ? 'text-2xl' : 'text-xl md:text-2xl'">
                                        {{ $article->title }}
                                    </h3>
                                    <p class="text-gray-400 dark:text-gray-400 text-sm leading-relaxed font-light italic line-clamp-2"
                                       :class="view === 'grid' ? 'line-clamp-3' : ''">
                                        {{ $article->excerpt }}
                                    </p>
                                </div>
                                <div class="pt-4 border-t border-gray-50 dark:border-gray-700 flex justify-start">
                                    <a href="{{ route('news.show', $article->slug) }}"
                                        class="text-acef-green font-bold text-xs flex items-center group-hover:translate-x-1 transition-transform">
                                        Read Article
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-20 text-gray-400">
                            No articles found.
                        </div>
                    @endforelse
                </div>

                <div class="flex justify-center pt-8">
                     {{ $articles->links() }}
                </div>
            </div>
        </section>

        <!-- Research Reports Section -->
        <section x-data="{ shown: false }" x-intersect.once.margin.0px.0px.-100px.0px="shown = true"
                 class="py-24 bg-acef-dark">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12 opacity-0" :class="{ 'animate-fade-in-up': shown }">
                <div class="flex justify-between items-end">
                    <div class="space-y-4">
                        <p class="text-acef-green font-bold text-xs uppercase tracking-widest">
                            {{ __('pages.news.research_section.label') }}</p>
                        <h2 class="text-5xl font-bold text-white tracking-tighter">
                            {{ __('pages.news.research_section.title') }}</h2>
                    </div>
                    <a href="{{ route('resources') }}"
                        class="text-white font-bold text-sm flex items-center hover:text-acef-green transition-colors">
                        {{ __('pages.news.research_section.view_all') }} <svg class="w-4 h-4 ml-1" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>

                <div
                    class="bg-gray-800/30 rounded-2xl border border-white/5 p-8 md:p-12 flex flex-col lg:flex-row gap-12 items-center">
                    <div class="lg:w-1/3 w-full">
                        <div class="relative aspect-square rounded-xl overflow-hidden group">
                            <img src="/map_africa_impact_1766827796711.png" alt="Report"
                                class="w-full h-full object-cover">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-orange-500/80 to-transparent flex flex-col justify-end p-8">
                                <span
                                    class="bg-white/20 backdrop-blur-md text-white text-xs font-bold px-3 py-1 rounded-lg w-fit mb-4 uppercase">{{ __('pages.news.research_section.featured_report.type') }}</span>
                                <h4 class="text-2xl font-bold text-white leading-tight">
                                    {{ __('pages.news.research_section.featured_report.title') }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="lg:w-2/3 space-y-8">
                        <h3 class="text-3xl md:text-4xl font-bold text-white leading-tight">
                            {{ __('pages.news.research_section.featured_report.full_title') }}</h3>
                        <p class="text-white/60 font-light leading-relaxed">
                            {{ __('pages.news.research_section.featured_report.desc') }}
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="flex items-start space-x-4">
                                <div
                                    class="w-10 h-10 bg-acef-green/20 rounded-xl flex items-center justify-center text-acef-green mt-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="space-y-1">
                                    <h5 class="text-white font-bold">
                                        {{ __('pages.news.research_section.featured_report.stat1_title') }}</h5>
                                    <p class="text-white/40 text-sm italic">
                                        {{ __('pages.news.research_section.featured_report.stat1_desc') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div
                                    class="w-10 h-10 bg-acef-green/20 rounded-xl flex items-center justify-center text-acef-green mt-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="space-y-1">
                                    <h5 class="text-white font-bold">
                                        {{ __('pages.news.research_section.featured_report.stat2_title') }}</h5>
                                    <p class="text-white/40 text-sm italic">
                                        {{ __('pages.news.research_section.featured_report.stat2_desc') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row items-center gap-4 pt-4">
                            <button
                                class="w-full sm:w-auto bg-acef-green text-acef-dark font-bold px-6 py-3.5 rounded-xl flex items-center justify-center space-x-3 hover:bg-white transition-all text-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                <span>{{ __('pages.news.research_section.featured_report.download_btn') }}</span>
                            </button>
                            <button
                                class="w-full sm:w-auto text-white font-bold px-6 py-3.5 rounded-xl hover:bg-white/5 transition-all border border-white/20 text-sm">
                                {{ __('pages.news.research_section.featured_report.summary_btn') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Subscription CTA -->
        <section x-data="{ shown: false }" x-intersect.once.margin.0px.0px.-100px.0px="shown = true"
                 class="py-24 bg-gray-50 dark:bg-gray-900 overflow-hidden relative transition-colors">
            <div class="max-w-4xl mx-auto px-4 relative z-10 opacity-0" :class="{ 'animate-fade-in-up': shown }">
                <div
                    class="bg-acef-green/5 dark:bg-gray-800/50 border border-acef-green/10 dark:border-white/5 rounded-3xl p-12 md:p-20 text-center space-y-8 flex flex-col items-center backdrop-blur-sm">
                    <div
                        class="w-16 h-16 bg-white dark:bg-gray-700 rounded-2xl shadow-sm flex items-center justify-center text-acef-green text-2xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-acef-dark dark:text-white tracking-tighter">
                        {{ __('pages.news.subscribe.title') }}</h2>
                    <p class="text-gray-400 dark:text-gray-400 font-light max-w-lg leading-relaxed italic">
                        {{ __('pages.news.subscribe.desc') }}
                    </p>
                    <form class="w-full max-w-lg flex flex-col sm:flex-row gap-4 pt-4">
                        <input type="email" placeholder="{{ __('pages.news.subscribe.email_placeholder') }}"
                            class="flex-1 px-8 py-5 bg-white dark:bg-gray-800 border-2 border-gray-100 dark:border-gray-700 rounded-2xl focus:border-acef-green dark:focus:border-acef-green transition-all outline-none text-gray-900 dark:text-white placeholder-gray-400">
                        <button
                            class="bg-acef-green text-acef-dark font-bold px-12 py-5 rounded-2xl hover:bg-acef-dark hover:text-white transition-all shadow-xl shadow-acef-green/20">
                            {{ __('pages.news.subscribe.btn') }}
                        </button>
                    </form>
                    <p class="text-[10px] text-gray-300 dark:text-gray-600 font-bold uppercase tracking-widest leading-loose">
                        {{ __('pages.news.subscribe.privacy') }}</p>
                </div>
            </div>
        </section>
    </main>

    @include('components.footer')
</body>

</html>