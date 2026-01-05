<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" content="notranslate">
    <title>{{ strip_tags(__('pages.impact.hero_title')) }} - ACEF</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @php
        $impactPage = \App\Models\Page::where('slug', 'impact')->first();
        $heroSlides = $impactPage ? $impactPage->activeHeroSlides()->with('media')->get() : collect();
    @endphp
</head>

<body class="antialiased font-sans bg-white overflow-x-hidden">
    @include('components.header')

    <x-hero 
        :page="$impactPage"
        :slides="$heroSlides"
        breadcrumb="🛡️ {{ __('pages.impact.transparency_badge') }}"
        title="{!! __('pages.impact.hero_title') !!}"
        subtitle="{{ __('pages.impact.hero_desc') }}"
        image-url="/hero_marine_ecosystem_1766827540454.png"
    >
        <x-slot name="actions">
            <a href="{{ isset($settings['annual_report']) ? Storage::url($settings['annual_report']) : '#' }}"
                {{ isset($settings['annual_report']) ? 'download' : '' }}
                class="bg-acef-green text-acef-dark font-bold px-8 py-4 rounded-2xl flex items-center space-x-3 hover:bg-white transition-all shadow-xl group transform hover:scale-105">
                <span>{{ __('pages.impact.download_report') }}</span>
                <svg class="w-5 h-5 group-hover:translate-y-1 transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
            </a>
            <a href="{{ isset($settings['methodology_doc']) ? Storage::url($settings['methodology_doc']) : '#' }}"
                {{ isset($settings['methodology_doc']) ? 'target="_blank"' : '' }}
                class="text-white font-bold px-8 py-4 rounded-2xl border-2 border-white/30 hover:bg-white/10 hover:border-white transition-all backdrop-blur-sm">
                {{ __('pages.impact.view_methodology') }}
            </a>
        </x-slot>
    </x-hero>

    <!-- Key Stats -->
    <section class="pt-24 pb-24 bg-white dark:bg-gray-900 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6" x-data="{
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
                @foreach(__('pages.home.stats') as $index => $stat)
                    <div
                        class="bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 p-8 rounded-2xl flex flex-col items-center space-y-4 shadow-sm hover:shadow-xl transition-all">
                        <div
                            class="w-14 h-14 bg-white dark:bg-gray-700 rounded-2xl flex items-center justify-center shadow-sm text-acef-green">
                            @if($index === 0)
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            @elseif($index === 1)
                                <span>👥</span>
                            @elseif($index === 2)
                                <span>🤝</span>
                            @else
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                    </path>
                                </svg>
                            @endif
                        </div>
                        <h3 class="text-gray-400 dark:text-gray-500 font-bold uppercase tracking-widest text-xs">{{ $stat['label'] }}</h3>
                        <span class="text-4xl font-bold text-acef-dark dark:text-white" x-text="stats[{{ $index }}].current.toLocaleString() + stats[{{ $index }}].suffix">0</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Interactive Map Section -->
    <section class="py-24 bg-white dark:bg-gray-900 border-t border-gray-50 dark:border-gray-800 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Map Area -->
                <div class="lg:col-span-8">
                    <div class="space-y-8 text-left mb-8">
                        <h2 class="text-4xl md:text-5xl font-bold text-acef-dark dark:text-white tracking-tighter">{{ __('pages.impact.map_title') }}</h2>
                        <p class="text-gray-500 dark:text-gray-400 font-light italic text-lg">{{ __('pages.impact.map_desc') }}</p>
                    </div>
                    
                    <div class="relative w-full rounded-2xl overflow-hidden shadow-2xl border border-gray-100 dark:border-gray-700 bg-acef-dark h-[600px] z-10">
                        <div id="africa-map" class="w-full h-full"></div>
                    </div>
                </div>

                <!-- Countries List -->
                <div class="lg:col-span-4 space-y-8">
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-8 md:p-10 border border-gray-100 dark:border-gray-700 h-full">
                        <div class="flex items-center space-x-3 mb-6">
                            <span class="w-2 h-8 bg-acef-green rounded-full"></span>
                            <h3 class="text-2xl font-bold text-acef-dark dark:text-white tracking-tight">Active Nations</h3>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-y-4 gap-x-2">
                             @php
                                $countries = [
                                    'Kenya', 'Cameroon', 'Sierra Leone', 'Benin', 'Nigeria', 
                                    'Democratic Republic of the Congo', 'Zimbabwe', 'Tanzania', 'Uganda', 'Zambia', 
                                    'Liberia', 'Ghana', 'Rwanda', 'Angola'
                                ];
                                sort($countries);
                            @endphp
                            @foreach($countries as $country)
                                <div class="flex items-center space-x-2 group cursor-default">
                                    <div class="w-1.5 h-1.5 rounded-full bg-acef-green/40 group-hover:bg-acef-green transition-colors"></div>
                                    <span class="text-gray-600 dark:text-gray-300 font-medium text-sm group-hover:text-acef-dark dark:group-hover:text-white transition-colors">{{ $country }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
                             <p class="text-xs text-gray-400 italic">Operating active field offices and partner networks across these regions.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if map container exists
             if (!document.getElementById('africa-map')) return;

            // Initialize Map focused on Africa
            var map = L.map('africa-map', {
                center: [0, 20], // Center of Africa
                zoom: 3.5,
                zoomControl: false,
                scrollWheelZoom: false,
                dragging: false, // Keep it static-like as requested, or set to true for interaction
                doubleClickZoom: false,
                attributionControl: false
            });

            // Add custom attribution bottom right
            L.control.attribution({position: 'bottomright'}).addAttribution('&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors').addTo(map);

            // Active Countries List
            const activeCountries = [
                'Kenya', 'Cameroon', 'Sierra Leone', 'Benin', 'Nigeria', 
                'DR Congo', 'Zimbabwe', 'Tanzania', 'Uganda', 'Zambia', 
                'Liberia', 'Ghana', 'Rwanda', 'Angola'
            ];

            // Fetch GeoJSON
            fetch('/africa.geojson')
                .then(response => response.json())
                .then(data => {
                    L.geoJSON(data, {
                        style: function(feature) {
                            // Check if country name is in our active list
                            // GeoJSON properties usually have 'name' or 'name_long'
                            const countryName = feature.properties.name;
                            const isActive = activeCountries.includes(countryName);

                            return {
                                fillColor: isActive ? '#00e573' : '#1f2937', // acef-green vs gray-800
                                weight: 1,
                                opacity: 1,
                                color: '#111827', // Dark border
                                dashArray: '',
                                fillOpacity: isActive ? 0.9 : 0.4
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

    <!-- Final Projects Slider/Highlights -->
    <section class="py-24 bg-white dark:bg-gray-900 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="flex flex-wrap items-end justify-between gap-8">
                <h2 class="text-5xl font-bold text-acef-dark dark:text-white tracking-tighter">{{ __('pages.impact.projects_title') }}
                </h2>
                <div class="flex flex-wrap items-center gap-4">
                    <select class="bg-gray-50 dark:bg-gray-800 border-none rounded-xl py-3 px-6 text-sm font-semibold text-gray-400 dark:text-gray-500 focus:ring-2 focus:ring-acef-green outline-none">
                        <option>{{ __('pages.projects_page.filter_category') }}</option>
                    </select>
                    <select class="bg-gray-50 dark:bg-gray-800 border-none rounded-xl py-3 px-6 text-sm font-semibold text-gray-400 dark:text-gray-500 focus:ring-2 focus:ring-acef-green outline-none">
                        <option>{{ __('pages.projects_page.filter_country') }}</option>
                    </select>
                    <div class="relative">
                        <input type="text" placeholder="{{ __('pages.projects_page.search_placeholder') }}"
                            class="pl-12 pr-6 py-3 bg-gray-50 dark:bg-gray-800 border-none rounded-xl text-sm w-full md:w-64 dark:text-white focus:ring-2 focus:ring-acef-green outline-none">
                        <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 dark:text-gray-600" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach($impactProjects as $proj)
                    <div
                        class="group bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-sm hover:shadow-2xl transition-all border border-gray-50 dark:border-gray-700">
                        <div class="relative aspect-[4/3] overflow-hidden">
                            <img src="{{ $proj->image ? Storage::url($proj->image) : asset('default-project.jpg') }}" alt="{{ $proj->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute top-6 left-6">
                                <span
                                    class="bg-acef-green dark:bg-emerald-500 text-white px-4 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider shadow-lg border border-white/20 shadow-acef-green/20">
                                    {{ $proj->category }}
                                </span>
                            </div>
                        </div>
                        <div class="p-8 space-y-4">
                            <div class="flex items-center text-acef-green text-xs font-semibold uppercase tracking-widest">
                                <span>{{ $proj->created_at->format('M Y') }}</span>
                                <span class="mx-2 text-gray-300 dark:text-gray-600">•</span>
                                @php
                                    $isFunded = $proj->goal_amount > 0 && $proj->raised_amount >= $proj->goal_amount;
                                    $statusLabel = $isFunded ? 'Funded' : 'Active';
                                    $statusClass = $isFunded ? 'text-blue-500' : 'text-emerald-500';
                                @endphp
                                <span
                                    class="{{ $statusClass }}">{{ $statusLabel }}</span>
                            </div>
                            <h3 class="text-2xl font-black text-acef-dark dark:text-white leading-tight group-hover:text-acef-green transition-colors">{{ $proj->title }}</h3>
                            <p class="text-gray-400 dark:text-gray-500 text-sm line-clamp-3 font-light leading-relaxed">{{ Str::limit($proj->description, 100) }}</p>
                            <a href="{{ route('projects.show', $proj) }}"
                                class="w-full py-4 border-2 border-gray-100 dark:border-gray-700 rounded-xl font-black text-xs hover:border-acef-dark dark:hover:border-acef-green dark:hover:text-acef-green transition-all block text-center uppercase tracking-widest">{{ __('buttons.read_more') }}</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-center pt-8">
                <button
                    class="flex items-center space-x-2 text-acef-dark dark:text-white font-bold text-sm hover:text-acef-green transition-colors group">
                    <span>{{ __('pages.impact.projects_load_more') }}</span>
                    <svg class="w-4 h-4 group-hover:translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 13l-7 7-7-7m14-8l-7 7-7-7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <!-- Join Us CTA -->
    <section class="py-24 bg-acef-dark text-white relative overflow-hidden">
        <!-- Background highlights -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-acef-green opacity-10 rounded-full blur-[150px]">
        </div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-acef-green opacity-5 rounded-full blur-[150px]">
        </div>

        <div class="max-w-4xl mx-auto px-4 text-center space-y-12 relative z-10">
            <h2 class="text-5xl md:text-7xl font-bold tracking-tighter leading-tight">
                {!! __('pages.impact.cta_title') !!}
            </h2>
            <p class="text-white/60 text-lg md:text-xl font-light italic leading-relaxed">
                {{ __('pages.impact.cta_desc') }}
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6 pt-4">
                <a href="{{ route('get-involved') }}"
                    class="w-full sm:w-auto bg-acef-green text-acef-dark font-bold px-12 py-5 rounded-2xl hover:bg-white transition-all transform hover:scale-105 shadow-2xl">
                    {{ __('pages.impact.partner_btn') }}
                </a>
                <a href="{{ route('donate') }}"
                    class="w-full sm:w-auto bg-white/5 border-2 border-white/10 text-white font-bold px-12 py-5 rounded-2xl hover:bg-white/10 transition-all">
                    {{ __('pages.impact.donate_btn') }}
                </a>
            </div>
        </div>
    </section>

    @include('components.footer')
</body>

</html>