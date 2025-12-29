<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Our Programmes - ACEF</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-white overflow-x-hidden">
        @include('components.header')

        <!-- Programmes Hero -->
        <section class="relative pt-32 pb-20 bg-acef-dark overflow-hidden">
            <!-- Background Elements -->
            <div class="absolute inset-0 opacity-20">
                <div class="absolute top-0 right-0 w-96 h-96 bg-acef-green rounded-full blur-[120px]"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-acef-green rounded-full blur-[120px]"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="bg-gray-800/50 backdrop-blur-xl rounded-[40px] p-12 md:p-20 text-center space-y-8 border border-white/10 shadow-2xl">
                    <h1 class="text-5xl md:text-7xl font-black text-white tracking-tighter">Our Programmes</h1>
                    <p class="text-xl text-white/70 max-w-2xl mx-auto font-light leading-relaxed">
                        Driving sustainable change across Africa through targeted environmental initiatives and community empowerment.
                    </p>
                    <div class="pt-4">
                        <button class="bg-acef-green text-acef-dark font-black px-10 py-4 rounded-2xl hover:bg-white transition-all transform hover:scale-105 shadow-xl">
                            Explore Initiatives
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <main class="relative z-20 -mt-10">
            <!-- Stats Bar -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100 flex flex-col space-y-2">
                        <span class="text-acef-green"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg></span>
                        <h4 class="text-gray-400 text-sm font-bold uppercase tracking-wider">Projects Launched</h4>
                        <span class="text-4xl font-black text-acef-dark">50+</span>
                    </div>
                    <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100 flex flex-col space-y-2">
                        <span class="text-acef-green text-xl">🌱</span>
                        <h4 class="text-gray-400 text-sm font-bold uppercase tracking-wider">Trees Planted</h4>
                        <span class="text-4xl font-black text-acef-dark">10k+</span>
                    </div>
                    <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100 flex flex-col space-y-2">
                        <span class="text-acef-green"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg></span>
                        <h4 class="text-gray-400 text-sm font-bold uppercase tracking-wider">Lives Impacted</h4>
                        <span class="text-4xl font-black text-acef-dark">500k</span>
                    </div>
                    <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100 flex flex-col space-y-2">
                        <span class="text-acef-green text-xl">🤝</span>
                        <h4 class="text-gray-400 text-sm font-bold uppercase tracking-wider">Partners</h4>
                        <span class="text-4xl font-black text-acef-dark">35</span>
                    </div>
                </div>
            </div>

            <!-- Initiatives List -->
            <section class="py-24 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                        <h2 class="text-4xl font-black text-acef-dark tracking-tighter">Active Initiatives</h2>
                        
                        <div class="flex flex-wrap items-center gap-4">
                            <!-- Basic Controls -->
                            <button class="flex items-center space-x-2 px-6 py-3 bg-gray-50 rounded-xl font-bold text-gray-500 hover:bg-gray-100 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                                <span>Filter</span>
                            </button>
                            <button class="flex items-center space-x-2 px-6 py-3 bg-gray-50 rounded-xl font-bold text-gray-500 hover:bg-gray-100 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path></svg>
                                <span>Sort</span>
                            </button>
                            <div class="relative">
                                <input type="text" placeholder="Search programmes..." class="pl-12 pr-6 py-3 bg-gray-50 border-none rounded-xl w-64 focus:ring-2 focus:ring-acef-green transition-all">
                                <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @php
                            $initiatives = [
                                [
                                    'title' => 'Mangrove Restoration',
                                    'category' => 'Marine Ecosystems',
                                    'desc' => 'Restoring degraded mangrove forests to protect coastal communities from storm surges and provide critical habitats for marine biodiversity.',
                                    'icon' => '🌳',
                                    'stats' => 'Coastline'
                                ],
                                [
                                    'title' => 'Sea Turtle Protection',
                                    'category' => 'Wildlife Conservation',
                                    'desc' => 'Community-led monitoring and protection of nesting sites for endangered sea turtles across the African Atlantic and Indian Ocean coasts.',
                                    'icon' => '🐢',
                                    'stats' => 'Biodiversity'
                                ],
                                [
                                    'title' => 'Kaya Forest Conservation',
                                    'category' => 'Indigenous Knowledge',
                                    'desc' => 'Preserving the sacred Kaya forests by integrating traditional ecological knowledge with modern conservation strategies.',
                                    'icon' => '🌲',
                                    'stats' => 'Heritage'
                                ],
                                [
                                    'title' => 'Plastic Waste Management',
                                    'category' => 'Circular Economy',
                                    'desc' => 'Implementing grassroots collection and recycling initiatives to eliminate plastic pollution from terrestrial and marine environments.',
                                    'icon' => '♻️',
                                    'stats' => 'Pollution'
                                ],
                                [
                                    'title' => 'Renewable Energy Access',
                                    'category' => 'Energy Transition',
                                    'desc' => 'Deploying off-grid solar and wind solutions to provide clean, reliable energy to rural and underserved communities.',
                                    'icon' => '☀️',
                                    'stats' => 'Energy'
                                ],
                                [
                                    'title' => 'Sustainable Agriculture',
                                    'category' => 'Food Security',
                                    'desc' => 'Training youth and women in agroforestry and climate-smart farming techniques to enhance local food security and resilience.',
                                    'icon' => '🌾',
                                    'stats' => 'Nutrition'
                                ],
                                [
                                    'title' => 'Water and Sanitation (WASH)',
                                    'category' => 'Public Health',
                                    'desc' => 'Providing clean water access and promoting hygiene practices through community-led infrastructure and education.',
                                    'icon' => '💧',
                                    'stats' => 'Health'
                                ],
                                [
                                    'title' => 'Eco-Innovation Hubs',
                                    'category' => 'Youth Leadership',
                                    'desc' => 'Supporting young entrepreneurs in developing technological and social innovations to solve local environmental challenges.',
                                    'icon' => '🚀',
                                    'stats' => 'Youth'
                                ],
                                [
                                    'title' => 'Climate Education',
                                    'category' => 'Advocacy',
                                    'desc' => 'Mainstreaming climate literacy through school programs and community workshops across 14 African nations.',
                                    'icon' => '📚',
                                    'stats' => 'Education'
                                ],
                                [
                                    'title' => 'Coral Reef Restoration',
                                    'category' => 'Marine Ecosystems',
                                    'desc' => 'Rebuilding damaged coral structures to support fish populations and enhance the scientific resilience of marine habitats.',
                                    'icon' => '🐠',
                                    'stats' => 'Ocean'
                                ]
                            ];
                        @endphp

                        @foreach($initiatives as $item)
                        <div class="bg-white p-10 rounded-3xl border border-gray-100 shadow-sm hover:shadow-2xl transition-all group flex flex-col justify-between min-h-[400px]">
                            <div class="space-y-6">
                                <div class="flex justify-between items-start">
                                    <div class="w-16 h-16 bg-acef-green/10 rounded-2xl flex items-center justify-center text-3xl">
                                        {{ $item['icon'] }}
                                    </div>
                                    <span class="text-acef-green text-[10px] font-bold uppercase tracking-widest">{{ $item['category'] }}</span>
                                </div>
                                <div class="space-y-3">
                                    <h3 class="text-2xl font-black text-acef-dark group-hover:text-acef-green transition-colors">{{ $item['title'] }}</h3>
                                    <p class="text-gray-500 text-sm leading-relaxed">
                                        {{ $item['desc'] }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex justify-between items-center pt-6 border-t border-gray-50">
                                <span class="text-gray-400 text-xs font-bold">{{ $item['stats'] }}</span>
                                <a href="{{ route('programmes') }}#{{ str($item['title'])->slug() }}" class="text-acef-green font-bold text-sm flex items-center group-hover:translate-x-1 transition-transform">
                                    Learn More <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </main>

        @include('components.footer')
    </body>
</html>
