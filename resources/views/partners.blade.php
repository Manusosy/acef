<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Our Partners - ACEF</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-white overflow-x-hidden">
        @include('components.header')

        <!-- Partners Hero -->
        <section class="pt-40 pb-24 bg-white text-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
                <h1 class="text-6xl md:text-8xl font-black text-acef-dark tracking-tighter leading-none">Global Alliances</h1>
                <p class="text-gray-400 text-lg md:text-xl font-light italic leading-relaxed max-w-3xl mx-auto">
                    We collaborate with governments, international organizations, and grassroots agencies to scale climate resilience solutions across Africa.
                </p>
            </div>
        </section>

        <main class="pb-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-32">
                
                <!-- Strategic Partners -->
                <section class="space-y-16">
                    <div class="text-center space-y-4">
                        <p class="text-acef-green font-bold text-[10px] uppercase tracking-widest">Strategic Alliances</p>
                        <h2 class="text-4xl font-black text-acef-dark tracking-tight leading-tight">Institutional Backing</h2>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 px-12">
                        @php
                            $p_logos = ['UNEP', 'UN Habitat', 'AU', 'EU Africa', 'WWF', 'Greenpeace', 'AfDB', 'IFC'];
                        @endphp
                        @foreach($p_logos as $logo)
                        <div class="bg-gray-50 aspect-video rounded-3xl flex items-center justify-center border border-gray-100 grayscale hover:grayscale-0 transition-all group">
                            <span class="text-gray-300 font-black text-xl group-hover:text-acef-dark transition-colors">{{ $logo }}</span>
                        </div>
                        @endforeach
                    </div>
                </section>

                <!-- Implementation Partners -->
                <section class="space-y-16 py-24 bg-gray-50/50 rounded-[60px] border border-gray-100">
                    <div class="text-center space-y-4">
                        <p class="text-acef-green font-bold text-[10px] uppercase tracking-widest">Ground Operations</p>
                        <h2 class="text-4xl font-black text-acef-dark tracking-tight leading-tight">Regional Implementation Partners</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-12 px-12">
                        <div class="bg-white p-10 rounded-[40px] shadow-sm space-y-6">
                            <h4 class="text-xl font-black text-acef-dark tracking-tight">Eco-Sahel Network</h4>
                            <p class="text-sm font-light text-gray-400 italic leading-relaxed italic">Managing large-scale reforestation efforts across the Great Green Wall initiatives in Senegal and Mali.</p>
                        </div>
                        <div class="bg-white p-10 rounded-[40px] shadow-sm space-y-6">
                            <h4 class="text-xl font-black text-acef-dark tracking-tight">Lake Victoria Alliance</h4>
                            <p class="text-sm font-light text-gray-400 italic leading-relaxed italic">Direct community interventions for water hygiene and sanitation in the East African lake region.</p>
                        </div>
                        <div class="bg-white p-10 rounded-[40px] shadow-sm space-y-6">
                            <h4 class="text-xl font-black text-acef-dark tracking-tight">Sun-Power Africa</h4>
                            <p class="text-sm font-light text-gray-400 italic leading-relaxed italic">Strategic technical partner for decentralized rural electrification through smart solar grids.</p>
                        </div>
                    </div>
                </section>

                <!-- Call to Partnership -->
                <section class="flex flex-col md:flex-row items-center justify-between gap-12 p-12 md:p-20 bg-acef-green rounded-[50px]">
                    <div class="space-y-6 max-w-xl">
                        <h2 class="text-4xl md:text-5xl font-black text-acef-dark tracking-tighter leading-tight">Ready to collaborate?</h2>
                        <p class="text-acef-dark font-light italic leading-relaxed">
                            Discover how your organization can partner with ACEF to drive meaningful environmental change.
                        </p>
                    </div>
                    <a href="{{ route('contact') }}" class="bg-acef-dark text-white font-black px-12 py-5 rounded-2xl hover:bg-white hover:text-acef-dark transition-all shadow-xl shadow-black/10">
                        Discuss Partnership
                    </a>
                </section>
            </div>
        </main>

        @include('components.footer')
    </body>
</html>
