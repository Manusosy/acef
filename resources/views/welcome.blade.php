@php
    $generalSettings = \App\Models\Setting::getGroup('general');
    $siteName = $generalSettings['site_name'] ?? 'ACEF';
    $siteTagline = $generalSettings['site_tagline'] ?? null;
    $siteFavicon = $generalSettings['site_favicon'] ?? null;
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
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans bg-white overflow-x-hidden">
    @include('components.header')

    <!-- Hero Section -->
    <section class="relative h-screen min-h-[700px] flex items-center overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="/hero_marine_ecosystem_1766827540454.png" alt="African Marine Ecosystem"
                class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-acef-dark/80 via-acef-dark/40 to-transparent"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full pt-32 pb-20 md:pt-48 md:pb-32">
            <div class="space-y-6 animate-fade-in-up">
                <span
                    class="inline-block py-2 px-6 rounded-full bg-acef-green/20 text-acef-green font-bold text-sm tracking-wider uppercase">{!! __('pages.home.founded') !!}</span>
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white leading-tight tracking-tighter max-w-4xl">
                    {!! __('pages.home.hero_title') !!}
                </h1>
            </div>
            <p
                class="text-lg md:text-xl font-light text-white/90 leading-relaxed max-w-2xl mt-6 animate-fade-in-up delay-100 italic">
                {!! __('pages.home.hero_subtitle') !!}
            </p>
            <div
                class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6 pt-4 animate-fade-in-up delay-200">
                <a href="{{ route('get-involved') }}"
                    class="bg-acef-green text-white px-10 py-5 rounded-full font-bold text-lg hover:scale-105 transition-transform shadow-2xl shadow-acef-green/30 flex items-center justify-center">
                    {{ __('buttons.get_involved') }}
                </a>
                <a href="{{ route('impact') }}"
                    class="bg-white/10 backdrop-blur-md border border-white/20 text-white px-10 py-5 rounded-full font-bold text-lg hover:bg-white/20 transition-all flex items-center justify-center">
                    {{ __('buttons.see_impact') }}
                </a>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 text-white animate-bounce">
            <svg class="w-6 h-6 text-acef-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
    </section>

    <main>
        <!-- Who We Are Section -->
        <section class="py-24 bg-white relative">
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
                            <p class="text-acef-green font-bold tracking-widest uppercase text-sm">
                                {{ __('pages.home.who_we_are_title') }}
                            </p>
                            <h2 class="text-5xl font-black text-acef-dark tracking-tighter leading-tight">
                                {!! __('pages.home.who_we_are_heading') !!}
                            </h2>
                        </div>
                        <p class="text-xl text-gray-600 leading-relaxed font-light">
                            {!! __('pages.home.who_we_are_text') !!}
                        </p>
                        <p class="text-gray-500 leading-relaxed font-light italic">
                            {!! __('pages.home.who_we_are_subtext') !!}
                        </p>
                        <div class="pt-4 grid grid-cols-2 gap-8">
                            <div class="flex flex-col">
                                <span class="text-4xl font-black text-acef-dark">14+</span>
                                <span
                                    class="text-xs text-gray-400 font-bold uppercase tracking-widest">{{ __('pages.home.countries') }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-4xl font-black text-acef-dark">2,000+</span>
                                <span
                                    class="text-xs text-gray-400 font-bold uppercase tracking-widest">{{ __('pages.home.members') }}</span>
                            </div>
                        </div>
                        <div class="pt-4">
                            <a href="{{ route('about') }}"
                                class="inline-block bg-acef-dark text-white px-10 py-5 rounded-full font-bold hover:bg-opacity-90 transition-all shadow-xl">
                                {{ __('buttons.our_story') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Programmes Section -->
        <section class="py-24 bg-acef-gray">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
                <h2 class="text-5xl font-black text-acef-dark tracking-tighter">{{ __('pages.home.programmes_title') }}
                </h2>
                <p class="text-gray-500 max-w-2xl mx-auto font-light italic">
                    {{ __('pages.home.programmes_subtitle') }}
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 pt-16">
                    @foreach(__('pages.home.programmes') as $prog)
                        <div
                            class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all group text-left border border-black/5 flex flex-col justify-between">
                            <div class="space-y-4">
                                <div
                                    class="w-14 h-14 rounded-2xl bg-{{ $prog['icon'] }}-50 flex items-center justify-center group-hover:bg-acef-green group-hover:text-white transition-colors duration-500 text-{{ $prog['icon'] }}-500">
                                    @php
                                        $icon = $prog['icon'];
                                    @endphp
                                    @if($icon == 'blue')
                                        <!-- Atlantic Coast (Shield/Waves) -->
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                        </svg>
                                    @elseif($icon == 'green')
                                        <!-- Marine Ecosystems (Globe/Water) -->
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @elseif($icon == 'indigo')
                                        <!-- Research (Beaker) -->
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                        </svg>
                                    @elseif($icon == 'amber')
                                        <!-- Climate (Sun/Cloud) -->
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                        </svg>
                                    @elseif($icon == 'emerald')
                                        <!-- Biodiversity (Leaf) -->
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                    @elseif($icon == 'sky')
                                        <!-- Pollution (Water Drop) -->
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                        </svg>
                                    @elseif($icon == 'lime')
                                        <!-- Agro-forestry (Tree) -->
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                        </svg>
                                    @elseif($icon == 'cyan')
                                        <!-- Eco-Tourism (Camera/Map) -->
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21v-8a2 2 0 012-2h14a2 2 0 012 2v8M3 21h18M5 21v-8a2 2 0 012-2h14a2 2 0 012 2v8M9 7h6m0 0v2m0-2h4a1 1 0 011 1v1m-7 4h12l-3-6H5l-3 6h7"></path>
                                        </svg>
                                    @elseif($icon == 'rose')
                                        <!-- Health (Heart) -->
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                    @elseif($icon == 'violet')
                                        <!-- Leaders (Users) -->
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                        </svg>
                                    @else
                                        <!-- Fallback -->
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 21l-8-9 8-9 8 9-8 9z"></path>
                                        </svg>
                                    @endif
                                </div>
                                <h3 class="text-xl font-bold text-acef-dark group-hover:text-acef-green transition-colors">
                                    {{ $prog['title'] }}
                                </h3>
                                <p class="text-gray-500 text-sm leading-relaxed">{{ $prog['desc'] }}</p>
                            </div>
                            <div class="pt-6">
                                <a href="{{ route('programmes') }}"
                                    class="text-acef-green font-bold flex items-center text-sm group-hover:translate-x-1 transition-transform">
                                    {{ __('buttons.read_more') }} <svg class="w-4 h-4 ml-1" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Featured Projects Section -->
        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
                <div class="flex justify-between items-end">
                    <div class="space-y-4">
                        <h2 class="text-5xl font-black text-acef-dark tracking-tighter">
                            {{ __('pages.home.featured_projects_title') }}
                        </h2>
                        <p class="text-gray-500 font-light italic">{{ __('pages.home.featured_projects_subtitle') }}
                        </p>
                    </div>
                    <a href="{{ route('projects') }}" class="text-acef-green font-bold flex items-center group">
                        {{ __('buttons.view_all_projects') }} <svg
                            class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    @foreach(__('pages.home.projects') as $project)
                        <div class="group cursor-pointer">
                            <div class="relative rounded-3xl overflow-hidden aspect-[4/5] mb-6 shadow-lg">
                                <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute top-6 left-6">
                                    <span
                                        class="bg-acef-green text-white px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">{{ $project['category'] }}</span>
                                </div>
                            </div>
                            <h3
                                class="text-2xl font-bold text-acef-dark group-hover:text-acef-green transition-colors mb-2">
                                {{ $project['title'] }}
                            </h3>
                            <p class="text-gray-500 text-sm line-clamp-2 italic mb-4">{{ $project['desc'] }}</p>
                            <a href="{{ route('projects') }}"
                                class="font-bold text-acef-dark group-hover:text-acef-green transition-colors flex items-center">
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
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12 text-center">
                    @foreach(__('pages.home.stats') as $stat)
                        <div class="space-y-2 group cursor-default p-4">
                            <span class="text-4xl md:text-6xl font-black text-acef-green block transform group-hover:scale-110 transition-transform duration-500">{{ $stat['value'] }}</span>
                            <span
                                class="text-acef-dark uppercase tracking-widest text-[10px] md:text-xs font-bold group-hover:text-acef-green transition-colors">{{ $stat['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Featured Video Section -->
        <section class="py-16 md:py-24 bg-acef-gray relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-5xl mx-auto">
                    <div class="relative rounded-[30px] md:rounded-[40px] overflow-hidden shadow-2xl border-4 border-white aspect-video group">
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
                    <p class="text-acef-green font-bold tracking-widest uppercase text-sm">
                        {{ __('pages.home.map_section.label') }}</p>
                    <h2 class="text-5xl font-black text-white tracking-tighter">
                        {{ __('pages.home.map_section.title') }}
                    </h2>
                    <p class="text-white/60 font-light italic">{{ __('pages.home.map_section.subtitle') }}</p>
                </div>

                <div class="relative w-full max-w-5xl h-[350px] md:h-[600px] mx-auto mt-10">
                    <div id="africa-map" class="w-full h-full rounded-3xl shadow-2xl border border-white/10 bg-acef-dark z-10 relative"></div>
                </div>
            </div>
        </section>

        <!-- News & Insights -->
        <section class="py-24 bg-acef-gray">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
                <div class="flex justify-between items-end">
                    <div class="space-y-4">
                        <h2 class="text-5xl font-black text-acef-dark tracking-tighter">
                            {{ __('pages.home.news_title') }}
                        </h2>
                        <p class="text-gray-500 font-light italic">{{ __('pages.home.news_subtitle') }}</p>
                    </div>
                    <a href="{{ route('news') }}" class="text-acef-green font-bold flex items-center group">
                        {{ __('buttons.visit_blog') }} <svg
                            class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @php
                        $news_items = __('pages.home.news_articles');
                        $news_images = [
                            '/project_mangroves_1766827746442.png',
                            '/hero_marine_ecosystem_1766827540454.png',
                            '/project_tree_planting_1766827726209.png'
                        ];
                    @endphp
                    @foreach($news_items as $index => $news)
                        <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all group">
                            <div class="relative aspect-video overflow-hidden">
                                <img src="{{ $news_images[$index] }}" alt="{{ $news['category'] }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute bottom-4 left-4">
                                    <span
                                        class="bg-white/90 backdrop-blur-md text-acef-dark px-3 py-1 rounded-full text-[10px] font-bold uppercase">{{ $news['category'] }}</span>
                                </div>
                            </div>
                            <div class="p-8 space-y-4">
                                <span
                                    class="text-gray-400 text-xs font-semibold uppercase tracking-wider">{{ $news['date'] }}</span>
                                <h3
                                    class="text-xl font-bold text-acef-dark group-hover:text-acef-green transition-colors leading-tight">
                                    {{ $news['title'] }}
                                </h3>
                                <p class="text-gray-500 text-sm italic">{{ $news['desc'] }}</p>
                                <div class="pt-2 border-t border-gray-100">
                                    <a href="{{ route('news') }}"
                                        class="text-acef-dark font-bold text-sm flex items-center group-hover:text-acef-green transition-colors">
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
        @php
            $homepagePartners = \App\Models\Partner::where('is_active', true)
                ->where('show_on_homepage', true)
                ->orderBy('sort_order')
                ->get();
        @endphp
        @if($homepagePartners->count() > 0)
        <section class="py-20 bg-white overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
                <p class="text-center text-gray-400 font-bold uppercase tracking-[0.3em] text-xs">
                    {{ __('pages.home.partners_title') }}
                </p>
                <div class="relative">
                    <!-- Simple Logo Cloud -->
                    <div class="flex flex-wrap justify-center items-center gap-12 grayscale opacity-40 hover:opacity-100 transition-opacity">
                        @foreach($homepagePartners as $partner)
                            @if($partner->logo)
                                <img src="{{ Storage::url($partner->logo) }}" alt="{{ $partner->name }}" class="h-12 w-auto object-contain transition-transform hover:scale-110" title="{{ $partner->name }}">
                            @else
                                <span class="text-2xl font-black text-acef-dark tracking-tighter">{{ strtoupper($partner->name) }}</span>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
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
                                fillColor: isActive ? '#00e573' : '#1f2937', 
                                weight: 1,
                                opacity: 1,
                                color: '#111827',
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
</body>

</html>