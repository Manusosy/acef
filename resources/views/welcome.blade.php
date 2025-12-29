<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ACEF - Protecting Marine Ecosystems</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

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

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="space-y-4 animate-fade-in-up">
                <span
                    class="inline-block py-2 px-6 rounded-full bg-acef-green/20 text-acef-green font-bold text-sm tracking-wider uppercase">Founded
                    2020 · Registered 2021</span>
                <h1 class="text-6xl md:text-8xl font-black leading-tight tracking-tighter">
                    Empowering <br>
                    <span class="text-acef-green">Grassroots</span> for a <br>
                    Sustainable Future
                </h1>
            </div>
            <p
                class="text-xl md:text-2xl font-light text-white/90 leading-relaxed max-w-xl animate-fade-in-up delay-100 italic">
                Leading youth-led action to address the triple planetary crisis across Africa.
            </p>
            <div
                class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6 pt-4 animate-fade-in-up delay-200">
                <a href="{{ route('get-involved') }}"
                    class="bg-acef-green text-white px-10 py-5 rounded-full font-bold text-lg hover:scale-105 transition-transform shadow-2xl shadow-acef-green/30 flex items-center justify-center">
                    Get Involved
                </a>
                <a href="{{ route('impact') }}"
                    class="bg-white/10 backdrop-blur-md border border-white/20 text-white px-10 py-5 rounded-full font-bold text-lg hover:bg-white/20 transition-all flex items-center justify-center">
                    See Our Impact
                </a>
            </div>
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
                            <p class="text-acef-green font-bold tracking-widest uppercase text-sm">Who We Are</p>
                            <h2 class="text-5xl font-black text-acef-dark tracking-tighter leading-tight">
                                Africa Climate and <br>
                                <span class="text-acef-green italic">Environment</span> Foundation
                            </h2>
                        </div>
                        <p class="text-xl text-gray-600 leading-relaxed font-light">
                            ACEF is a youth-focused non-governmental organization dedicated to empowering grassroots
                            youth and women, supporting locally driven initiatives to address the <span
                                class="text-acef-dark font-bold">triple planetary crisis</span>: climate change,
                            biodiversity loss, and pollution.
                        </p>
                        <p class="text-gray-500 leading-relaxed font-light italic">
                            Registered across various African nations, we work to enhance environmental resilience and
                            promote sustainable livelihoods through innovative, community-led solutions.
                        </p>
                        <div class="pt-4 grid grid-cols-2 gap-8">
                            <div class="flex flex-col">
                                <span class="text-4xl font-black text-acef-dark">14+</span>
                                <span class="text-xs text-gray-400 font-bold uppercase tracking-widest">Countries</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-4xl font-black text-acef-dark">2,000+</span>
                                <span class="text-xs text-gray-400 font-bold uppercase tracking-widest">Members</span>
                            </div>
                        </div>
                        <div class="pt-4">
                            <a href="{{ route('about') }}"
                                class="inline-block bg-acef-dark text-white px-10 py-5 rounded-full font-bold hover:bg-opacity-90 transition-all shadow-xl">
                                Our Story
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Programmes Section -->
        <section class="py-24 bg-acef-gray">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
                <h2 class="text-5xl font-black text-acef-dark tracking-tighter">Our Programmes</h2>
                <p class="text-gray-500 max-w-2xl mx-auto font-light italic">
                    Comprehensive initiatives designed to cover every aspect of marine and environmental conservation.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 pt-16">
                    @php
                        $programmes = [
                            ['title' => 'Atlantic Coast Protection', 'desc' => 'Restoring and protecting the biodiversity of West African shores.', 'icon' => 'blue'],
                            ['title' => 'Continental Marine Ecosystems', 'desc' => 'Inland water bodies and river mouth conservation across the continent.', 'icon' => 'green'],
                            ['title' => 'Marine Research & Science', 'desc' => 'Scientific exploration to understand our ocean floor and species.', 'icon' => 'indigo'],
                            ['title' => 'Climate Change Adaptation', 'desc' => 'Helping communities adapt to rising sea levels and changing climates.', 'icon' => 'amber'],
                            ['title' => 'Nature Biodiversity Conservation', 'desc' => 'Protecting endangered avian and aquatic species in their habitats.', 'icon' => 'emerald'],
                            ['title' => 'Water Pollution Control', 'desc' => 'Addressing plastic waste and industrial runoff in marine environments.', 'icon' => 'sky'],
                            ['title' => 'Agro-forestry for Biodiversity', 'desc' => 'Restoring forest cover to protect water catchments and biodiversity.', 'icon' => 'lime'],
                            ['title' => 'Eco-Tourism Development', 'desc' => 'Sustainable tourism models that benefit both people and nature.', 'icon' => 'cyan'],
                            ['title' => 'Health & Environment', 'desc' => 'Linking community health with a clean and safe environment.', 'icon' => 'rose'],
                            ['title' => 'Empowering Leaders of Tomorrow', 'desc' => 'Training the next generation of environmental advocates.', 'icon' => 'violet'],
                        ];
                    @endphp

                    @foreach($programmes as $prog)
                        <div
                            class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all group text-left border border-black/5 flex flex-col justify-between">
                            <div class="space-y-4">
                                <div
                                    class="w-14 h-14 rounded-2xl bg-{{ $prog['icon'] }}-50 flex items-center justify-center group-hover:bg-acef-green group-hover:text-white transition-colors duration-500 text-{{ $prog['icon'] }}-500">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M12 21l-8-9 8-9 8 9-8 9z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-acef-dark group-hover:text-acef-green transition-colors">
                                    {{ $prog['title'] }}
                                </h3>
                                <p class="text-gray-500 text-sm leading-relaxed">{{ $prog['desc'] }}</p>
                            </div>
                            <div class="pt-6">
                                <a href="{{ route('programmes') }}"
                                    class="text-acef-green font-bold flex items-center text-sm group-hover:translate-x-1 transition-transform">
                                    Read More <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
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
                        <h2 class="text-5xl font-black text-acef-dark tracking-tighter">Featured Projects</h2>
                        <p class="text-gray-500 font-light italic">Recent impactful initiatives across our focus areas.
                        </p>
                    </div>
                    <a href="{{ route('projects') }}" class="text-acef-green font-bold flex items-center group">
                        View All Projects <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <!-- Project 1 -->
                    <div class="group cursor-pointer">
                        <div class="relative rounded-3xl overflow-hidden aspect-[4/5] mb-6 shadow-lg">
                            <img src="/project_solar_panels_1766827705821.png" alt="Solar Project"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute top-6 left-6">
                                <span
                                    class="bg-acef-green text-white px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">Renewable
                                    Energy</span>
                            </div>
                        </div>
                        <h3
                            class="text-2xl font-bold text-acef-dark group-hover:text-acef-green transition-colors mb-2">
                            Clean Energy for Coastal Schools</h3>
                        <p class="text-gray-500 text-sm line-clamp-2 italic mb-4">Implementing off-grid solar solutions
                            for 50 schools along the Kenyan coast.</p>
                        <a href="{{ route('projects') }}"
                            class="font-bold text-acef-dark group-hover:text-acef-green transition-colors flex items-center">
                            Read More <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                    <!-- Project 2 -->
                    <div class="group cursor-pointer">
                        <div class="relative rounded-3xl overflow-hidden aspect-[4/5] mb-6 shadow-lg">
                            <img src="/project_tree_planting_1766827726209.png" alt="Tree Planting"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute top-6 left-6">
                                <span
                                    class="bg-acef-green text-white px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">Reforestation</span>
                            </div>
                        </div>
                        <h3
                            class="text-2xl font-bold text-acef-dark group-hover:text-acef-green transition-colors mb-2">
                            Building Resilient Hillside Forests</h3>
                        <p class="text-gray-500 text-sm line-clamp-2 italic mb-4">Protecting water catchments through
                            community-led tree planting initiatives.</p>
                        <a href="{{ route('projects') }}"
                            class="font-bold text-acef-dark group-hover:text-acef-green transition-colors flex items-center">
                            Read More <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                    <!-- Project 3 -->
                    <div class="group cursor-pointer">
                        <div class="relative rounded-3xl overflow-hidden aspect-[4/5] mb-6 shadow-lg">
                            <img src="/project_mangroves_1766827746442.png" alt="Mangroves"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute top-6 left-6">
                                <span
                                    class="bg-acef-green text-white px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">Marine
                                    Conservation</span>
                            </div>
                        </div>
                        <h3
                            class="text-2xl font-bold text-acef-dark group-hover:text-acef-green transition-colors mb-2">
                            Mangrove Forest Restoration</h3>
                        <p class="text-gray-500 text-sm line-clamp-2 italic mb-4">Restoring 1,000 hectares of mangroves
                            to protect against coastal erosion.</p>
                        <a href="{{ route('projects') }}"
                            class="font-bold text-acef-dark group-hover:text-acef-green transition-colors flex items-center">
                            Read More <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-20 bg-acef-dark text-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 right-0 w-96 h-96 bg-acef-green rounded-full blur-[120px]"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-acef-green rounded-full blur-[120px]"></div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-12 text-center">
                    <div class="space-y-2">
                        <span class="text-5xl md:text-6xl font-black text-acef-green block">14</span>
                        <span class="text-white/60 uppercase tracking-widest text-xs font-bold">Countries</span>
                    </div>
                    <div class="space-y-2">
                        <span class="text-5xl md:text-6xl font-black text-acef-green block">2,000+</span>
                        <span class="text-white/60 uppercase tracking-widest text-xs font-bold">Volunteers</span>
                    </div>
                    <div class="space-y-2">
                        <span class="text-5xl md:text-6xl font-black text-acef-green block">50+</span>
                        <span class="text-white/60 uppercase tracking-widest text-xs font-bold">Global Partners</span>
                    </div>
                    <div class="space-y-2">
                        <span class="text-5xl md:text-6xl font-black text-acef-green block">10,000+</span>
                        <span class="text-white/60 uppercase tracking-widest text-xs font-bold">Trees Planted</span>
                    </div>
                </div>
            </div>
        </section>
        <!-- Map Section -->
        <section class="py-24 bg-acef-dark relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center space-y-12">
                <div class="text-center space-y-4 max-w-2xl">
                    <p class="text-acef-green font-bold tracking-widest uppercase text-sm">Where We Work</p>
                    <h2 class="text-5xl font-black text-white tracking-tighter">Our Global Impact</h2>
                    <p class="text-white/60 font-light italic">Spanning across Africa to restore balance to our most
                        vital ecosystems.</p>
                </div>

                <div class="relative w-full max-w-4xl pt-10">
                    <img src="/map_africa_impact_1766827796711.png" alt="Impact Map"
                        class="w-full h-auto rounded-3xl shadow-2xl">

                    <!-- Pulse points -->
                    <div class="absolute top-[34%] left-[28%] group">
                        <div class="w-4 h-4 bg-acef-green rounded-full animate-ping opacity-75"></div>
                        <div class="w-4 h-4 bg-acef-green rounded-full relative -mt-4"></div>
                    </div>
                    <div class="absolute top-[60%] left-[62%] group">
                        <div class="w-4 h-4 bg-acef-green rounded-full animate-ping opacity-75"></div>
                        <div class="w-4 h-4 bg-acef-green rounded-full relative -mt-4"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- News & Insights -->
        <section class="py-24 bg-acef-gray">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
                <div class="flex justify-between items-end">
                    <div class="space-y-4">
                        <h2 class="text-5xl font-black text-acef-dark tracking-tighter">News & Insights</h2>
                        <p class="text-gray-500 font-light italic">Stay informed with the latest updates and stories
                            from the field.</p>
                    </div>
                    <a href="{{ route('news') }}" class="text-acef-green font-bold flex items-center group">
                        Visit Our Blog <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    <!-- News 1 -->
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all group">
                        <div class="relative aspect-video overflow-hidden">
                            <img src="/project_mangroves_1766827746442.png" alt="Biodiversity"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute bottom-4 left-4">
                                <span
                                    class="bg-white/90 backdrop-blur-md text-acef-dark px-3 py-1 rounded-full text-[10px] font-bold uppercase">Biodiversity</span>
                            </div>
                        </div>
                        <div class="p-8 space-y-4">
                            <span class="text-gray-400 text-xs font-semibold uppercase tracking-wider">March 24,
                                2025</span>
                            <h3
                                class="text-xl font-bold text-acef-dark group-hover:text-acef-green transition-colors leading-tight">
                                New Species of Marine Life Discovered off Coastal Kenya</h3>
                            <p class="text-gray-500 text-sm italic">Our research team has identified several previously
                                undocumented species in the Lamu archipelago.</p>
                            <div class="pt-2 border-t border-gray-100">
                                <a href="{{ route('news') }}"
                                    class="text-acef-dark font-bold text-sm flex items-center group-hover:text-acef-green transition-colors">
                                    Read More <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- News 2 -->
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all group">
                        <div class="relative aspect-video overflow-hidden">
                            <img src="/hero_marine_ecosystem_1766827540454.png" alt="Ocean Conservation"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute bottom-4 left-4">
                                <span
                                    class="bg-white/90 backdrop-blur-md text-acef-dark px-3 py-1 rounded-full text-[10px] font-bold uppercase">Conservation</span>
                            </div>
                        </div>
                        <div class="p-8 space-y-4">
                            <span class="text-gray-400 text-xs font-semibold uppercase tracking-wider">March 18,
                                2025</span>
                            <h3
                                class="text-xl font-bold text-acef-dark group-hover:text-acef-green transition-colors leading-tight">
                                Community Beach Cleaning: Over 5 Tons of Plastic Removed</h3>
                            <p class="text-gray-500 text-sm italic">Hundreds of volunteers joined forces to restore the
                                pristine beauty of our shores this weekend.</p>
                            <div class="pt-2 border-t border-gray-100">
                                <a href="{{ route('news') }}"
                                    class="text-acef-dark font-bold text-sm flex items-center group-hover:text-acef-green transition-colors">
                                    Read More <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- News 3 -->
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all group">
                        <div class="relative aspect-video overflow-hidden">
                            <img src="/project_tree_planting_1766827726209.png" alt="Reforestation"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute bottom-4 left-4">
                                <span
                                    class="bg-white/90 backdrop-blur-md text-acef-dark px-3 py-1 rounded-full text-[10px] font-bold uppercase">Reforestation</span>
                            </div>
                        </div>
                        <div class="p-8 space-y-4">
                            <span class="text-gray-400 text-xs font-semibold uppercase tracking-wider">March 12,
                                2025</span>
                            <h3
                                class="text-xl font-bold text-acef-dark group-hover:text-acef-green transition-colors leading-tight">
                                Strategic Partnership with Global Re-Green Initiative</h3>
                            <p class="text-gray-500 text-sm italic">New funding secured to accelerate our tree planting
                                goals for the 2025-2026 season.</p>
                            <div class="pt-2 border-t border-gray-100">
                                <a href="{{ route('news') }}"
                                    class="text-acef-dark font-bold text-sm flex items-center group-hover:text-acef-green transition-colors">
                                    Read More <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Partners Section -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
                <p class="text-center text-gray-400 font-bold uppercase tracking-[0.3em] text-xs">Our Global Partners &
                    Supporters</p>
                <div
                    class="flex flex-wrap justify-center items-center gap-12 grayscale opacity-40 hover:opacity-100 transition-opacity">
                    <span class="text-3xl font-black text-acef-dark tracking-tighter">UN@ENVIRONMENT</span>
                    <span class="text-3xl font-black text-acef-dark tracking-tighter">GREENPEACE</span>
                    <span class="text-3xl font-black text-acef-dark tracking-tighter">WWF</span>
                    <span class="text-3xl font-black text-acef-dark tracking-tighter">ECO-TRUST</span>
                    <span class="text-3xl font-black text-acef-dark tracking-tighter">PLANET@FIRST</span>
                </div>
            </div>
        </section>
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
</body>

</html>