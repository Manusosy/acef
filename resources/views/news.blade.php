<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Insights & News - ACEF</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans bg-white overflow-x-hidden">
    @include('components.header')

    <!-- Featured News Hero -->
    <section class="pt-32 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="bg-white border border-gray-100 rounded-[50px] overflow-hidden shadow-2xl flex flex-col lg:flex-row">
                <div class="lg:w-1/2 relative min-h-[400px]">
                    <img src="/project_mangroves_1766827746442.png" alt="Marine Life"
                        class="absolute inset-0 w-full h-full object-cover">
                </div>
                <div class="lg:w-1/2 p-12 md:p-20 flex flex-col justify-center space-y-8">
                    <span
                        class="bg-acef-green/10 text-acef-green px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest w-fit">Featured
                        Insight</span>
                    <h1 class="text-4xl md:text-5xl font-black text-acef-dark leading-tight tracking-tighter">
                        The Impact of Plastic Pollution on Marine Life: A Call to Action
                    </h1>
                    <p class="text-gray-500 font-light leading-relaxed italic">
                        An urgent analysis of how synthetic waste is compromising the health of Africa's coastal
                        ecosystems and the necessary community-led steps to mitigate the crisis.
                    </p>
                    <button
                        class="bg-acef-green text-acef-dark font-black px-10 py-5 rounded-2xl flex items-center space-x-3 hover:bg-acef-dark hover:text-white transition-all w-fit group">
                        <span>Read Full Insight</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <main>
        <!-- Browse Insights -->
        <section class="py-24 bg-gray-50/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
                <div class="flex flex-col md:flex-row justify-between items-end gap-8">
                    <div class="space-y-4">
                        <h2 class="text-5xl font-black text-acef-dark tracking-tighter">Browse Insights</h2>
                        <p class="text-gray-400 font-light italic">Explore articles, stories, and research from the
                            field.</p>
                    </div>
                    <div class="relative w-full md:w-80">
                        <input type="text" placeholder="Search insights..."
                            class="w-full pl-12 pr-6 py-4 bg-white border-none rounded-2xl shadow-sm text-sm">
                        <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-300" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Category Pills -->
                <div class="flex flex-wrap gap-4 overflow-x-auto pb-4 scrollbar-hide">
                    <button
                        class="px-8 py-3 bg-acef-green text-acef-dark font-black rounded-xl text-sm whitespace-nowrap">All</button>
                    <button
                        class="px-8 py-3 bg-white text-gray-400 font-bold rounded-xl text-sm border border-gray-100 hover:border-acef-dark transition-all whitespace-nowrap">Climate
                        Action</button>
                    <button
                        class="px-8 py-3 bg-white text-gray-400 font-bold rounded-xl text-sm border border-gray-100 hover:border-acef-dark transition-all whitespace-nowrap">Youth
                        Leadership</button>
                    <button
                        class="px-8 py-3 bg-white text-gray-400 font-bold rounded-xl text-sm border border-gray-100 hover:border-acef-dark transition-all whitespace-nowrap">Conservation</button>
                </div>

                <!-- Article Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @php
                        $articles = [
                            [
                                'title' => 'Climate Change and its Effects on Agriculture in Africa',
                                'author' => 'ACEF Research',
                                'date' => 'Dec 27, 2024',
                                'category' => 'Agriculture',
                                'desc' => 'Examining the volatile impact of shifting weather patterns on food security and the resilience of smallholder farmers.',
                                'image' => '/uploaded_image_1766828557603.png',
                                'link_text' => 'Read Analysis'
                            ],
                            [
                                'title' => 'The Importance of Renewable Energy for Sustainable Development',
                                'author' => 'Energy Lead',
                                'date' => 'Dec 20, 2024',
                                'category' => 'Renewables',
                                'desc' => 'Why solar and wind energy are not just environmental choices, but economic necessities for the future of the continent.',
                                'image' => '/project_solar_panels_1766827705821.png',
                                'link_text' => 'Read Feature'
                            ],
                            [
                                'title' => 'The Role of Youth in Environmental Conservation',
                                'author' => 'Youth Network',
                                'date' => 'Dec 15, 2024',
                                'category' => 'Youth Leadership',
                                'desc' => 'How the current generation is taking the lead in climate advocacy and grassroots restoration across the continent.',
                                'image' => '/project_tree_planting_1766827726209.png',
                                'link_text' => 'Read Story'
                            ]
                        ];
                    @endphp

                    @foreach($articles as $art)
                        <div
                            class="group bg-white rounded-[40px] overflow-hidden shadow-sm hover:shadow-2xl transition-all border border-gray-50 flex flex-col">
                            <div class="relative aspect-[16/10] overflow-hidden">
                                <img src="{{ $art['image'] }}" alt="{{ $art['title'] }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute top-6 left-6">
                                    <span
                                        class="bg-white/90 backdrop-blur-md px-4 py-1.5 rounded-xl text-[10px] font-bold uppercase tracking-wider text-acef-dark">{{ $art['category'] }}</span>
                                </div>
                            </div>
                            <div class="p-10 space-y-6 flex-1 flex flex-col">
                                <div class="space-y-4 flex-1">
                                    <div
                                        class="flex items-center text-gray-300 text-[10px] font-bold uppercase tracking-widest">
                                        <span>{{ $art['author'] }}</span>
                                        <span class="mx-2">•</span>
                                        <span>{{ $art['date'] }}</span>
                                    </div>
                                    <h3
                                        class="text-2xl font-black text-acef-dark leading-tight group-hover:text-acef-green transition-colors">
                                        {{ $art['title'] }}
                                    </h3>
                                    <p class="text-gray-400 text-sm leading-relaxed font-light line-clamp-3 italic">
                                        {{ $art['desc'] }}
                                    </p>
                                </div>
                                <div class="pt-6 border-t border-gray-50 flex justify-start">
                                    <a href="{{ route('news') }}"
                                        class="text-acef-green font-black text-xs flex items-center group-hover:translate-x-1 transition-transform">
                                        {{ $art['link_text'] }}
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-center">
                    <button
                        class="text-acef-dark font-black text-sm flex items-center space-x-2 border-b-2 border-acef-green pb-1 hover:text-acef-green transition-colors">
                        <span>Load More Articles</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        </section>

        <!-- Research Reports Section -->
        <section class="py-24 bg-acef-dark">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
                <div class="flex justify-between items-end">
                    <div class="space-y-4">
                        <p class="text-acef-green font-bold text-[10px] uppercase tracking-widest">Data & Analysis</p>
                        <h2 class="text-5xl font-black text-white tracking-tighter">Latest Research Reports</h2>
                    </div>
                    <a href="{{ route('resources') }}"
                        class="text-white font-bold text-sm flex items-center hover:text-acef-green transition-colors">
                        View All Research <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>

                <div
                    class="bg-gray-800/30 rounded-[50px] border border-white/5 p-8 md:p-12 flex flex-col lg:flex-row gap-12 items-center">
                    <div class="lg:w-1/3 w-full">
                        <div class="relative aspect-square rounded-[30px] overflow-hidden group">
                            <img src="/map_africa_impact_1766827796711.png" alt="Report"
                                class="w-full h-full object-cover">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-orange-500/80 to-transparent flex flex-col justify-end p-8">
                                <span
                                    class="bg-white/20 backdrop-blur-md text-white text-[10px] font-bold px-3 py-1 rounded-lg w-fit mb-4 uppercase">PDF
                                    Report</span>
                                <h4 class="text-2xl font-black text-white leading-tight">Climate Resilience 2024</h4>
                            </div>
                        </div>
                    </div>
                    <div class="lg:w-2/3 space-y-8">
                        <h3 class="text-3xl md:text-4xl font-black text-white leading-tight">ACEF Annual Climate
                            Resilience Report 2024</h3>
                        <p class="text-white/60 font-light leading-relaxed">
                            Our comprehensive analysis of climate adaptation strategies across 14 African nations. This
                            report highlights key success factors, funding gaps, and the critical role of indigenous
                            knowledge in building long-term resilience.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="flex items-start space-x-4">
                                <div
                                    class="w-10 h-10 bg-acef-green/20 rounded-xl flex items-center justify-center text-acef-green mt-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="space-y-1">
                                    <h5 class="text-white font-bold">Impact Data</h5>
                                    <p class="text-white/40 text-sm italic">Quantitative results from 150+ projects.</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div
                                    class="w-10 h-10 bg-acef-green/20 rounded-xl flex items-center justify-center text-acef-green mt-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="space-y-1">
                                    <h5 class="text-white font-bold">Policy Recommendations</h5>
                                    <p class="text-white/40 text-sm italic">Actionable steps for governments.</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row items-center gap-4 pt-4">
                            <button
                                class="w-full sm:w-auto bg-acef-green text-acef-dark font-black px-10 py-5 rounded-2xl flex items-center justify-center space-x-3 hover:bg-white transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                <span>Download Full Report</span>
                            </button>
                            <button
                                class="w-full sm:w-auto text-white font-bold px-10 py-5 rounded-2xl hover:bg-white/5 transition-all">
                                Read Executive Summary
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Subscription CTA -->
        <section class="py-24 bg-gray-50 overflow-hidden relative">
            <div class="max-w-4xl mx-auto px-4 relative z-10">
                <div
                    class="bg-acef-green/5 border border-acef-green/10 rounded-[50px] p-12 md:p-20 text-center space-y-8 flex flex-col items-center">
                    <div
                        class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-acef-green">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-black text-acef-dark tracking-tighter">Stay Informed</h2>
                    <p class="text-gray-400 font-light max-w-lg leading-relaxed italic">
                        Join 12,000+ subscribers. Get the latest insights, stories, and research delivered directly to
                        your inbox.
                    </p>
                    <form class="w-full max-w-lg flex flex-col sm:flex-row gap-4 pt-4">
                        <input type="email" placeholder="Enter your email address"
                            class="flex-1 px-8 py-5 bg-white border-2 border-gray-100 rounded-2xl focus:border-acef-green transition-all outline-none">
                        <button
                            class="bg-acef-green text-acef-dark font-black px-12 py-5 rounded-2xl hover:bg-acef-dark hover:text-white transition-all shadow-xl shadow-acef-green/20">
                            Subscribe
                        </button>
                    </form>
                    <p class="text-[10px] text-gray-300 font-bold uppercase tracking-widest leading-loose">We respect
                        your privacy. Unsubscribe at any time.</p>
                </div>
            </div>
        </section>
    </main>

    @include('components.footer')
</body>

</html>