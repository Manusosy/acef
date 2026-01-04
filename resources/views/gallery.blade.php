<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" content="notranslate">
    <title>{{ __('pages.gallery.hero_title') }} - ACEF</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="antialiased font-sans bg-white overflow-x-hidden">
    @include('components.header')

    <main class="pt-40 pb-24" x-data="{
        folders: {{ json_encode($folders) }},
        galleryItems: {{ json_encode($galleryItems) }},
        selectedAlbum: null,
        filters: {
            programme: '',
            project: '',
            category: ''
        },
        get filteredFolders() {
            return this.folders.filter(f => {
                const matchesProg = this.filters.programme === '' || (f.programme_id == this.filters.programme);
                const matchesProj = this.filters.project === '' || (f.project_id == this.filters.project);
                return matchesProg && matchesProj;
            });
        },
        get filteredItems() {
            return this.galleryItems.filter(item => {
                const matchesProg = this.filters.programme === '' || (item.project && item.project.programme_id == this.filters.programme);
                const matchesProj = this.filters.project === '' || item.project_id == this.filters.project;
                const matchesCat = this.filters.category === '' || item.category === this.filters.category;
                return matchesProg && matchesProj && matchesCat;
            });
        },
        resetFilters() {
            this.filters = { programme: '', project: '', category: '' };
        }
    }">
        <!-- Gallery Hero -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
            <div class="flex flex-col md:flex-row justify-between items-end gap-8">
                <div class="space-y-6 max-w-2xl">
                    <h1 class="text-6xl md:text-7xl font-black text-acef-dark tracking-tighter leading-none">
                        {{ __('pages.gallery.hero_title') }}</h1>
                    <p class="text-gray-400 text-lg font-light italic leading-relaxed">
                        {{ __('pages.gallery.hero_desc') }}
                    </p>
                </div>
            </div>
        </section>

        <!-- Filter Bar -->
        <section class="bg-gray-50 dark:bg-[#111827]/80 border-y border-gray-100 dark:border-white/5 py-8 backdrop-blur-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row items-center justify-between gap-6">
                    <div class="flex flex-wrap items-center gap-4">
                        <div class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-widest text-gray-300 mr-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                            <span>{{ __('pages.gallery.filters.label') }}</span>
                        </div>

                        <div class="flex items-center space-x-3">
                            <select x-model="filters.programme" class="bg-white dark:bg-white/5 border-none dark:border dark:border-white/10 rounded-xl px-6 py-3 text-xs font-bold text-acef-dark dark:text-white shadow-sm focus:ring-2 focus:ring-acef-green ring-offset-2 dark:ring-offset-gray-900 transition-all outline-none">
                                <option value="">All Programmes</option>
                                @foreach($programmes as $prog)
                                    <option value="{{ $prog->id }}">{{ $prog->title }}</option>
                                @endforeach
                            </select>
                            <select x-model="filters.project" class="bg-white dark:bg-white/5 border-none dark:border dark:border-white/10 rounded-xl px-6 py-3 text-xs font-bold text-acef-dark dark:text-white shadow-sm focus:ring-2 focus:ring-acef-green ring-offset-2 dark:ring-offset-gray-900 transition-all outline-none">
                                <option value="">All Projects</option>
                                @foreach($projects as $proj)
                                    <option value="{{ $proj->id }}">{{ $proj->title }}</option>
                                @endforeach
                            </select>
                            <button @click="resetFilters()" class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 hover:text-acef-dark dark:hover:text-acef-green transition-colors border-b-2 border-transparent hover:border-acef-green pb-0.5">{{ __('pages.gallery.filters.reset') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Media Gallery -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <!-- Albums Section -->
            <div x-show="filteredFolders.length > 0" class="mb-24">
                <h2 class="text-3xl font-black text-acef-dark mb-10 tracking-tight">Galleries by Project</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    <template x-for="folder in filteredFolders" :key="folder.id">
                        <div @click="selectedAlbum = folder" class="group cursor-pointer">
                            <div class="relative aspect-[4/3] rounded-3xl overflow-hidden mb-6 bg-gray-100 dark:bg-white/5">
                                <template x-if="folder.media_items.length > 0">
                                    <img :src="'/storage/' + folder.media_items[0].path" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                </template>
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 via-transparent to-transparent opacity-60 group-hover:opacity-100 transition-opacity"></div>
                                <div class="absolute bottom-6 left-6 text-white">
                                    <span class="text-[10px] font-black uppercase tracking-widest bg-emerald-500/90 px-3 py-1 rounded-full mb-2 inline-block" x-text="folder.media_items.length + ' Photos'"></span>
                                    <h3 class="text-xl font-bold" x-text="folder.name"></h3>
                                </div>
                            </div>
                            <div class="px-2">
                                <div class="flex items-center gap-2 mb-1">
                                    <template x-if="folder.project">
                                        <span class="text-[9px] font-black text-acef-green uppercase tracking-widest" x-text="folder.project.title"></span>
                                    </template>
                                    <template x-if="folder.programme">
                                        <span class="text-[9px] font-black text-blue-500 uppercase tracking-widest" x-text="folder.programme.title"></span>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Individual Highlights / Gallery Items -->
            <div x-show="filteredItems.length > 0">
                <h2 class="text-3xl font-black text-acef-dark mb-10 tracking-tight">Featured Highlights</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    <template x-for="item in filteredItems" :key="item.id">
                        <div class="group flex flex-col space-y-4">
                            <div class="relative aspect-square rounded-[32px] overflow-hidden bg-gray-100 dark:bg-white/5 border border-gray-50 dark:border-white/5">
                                <img :src="'/storage/' + item.image" :alt="item.title" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            </div>
                            <div class="px-2">
                                <h3 class="text-sm font-bold text-acef-dark leading-tight" x-text="item.title"></h3>
                                <p class="text-[10px] text-gray-400 mt-1 uppercase font-black" x-text="item.location"></p>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <div x-show="filteredFolders.length === 0 && filteredItems.length === 0" class="py-20 text-center text-gray-400 italic">
                No items found matching your filters.
            </div>
        </section>

        <!-- Album Modal -->
        <div x-show="selectedAlbum" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4">
            <div @click="selectedAlbum = null" class="absolute inset-0 bg-black/95 backdrop-blur-xl"></div>
            <div class="bg-white dark:bg-gray-900 rounded-[40px] w-full max-w-6xl max-h-[90vh] overflow-hidden relative shadow-2xl flex flex-col">
                <div class="p-8 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-black text-acef-dark dark:text-white" x-text="selectedAlbum?.name"></h2>
                        <div class="flex items-center gap-3 mt-1">
                            <template x-if="selectedAlbum?.project">
                                <span class="text-[10px] font-black text-acef-green uppercase tracking-widest" x-text="selectedAlbum.project.title"></span>
                            </template>
                        </div>
                    </div>
                    <button @click="selectedAlbum = null" class="p-3 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-2xl transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div class="flex-1 overflow-y-auto p-12">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        <template x-for="item in selectedAlbum?.media_items" :key="item.id">
                            <div class="aspect-square rounded-2xl overflow-hidden bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10">
                                <img :src="'/storage/' + item.path" class="w-full h-full object-cover">
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <!-- YouTube Channel Section -->
        <section class="py-24 bg-acef-dark relative overflow-hidden">
             <!-- Featured Video Section -->
             @if(isset($featuredVideo) && $featuredVideo->video_url)
             <div class="mb-20">
                 <div class="relative rounded-2xl overflow-hidden shadow-2xl border-4 border-white aspect-video group max-w-4xl mx-auto">
                     @php
                         $videoUrl = $featuredVideo->video_url;
                         $embedUrl = $videoUrl;
                         if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $videoUrl, $matches)) {
                             $videoId = $matches[1];
                             $embedUrl = "https://www.youtube.com/embed/{$videoId}?autoplay=0&rel=0&modestbranding=1";
                         }
                     @endphp
                     <iframe 
                         class="w-full h-full object-cover"
                         src="{{ $embedUrl }}" 
                         title="{{ $featuredVideo->title }}" 
                         frameborder="0" 
                         allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                         allowfullscreen>
                     </iframe>
                     <div class="absolute bottom-8 left-8 text-white pointer-events-none bg-black/50 p-4 rounded-xl backdrop-blur-sm">
                         <span class="bg-acef-green px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-2 inline-block text-acef-dark">Featured Video</span>
                         <h3 class="text-2xl font-bold">{{ $featuredVideo->title }}</h3>
                     </div>
                 </div>
             </div>
             @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-16">
                <template x-for="item in filteredItems" :key="item.id">
                    <div class="group flex flex-col space-y-6 cursor-pointer">
                        <div
                            class="relative aspect-[4/5] rounded-[40px] overflow-hidden bg-gray-100 dark:bg-white/5 shadow-sm border border-gray-50 dark:border-white/5">
                            <img :src="'/storage/' + item.image" :alt="item.title"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

                            <!-- Badges -->
                            <div class="absolute top-6 left-6 flex space-x-2">
                                <span
                                    class="bg-white/90 backdrop-blur-md px-4 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest text-acef-dark" x-text="item.category"></span>
                            </div>

                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        </div>

                        <div class="space-y-4 px-2">
                            <div class="space-y-1">
                                <span
                                    class="text-acef-green font-bold text-[10px] uppercase tracking-widest" x-text="item.activity_type"></span>
                                <h3
                                    class="text-xl font-black text-acef-dark leading-tight group-hover:text-acef-green transition-colors" x-text="item.title">
                                    </h3>
                            </div>
                            <div
                                class="flex items-center justify-between text-[10px] font-black uppercase tracking-widest text-gray-300">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-3 h-3 text-acef-green" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span x-text="item.location || 'Unknown'"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
                
                <div x-show="filteredItems.length === 0" class="col-span-full text-center py-20 text-gray-400">
                    <p class="text-xl font-light italic">No gallery items found matching your filters.</p>
                    <button @click="resetFilters()" class="text-acef-green font-bold mt-4 hover:underline">Clear Filters</button>
                </div>
            </div>

            <!-- Footer / Load More -->
            <div class="pt-24 flex flex-col items-center space-y-10" x-show="filteredItems.length > 0">
                <p
                    class="text-[10px] font-bold text-gray-300 uppercase tracking-widest leading-loose italic max-w-sm text-center">
                    {!! __('pages.gallery.note', ['programmes_url' => route('programmes'), 'projects_url' => route('projects')]) !!}
                </p>
            </div>
        </section>

        <!-- YouTube Channel Section -->
        <section class="py-24 bg-acef-dark relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-end gap-8 mb-16">
                    <div class="space-y-4">
                        <p class="text-acef-green font-bold tracking-widest uppercase text-sm">Media Hub</p>
                        <h2 class="text-5xl font-black text-white tracking-tighter">YouTube Channel</h2>
                        <p class="text-white/60 font-light italic">Watch our latest stories of impact from the field.</p>
                    </div>
                    <a href="https://youtube.com/@acefngo" target="_blank" class="bg-red-600 text-white px-8 py-4 rounded-xl font-bold hover:bg-red-700 transition-all flex items-center gap-3">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        Subscribe to Channel
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @php
                        $youtubeVideos = [
                            ['id' => 'M_Fx1EhJcA4', 'title' => 'The Great Green Wall'],
                            ['id' => 'dQw4w9WgXcQ', 'title' => 'Community Impact Story'],
                            ['id' => 'aqz-KE-bpKQ', 'title' => 'Ocean Conservation']
                        ];
                    @endphp
                    @foreach($youtubeVideos as $video)
                        <div class="group relative rounded-2xl overflow-hidden aspect-video border border-white/10 bg-black/40 shadow-2xl">
                            <iframe 
                                class="w-full h-full"
                                src="https://www.youtube.com/embed/{{ $video['id'] }}?rel=0&modestbranding=1" 
                                title="{{ $video['title'] }}" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                allowfullscreen>
                            </iframe>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    @include('components.footer')
</body>

</html>