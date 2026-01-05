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

    @php
        $galleryPage = \App\Models\Page::where('slug', 'gallery')->first();
        $heroSlides = $galleryPage ? $galleryPage->activeHeroSlides()->with('media')->get() : collect();
    @endphp
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
        youtubeSettings: {{ json_encode($youtubeSettings) }},
        youtubeVideos: [],
        loadingYoutube: true,
        youtubeError: null,
        selectedAlbum: null,
        filters: {
            programme: '',
            project: '',
            category: ''
        },
        async init() {
            if (this.youtubeSettings.youtube_api_key && this.youtubeSettings.youtube_channel_id) {
                try {
                    const response = await fetch(`https://www.googleapis.com/youtube/v3/search?key=${this.youtubeSettings.youtube_api_key}&channelId=${this.youtubeSettings.youtube_channel_id}&part=snippet,id&order=date&maxResults=6&type=video`);
                    const data = await response.json();
                    
                    if (data.error) {
                        this.youtubeError = data.error.message;
                    } else if (data.items) {
                        this.youtubeVideos = data.items.map(item => ({
                            id: item.id.videoId,
                            title: item.snippet.title,
                            thumbnail: item.snippet.thumbnails.high.url,
                            publishedAt: new Date(item.snippet.publishedAt).toLocaleDateString()
                        }));
                    }
                } catch (e) {
                    this.youtubeError = 'Failed to load videos. Please check your API configuration.';
                } finally {
                    this.loadingYoutube = false;
                }
            } else {
                this.loadingYoutube = false;
            }
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
        <x-hero 
            :page="$galleryPage"
            :slides="$heroSlides"
            breadcrumb="{{ __('navigation.gallery') }}"
            title="{{ __('pages.gallery.hero_title') }}"
            subtitle="{{ __('pages.gallery.hero_desc') }}"
            image-url="/mission_vision_africa_1766827653058.png"
        />

        <!-- Filter Bar -->
        <section class="bg-gray-50 dark:bg-[#111827]/80 border-y border-gray-100 dark:border-white/5 py-8 backdrop-blur-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row items-center justify-between gap-6">
                    <div class="flex flex-wrap items-center gap-4">
                        <div class="flex items-center space-x-2 text-xs font-bold uppercase tracking-widest text-gray-400 mr-2">
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
                            <button @click="resetFilters()" class="text-xs font-bold uppercase text-gray-400 dark:text-gray-500 hover:text-acef-dark dark:hover:text-acef-green transition-colors border-b-2 border-transparent hover:border-acef-green pb-0.5">{{ __('pages.gallery.filters.reset') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Media Gallery -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <!-- Albums Section -->
            <div x-show="filteredFolders.length > 0" class="mb-24">
                <h2 class="text-3xl font-bold text-acef-dark mb-10 tracking-tight">Galleries by Project</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    <template x-for="folder in filteredFolders" :key="folder.id">
                        <div @click="selectedAlbum = folder" class="group cursor-pointer">
                            <div class="relative aspect-[4/3] rounded-2xl overflow-hidden mb-6 bg-gray-100 dark:bg-white/5">
                                <template x-if="folder.media_items.length > 0">
                                    <img :src="'/storage/' + folder.media_items[0].path" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                </template>
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 via-transparent to-transparent opacity-60 group-hover:opacity-100 transition-opacity"></div>
                                <div class="absolute bottom-6 left-6 text-white">
                                    <span class="text-xs font-bold uppercase tracking-widest bg-emerald-500/90 px-3 py-1 rounded-full mb-2 inline-block" x-text="folder.media_items.length + ' Photos'"></span>
                                    <h3 class="text-xl font-bold" x-text="folder.name"></h3>
                                </div>
                            </div>
                            <div class="px-2">
                                <div class="flex items-center gap-2 mb-1">
                                    <template x-if="folder.project">
                                        <span class="text-xs font-bold text-acef-green uppercase tracking-widest" x-text="folder.project.title"></span>
                                    </template>
                                    <template x-if="folder.programme">
                                        <span class="text-xs font-bold text-blue-500 uppercase tracking-widest" x-text="folder.programme.title"></span>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Individual Highlights / Gallery Items -->
            <div x-show="filteredItems.length > 0">
                <h2 class="text-3xl font-bold text-acef-dark mb-10 tracking-tight">Featured Highlights</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    <template x-for="item in filteredItems" :key="item.id">
                        <div class="group flex flex-col space-y-4">
                            <div class="relative aspect-square rounded-2xl overflow-hidden bg-gray-100 dark:bg-white/5 border border-gray-50 dark:border-white/5">
                                <img :src="'/storage/' + item.image" :alt="item.title" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            </div>
                            <div class="px-2">
                                <h3 class="text-sm font-bold text-acef-dark leading-tight" x-text="item.title"></h3>
                                <p class="text-xs text-gray-400 mt-1 uppercase font-bold" x-text="item.location"></p>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

        </section>

        <!-- Album Modal -->
        <div x-show="selectedAlbum" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4">
            <div @click="selectedAlbum = null" class="absolute inset-0 bg-black/95 backdrop-blur-xl"></div>
            <div class="bg-white dark:bg-gray-900 rounded-3xl w-full max-w-6xl max-h-[90vh] overflow-hidden relative shadow-2xl flex flex-col">
                <div class="p-8 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-acef-dark dark:text-white" x-text="selectedAlbum?.name"></h2>
                        <div class="flex items-center gap-3 mt-1">
                            <template x-if="selectedAlbum?.project">
                                <span class="text-xs font-bold text-acef-green uppercase tracking-widest" x-text="selectedAlbum.project.title"></span>
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

        <!-- YouTube Channel Section (Dynamic) -->
        <section class="py-24 bg-acef-dark relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-end gap-8 mb-16">
                    <div class="space-y-4">
                        <p class="text-acef-green font-bold tracking-widest uppercase text-sm">Media Hub</p>
                        <h2 class="text-5xl font-bold text-white tracking-tighter">Voices of Impact: Our YouTube Channel</h2>
                        <p class="text-white/60 font-light italic">Watch our latest stories of impact from the field. Your support allows us to document these milestones and share the radical transparency of our work in the field. Join us in our journey towards a sustainable future.</p>
                    </div>
                    <a :href="'https://youtube.com/channel/' + (youtubeSettings.youtube_channel_id || '')" target="_blank" class="bg-red-600 text-white px-8 py-4 rounded-xl font-bold hover:bg-red-700 transition-all flex items-center gap-3">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        Visit our Channel
                    </a>
                </div>

                <!-- Loading State -->
                <div x-show="loadingYoutube" class="py-20 flex flex-col items-center justify-center space-y-4">
                    <div class="w-12 h-12 border-4 border-acef-green/20 border-t-acef-green rounded-full animate-spin"></div>
                    <p class="text-gray-400 font-bold uppercase tracking-widest text-xs">Syncing with YouTube...</p>
                </div>

                <!-- Error State -->
                <div x-show="!loadingYoutube && youtubeError" class="py-12 px-8 bg-red-900/20 border border-red-800 rounded-3xl text-center">
                    <p class="text-red-400 font-medium" x-text="youtubeError"></p>
                </div>

                <!-- Unconfigured State -->
                <div x-show="!loadingYoutube && !youtubeError && youtubeVideos.length === 0" class="py-20 text-center border-2 border-dashed border-white/10 rounded-[40px]">
                    <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-white font-bold text-xl mb-2">Stay Tuned for Video Updates</h3>
                    <p class="text-gray-400 max-w-md mx-auto italic">We're currently updating our media hub to bring you more immersive stories from our projects across the globe.</p>
                </div>

                <!-- Videos Grid -->
                <div x-show="!loadingYoutube && youtubeVideos.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <template x-for="video in youtubeVideos" :key="video.id">
                        <div class="group relative flex flex-col">
                            <div class="relative aspect-video rounded-xl overflow-hidden border border-white/10 bg-black/40 shadow-2xl mb-4">
                                <img :src="video.thumbnail" :alt="video.title" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center shadow-xl transform scale-90 group-hover:scale-100 transition-transform">
                                        <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    </div>
                                </div>
                                <a :href="'https://youtube.com/watch?v=' + video.id" target="_blank" class="absolute inset-0 z-10"></a>
                            </div>
                            <div class="px-2">
                                <h3 class="text-white font-bold text-lg leading-tight mb-2 group-hover:text-acef-green transition-colors line-clamp-2" x-text="video.title"></h3>
                                <p class="text-xs font-bold uppercase tracking-widest text-gray-400" x-text="'Published ' + video.publishedAt"></p>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </section>
    </main>

    @include('components.footer')
</body>

</html>