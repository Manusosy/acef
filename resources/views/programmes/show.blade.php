<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" content="notranslate">
    <title>{{ $programme->title }} - ACEF</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans bg-white dark:bg-gray-950 transition-colors duration-300">
    @include('components.header')
    <!-- Hero Section -->
    <div class="relative h-[500px] md:h-[600px] flex items-end justify-center overflow-hidden">
        <div class="absolute inset-0">
            @if($programme->hero_image)
                <img src="{{ Str::startsWith($programme->hero_image, 'http') ? $programme->hero_image : Storage::url($programme->hero_image) }}" alt="{{ $programme->title }}" class="w-full h-full object-cover">
            @elseif($programme->image)
                <img src="{{ Str::startsWith($programme->image, 'http') ? $programme->image : Storage::url($programme->image) }}" alt="{{ $programme->title }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-acef-dark-blue"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent opacity-90"></div>
        </div>
        
        <div class="relative max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 pb-16 z-10">
            <!-- Breadcrumb -->
            <nav class="flex text-sm text-gray-300 mb-6">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('programmes') }}" class="hover:text-white transition-colors">Programmes</a>
                <span class="mx-2">/</span>
                <span class="text-white truncate">{{ $programme->title }}</span>
            </nav>

            <span class="inline-block py-1 px-3 rounded-full bg-acef-green text-white font-bold tracking-wide uppercase text-xs mb-4">Active Programme</span>
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white mb-6 tracking-tight leading-tight max-w-4xl">{{ $programme->title }}</h1>
            <p class="text-lg md:text-xl text-gray-200 max-w-2xl font-light leading-relaxed mb-8">{{ $programme->excerpt }}</p>

            <div class="flex flex-wrap gap-4">
                @if($programme->factsheet)
                    <a href="{{ Str::startsWith($programme->factsheet, 'http') ? $programme->factsheet : Storage::url($programme->factsheet) }}" target="_blank" class="px-6 py-3 bg-white hover:bg-gray-100 text-gray-900 font-bold rounded-lg transition-colors flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Download Factsheet
                    </a>
                @endif
                <a href="#donate" class="px-6 py-3 bg-acef-gold text-acef-dark hover:bg-white hover:text-acef-dark font-bold rounded-lg transition-all shadow-xl">
                    Support Programme
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Bar -->
    <div class="bg-white border-b border-gray-100 relative z-20 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-gray-100">
                <div class="py-8 px-4 text-center md:text-left">
                    <div class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Beneficiaries</div>
                    <div class="text-2xl md:text-3xl font-black text-gray-900">{{ $programme->stats['beneficiaries'] ?? '0' }}</div>
                </div>
                <div class="py-8 px-4 text-center md:text-left">
                    <div class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Trees Planted</div>
                    <div class="text-2xl md:text-3xl font-black text-gray-900">{{ $programme->stats['trees'] ?? '0' }}</div>
                </div>
                <div class="py-8 px-4 text-center md:text-left">
                    <div class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Communities</div>
                    <div class="text-2xl md:text-3xl font-black text-gray-900">{{ $programme->stats['communities'] ?? '0' }}</div>
                </div>
                <div class="py-8 px-4 text-center md:text-left">
                    <div class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Duration</div>
                    <div class="text-2xl md:text-3xl font-black text-gray-900">{{ $programme->duration ?? 'Ongoing' }}</div>
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
                    <!-- Overview -->
                    <section id="overview" class="bg-white dark:bg-gray-800 rounded-lg p-8 border border-gray-100 dark:border-gray-700 shadow-sm">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Programme Overview</h2>
                        <div class="prose prose-lg dark:prose-invert prose-emerald max-w-none">
                            {!! $programme->content !!}
                        </div>
                        
                        <!-- Location Map Placeholder -->
                        @if($programme->location)
                        <div class="mt-8 relative h-64 bg-gray-100 dark:bg-gray-700 rounded-lg overflow-hidden flex items-center justify-center group">
                             <!-- Replace with real map if available -->
                             <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Map Location" class="absolute inset-0 w-full h-full object-cover opacity-50 grayscale group-hover:grayscale-0 transition-all duration-500">
                             <div class="relative bg-white dark:bg-gray-800 px-4 py-2 rounded-lg shadow-lg flex items-center gap-2">
                                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                                <span class="font-bold text-gray-900 dark:text-white text-sm">Operating Region: {{ is_array($programme->country) ? implode(', ', $programme->country) : $programme->country }}</span>
                             </div>
                        </div>
                        @endif
                    </section>

                    <!-- Focus Areas -->
                    @if(!empty($programme->focus_areas) && count($programme->focus_areas) > 0)
                    <section>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Focus Areas</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($programme->focus_areas as $area)
                            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-100 dark:border-gray-700 shadow-sm flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white mb-1">{{ $area }}</h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Strategic implementation focus.</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </section>
                    @endif

                    <!-- Impact Stories -->
                    @if(!empty($programme->impact_stories) && count($programme->impact_stories) > 0)
                    <section>
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Impact Stories</h2>
                            <div class="flex gap-2">
                                <button class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-50"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></button>
                                <button class="w-8 h-8 rounded-full bg-acef-green text-white flex items-center justify-center hover:bg-emerald-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></button>
                            </div>
                        </div>
                        
                        <!-- Story Card -->
                        <div class="space-y-6">
                            @foreach($programme->impact_stories as $story)
                                <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg border border-gray-100 dark:border-gray-700 flex flex-col md:flex-row">
                                    <div class="md:w-1/3">
                                        <img src="https://images.unsplash.com/photo-1531123897727-8f129e1688ce?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover min-h-[200px]" alt="Story Image">
                                    </div>
                                    <div class="p-8 md:w-2/3 flex flex-col justify-center">
                                        <svg class="w-8 h-8 text-acef-green mb-4 opacity-50" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.896 14.321 15.925 14.932 15.087C15.541 14.249 16.291 13.674 17.182 13.363C17.766 14.032 18.526 14.368 19.462 14.368C20.443 14.368 21.282 14.032 21.981 13.363C22.68 12.671 23.03 11.833 23.03 10.849C23.03 9.842 22.68 9.004 21.981 8.335C21.282 7.643 20.443 7.297 19.462 7.297C17.653 7.297 16.208 7.915 15.127 9.151C14.045 10.387 13.522 12.569 13.559 15.698L13.5 21L14.017 21ZM5.517 21L5.517 18C5.517 16.896 5.821 15.925 6.432 15.087C7.041 14.249 7.791 13.674 8.682 13.363C9.266 14.032 10.026 14.368 10.962 14.368C11.943 14.368 12.782 14.032 13.481 13.363C14.18 12.671 14.53 11.833 14.53 10.849C14.53 9.842 14.18 9.004 13.481 8.335C12.782 7.643 11.943 7.297 10.962 7.297C9.153 7.297 7.708 7.915 6.627 9.151C5.545 10.387 5.022 12.569 5.059 15.698L5 21L5.517 21Z"/></svg>
                                        <blockquote class="text-lg italic text-gray-700 dark:text-gray-300 mb-6">"{{ $story['description'] ?? '' }}"</blockquote>
                                        <div>
                                            <div class="font-bold text-gray-900 dark:text-white">{{ $story['title'] ?? '' }}</div>
                                            <div class="text-sm text-acef-green font-bold uppercase tracking-wider">{{ $story['number'] ?? '' }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                    @endif
                </div>

                <!-- Right Column (Sidebar) -->
                <div class="lg:col-span-4 space-y-8">
                    
                    <!-- Supporting Organizations -->
                    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg border border-gray-100 dark:border-gray-700 shadow-sm">
                        <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-6 border-b border-gray-50 dark:border-gray-700 pb-3">Supporting Organizations</h3>
                        <div class="grid grid-cols-2 gap-4">
                            @forelse($programme->partners as $partner)
                            <div class="aspect-square bg-gray-50 dark:bg-gray-900 rounded-lg p-4 flex items-center justify-center group hover:bg-white dark:hover:bg-gray-800 transition-all border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md">
                                <img src="{{ $partner->logo ? (Str::startsWith($partner->logo, 'http') ? $partner->logo : Storage::url($partner->logo)) : '/placeholder.png' }}" alt="{{ $partner->name }}" class="max-w-full max-h-full object-contain grayscale group-hover:grayscale-0 opacity-50 group-hover:opacity-100 transition-all">
                            </div>
                            @empty
                            <div class="col-span-2 py-4 text-center">
                                <p class="text-xs text-gray-400 italic">Partners will be listed soon.</p>
                            </div>
                            @endforelse
                        </div>
                        <p class="mt-6 text-[10px] text-gray-400 font-medium leading-relaxed italic">
                            These organizations directly contribute to the implementation and success of this programme.
                        </p>
                    </div>

                    <!-- Funding Goal -->
                    @if($programme->funding_goal > 0)
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-100 dark:border-gray-700 shadow-sm">
                         <div class="flex items-center justify-between mb-2">
                             <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Funding Goal</h3>
                             <span class="text-xs font-bold text-acef-green">{{ round(($programme->funding_raised / $programme->funding_goal) * 100) }}%</span>
                         </div>
                         <div class="relative h-2 bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden mb-4">
                             <div class="absolute top-0 left-0 h-full bg-acef-green rounded-full" style="width: {{ ($programme->funding_raised / $programme->funding_goal) * 100 }}%"></div>
                         </div>
                         <div class="flex items-end justify-between mb-6">
                             <div>
                                 <div class="text-2xl font-black text-gray-900 dark:text-white">${{ number_format($programme->funding_raised) }}</div>
                                 <div class="text-xs text-gray-500">Raised so far</div>
                             </div>
                             <div class="text-right">
                                 <div class="text-sm font-bold text-gray-400">${{ number_format($programme->funding_goal) }}</div>
                                 <div class="text-xs text-gray-500">Target</div>
                             </div>
                         </div>
                         <a href="{{ route('donate') }}" id="donate" class="group relative block w-full py-5 bg-acef-gold text-acef-dark font-black rounded-lg text-center overflow-hidden transition-all hover:scale-[1.02] active:scale-[0.98] shadow-lg">
                             <span class="relative z-10 flex items-center justify-center gap-2 uppercase tracking-widest text-sm group-hover:text-acef-dark">
                                Donate to this Program
                             </span>
                             <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-100 transition-opacity"></div>
                         </a>
                    </div>
                    @endif

                    <!-- On This Page -->
                    <div class="hidden lg:block bg-gray-50 dark:bg-gray-800/50 p-6 rounded-lg">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">On This Page</h3>
                        <nav class="space-y-2">
                            <a href="#overview" class="block text-sm font-medium text-acef-green pl-3 border-l-2 border-acef-green">Overview</a>
                            <a href="#" class="block text-sm font-medium text-gray-500 hover:text-gray-900 pl-3 border-l-2 border-transparent">Impact Stories</a>
                            <a href="#" class="block text-sm font-medium text-gray-500 hover:text-gray-900 pl-3 border-l-2 border-transparent">Focus Areas</a>
                            <a href="#" class="block text-sm font-medium text-gray-500 hover:text-gray-900 pl-3 border-l-2 border-transparent">Related Projects</a>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('components.footer')
</body>
</html>
