<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Impact Gallery - ACEF</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .scrollbar-hide::-webkit-scrollbar { display: none; }
            .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
        </style>
    </head>
    <body class="antialiased font-sans bg-white overflow-x-hidden">
        @include('components.header')

        <main class="pt-40 pb-24">
            <!-- Gallery Hero -->
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
                <div class="flex flex-col md:flex-row justify-between items-end gap-8">
                    <div class="space-y-6 max-w-2xl">
                        <h1 class="text-6xl md:text-7xl font-black text-acef-dark tracking-tighter leading-none">Impact Gallery</h1>
                        <p class="text-gray-400 text-lg font-light italic leading-relaxed">
                            Explore visual evidence of our field activities across all programmes. We believe in radical transparency and showcasing the real ecological impact of your support.
                        </p>
                    </div>
                    <button class="bg-white text-acef-dark border border-gray-100 shadow-sm px-8 py-4 rounded-2xl font-black text-sm flex items-center space-x-3 hover:bg-acef-dark hover:text-white transition-all">
                        <svg class="w-5 h-5 text-acef-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2-2z"></path></svg>
                        <span>Submit Field Report</span>
                    </button>
                </div>
            </section>

            <!-- Filter Bar -->
            <section class="bg-gray-50/50 border-y border-gray-100 py-6 sticky top-[95px] z-[40]">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col lg:flex-row items-center justify-between gap-6">
                        <div class="flex flex-wrap items-center gap-4">
                            <div class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-widest text-gray-300 mr-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                                <span>Filters:</span>
                            </div>
                            
                            <!-- Filter Pill Groups -->
                            <div class="flex items-center space-x-3">
                                <select class="bg-white border-none rounded-xl px-6 py-3 text-xs font-bold text-acef-dark shadow-sm focus:ring-2 focus:ring-acef-green ring-offset-2 transition-all outline-none">
                                    <option>Programme</option>
                                    <option>Reforestation</option>
                                    <option>Water Security</option>
                                    <option>Clean Energy</option>
                                </select>
                                <select class="bg-white border-none rounded-xl px-6 py-3 text-xs font-bold text-acef-dark shadow-sm focus:ring-2 focus:ring-acef-green ring-offset-2 transition-all outline-none">
                                    <option>Activity Type</option>
                                    <option>Field Activity</option>
                                    <option>Community Workshop</option>
                                    <option>Drone Survey</option>
                                </select>
                                <select class="bg-white border-none rounded-xl px-6 py-3 text-xs font-bold text-acef-dark shadow-sm focus:ring-2 focus:ring-acef-green ring-offset-2 transition-all outline-none">
                                    <option>Country</option>
                                    <option>Senegal</option>
                                    <option>Rwanda</option>
                                    <option>Nigeria</option>
                                    <option>Mozambique</option>
                                </select>
                                <div class="bg-acef-green/10 text-acef-green px-4 py-3 rounded-xl flex items-center space-x-2">
                                    <span class="text-xs font-black">Year: 2023</span>
                                    <button class="hover:text-acef-dark transition-colors"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                                </div>
                                <button class="text-[10px] font-black uppercase text-gray-300 hover:text-acef-dark transition-colors border-b-2 border-transparent hover:border-acef-green pb-0.5">Reset</button>
                            </div>
                        </div>

                        <div class="flex items-center space-x-8">
                            <span class="text-[10px] font-bold text-gray-300 uppercase tracking-widest whitespace-nowrap">Showing <span class="text-acef-dark font-black">12</span> of 348 results</span>
                            <div class="flex items-center bg-white rounded-xl shadow-sm p-1">
                                <button class="p-2 bg-acef-dark text-white rounded-lg shadow-lg">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                                </button>
                                <button class="p-2 text-gray-300 hover:text-acef-dark transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Media Gallery Grid -->
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-16">
                    @php
                        $items = [
                            [
                                'category' => 'REFORESTATION',
                                'duration' => '2:14',
                                'type' => 'Field Activity',
                                'title' => 'Great Green Wall Expansion',
                                'location' => 'Senegal',
                                'year' => '2023',
                                'image' => '/project_tree_planting_1766827726209.png',
                                'is_video' => true
                            ],
                            [
                                'category' => 'WATER SECURITY',
                                'duration' => null,
                                'type' => 'Community Workshop',
                                'title' => 'Community Hygiene Training',
                                'location' => 'Rwanda',
                                'year' => '2023',
                                'image' => '/uploaded_image_1766827444492.png',
                                'is_video' => false
                            ],
                            [
                                'category' => 'CLEAN ENERGY',
                                'duration' => null,
                                'type' => 'Infrastructure',
                                'title' => 'School Solar Installation',
                                'location' => 'Nigeria',
                                'year' => '2023',
                                'image' => '/project_solar_panels_1766827705821.png',
                                'is_video' => false
                            ],
                            [
                                'category' => 'BIODIVERSITY',
                                'duration' => '4:30',
                                'type' => 'Drone Survey',
                                'title' => 'Mangrove Restoration Aerials',
                                'location' => 'Mozambique',
                                'year' => '2023',
                                'image' => '/project_mangroves_1766827746442.png',
                                'is_video' => true
                            ],
                            [
                                'category' => 'SUSTAINABLE AG',
                                'duration' => null,
                                'type' => 'Success Story',
                                'title' => 'First Harvest: Eco-Farm',
                                'location' => 'Uganda',
                                'year' => '2023',
                                'image' => '/uploaded_image_1766828557603.png',
                                'is_video' => false
                            ],
                            [
                                'category' => 'RESEARCH',
                                'duration' => null,
                                'type' => 'Data Collection',
                                'title' => 'Soil Analysis Survey',
                                'location' => 'Ethiopia',
                                'year' => '2023',
                                'image' => '/map_africa_impact_1766827796711.png',
                                'is_video' => false
                            ]
                        ];
                    @endphp

                    @foreach($items as $item)
                    <div class="group flex flex-col space-y-6 cursor-pointer">
                        <div class="relative aspect-[4/5] rounded-[40px] overflow-hidden bg-gray-100 shadow-sm border border-gray-50">
                            <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            
                            <!-- Badges -->
                            <div class="absolute top-6 left-6 flex space-x-2">
                                <span class="bg-white/90 backdrop-blur-md px-4 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest text-acef-dark">{{ $item['category'] }}</span>
                            </div>

                            @if($item['is_video'])
                            <div class="absolute top-6 right-6">
                                <div class="bg-black/60 backdrop-blur-md px-3 py-1.5 rounded-xl text-[9px] font-black text-white flex items-center space-x-2">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M7 6.75V17.25L17.5 12L7 6.75Z"></path></svg>
                                    <span>{{ $item['duration'] }}</span>
                                </div>
                            </div>
                            <!-- Centered Play Button -->
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <div class="w-16 h-16 bg-acef-green text-acef-dark rounded-full flex items-center justify-center shadow-2xl scale-75 group-hover:scale-100 transition-transform">
                                    <svg class="w-8 h-8 translate-x-1" fill="currentColor" viewBox="0 0 24 24"><path d="M7 6.75V17.25L17.5 12L7 6.75Z"></path></svg>
                                </div>
                            </div>
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        </div>

                        <div class="space-y-4 px-2">
                            <div class="space-y-1">
                                <span class="text-acef-green font-bold text-[10px] uppercase tracking-widest">{{ $item['type'] }}</span>
                                <h3 class="text-xl font-black text-acef-dark leading-tight group-hover:text-acef-green transition-colors">{{ $item['title'] }}</h3>
                            </div>
                            <div class="flex items-center justify-between text-[10px] font-black uppercase tracking-widest text-gray-300">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-3 h-3 text-acef-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span>{{ $item['location'] }}</span>
                                </div>
                                <span>{{ $item['year'] }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Footer / Load More -->
                <div class="pt-24 flex flex-col items-center space-y-10">
                    <button class="bg-white border-2 border-gray-100 text-acef-dark font-black px-12 py-5 rounded-2xl hover:border-acef-green hover:bg-acef-green/5 transition-all text-sm flex items-center space-x-3 group">
                        <span>Load More Media</span>
                        <svg class="w-5 h-5 group-hover:translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <p class="text-[10px] font-bold text-gray-300 uppercase tracking-widest leading-loose italic max-w-sm text-center">
                        Note: Media from this gallery is automatically synced to relevant <a href="{{ route('programmes') }}" class="text-acef-dark hover:text-acef-green underline">Programme</a> and <a href="{{ route('projects') }}" class="text-acef-dark hover:text-acef-green underline">Project</a> pages to ensure consistent reporting.
                    </p>
                </div>
            </section>
        </main>

        @include('components.footer')
    </body>
</html>
