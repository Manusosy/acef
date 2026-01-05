<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" content="notranslate">
    <title>{{ $project->title }} - ACEF</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="antialiased font-sans bg-gray-50 dark:bg-gray-950 transition-colors duration-300">
@include('components.header')

    @php
        $videoEmbedUrl = null;
        if($project->video_url) {
            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $project->video_url, $match)) {
                $videoEmbedUrl = "https://www.youtube.com/embed/" . $match[1] . "?autoplay=1";
            } elseif (preg_match('/vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/(?:[^\/]*)\/videos\/|album\/(?:\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)/', $project->video_url, $match)) {
                $videoEmbedUrl = "https://player.vimeo.com/video/" . $match[1] . "?autoplay=1";
            }
        }
    @endphp

    <!-- High-Impact Hero Section -->
    <div class="relative min-h-[500px] md:min-h-[600px] flex items-end justify-center overflow-hidden">
        <div class="absolute inset-0">
            @if($project->image)
                <img src="{{ Str::startsWith($project->image, 'http') ? $project->image : Storage::url($project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-acef-dark"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent opacity-90"></div>
        </div>
        
        <div class="relative max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 pb-16 z-10 text-center md:text-left">
            <!-- Breadcrumb -->
            <nav class="flex text-sm text-gray-300 mb-6 justify-center md:justify-start">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('projects') }}" class="hover:text-white transition-colors">Projects</a>
                <span class="mx-2">/</span>
                <span class="text-white truncate">{{ $project->title }}</span>
            </nav>

            <!-- Project Meta Tags -->
            <div class="flex flex-wrap items-center justify-center md:justify-start gap-3 mb-6">
                <span class="inline-flex items-center py-1 px-3 rounded-full bg-acef-green text-white font-bold tracking-wide uppercase text-[10px]">
                    {{ ucfirst($project->status) }}
                </span>
                <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full bg-white/10 backdrop-blur-md text-white border border-white/20 text-[10px] font-bold uppercase">
                    <svg class="w-3 h-3 text-acef-green" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                    @php
                        $count = count($project->country_names);
                        $locationDisplay = $count > 1 ? $count . ' Countries' : ($project->country_names[0] ?? 'Global');
                    @endphp
                    {{ $locationDisplay }}
                </span>
            </div>
            
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white mb-6 tracking-tight leading-tight max-w-4xl drop-shadow-xl">
                {{ $project->title }}
            </h1>
            
            <p class="text-lg md:text-xl text-gray-200 max-w-2xl mb-10 leading-relaxed font-light">
                {{ Str::limit(strip_tags($project->description), 180) }}
            </p>

            <div class="flex flex-wrap items-center justify-center md:justify-start gap-4">
                <a href="{{ route('donate') }}" class="px-8 py-3 bg-acef-gold hover:bg-white hover:text-acef-dark text-acef-dark font-bold rounded-lg transition-all shadow-xl flex items-center gap-3">
                    Support this Project
                </a>
                @if($project->video_url)
                <button @click="document.getElementById('project-action').scrollIntoView({behavior: 'smooth'})" class="px-8 py-3 border border-white text-white hover:bg-white hover:text-gray-900 font-bold rounded-lg transition-all flex items-center gap-3">
                    Watch Video
                </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Horizontal Stats Bar -->
    <div class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 relative z-20 shadow-sm py-6 overflow-x-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between min-w-[600px] md:min-w-0 divide-x divide-gray-100 dark:divide-gray-700">
                <div class="flex items-center gap-4 flex-1">
                    <div class="w-12 h-12 rounded-lg bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                    </div>
                    <div>
                        <span class="block text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-1">Active Program</span>
                        <span class="block text-xl font-black text-gray-900 dark:text-white">{{ $project->programme->title ?? 'General Initiative' }}</span>
                    </div>
                </div>

                <div class="flex items-center gap-4 flex-1 pl-8">
                    <div class="w-12 h-12 rounded-lg bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center flex-shrink-0">
                         <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <div>
                        <span class="block text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-1">Implementation</span>
                        <span class="block text-xl font-black text-gray-900 dark:text-white">{{ $project->start_date?->format('Y') ?? '2024' }}</span>
                    </div>
                </div>

                <div class="flex items-center gap-4 flex-1 pl-8">
                    <div class="w-12 h-12 rounded-lg bg-orange-50 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <span class="block text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-1">Total Budget</span>
                        <span class="block text-xl font-black text-gray-900 dark:text-white">${{ number_format($project->goal_amount) }}</span>
                    </div>
                </div>

                @if($project->partners->count() > 0)
                <div class="flex items-center gap-4 flex-1 pl-8">
                    <div class="flex -space-x-3 overflow-hidden">
                        @foreach($project->partners->take(3) as $partner)
                            <div class="w-10 h-10 rounded-full bg-white border-2 border-gray-50 dark:border-gray-800 flex items-center justify-center overflow-hidden flex-shrink-0 shadow-sm">
                                @if($partner->logo)
                                    <img src="{{ Str::startsWith($partner->logo, 'http') ? $partner->logo : Storage::url($partner->logo) }}" class="w-full h-full object-contain p-1.5" title="{{ $partner->name }}">
                                @else
                                    <span class="text-[10px] font-black text-emerald-600 uppercase">{{ substr($partner->name, 0, 1) }}</span>
                                @endif
                            </div>
                        @endforeach
                        @if($project->partners->count() > 3)
                            <div class="w-10 h-10 rounded-full border-2 border-white dark:border-gray-800 bg-emerald-500 text-white flex items-center justify-center text-[8px] font-black shadow-sm">
                                +{{ $project->partners->count() - 3 }}
                            </div>
                        @endif
                    </div>
                    <div>
                        <span class="block text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-1">Project Partners</span>
                        <span class="block text-xl font-black text-gray-900 dark:text-white">
                            {{ $project->partners->count() . ' Partners' }}
                        </span>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="py-20 md:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
                
                <!-- Left: Description & Project in Action -->
                <div class="lg:col-span-8 space-y-24">
                    
                    <!-- About the Project -->
                    <section class="bg-white dark:bg-gray-800 p-8 rounded-lg border border-gray-100 dark:border-gray-700 shadow-sm">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">About the Project</h2>
                        <div class="prose prose-lg dark:prose-invert prose-emerald max-w-none leading-relaxed text-gray-600 dark:text-gray-400 font-normal whitespace-pre-wrap">
                            {!! $project->description !!}
                        </div>
                    </section>

                    <!-- Project in Action (Video) -->
                    @if($project->video_url)
                    <section id="project-action" x-data="{ playing: false }">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 tracking-tight">Project in Action</h2>
                        <div class="relative aspect-video rounded-lg overflow-hidden bg-black shadow-lg">
                            <template x-if="!playing">
                                <div class="w-full h-full relative group cursor-pointer" @click="playing = true">
                                    @if($project->image)
                                        <img src="{{ Str::startsWith($project->image, 'http') ? $project->image : Storage::url($project->image) }}" class="w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-700">
                                    @endif
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="w-20 h-20 bg-acef-green text-acef-dark rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform cursor-pointer z-10">
                                            <svg class="w-8 h-8 translate-x-1" fill="currentColor" viewBox="0 0 20 20"><path d="M4.516 7.548c0-.923.651-1.191 1.391-.838l8.051 3.843c.74.353.74.921 0 1.274l-8.051 3.843c-.74.353-1.391.085-1.391-.838V7.548z"></path></svg>
                                        </div>
                                    </div>
                                    <div class="absolute bottom-6 left-6">
                                        <span class="bg-acef-green px-3 py-1 rounded-md text-[10px] font-bold uppercase text-white mb-2 inline-block">Project Video</span>
                                        <h3 class="text-xl font-bold text-white">{{ $project->title }}</h3>
                                    </div>
                                </div>
                            </template>
                            <template x-if="playing">
                                <iframe class="w-full h-full" src="{{ $videoEmbedUrl }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </template>
                        </div>
                    </section>
                    @endif

                    <!-- Project Gallery -->
                    @if(is_array($project->gallery) && count($project->gallery) > 0)
                    <section>
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">Project Gallery</h2>
                             <p class="text-xs font-bold text-acef-green uppercase tracking-widest">{{ count($project->gallery) }} Photos</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach(array_slice($project->gallery, 0, 6) as $index => $img)
                            <div class="relative group overflow-hidden rounded-lg aspect-[4/3] shadow-sm cursor-pointer {{ $index === 0 ? 'md:col-span-2 md:row-span-2 aspect-auto' : '' }}">
                                <img src="{{ Str::startsWith($img, 'http') ? $img : Storage::url($img) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                     <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </section>
                    @endif

                    <!-- Voices from the Field -->
                    @if(is_array($project->voices) && count($project->voices) > 0)
                    <section>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 tracking-tight">Voices from the Field</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($project->voices as $voice)
                            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-100 dark:border-gray-700 shadow-sm relative text-left">
                                <div class="flex gap-1 text-acef-green mb-4 opacity-50">
                                     @for($i=0; $i<5; $i++) <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg> @endfor
                                </div>
                                <p class="text-lg text-gray-700 dark:text-gray-300 font-medium italic mb-6 leading-relaxed">"{{ $voice['quote'] ?? '' }}"</p>
                                <div class="flex items-center gap-4 pt-6 border-t border-gray-50 dark:border-gray-700 font-sans">
                                    <div class="w-10 h-10 rounded-full bg-acef-green flex items-center justify-center font-bold text-white text-lg">
                                        {{ substr($voice['name'] ?? 'V', 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 dark:text-white">{{ $voice['name'] ?? 'Beneficiary' }}</h4>
                                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $voice['role'] ?? 'Participant' }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </section>
                    @endif
                </div>

                <!-- Right: Funding Status & Key Objectives -->
                <div class="lg:col-span-4 space-y-8">
                    
                    <!-- Funding Status Card -->
                    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg border border-gray-100 dark:border-gray-700 shadow-sm">
                        <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6 border-b border-gray-50 dark:border-gray-700 pb-3">Funding Progress</h3>
                        <div class="flex items-baseline gap-2 mb-4">
                            <span class="text-3xl font-black text-gray-900 dark:text-white">${{ number_format($project->raised_amount) }}</span>
                            <span class="text-gray-400 font-medium text-sm">of ${{ number_format($project->goal_amount) }}</span>
                        </div>

                        <div class="h-2 w-full bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden mb-8">
                            <div class="h-full bg-acef-green rounded-full shadow-sm" style="width: {{ $project->progress_percent }}%"></div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-8">
                            <div class="text-left">
                                <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Target Area</span>
                                <span class="block text-sm font-bold text-gray-900 dark:text-white">{{ $project->location ?? 'Regional' }}</span>
                            </div>
                            <div class="text-right">
                                <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Duration</span>
                                <span class="block text-sm font-bold text-gray-900 dark:text-white">
                                    @if($project->end_date)
                                        {{ $project->start_date->diffInMonths($project->end_date) }} Months
                                    @else
                                        Ongoing
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="space-y-4 text-center">
                            <a href="{{ route('donate') }}" class="block w-full py-4 bg-acef-gold hover:bg-white hover:text-acef-dark text-acef-dark text-center font-bold rounded-lg transition-all shadow-sm uppercase tracking-widest text-xs">
                                Donate Now
                            </a>
                            <button class="w-full py-4 bg-transparent border border-gray-100 dark:border-gray-700 text-gray-500 dark:text-gray-400 font-bold rounded-lg hover:text-gray-900 dark:hover:text-white transition-all text-xs uppercase tracking-widest">
                                Share Project
                            </button>
                        </div>

                        @if(is_array($project->objectives) && count(array_filter($project->objectives)) > 0)
                        <div class="mt-10 pt-10 border-t border-gray-50 dark:border-gray-700 text-left">
                            <div class="flex items-center gap-2 mb-6">
                                <div class="w-1.5 h-6 bg-acef-green rounded-full"></div>
                                <h3 class="text-[10px] font-black text-gray-400 dark:text-white tracking-widest uppercase">Key Objectives</h3>
                            </div>
                            <ul class="space-y-4">
                                @foreach(array_filter($project->objectives) as $objective)
                                <li class="flex gap-3 group">
                                    <div class="w-5 h-5 rounded-full bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <p class="text-xs font-bold text-gray-600 dark:text-gray-400 leading-tight">{{ $objective }}</p>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <!-- Partners List Inside Sidebar -->
                        @if($project->partners->isNotEmpty())
                        <div class="mt-10 pt-10 border-t border-gray-50 dark:border-gray-700 text-left">
                            <div class="flex items-center gap-2 mb-6">
                                <div class="w-1.5 h-6 bg-blue-500 rounded-full"></div>
                                <h3 class="text-[10px] font-black text-gray-400 dark:text-white tracking-widest uppercase">Supporting Partners</h3>
                            </div>
                            <div class="space-y-4">
                                @foreach($project->partners as $partner)
                                    <div class="flex items-center gap-4 group cursor-default">
                                        <div class="w-10 h-10 rounded-lg bg-gray-50 dark:bg-gray-700 border border-gray-100 dark:border-gray-600 flex items-center justify-center p-1.5 flex-shrink-0 group-hover:border-emerald-500 transition-colors">
                                            @if($partner->logo)
                                                <img src="{{ Str::startsWith($partner->logo, 'http') ? $partner->logo : Storage::url($partner->logo) }}" class="w-full h-full object-contain">
                                            @else
                                                <span class="text-xs font-black text-gray-400 uppercase tracking-tighter">{{ substr($partner->name, 0, 2) }}</span>
                                            @endif
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-black text-gray-900 dark:text-white leading-tight group-hover:text-emerald-500 transition-colors">{{ $partner->name }}</h4>
                                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-0.5">Project Partner</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Similar Projects -->
    @php
        $similarProjects = \App\Models\Project::where('category', $project->category)
            ->where('id', '!=', $project->id)
            ->where('status', '!=', 'draft')
            ->take(3)
            ->get();
    @endphp

    @if($similarProjects->isNotEmpty())
    <div class="py-20 bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-12 text-left">
                 <h2 class="text-3xl font-bold text-gray-900 dark:text-white tracking-tight">Similar Projects</h2>
                 <div class="flex gap-2">
                    <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:text-acef-dark hover:border-acef-dark transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:text-acef-dark hover:border-acef-dark transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                 </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
                @foreach($similarProjects as $similar)
                <a href="{{ route('projects.show', $similar->slug) }}" class="group block bg-white dark:bg-gray-800 rounded-lg overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-all">
                    <div class="aspect-[16/10] overflow-hidden">
                        @if($similar->image)
                            <img src="{{ Str::startsWith($similar->image, 'http') ? $similar->image : Storage::url($similar->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @endif
                    </div>
                    <div class="p-6">
                         <span class="text-[10px] font-bold text-acef-green uppercase tracking-widest mb-2 block">{{ $similar->category }}</span>
                         <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 group-hover:text-acef-green transition-colors leading-tight">{{ $similar->title }}</h3>
                         <div class="flex items-center gap-2 mb-6 text-left">
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                            <span class="text-xs font-bold text-gray-400">{{ $similar->location }}</span>
                         </div>
                         <div class="h-1.5 w-full bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                             <div class="h-full bg-acef-green" style="width: {{ $similar->progress_percent }}%"></div>
                         </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    @include('components.footer')
</body>

</html>
