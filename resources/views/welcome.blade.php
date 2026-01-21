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

<body class="antialiased font-sans bg-white dark:bg-gray-900 overflow-x-hidden transition-colors duration-500">
    @include('components.header')

    <x-hero 
        :page="$homePage"
        :slides="$heroSlides"
        :breadcrumb="__('pages.home.founded')"
        title="{!! __('pages.home.hero_title') !!}"
        subtitle="{!! __('pages.home.hero_subtitle') !!}"
        height=""
        min-height=""
        class="h-screen md:h-[70vh] min-h-[600px]"
        style="height: 85vh; min-height: 600px;"
        image-url="/hero_marine_ecosystem_1766827540454.png"
    >
        <x-slot name="actions">
            <a href="{{ route('get-involved') }}"
                class="bg-acef-green text-white px-8 py-4 rounded-xl font-bold text-lg hover:scale-105 transition-transform shadow-2xl shadow-acef-green/30 flex items-center justify-center group gap-2">
                {{ __('buttons.get_involved') }}
                <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
            <a href="{{ route('impact') }}"
                class="bg-white/10 backdrop-blur-md border border-white/20 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-white/20 transition-all flex items-center justify-center">
                {{ __('buttons.see_impact') }}
            </a>
        </x-slot>
    </x-hero>

    <main>
        <!-- Who We Are Section -->
        <section x-data="{ shown: false }" x-intersect.once.margin.0px.0px.-100px.0px="shown = true" 
                 class="py-24 bg-white dark:bg-gray-950 transition-colors duration-300 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" :class="{ 'animate-fade-in-up': shown }">
                <div class="flex flex-col lg:flex-row items-center gap-16">
                    <div class="w-full lg:w-1/2 relative flex justify-center lg:justify-start">
                        <div class="relative z-10 rounded-xl overflow-hidden shadow-2xl h-[280px] sm:h-[400px] lg:h-[450px] w-full max-w-2xl bg-gray-100 dark:bg-gray-800" style="aspect-ratio: 4/3;">
                            @if(isset($whoWeAreImages) && $whoWeAreImages->isNotEmpty())
                                {{-- Carousel Mode --}}
                                <div x-data="{ 
                                    active: 0, 
                                    count: {{ $whoWeAreImages->count() }},
                                    timer: null,
                                    next() { this.active = (this.active + 1) % this.count },
                                    start() { this.timer = setInterval(() => this.next(), 8000) },
                                    stop() { clearInterval(this.timer) }
                                }" x-init="start()" @mouseenter="stop()" @mouseleave="start()" class="relative w-full h-full group">
                                    
                                    @foreach($whoWeAreImages as $index => $image)
                                        <div x-show="active === {{ $index }}"
                                             x-transition:enter="transition ease-in-out duration-[1000ms]"
                                             x-transition:enter-start="opacity-0"
                                             x-transition:enter-end="opacity-100"
                                             x-transition:leave="transition ease-in-out duration-[1000ms]"
                                             x-transition:leave-start="opacity-100"
                                             x-transition:leave-end="opacity-0"
                                             class="absolute inset-0 w-full h-full">
                                            @if($image->media)
                                                <img src="{{ str_starts_with($image->media->url, 'http') ? $image->media->url : url($image->media->url) }}" alt="{{ $image->caption ?? 'ACEF Work' }}" 
                                                     class="w-full h-full object-cover"
                                                     onerror="this.src='/mission_vision_africa_1766827653058.png'">
                                            @else
                                                <img src="/mission_vision_africa_1766827653058.png" alt="Who We Are"
                                                     class="w-full h-full object-cover">
                                            @endif
                                            
                                            {{-- Caption Overlay --}}
                                            @if($image->country || $image->caption)
                                                <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/80 via-black/40 to-transparent text-white">
                                                    @if($image->country)
                                                        <div class="inline-flex items-center gap-2 bg-acef-green px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider mb-2">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                                            {{ $image->country }}
                                                        </div>
                                                    @endif
                                                    @if($image->caption)
                                                        <p class="text-xs font-medium leading-relaxed opacity-90 line-clamp-2">{{ $image->caption }}</p>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach

                                    {{-- Indicators --}}
                                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-1.5 z-20">
                                        <template x-for="i in count" :key="i">
                                            <button @click="active = i-1" 
                                                    :class="active === i-1 ? 'bg-acef-green w-6' : 'bg-white/50 w-1.5 hover:bg-white'"
                                                    class="h-1 rounded-full transition-all duration-300"></button>
                                        </template>
                                    </div>
                                </div>
                            @else
                                {{-- Static Fallback --}}
                                <img src="/mission_vision_africa_1766827653058.png" alt="Who We Are"
                                    class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div class="absolute -top-4 -left-4 w-24 h-24 border-2 border-acef-green rounded-xl -z-0 opacity-30">
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
                        <div class="pt-10 flex flex-col sm:flex-row items-center gap-10" x-data="{
                            countries: 0,
                            members: 0,
                            startCount() {
                                this.animateValue('countries', 14, 2000);
                                this.animateValue('members', 2000, 2000);
                            },
                            animateValue(prop, end, duration) {
                                let start = 0;
                                let startTime = null;
                                const step = (timestamp) => {
                                    if (!startTime) startTime = timestamp;
                                    const progress = Math.min((timestamp - startTime) / duration, 1);
                                    this[prop] = Math.floor(progress * (end - start) + start);
                                    if (progress < 1) window.requestAnimationFrame(step);
                                };
                                window.requestAnimationFrame(step);
                            }
                        }" x-intersect.once="startCount()">
                            {{-- Action Button --}}
                            <div class="flex-shrink-0">
                                <a href="{{ route('about') }}"
                                    class="inline-flex items-center gap-3 bg-acef-dark text-white px-10 py-5 rounded-xl font-bold hover:bg-yellow-400 hover:text-acef-dark transition-all shadow-xl group text-base">
                                    {{ __('buttons.our_story') }}
                                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>

                            {{-- Divider (Desktop only) --}}
                            <div class="hidden sm:block w-px h-12 bg-gray-200 dark:bg-gray-800"></div>

                            {{-- Stats Display --}}
                            <div class="flex items-center gap-12">
                                <div class="flex flex-col">
                                    <span class="text-4xl font-extrabold text-acef-dark dark:text-white" x-text="countries + '+'">0+</span>
                                    <span class="text-[10px] text-gray-500 font-bold uppercase tracking-[0.2em]">{{ __('pages.home.countries') }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-4xl font-extrabold text-acef-dark dark:text-white" x-text="members.toLocaleString() + '+'">0+</span>
                                    <span class="text-[10px] text-gray-500 font-bold uppercase tracking-[0.2em]">{{ __('pages.home.members') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Global Engagements Timeline -->
        <x-timeline-section :years="$timelineYears" />

        <!-- Accreditations Showcase -->
        @if($accreditations->count() > 0)
        <section x-data="{ shown: false }" x-intersect.once.margin.0px.0px.-100px.0px="shown = true"
                 class="py-24 md:py-32 bg-white dark:bg-gray-950 border-t border-gray-100 dark:border-gray-900 transition-colors duration-300 relative overflow-hidden">
            
            {{-- Professional Topographic Background (Clean Lines) --}}
            <div class="absolute inset-0 pointer-events-none select-none z-0 overflow-hidden">
                <svg width="100%" height="100%" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg" class="opacity-10 dark:opacity-20">
                    <g fill="none" stroke="#134712" stroke-width="1" stroke-opacity="0.3">
                        <path d="M0 200c100 0 100-100 200-100s100 100 200 100 100-100 200-100 100 100 200 100" />
                        <path d="M0 400c150 0 150-150 300-150s150 150 300 150 150-150 300-150" />
                        <path d="M0 600c200 0 200-200 400-200s200 200 400 200" />
                        <path d="M0 800c250 0 250-250 500-250s250 250 500 250" />
                        <path d="M1000 200c-100 0-100 100-200 100s-100-100-200-100-100 100-200 100-100-100-200-100" />
                        <path d="M1000 400c-150 0-150 150-300 150s-150-150-300-150-150 150-300 150" />
                    </g>
                </svg>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10" :class="{ 'animate-fade-in-up': shown }">
                <div class="flex flex-col items-center text-center space-y-4 max-w-3xl mx-auto mb-20">
                    <p class="text-acef-green dark:text-acef-light-green font-bold tracking-[0.4em] uppercase text-[10px]">
                        {{ __('pages.accreditations.hero_title') }}
                    </p>
                    <h2 class="text-4xl md:text-5xl font-black text-acef-dark dark:text-white tracking-tighter leading-tight">
                        Institutional Excellence & <br class="hidden md:block"> Global Recognition
                    </h2>
                    <div class="w-16 h-1 bg-acef-green/20 rounded-full mx-auto my-2"></div>
                    <p class="text-gray-500 dark:text-gray-400 font-light italic text-sm md:text-base max-w-2xl leading-relaxed">
                        ACEF's operations are validated by leading international organizations, maintaining the highest standards of environmental governance and transparency.
                    </p>
                </div>

                {{-- Production Style Grid (Centered) --}}
                <div class="flex flex-wrap justify-center gap-6 md:gap-10">
                    @foreach($accreditations as $acc)
                        <div class="group relative flex flex-col items-center space-y-3">
                            {{-- Reverted Production Style Card --}}
                            <div class="w-24 h-24 md:w-36 md:h-36 bg-gray-50 dark:bg-white/5 rounded-2xl flex items-center justify-center p-6 border border-gray-100 dark:border-gray-800 transition-all duration-500 hover:border-acef-green dark:hover:border-acef-green transform hover:-translate-y-1 overflow-hidden relative">
                                @if($acc->image)
                                    <img src="{{ str_starts_with($acc->image, 'http') ? $acc->image : Storage::url($acc->image) }}" alt="{{ $acc->acronym }}" 
                                         class="max-h-full max-w-full object-contain transition-transform duration-700 group-hover:scale-110">
                                @else
                                    <span class="text-xl md:text-2xl font-black text-acef-dark/20 dark:text-white/10 group-hover:text-acef-green transition-colors uppercase tracking-widest">
                                        {{ $acc->acronym }}
                                    </span>
                                @endif
                                
                                {{-- Decorative Accent (Production Detail) --}}
                                <div class="absolute bottom-0 right-0 w-8 h-8 bg-acef-green/5 group-hover:bg-acef-green/10 rounded-tl-full transition-colors duration-500"></div>
                            </div>
                            
                            <span class="text-[10px] md:text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest text-center group-hover:text-acef-dark dark:group-hover:text-white transition-colors duration-300">
                                {{ $acc->acronym }}
                            </span>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-center pt-20">
                    <a href="{{ route('accreditations') }}" 
                       class="inline-flex items-center gap-3 px-10 py-4 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl text-acef-dark dark:text-white font-bold text-xs uppercase tracking-widest hover:border-acef-green hover:text-acef-green transition-all group">
                        <span>View Accreditation Details</span>
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </section>
        @endif

        <!-- Featured Projects Section -->
        <section x-data="{ shown: false }" x-intersect.once.margin.0px.0px.-100px.0px="shown = true"
                 class="py-24 bg-white dark:bg-gray-950 transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12" :class="{ 'animate-fade-in-up': shown }">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end gap-6">
                    <div class="space-y-4 text-left">
                        <h2 class="text-5xl font-black text-acef-dark dark:text-white tracking-tighter">
                            {{ __('pages.home.featured_projects_title') }}
                        </h2>
                        <p class="text-gray-500 font-light italic">{{ __('pages.home.featured_projects_subtitle') }}
                        </p>
                    </div>
                    <a href="{{ route('projects') }}" class="text-acef-green dark:text-acef-light-green font-bold flex items-center group transition-colors sm:pb-2">
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
                            <p class="text-gray-500 line-clamp-2 italic mb-4">{{ Str::limit(strip_tags($project->description), 100) }}</p>
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
        <section class="relative overflow-hidden">
            <!-- Sticky Background Image (Community Photo) -->
            <div class="absolute inset-0 z-0">
                <div class="w-full h-full bg-center bg-cover bg-no-repeat bg-fixed" 
                     style="background-image: url('/stats-bg-final.jpg');">
                </div>
                <!-- Reduced Black Overlay for Better Image Visibility -->
                <div class="absolute inset-0 bg-black/60"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-16 md:py-24 w-full">
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
                        <div class="space-y-1 group cursor-default p-4 flex flex-col items-center">
                            <span class="text-4xl md:text-6xl font-black text-white block tracking-tighter" x-text="stat.current.toLocaleString() + stat.suffix">0</span>
                            <span class="text-white/90 uppercase tracking-[0.2em] text-[10px] md:text-xs font-black block pt-2" x-text="stat.label"></span>
                        </div>
                    </template>
                </div>
            </div>
        </section>

        <!-- Featured Video Section -->
        <section x-data="{ shown: false }" x-intersect.once.margin.0px.0px.-100px.0px="shown = true"
                 class="py-16 md:py-24 bg-acef-gray relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" :class="{ 'animate-fade-in-up': shown }">
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
        <section x-data="{ shown: false }" x-intersect.once.margin.0px.0px.-100px.0px="shown = true"
                 class="py-24 bg-gray-50 dark:bg-acef-dark transition-colors duration-300 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center space-y-12" :class="{ 'animate-fade-in-up': shown }">
                <div class="text-center space-y-4 max-w-2xl">
                    <p class="text-acef-green dark:text-acef-light-green font-bold tracking-widest uppercase text-sm">
                        {{ __('pages.home.map_section.label') }}</p>
                    <h2 class="text-5xl font-black text-acef-dark dark:text-white tracking-tighter">
                        {{ __('pages.home.map_section.title') }}
                    </h2>
                    <p class="text-gray-600 dark:text-white/60 font-light italic">{{ __('pages.home.map_section.subtitle') }}</p>
                </div>

                <div class="relative w-full max-w-5xl h-[350px] md:h-[600px] mx-auto mt-10">
                    <div id="africa-map" class="w-full h-full rounded-2xl shadow-2xl border border-gray-200 dark:border-white/10 bg-gray-200 dark:bg-acef-dark z-10 relative"></div>
                </div>
            </div>
        </section>

        <!-- News & Insights -->
        <section x-data="{ shown: false }" x-intersect.once.margin.0px.0px.-100px.0px="shown = true"
                 class="py-24 bg-acef-gray">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12" :class="{ 'animate-fade-in-up': shown }">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end gap-6">
                    <div class="space-y-4 text-left">
                        <h2 class="text-5xl font-black text-acef-dark dark:text-white tracking-tighter">
                            {{ __('pages.home.news_title') }}
                        </h2>
                        <p class="text-gray-500 font-light italic">{{ __('pages.home.news_subtitle') }}</p>
                    </div>
                    <a href="{{ route('news') }}" class="text-acef-green dark:text-acef-light-green font-bold flex items-center group transition-colors sm:pb-2">
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
        <section x-data="{ shown: false }" x-intersect.once.margin.0px.0px.-100px.0px="shown = true"
                 class="py-24 bg-white dark:bg-gray-900 overflow-hidden relative border-t border-gray-50 dark:border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12" :class="{ 'animate-fade-in-up': shown }">
                <p class="text-center text-gray-400 dark:text-gray-500 font-black uppercase tracking-[0.4em] text-[11px]">
                    {{ __('pages.home.partners_title') }}
                </p>
                
                <div class="relative group">
                    <!-- Edge Mask Gradients -->
                    <div class="absolute inset-y-0 left-0 w-32 bg-gradient-to-r from-white dark:from-gray-900 to-transparent z-10 pointer-events-none"></div>
                    <div class="absolute inset-y-0 right-0 w-32 bg-gradient-to-l from-white dark:from-gray-900 to-transparent z-10 pointer-events-none"></div>

                    <!-- Partners Carousel -->
                    <div class="flex overflow-hidden">
                        <div class="flex animate-scroll hover:[animation-play-state:paused] gap-8 md:gap-16 items-center py-4">
                            @php $partnerList = $partners->concat($partners)->concat($partners); @endphp
                            @foreach($partnerList as $partner)
                                <div class="flex-shrink-0 w-40 md:w-64 h-24 md:h-32 transition-all duration-700 flex items-center justify-center p-4">
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
        /* Map Styles for Light/Dark Mode */
        .map-country-active {
            fill: #13a759 !important; /* acef-green */
            fill-opacity: 0.9 !important;
            stroke: #ffffff !important;
            stroke-width: 1px !important;
            transition: all 0.3s ease;
        }
        .dark .map-country-active {
            fill: #13a759 !important; /* Vibrant acef-green for dark mode contrast */
            stroke: #ffffff !important; /* White border as requested */
        }
        
        .map-country-inactive {
            fill: #d1d5db !important; /* gray-300 for light mode */
            fill-opacity: 1 !important;
            stroke: #ffffff !important;
            stroke-width: 1px !important;
            transition: all 0.3s ease;
        }
        .dark .map-country-inactive {
            fill: #1f2937 !important; /* gray-800 for dark mode */
            fill-opacity: 0.6 !important; /* Increased slightly for dark mode visibility */
            stroke: #ffffff !important; /* White border as requested */
        }

        .map-country-active:hover {
            fill-opacity: 1 !important;
            stroke-width: 2px !important;
        }
        
        /* Leaflet tooltip customization */
        .leaflet-tooltip.custom-tooltip {
            background-color: white;
            color: #0b3d32;
            border: none;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            font-weight: 700;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
        }
        .dark .leaflet-tooltip.custom-tooltip {
            background-color: #1f2937;
            color: white;
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
                                className: isActive ? 'map-country-active' : 'map-country-inactive'
                            };
                        },
                        onEachFeature: function(feature, layer) {
                            if (activeCountries.includes(feature.properties.name)) {
                                layer.bindTooltip(feature.properties.name, {
                                    permanent: false,
                                    direction: 'center',
                                    className: 'custom-tooltip'
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