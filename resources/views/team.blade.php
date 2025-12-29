<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Our Team - ACEF</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-white overflow-x-hidden">
        @include('components.header')

        <!-- Team Hero -->
        <section class="pt-40 pb-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8">
                <h1 class="text-6xl md:text-8xl font-black text-acef-dark tracking-tighter leading-none">The Faces of Impact</h1>
                <p class="text-gray-400 text-lg md:text-xl font-light italic leading-relaxed max-w-3xl mx-auto">
                    A multi-disciplinary team of climate advocates, policy experts, and community organizers dedicated to Africa's environmental future.
                </p>
            </div>
        </section>

        <main class="pb-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-24">
                
                <!-- Leadership Section -->
                <section class="space-y-12">
                    <div class="flex items-center space-x-4">
                        <span class="w-12 h-1 bg-acef-green rounded-full"></span>
                        <h2 class="text-3xl font-black text-acef-dark tracking-tight">Executive Leadership</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                        @php
                            $leadership = [
                                ['name' => 'Emmanuel Soita', 'role' => 'Founder & Executive Director', 'image' => '/uploaded_image_1766827444492.png'],
                                ['name' => 'Dr. Amina Bello', 'role' => 'Director of Research', 'image' => '/mission_vision_africa_1766827653058.png'],
                                ['name' => 'Jean-Luc Ngabo', 'role' => 'Regional Coordinator (West Africa)', 'image' => '/project_solar_panels_1766827705821.png']
                            ];
                        @endphp
                        @foreach($leadership as $leader)
                        <div class="group space-y-6">
                            <div class="aspect-[4/5] rounded-[40px] overflow-hidden bg-gray-100 grayscale hover:grayscale-0 transition-all duration-700">
                                <img src="{{ $leader['image'] }}" alt="{{ $leader['name'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            </div>
                            <div class="space-y-1">
                                <h3 class="text-2xl font-black text-acef-dark tracking-tight">{{ $leader['name'] }}</h3>
                                <p class="text-acef-green font-bold text-xs uppercase tracking-widest">{{ $leader['role'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>

                <!-- Operations & Strategy -->
                <section class="space-y-12">
                    <div class="flex items-center space-x-4">
                        <span class="w-12 h-1 bg-acef-green rounded-full"></span>
                        <h2 class="text-3xl font-black text-acef-dark tracking-tight">Project Leads</h2>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                        @php
                            $leads = [
                                ['name' => 'Sarah Jenkins', 'role' => 'Community Engagement', 'image' => '/hero_marine_ecosystem_1766827540454.png'],
                                ['name' => 'Mark Otieno', 'role' => 'Technical Operations', 'image' => '/project_tree_planting_1766827726209.png'],
                                ['name' => 'Fatima Yusuf', 'role' => 'Policy Advocacy', 'image' => '/project_mangroves_1766827746442.png'],
                                ['name' => 'Abel Tesfaye', 'role' => 'Digital Innovation', 'image' => '/map_africa_impact_1766827796711.png']
                            ];
                        @endphp
                        @foreach($leads as $lead)
                        <div class="group space-y-4">
                            <div class="aspect-square rounded-[30px] overflow-hidden bg-gray-50 border border-gray-100">
                                <img src="{{ $lead['image'] }}" alt="{{ $lead['name'] }}" class="w-full h-full object-cover grayscale opacity-80 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-500">
                            </div>
                            <div class="space-y-0.5">
                                <h4 class="font-black text-acef-dark text-sm">{{ $lead['name'] }}</h4>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest leading-loose">{{ $lead['role'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>

                <!-- Join the Team CTA -->
                <section class="bg-acef-dark rounded-[50px] p-12 md:p-20 flex flex-col items-center text-center space-y-8 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute -top-24 -left-24 w-96 h-96 bg-acef-green rounded-full blur-3xl"></div>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-black text-white tracking-tighter leading-tight relative z-10">Become a Part of the Journey</h2>
                    <p class="text-white/40 text-sm font-light italic leading-relaxed max-w-xl relative z-10">
                        We are always looking for passionate volunteers and experts to join our mission. If you have skills in environmental science, policy, or digital media, we want to hear from you.
                    </p>
                    <a href="{{ route('get-involved') }}" class="bg-acef-green text-acef-dark font-black px-12 py-5 rounded-2xl hover:bg-white transition-all shadow-xl shadow-acef-green/20 relative z-10">
                        View Openings
                    </a>
                </section>
            </div>
        </main>

        @include('components.footer')
    </body>
</html>
