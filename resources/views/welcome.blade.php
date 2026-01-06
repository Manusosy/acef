@php
    $generalSettings = \App\Models\Setting::getGroup('general');
    $siteName = $generalSettings['site_name'] ?? 'ACEF';
    $siteTagline = $generalSettings['site_tagline'] ?? null;
    $siteFavicon = $generalSettings['site_favicon'] ?? null;
    
    $homePage = \App\Models\Page::where('slug', 'home')->first();
    $heroSlides = $homePage ? $homePage->activeHeroSlides()->with('media')->get() : collect();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" content="notranslate">
    
    @if($siteFavicon)
        <link rel="icon" type="image/x-icon" href="{{ Storage::url($siteFavicon) }}">
    @endif

    <title>{{ $siteName }} @if($siteTagline) - {{ $siteTagline }} @endif</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans bg-white overflow-x-hidden">
    @include('components.header')

    <x-hero 
        :page="$homePage"
        :slides="$heroSlides"
        :breadcrumb="__('pages.home.founded')"
        title="{!! __('pages.home.hero_title') !!}"
        subtitle="{!! __('pages.home.hero_subtitle') !!}"
        height="h-screen"
        min-height="min-h-[700px]"
        image-url="/hero_marine_ecosystem_1766827540454.png"
    >
        <x-slot name="actions">
            <a href="{{ route('get-involved') }}"
                class="bg-acef-green text-white px-10 py-5 rounded-xl font-bold text-lg hover:scale-105 transition-transform shadow-2xl shadow-acef-green/30 flex items-center justify-center">
                {{ __('buttons.get_involved') }}
            </a>
            <a href="{{ route('impact') }}"
                class="bg-white/10 backdrop-blur-md border border-white/20 text-white px-10 py-5 rounded-xl font-bold text-lg hover:bg-white/20 transition-all flex items-center justify-center">
                {{ __('buttons.see_impact') }}
            </a>
        </x-slot>
    </x-hero>

    <main>
        <!-- Who We Are Section -->
        <section class="py-24 bg-white dark:bg-gray-950 transition-colors duration-300 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row items-center gap-16">
                    <div class="lg:w-1/2 relative">
                        <div class="relative z-10 rounded-2xl overflow-hidden shadow-2xl">
                            <img src="/mission_vision_africa_1766827653058.png" alt="Who We Are"
                                class="w-full h-[600px] object-cover">
                        </div>
                        <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-acef-green rounded-2xl -z-0 opacity-50">
                        </div>
                        <div class="absolute -top-6 -left-6 w-32 h-32 border-2 border-acef-green rounded-2xl -z-0">
                        </div>
                    </div>
                    <div class="lg:w-1/2 space-y-8">
                        <div class="space-y-4">
                            <p class="text-acef-green dark:text-acef-light-green font-bold tracking-widest uppercase text-sm">
                                {{ __('pages.home.who_we_are_title') }}
                            </p>
                            <h2 class="text-5xl font-black text-acef-dark dark:text-white tracking-tighter leading-tight">
                                {!! __('pages.home.who_we_are_heading') !!}
                            </h2>
                        </div>
                        <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed font-light">
                             {!! __('pages.home.who_we_are_text') !!}
                        </div>
                        <p class="text-gray-500 leading-relaxed font-light italic">
                            {!! __('pages.home.who_we_are_subtext') !!}
                        </p>
                        <div class="pt-4 grid grid-cols-2 gap-8">
                            <div class="flex flex-col">
                                <span class="text-4xl font-black text-acef-dark dark:text-white">14+</span>
                                <span
                                    class="text-xs text-gray-400 font-bold uppercase tracking-widest">{{ __('pages.home.countries') }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-4xl font-black text-acef-dark dark:text-white">2,000+</span>
                                <span
                                    class="text-xs text-gray-400 font-bold uppercase tracking-widest">{{ __('pages.home.members') }}</span>
                            </div>
                        </div>
                        <div class="pt-4">
                            <a href="{{ route('about') }}"
                                class="inline-block bg-acef-dark text-white px-10 py-5 rounded-xl font-bold hover:bg-opacity-90 transition-all shadow-xl">
                                {{ __('buttons.our_story') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Global Engagements Timeline -->
        <x-timeline-section :years="$timelineYears" />

        <!-- Accreditations Showcase -->
        @if($accreditations->count() > 0)
        <section class="py-16 md:py-24 bg-white dark:bg-gray-950 border-y border-gray-100 dark:border-gray-800 transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
                <div class="flex flex-col items-center text-center space-y-4 max-w-3xl mx-auto">
                    <p class="text-acef-green dark:text-acef-light-green font-bold tracking-[0.3em] uppercase text-[10px] md:text-xs">
                        {{ __('pages.accreditations.hero_title') }}
                    </p>
                    <h2 class="text-4xl md:text-5xl font-black text-acef-dark dark:text-white tracking-tighter">
                        Building Credibility Through Excellence
                    </h2>
                    <p class="text-gray-500 dark:text-gray-400 font-light italic text-sm md:text-base">
                        Our work is recognized and accredited by leading international organizations, ensuring global standards of environmental stewardship.
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6 md:gap-10 items-center justify-items-center">
                    @foreach($accreditations as $acc)
                        <div class="group relative flex flex-col items-center space-y-3">
                            <div class="w-24 h-24 md:w-32 md:h-32 bg-gray-50 dark:bg-gray-900/50 rounded-2xl flex items-center justify-center p-4 border border-gray-100 dark:border-gray-800 shadow-sm transition-all duration-500 hover:shadow-xl hover:border-acef-green dark:hover:border-acef-green transform hover:-translate-y-1 overflow-hidden">
                                @if($acc->image)
                                    <img src="{{ str_starts_with($acc->image, 'http') ? $acc->image : Storage::url($acc->image) }}" alt="{{ $acc->acronym }}" 
                                         class="max-h-full max-w-full object-contain transition-all duration-700 group-hover:scale-110">
                                @else
                                    <span class="text-xl md:text-2xl font-black text-acef-dark/20 dark:text-white/10 group-hover:text-acef-green transition-colors uppercase tracking-widest">
                                        {{ $acc->acronym }}
                                    </span>
                                @endif
                                
                                <!-- Decorative Accent -->
                                <div class="absolute bottom-0 right-0 w-8 h-8 bg-acef-green/5 group-hover:bg-acef-green/10 rounded-tl-full transition-colors duration-500"></div>
                            </div>
                            <span class="text-[10px] md:text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest text-center group-hover:text-acef-dark dark:group-hover:text-white transition-colors duration-300">
                                {{ $acc->acronym }}
                            </span>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-center pt-8">
                    <a href="{{ route('accreditations') }}" 
                       class="inline-flex items-center space-x-2 text-acef-green dark:text-acef-light-green font-bold text-sm uppercase tracking-widest group border-b-2 border-transparent hover:border-acef-green dark:hover:border-acef-light-green transition-all pb-1">
                        <span>Explore full accreditations</span>
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </section>
        @endif

        <!-- Featured Projects Section -->
        <section class="py-24 bg-white dark:bg-gray-950 transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
                <div class="flex justify-between items-end">
                    <div class="space-y-4">
                        <h2 class="text-5xl font-black text-acef-dark dark:text-white tracking-tighter">
                            {{ __('pages.home.featured_projects_title') }}
                        </h2>
                        <p class="text-gray-500 font-light italic">{{ __('pages.home.featured_projects_subtitle') }}
                        </p>
                    </div>
                    <a href="{{ route('projects') }}" class="text-acef-green dark:text-acef-light-green font-bold flex items-center group transition-colors">
                        {{ __('buttons.view_all_projects') }} <svg
                            class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    @foreach($featuredProjects as $project)
                        <div class="group cursor-pointer">
                            <div class="relative rounded-lg overflow-hidden aspect-[4/5] mb-6 shadow-lg">
                                <img src="{{ $project->image ? Storage::url($project->image) : asset('default-project.jpg') }}" alt="{{ $project->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute top-6 left-6">
                                    <span
                                        class="bg-acef-green text-white px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">{{ $project->category }}</span>
                                </div>
                            </div>
                            <h3
                                class="text-2xl font-bold text-acef-dark dark:text-white group-hover:text-acef-green transition-colors mb-2">
                                {{ $project->title }}
                            </h3>
                            <p class="text-gray-500 line-clamp-2 italic mb-4">{{Str::limit($project->description, 100)}}</p>
                            <a href="{{ route('projects.show', $project) }}"
                                class="font-bold text-acef-dark dark:text-white group-hover:text-acef-green transition-colors flex items-center">
                                {{ __('buttons.read_more') }} <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-16 md:py-24 bg-white relative overflow-hidden border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12 text-center" x-data="{
                    stats: [
                        @foreach(__('pages.home.stats') as $stat)
                        { value: {{ (int)str_replace(['+', '%', ','], '', $stat['value']) }}, label: '{{ $stat['label'] }}', current: 0, suffix: '{{ preg_replace('/[0-9,]/', '', $stat['value']) }}' },
                        @endforeach
                    ],
                    startCount() {
                        this.stats.forEach(stat => {
                            let start = 0;
                            let end = stat.value;
                            let duration = 2000;
                            let startTime = null;

                            const step = (timestamp) => {
                                if (!startTime) startTime = timestamp;
                                const progress = Math.min((timestamp - startTime) / duration, 1);
                                stat.current = Math.floor(progress * (end - start) + start);
                                if (progress < 1) {
                                    window.requestAnimationFrame(step);
                                }
                            };
                            window.requestAnimationFrame(step);
                        });
                    }
                }" x-intersect.once="startCount()">
                    <template x-for="stat in stats">
                        <div class="space-y-2 group cursor-default p-4">
                            <span class="text-4xl md:text-6xl font-black text-acef-green dark:text-acef-light-green block transform group-hover:scale-110 transition-transform duration-500" x-text="stat.current.toLocaleString() + stat.suffix">0</span>
                            <span
                                class="text-acef-dark dark:text-white uppercase tracking-widest text-[10px] md:text-xs font-bold group-hover:text-acef-green transition-colors" x-text="stat.label"></span>
                        </div>
                    </template>
                </div>
            </div>
        </section>

        <!-- Featured Video Section -->
        <section class="py-16 md:py-24 bg-acef-gray relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-5xl mx-auto">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border-4 border-white aspect-video group">
                        <!-- Video: The Great Green Wall (User Provided) -->
                        <iframe 
                            class="w-full h-full object-cover transform scale-105 group-hover:scale-100 transition-transform duration-700"
                            src="https://www.youtube.com/embed/M_Fx1EhJcA4?start=25&autoplay=1&mute=1&controls=0&loop=1&playlist=M_Fx1EhJcA4&rel=0&modestbranding=1" 
                            title="The Great Green Wall" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                            referrerpolicy="strict-origin-when-cross-origin" 
                            allowfullscreen>
                        </iframe>
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-acef-dark/80 via-transparent to-transparent pointer-events-none"></div>
                        <div class="absolute bottom-8 left-8 text-white pointer-events-none">
                            <span class="bg-acef-green px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-2 inline-block">Watch Our Impact</span>
                            <h3 class="text-2xl font-bold">Restoring Africa's Natural Heritage</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Map Section -->
        <section class="py-24 bg-acef-dark relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center space-y-12">
                <div class="text-center space-y-4 max-w-2xl">
                    <p class="text-acef-light-green font-bold tracking-widest uppercase text-sm">
                        {{ __('pages.home.map_section.label') }}</p>
                    <h2 class="text-5xl font-black text-white tracking-tighter">
                        {{ __('pages.home.map_section.title') }}
                    </h2>
                    <p class="text-white/60 font-light italic">{{ __('pages.home.map_section.subtitle') }}</p>
                </div>

                <div class="relative w-full max-w-5xl h-[350px] md:h-[600px] mx-auto mt-10">
                    <div id="africa-map" class="w-full h-full rounded-2xl shadow-2xl border border-white/10 bg-acef-dark z-10 relative"></div>
                </div>
            </div>
        </section>

        <!-- News & Insights -->
        <section class="py-24 bg-acef-gray">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
                <div class="flex justify-between items-end">
                    <div class="space-y-4">
                        <h2 class="text-5xl font-black text-acef-dark dark:text-white tracking-tighter">
                            {{ __('pages.home.news_title') }}
                        </h2>
                        <p class="text-gray-500 font-light italic">{{ __('pages.home.news_subtitle') }}</p>
                    </div>
                    <a href="{{ route('news') }}" class="text-acef-green dark:text-acef-light-green font-bold flex items-center group transition-colors">
                        {{ __('buttons.visit_blog') }} <svg
                            class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach($latestNews as $news)
                        <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all group">
                            <div class="relative aspect-video overflow-hidden">
                                <img src="{{ $news->image ? (str_starts_with($news->image, 'http') ? $news->image : Storage::url($news->image)) : asset('default-news.jpg') }}" alt="{{ $news->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute bottom-4 left-4">
                                    <span
                                        class="bg-acef-green text-white px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider shadow-lg">{{ $news->category->name ?? 'News' }}</span>
                                </div>
                            </div>
                            <div class="p-8 space-y-4">
                                <span
                                    class="text-gray-400 text-xs font-semibold uppercase tracking-wider">{{ $news->published_at ? $news->published_at->format('M d, Y') : 'Draft' }}</span>
                                <h3
                                    class="text-xl font-bold text-acef-dark dark:text-white group-hover:text-acef-green transition-colors leading-tight">
                                    {{ $news->title }}
                                </h3>
                                <p class="text-gray-500 italic">{{ Str::limit($news->excerpt, 100) }}</p>
                                <div class="pt-2 border-t border-gray-100">
                                    <a href="{{ route('news.show', $news) }}"
                                        class="text-acef-dark dark:text-white font-bold text-base flex items-center group-hover:text-acef-green transition-colors">
                                        {{ __('buttons.read_more') }} <svg class="w-4 h-4 ml-1" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Partners Section -->
        @if($partners->count() > 0)
        <section class="py-24 bg-white dark:bg-gray-900 overflow-hidden relative border-t border-gray-50 dark:border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
                <p class="text-center text-gray-400 dark:text-gray-500 font-black uppercase tracking-[0.4em] text-[11px]">
                    {{ __('pages.home.partners_title') }}
                </p>
                
                <div class="relative group">
                    <!-- Edge Mask Gradients -->
                    <div class="absolute inset-y-0 left-0 w-32 bg-gradient-to-r from-white dark:from-gray-900 to-transparent z-10 pointer-events-none"></div>
                    <div class="absolute inset-y-0 right-0 w-32 bg-gradient-to-l from-white dark:from-gray-900 to-transparent z-10 pointer-events-none"></div>

                    <!-- Partners Carousel -->
                    <div class="flex overflow-hidden">
                        <div class="flex animate-scroll hover:[animation-play-state:paused] gap-16 items-center py-4">
                            @php $partnerList = $partners->concat($partners)->concat($partners); @endphp
                            @foreach($partnerList as $partner)
                                <div class="flex-shrink-0 w-56 md:w-80 h-32 transition-all duration-700 flex items-center justify-center p-4">
                                    @if($partner->logo)
                                        <img src="{{ Storage::url($partner->logo) }}" 
                                             alt="{{ $partner->name }}" 
                                             class="max-h-full max-w-full object-contain transition-transform hover:scale-110 duration-500" 
                                             title="{{ $partner->name }}">
                                    @else
                                        <span class="text-2xl font-black text-acef-dark dark:text-white/20 tracking-tighter opacity-50 group-hover:opacity-100 transition-opacity">{{ strtoupper($partner->name) }}</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <style>
            @keyframes scroll {
                0% { transform: translateX(0); }
                100% { transform: translateX(calc(-50% - 1.5rem)); }
            }
            .animate-scroll {
                animation: scroll 60s linear infinite;
                display: flex;
                width: max-content;
            }
        </style>
        @endif
    </main>
    @include('components.footer')

    <style>
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 1s ease-out forwards;
        }

        .delay-100 {
            animation-delay: 0.2s;
        }

        .delay-200 {
            animation-delay: 0.4s;
        }
    </style>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
             if (!document.getElementById('africa-map')) return;

            var map = L.map('africa-map', {
                center: [0, 20],
                zoom: 3.5,
                zoomControl: false,
                scrollWheelZoom: false,
                dragging: false,
                doubleClickZoom: false,
                attributionControl: false
            });

            L.control.attribution({position: 'bottomright'}).addAttribution('&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors').addTo(map);

            const activeCountries = [
                'Kenya', 'Cameroon', 'Sierra Leone', 'Benin', 'Nigeria', 
                'DR Congo', 'Zimbabwe', 'Tanzania', 'Uganda', 'Zambia', 
                'Liberia', 'Ghana', 'Rwanda', 'Angola'
            ];

            fetch('/africa.geojson')
                .then(response => response.json())
                .then(data => {
                    L.geoJSON(data, {
                        style: function(feature) {
                            const countryName = feature.properties.name;
                            const isActive = activeCountries.includes(countryName);

                            return {
                                fillColor: isActive ? '#134712' : '#374151', 
                                weight: 1,
                                opacity: 1,
                                color: '#4b5563',
                                dashArray: '',
                                fillOpacity: isActive ? 1.0 : 0.8
                            };
                        },
                        onEachFeature: function(feature, layer) {
                            if (activeCountries.includes(feature.properties.name)) {
                                layer.bindTooltip(feature.properties.name, {
                                    permanent: false,
                                    direction: 'center',
                                    className: 'bg-white text-acef-dark font-bold px-2 py-1 rounded shadow-lg border-0'
                                });
                                
                                layer.on({
                                    mouseover: function(e) {
                                        var layer = e.target;
                                        layer.setStyle({
                                            fillOpacity: 1,
                                            weight: 2,
                                            color: '#fff'
                                        });
                                    },
                                    mouseout: function(e) {
                                        var layer = e.target;
                                        layer.setStyle({
                                            fillOpacity: 0.9,
                                            weight: 1,
                                            color: '#111827'
                                        });
                                    }
                                });
                            }
                        }
                    }).addTo(map);
                })
                .catch(error => console.error('Error loading GeoJSON:', error));
        });
    </script>
</body>

</html>