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
</head>

<body class="antialiased font-sans bg-white dark:bg-gray-950 transition-colors duration-300">
    @include('components.header')

    <!-- Hero Section -->
    <div class="relative h-[500px] md:h-[600px] flex items-end justify-center overflow-hidden">
        <div class="absolute inset-0">
            @if($project->image)
                <img src="{{ Str::startsWith($project->image, 'http') ? $project->image : Storage::url($project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-acef-dark"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent opacity-90"></div>
        </div>
        
        <div class="relative max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 pb-16 z-10">
            <!-- Breadcrumb -->
            <nav class="flex text-sm text-gray-300 mb-6">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('projects') }}" class="hover:text-white transition-colors">Projects</a>
                <span class="mx-2">/</span>
                <span class="text-white truncate">{{ $project->title }}</span>
            </nav>

            <div class="flex flex-wrap items-center gap-3 mb-4">
                <span class="inline-block py-1 px-3 rounded-lg bg-acef-green text-acef-dark font-bold tracking-wide uppercase text-xs">
                    {{ ucfirst($project->status) }} Project
                </span>
                @if($project->programme)
                <a href="{{ route('programmes.show', $project->programme) }}" class="inline-block py-1 px-3 rounded-lg bg-white/10 backdrop-blur-md text-white border border-white/20 text-xs font-bold uppercase tracking-wider hover:bg-white/20 transition-all">
                    {{ $project->programme->title }}
                </a>
                @endif
            </div>
            
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white mb-6 tracking-tight leading-tight max-w-4xl">{{ $project->title }}</h1>
            
            <div class="flex flex-wrap items-center gap-6">
                 <div class="flex items-center text-white/80 font-medium">
                    <svg class="w-5 h-5 mr-2 text-acef-green" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                    {{ is_array($project->country) ? implode(', ', $project->country) : $project->country }}
                 </div>
                 <div class="flex items-center text-white/80 font-medium">
                    <svg class="w-5 h-5 mr-2 text-acef-green" fill="currentColor" viewBox="0 0 20 20"><path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path></svg>
                    {{ $project->category }}
                 </div>
            </div>
        </div>
    </div>

    <!-- Stats & Progress Bar -->
    <div class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 relative z-20 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-8 py-8">
                <div class="w-full md:w-1/2 space-y-4">
                    <div class="flex justify-between items-end mb-2">
                        <div>
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Fundraising Progress</span>
                            <div class="text-3xl font-black text-gray-900 dark:text-white">${{ number_format($project->raised_amount) }} <span class="text-lg text-gray-400 font-normal">/ ${{ number_format($project->goal_amount) }}</span></div>
                        </div>
                        <div class="text-right">
                            <span class="text-2xl font-black text-acef-green">{{ $project->progress_percent }}%</span>
                        </div>
                    </div>
                    <div class="h-3 w-full bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div class="h-full bg-acef-green rounded-full transition-all duration-1000 shadow-lg shadow-emerald-500/20" style="width: {{ $project->progress_percent }}%"></div>
                    </div>
                </div>
                <div class="w-full md:w-auto flex gap-4">
                    <a href="{{ route('donate') }}" class="px-8 py-4 bg-acef-green hover:bg-emerald-500 text-acef-dark font-black rounded-lg transition-all transform hover:-translate-y-1 shadow-xl shadow-emerald-500/20 flex items-center gap-2">
                        Support this Project
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="py-16 md:py-24 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <!-- Left Column (Content) -->
                <div class="lg:col-span-8 space-y-12">
                    
                    <!-- Description -->
                    <section class="bg-white dark:bg-gray-800 rounded-lg p-10 border border-gray-100 dark:border-gray-700 shadow-sm">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 border-l-4 border-acef-green pl-4">Project Description</h2>
                        <div class="prose prose-lg dark:prose-invert prose-emerald max-w-none leading-relaxed">
                            {!! $project->description !!}
                        </div>
                    </section>

                    <!-- Gallery Section -->
                    @if(is_array($project->gallery) && count($project->gallery) > 0)
                    <section>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Project Gallery</h2>
                        <!-- Swiper -->
                        <div class="swiper projectGallery rounded-lg overflow-hidden shadow-2xl bg-black">
                            <div class="swiper-wrapper">
                                @foreach($project->gallery as $image)
                                <div class="swiper-slide aspect-video relative">
                                    <img src="{{ Str::startsWith($image, 'http') ? $image : Storage::url($image) }}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-8">
                                        <p class="text-white font-medium italic opacity-80">Documentation from the field</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-next text-white hover:text-acef-green"></div>
                            <div class="swiper-button-prev text-white hover:text-acef-green"></div>
                        </div>
                    </section>
                    @endif

                    <!-- Testimonials Slider (Voices of the people) -->
                    <section class="bg-acef-dark p-12 rounded-lg relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-8 opacity-10">
                            <svg class="w-32 h-32 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.896 14.321 15.925 14.932 15.087C15.541 14.249 16.291 13.674 17.182 13.363C17.766 14.032 18.526 14.368 19.462 14.368C20.443 14.368 21.282 14.032 21.981 13.363C22.68 12.671 23.03 11.833 23.03 10.849C23.03 9.842 22.68 9.004 21.981 8.335C21.282 7.643 20.443 7.297 19.462 7.297C17.653 7.297 16.208 7.915 15.127 9.151C14.045 10.387 13.522 12.569 13.559 15.698L13.5 21L14.017 21ZM5.517 21L5.517 18C5.517 16.896 5.821 15.925 6.432 15.087C7.041 14.249 7.791 13.674 8.682 13.363C9.266 14.032 10.026 14.368 10.962 14.368C11.943 14.368 12.782 14.032 13.481 13.363C14.18 12.671 14.53 11.833 14.53 10.849C14.53 9.842 14.18 9.004 13.481 8.335C12.782 7.643 11.943 7.297 10.962 7.297C9.153 7.297 7.708 7.915 6.627 9.151C5.545 10.387 5.022 12.569 5.059 15.698L5 21L5.517 21Z"/></svg>
                        </div>
                        <h2 class="text-2xl font-bold text-white mb-8 border-l-4 border-acef-green pl-4 uppercase tracking-widest text-sm">Voices of the people</h2>
                        
                        <div class="swiper testimonialSlider">
                            <div class="swiper-wrapper">
                                @forelse($project->voices ?? [] as $voice)
                                <div class="swiper-slide">
                                    <p class="text-xl md:text-2xl text-white/90 italic leading-relaxed mb-8">"{{ $voice['quote'] ?? '' }}"</p>
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-acef-green/20 rounded-full flex items-center justify-center text-acef-green font-bold">
                                            {{ substr($voice['name'] ?? 'C', 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="text-white font-bold">{{ $voice['name'] ?? 'Community Member' }}</div>
                                            <div class="text-acef-green text-xs font-bold uppercase tracking-widest">{{ $voice['role'] ?? 'Beneficiary' }}</div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="swiper-slide pb-12">
                                    <p class="text-xl text-white/50 italic">Impact stories are being gathered from the field.</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Right Column (Sidebar) -->
                <div class="lg:col-span-4 space-y-8">
                    
                    <!-- Objectives -->
                    @if(is_array($project->objectives) && count($project->objectives) > 0)
                    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg border border-gray-100 dark:border-gray-700 shadow-sm">
                        <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-6">Key Objectives</h3>
                        <div class="space-y-6">
                            @foreach($project->objectives as $objective)
                            <div class="flex gap-4 group">
                                <div class="w-8 h-8 rounded-lg bg-emerald-50 dark:bg-emerald-900/30 flex items-center justify-center text-acef-green flex-shrink-0 group-hover:scale-110 transition-transform">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-300 leading-snug">{{ $objective }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Supporting Organizations -->
                    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg border border-gray-100 dark:border-gray-700 shadow-sm">
                        <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-6">Supporting Organizations</h3>
                        <div class="grid grid-cols-2 gap-4">
                            @forelse($project->partners as $partner)
                            <div class="aspect-square bg-gray-50 dark:bg-gray-900 rounded-lg p-4 flex items-center justify-center group hover:bg-white dark:hover:bg-gray-800 transition-all border border-gray-100 dark:border-gray-700">
                                <img src="{{ $partner->logo ? Storage::url($partner->logo) : '/placeholder.png' }}" alt="{{ $partner->name }}" class="max-w-full max-h-full object-contain grayscale group-hover:grayscale-0 opacity-50 group-hover:opacity-100 transition-all">
                            </div>
                            @empty
                            <div class="col-span-2 py-4 text-center">
                                <p class="text-xs text-gray-400 italic">Official partners being finalised.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Share -->
                    <div class="bg-emerald-950 p-8 rounded-lg overflow-hidden relative">
                         <div class="relative z-10 space-y-4">
                             <h4 class="text-white font-black uppercase tracking-widest text-xs">Share this story</h4>
                             <p class="text-white/60 text-xs font-light tracking-wide italic leading-relaxed">Multiply our impact by sharing this initiative with your network.</p>
                             <div class="flex gap-3">
                                <button class="w-10 h-10 rounded-lg bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition-all"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></button>
                                <button class="w-10 h-10 rounded-lg bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition-all"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg></button>
                                <button class="w-10 h-10 rounded-lg bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition-all"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></button>
                             </div>
                         </div>
                         <div class="absolute -bottom-4 -right-4 opacity-10">
                            <svg class="w-32 h-32 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                         </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('components.footer')

    <script>
        const swiper = new Swiper('.projectGallery', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

        const testimonialSwiper = new Swiper('.testimonialSlider', {
            loop: true,
            autoplay: {
                delay: 8000,
            },
        });
    </script>
</body>
</html>
