<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Our Impact - ACEF</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-white overflow-x-hidden">
        @include('components.header')

        <!-- Impact Hero -->
        <section class="relative pt-40 pb-24 bg-white overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8">
                <div class="inline-flex items-center space-x-2 bg-acef-green/10 text-acef-green px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest border border-acef-green/20">
                    <span>🛡️</span>
                    <span>Transparency Report 2023-2024</span>
                </div>
                <h1 class="text-6xl md:text-8xl font-black text-acef-dark tracking-tighter leading-none">
                    Real Impact. <br>
                    <span class="text-acef-green">Measurable Change.</span>
                </h1>
                <p class="text-gray-500 max-w-2xl mx-auto text-lg md:text-xl font-light leading-relaxed italic">
                    We believe in radical transparency. Explore our data-driven achievements and ongoing reforestation programs across the African continent.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
                    <button class="bg-acef-dark text-white font-black px-10 py-5 rounded-2xl flex items-center space-x-3 hover:bg-acef-green transition-all shadow-xl group">
                        <span>Download Annual Report</span>
                        <svg class="w-5 h-5 group-hover:translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    </button>
                    <button class="text-acef-dark font-black px-10 py-5 rounded-2xl border-2 border-gray-100 hover:border-acef-dark transition-all">
                        View Methodology
                    </button>
                </div>
            </div>
        </section>

        <!-- Key Stats -->
        <section class="pb-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-gray-50 border border-gray-100 p-12 rounded-[40px] flex flex-col items-center space-y-4 shadow-sm hover:shadow-xl transition-all">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-sm text-acef-green">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-gray-400 font-bold uppercase tracking-widest text-xs">Countries Reached</h3>
                        <span class="text-6xl font-black text-acef-dark">12</span>
                    </div>
                    <div class="bg-gray-50 border border-gray-100 p-12 rounded-[40px] flex flex-col items-center space-y-4 shadow-sm hover:shadow-xl transition-all">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-sm text-acef-green">
                            <span>🌳</span>
                        </div>
                        <h3 class="text-gray-400 font-bold uppercase tracking-widest text-xs">Trees Planted</h3>
                        <span class="text-6xl font-black text-acef-dark">1.2M</span>
                    </div>
                    <div class="bg-gray-50 border border-gray-100 p-12 rounded-[40px] flex flex-col items-center space-y-4 shadow-sm hover:shadow-xl transition-all">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-sm text-acef-green">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <h3 class="text-gray-400 font-bold uppercase tracking-widest text-xs">Active Projects</h3>
                        <span class="text-6xl font-black text-acef-dark">45</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Interactive Map Section -->
        <section class="py-24 bg-white border-t border-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-start gap-12">
                <div class="space-y-4">
                    <h2 class="text-5xl font-black text-acef-dark tracking-tighter">Our Footprint Across Africa</h2>
                    <p class="text-gray-500 font-light italic">Click on the interactive markers to see specific regional impact data and active field offices.</p>
                </div>
                
                <div class="w-full relative bg-gray-100 rounded-[50px] aspect-[16/10] md:aspect-[21/9] overflow-hidden shadow-inner flex items-center justify-center">
                    <img src="/map_africa_impact_1766827796711.png" alt="Africa Map" class="w-full h-full object-contain opacity-50 grayscale scale-110">
                    
                    <!-- Pulsing Markers -->
                    <div class="absolute top-[40%] left-[35%] group cursor-pointer translate-x-1/2">
                        <div class="relative">
                            <div class="w-6 h-6 bg-acef-green rounded-full animate-ping opacity-40"></div>
                            <div class="w-6 h-6 bg-acef-green rounded-full relative -mt-6 shadow-xl border-4 border-white"></div>
                        </div>
                    </div>
                    <div class="absolute top-[60%] left-[55%] group cursor-pointer translate-x-1/2">
                        <div class="relative">
                            <div class="w-4 h-4 bg-acef-green rounded-full animate-ping opacity-40"></div>
                            <div class="w-4 h-4 bg-acef-green rounded-full relative -mt-4 shadow-xl border-4 border-white"></div>
                        </div>
                    </div>
                    <div class="absolute top-[30%] left-[45%] group cursor-pointer translate-x-1/2">
                        <div class="relative animate-bounce">
                            <div class="w-5 h-5 bg-blue-500 rounded-full shadow-xl border-4 border-white"></div>
                        </div>
                    </div>

                    <div class="absolute bottom-10 right-10 flex items-center space-x-6 bg-white/50 backdrop-blur-md px-6 py-3 rounded-2xl border border-white">
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-acef-green rounded-full"></div>
                            <span class="text-xs font-bold text-acef-dark uppercase">Active</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                            <span class="text-xs font-bold text-acef-dark uppercase">Planned</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Final Projects Slider/Highlights -->
        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
                <div class="flex flex-wrap items-end justify-between gap-8">
                    <h2 class="text-5xl font-black text-acef-dark tracking-tighter">Active Projects</h2>
                    <div class="flex items-center space-x-4">
                        <select class="bg-gray-50 border-none rounded-xl py-3 px-6 text-sm font-bold text-gray-400">
                            <option>All Categories</option>
                        </select>
                        <select class="bg-gray-50 border-none rounded-xl py-3 px-6 text-sm font-bold text-gray-400">
                            <option>All Countries</option>
                        </select>
                        <div class="relative">
                            <input type="text" placeholder="Search projects..." class="pl-12 pr-6 py-3 bg-gray-50 border-none rounded-xl text-sm w-64">
                            <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <!-- Project 1 -->
                    <div class="group bg-white rounded-[40px] overflow-hidden shadow-sm hover:shadow-2xl transition-all border border-gray-50">
                        <div class="relative aspect-[4/3] overflow-hidden">
                            <img src="/project_tree_planting_1766827726209.png" alt="Sahara Green" class="w-full h-full object-cover">
                            <div class="absolute top-6 left-6">
                                <span class="bg-white/90 backdrop-blur-md px-4 py-1.5 rounded-xl text-[10px] font-bold uppercase tracking-wider text-acef-dark">Reforestation</span>
                            </div>
                        </div>
                        <div class="p-8 space-y-4">
                            <div class="flex items-center text-acef-green text-[10px] font-bold uppercase tracking-widest">
                                <span>April 20 - June 10 2024</span>
                                <span class="mx-2">•</span>
                                <span>Ongoing</span>
                            </div>
                            <h3 class="text-2xl font-black text-acef-dark leading-tight">Sahara Green Wall Initiative</h3>
                            <p class="text-gray-400 text-sm line-clamp-3">Combatting desertification by planting a belt of trees across the Sahel region to restore degraded land.</p>
                            <button class="w-full py-4 border-2 border-gray-100 rounded-2xl font-black text-xs hover:border-acef-dark transition-all">View Project Details</button>
                        </div>
                    </div>
                    <!-- Project 2 -->
                    <div class="group bg-white rounded-[40px] overflow-hidden shadow-sm hover:shadow-2xl transition-all border border-gray-50">
                        <div class="relative aspect-[4/3] overflow-hidden">
                            <img src="/project_solar_panels_1766827705821.png" alt="Solar" class="w-full h-full object-cover">
                            <div class="absolute top-6 left-6">
                                <span class="bg-white/90 backdrop-blur-md px-4 py-1.5 rounded-xl text-[10px] font-bold uppercase tracking-wider text-acef-dark text-blue-500 italic">Energy</span>
                            </div>
                        </div>
                        <div class="p-8 space-y-4">
                            <div class="flex items-center text-acef-green text-[10px] font-bold uppercase tracking-widest">
                                <span>May 12 - Sept 30 2024</span>
                                <span class="mx-2">•</span>
                                <span>Ongoing</span>
                            </div>
                            <h3 class="text-2xl font-black text-acef-dark leading-tight">Rural Solar Microgrids</h3>
                            <p class="text-gray-400 text-sm line-clamp-3">Providing clean, reliable electricity to off-grid communities through community-owned solar solutions.</p>
                            <button class="w-full py-4 border-2 border-gray-100 rounded-2xl font-black text-xs hover:border-acef-dark transition-all">View Project Details</button>
                        </div>
                    </div>
                    <!-- Project 3 -->
                    <div class="group bg-white rounded-[40px] overflow-hidden shadow-sm hover:shadow-2xl transition-all border border-gray-50">
                        <div class="relative aspect-[4/3] overflow-hidden">
                            <img src="/mission_vision_africa_1766827653058.png" alt="Water" class="w-full h-full object-cover">
                            <div class="absolute top-6 left-6">
                                <span class="bg-white/90 backdrop-blur-md px-4 py-1.5 rounded-xl text-[10px] font-bold uppercase tracking-wider text-acef-dark text-acef-green">Water</span>
                            </div>
                        </div>
                        <div class="p-8 space-y-4">
                            <div class="flex items-center text-acef-green text-[10px] font-bold uppercase tracking-widest">
                                <span>March 01 - June 12 2025</span>
                                <span class="mx-2">•</span>
                                <span class="text-blue-500">Funded</span>
                            </div>
                            <h3 class="text-2xl font-black text-acef-dark leading-tight">Clean Water Access</h3>
                            <p class="text-gray-400 text-sm line-clamp-3">Installing rainwater harvesting systems to ensure safe drinking water for highland schools.</p>
                            <button class="w-full py-4 border-2 border-gray-100 rounded-2xl font-black text-xs hover:border-acef-dark transition-all">View Project Details</button>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center pt-8">
                    <button class="flex items-center space-x-2 text-acef-dark font-black text-sm hover:text-acef-green transition-colors">
                        <span>Load more projects</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-8l-7 7-7-7"></path></svg>
                    </button>
                </div>
            </div>
        </section>

        <!-- Join Us CTA -->
        <section class="py-24 bg-acef-dark text-white relative overflow-hidden">
            <!-- Background highlights -->
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-acef-green opacity-10 rounded-full blur-[150px]"></div>
            <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-acef-green opacity-5 rounded-full blur-[150px]"></div>

            <div class="max-w-4xl mx-auto px-4 text-center space-y-12 relative z-10">
                <h2 class="text-5xl md:text-7xl font-black tracking-tighter leading-tight">
                    Join Us In Making <br> A Difference
                </h2>
                <p class="text-white/60 text-lg md:text-xl font-light italic leading-relaxed">
                    Your partnership can accelerate these projects. Whether you are an individual donor or a corporate partner, your impact starts here.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-6 pt-4">
                    <button class="w-full sm:w-auto bg-acef-green text-acef-dark font-black px-12 py-5 rounded-2xl hover:bg-white transition-all transform hover:scale-105 shadow-2xl">
                        Partner with ACEF
                    </button>
                    <button class="w-full sm:w-auto bg-white/5 border-2 border-white/10 text-white font-black px-12 py-5 rounded-2xl hover:bg-white/10 transition-all">
                        Make a Donation
                    </button>
                </div>
            </div>
        </section>

        @include('components.footer')
    </body>
</html>
