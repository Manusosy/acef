<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" content="notranslate">
    <title>{{ strip_tags(__('pages.programmes.hero_title')) }} - ACEF</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @php
        $programmesPage = \App\Models\Page::where('slug', 'programmes')->first();
        $heroSlides = $programmesPage ? $programmesPage->activeHeroSlides()->with('media')->get() : collect();
    @endphp
</head>

<body class="antialiased font-sans bg-white dark:bg-gray-950 overflow-x-hidden transition-colors duration-300">
    @include('components.header')

    <x-hero 
        :page="$programmesPage"
        :slides="$heroSlides"
        breadcrumb="{{ __('pages.programmes_title') ?? 'Our Impact' }}"
        title="{!! __('pages.programmes.hero_title') !!}"
        subtitle="{{ __('pages.programmes.hero_desc') }}"
        image-url="https://images.unsplash.com/photo-1542601906990-24bd0827f72f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
    />

    <main class="bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-300" x-data="{
        category: '',
        country: '',
        search: '',
        checkVisible(item) {
            const searchLower = this.search.toLowerCase();
            const titleMatch = item.title.toLowerCase().includes(searchLower);
            const excerptMatch = item.excerpt ? item.excerpt.toLowerCase().includes(searchLower) : false;
            const catMatch = item.category ? item.category.toLowerCase().includes(searchLower) : false;
            
            const matchesCategory = this.category === '' || item.category === this.category;
            const matchesCountry = this.country === '' || (item.country && item.country.includes(this.country));

            return (titleMatch || excerptMatch || catMatch) && matchesCategory && matchesCountry;
        }
    }">
        <!-- Filter Bar -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-30 -mt-12">
            <div
                class="bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-700 flex flex-wrap items-center justify-between gap-6">
                <div class="flex flex-wrap items-center gap-4">
                    <select x-model="category"
                        class="bg-gray-50 dark:bg-gray-700 border-none rounded-2xl py-3 px-6 text-sm font-bold text-gray-500 dark:text-gray-300 focus:ring-2 focus:ring-acef-green">
                        <option value="">All Categories</option>
                        @foreach($programmes->pluck('category')->unique()->filter() as $cat)
                            <option value="{{ $cat }}">{{ $cat }}</option>
                        @endforeach
                    </select>

                    <select x-model="country"
                        class="bg-gray-50 dark:bg-gray-700 border-none rounded-2xl py-3 px-6 text-sm font-bold text-gray-500 dark:text-gray-300 focus:ring-2 focus:ring-acef-green">
                        <option value="">All Countries</option>
                        @foreach($countries as $c)
                            <option value="{{ $c }}">{{ $c }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="relative flex-1 max-w-sm">
                    <input type="text" x-model="search" placeholder="{{ __('pages.programmes.search_placeholder') }}"
                        class="w-full pl-12 pr-6 py-3 bg-gray-50 dark:bg-gray-700 border-none rounded-2xl text-sm dark:text-white focus:ring-2 focus:ring-acef-green">
                    <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Programmes Grid -->
        <section class="py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach($programmes as $program)
                        <div x-show="checkVisible({{ json_encode($program) }})" x-transition
                            class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-sm hover:shadow-2xl transition-all group border border-gray-50 dark:border-gray-700">
                            <div class="relative aspect-[4/3] overflow-hidden">
                                @if($program->image)
                                    <img src="{{ Str::startsWith($program->image, 'http') ? $program->image : Storage::url($program->image) }}" alt="{{ $program->title }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full bg-emerald-50 dark:bg-gray-700 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-acef-green/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                
                                <div class="absolute top-6 left-6">
                                    <span
                                        class="bg-white/90 dark:bg-gray-900/90 backdrop-blur-md text-acef-dark dark:text-acef-green px-4 py-1.5 rounded-lg text-xs font-semibold uppercase tracking-wider shadow-sm border border-gray-100 dark:border-gray-700">
                                        {{ $program->category ?: 'General' }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-10 space-y-6">
                                <div class="space-y-4">
                                    <div class="flex items-center gap-3">
                                        <div class="text-acef-green dark:text-acef-light-green text-xs font-semibold uppercase tracking-widest">
                                            {{ $program->meta_val ?: 'Active Initiative' }}
                                        </div>
                                        <span class="text-gray-300 dark:text-gray-600">•</span>
                                        <div class="text-gray-400 dark:text-gray-500 text-xs font-semibold uppercase tracking-widest">
                                            {{ $program->projects_count }} {{ Str::plural('Project', $program->projects_count) }}
                                        </div>
                                    </div>
                                    <h3
                                        class="text-2xl font-bold text-acef-dark dark:text-white leading-tight group-hover:text-acef-green transition-colors">
                                        <a href="{{ route('programmes.show', $program) }}">
                                            {{ $program->title }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-500 dark:text-gray-400 font-light leading-relaxed line-clamp-3">
                                        {{ $program->excerpt }}
                                    </p>
                                </div>

                                <div class="flex justify-between items-center pt-6 border-t border-gray-50 dark:border-gray-700">
                                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest">
                                        ACEF Programme
                                    </span>
                                    <a href="{{ route('programmes.show', $program) }}"
                                        class="text-acef-dark dark:text-white font-bold text-base flex items-center hover:text-acef-green transition-colors group/link">
                                        Learn More
                                        <svg class="w-4 h-4 ml-1 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($programmes->isEmpty())
                    <div class="text-center py-24 bg-white dark:bg-gray-800 rounded-[40px] border border-dashed border-gray-200 dark:border-gray-700">
                        <p class="text-gray-400 text-lg italic">No programs found at the moment.</p>
                    </div>
                @endif
            </div>
        </section>
    </main>

    @include('components.footer')
</body>

</html>