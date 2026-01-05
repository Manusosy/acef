<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" content="notranslate">
    <title>{{ __('pages.team.hero_title') }} - ACEF</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @php
        $teamPage = \App\Models\Page::where('slug', 'team')->first();
        $heroSlides = $teamPage ? $teamPage->activeHeroSlides()->with('media')->get() : collect();
    @endphp
</head>

<body class="antialiased font-sans bg-white overflow-x-hidden">
    @include('components.header')

    <x-hero 
        :page="$teamPage"
        :slides="$heroSlides"
        breadcrumb="{{ __('navigation.team') }}"
        title="{{ __('pages.team.hero_title') }}"
        subtitle="{{ __('pages.team.hero_desc') }}"
        image-url="/mission_vision_africa_1766827653058.png"
    />

    <main class="pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-24">

            <!-- Leadership Section -->
            <section class="space-y-12">
                <div class="flex items-center space-x-4">
                    <span class="w-12 h-1 bg-acef-green rounded-full"></span>
                    <h2 class="text-3xl font-bold text-acef-dark tracking-tight">
                        {{ __('pages.team.leadership_title') }}</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    @foreach($leadership as $leader)
                        <div class="group space-y-6">
                            <div
                                class="aspect-[4/5] rounded-2xl overflow-hidden bg-gray-100 grayscale hover:grayscale-0 transition-all duration-700">
                                @if($leader->image)
                                    <img src="{{ Storage::url($leader->image) }}" alt="{{ $leader->name }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                        <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="space-y-1">
                                <h3 class="text-2xl font-bold text-acef-dark tracking-tight">{{ $leader->name }}</h3>
                                <p class="text-acef-green font-semibold text-xs uppercase tracking-widest">{{ $leader->role }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- Project Leads Section -->
            @if($projectLeads->count() > 0)
            <section class="space-y-12">
                <div class="flex items-center space-x-4">
                    <span class="w-12 h-1 bg-acef-green rounded-full"></span>
                    <h2 class="text-3xl font-bold text-acef-dark tracking-tight">
                        {{ __('pages.team.project_leads_title') }}</h2>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    @foreach($projectLeads as $lead)
                        <div class="group space-y-4">
                            <div class="aspect-square rounded-2xl overflow-hidden bg-gray-50 border border-gray-100">
                                @if($lead->image)
                                    <img src="{{ Storage::url($lead->image) }}" alt="{{ $lead->name }}"
                                        class="w-full h-full object-cover grayscale opacity-80 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="space-y-0.5">
                                <h4 class="font-black text-acef-dark text-sm">{{ $lead->name }}</h4>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest leading-loose">
                                    {{ $lead->role }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- Operations & Strategy -->
            <section class="space-y-12">
                <div class="flex items-center space-x-4">
                    <span class="w-12 h-1 bg-acef-green rounded-full"></span>
                    <h2 class="text-3xl font-bold text-acef-dark tracking-tight">{{ __('pages.team.leads_title') }}
                    </h2>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    @foreach($staff as $lead)
                        <div class="group space-y-4">
                            <div class="aspect-square rounded-2xl overflow-hidden bg-gray-50 border border-gray-100">
                                @if($lead->image)
                                    <img src="{{ Storage::url($lead->image) }}" alt="{{ $lead->name }}"
                                        class="w-full h-full object-cover grayscale opacity-80 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="space-y-0.5">
                                <h4 class="font-black text-acef-dark text-sm">{{ $lead->name }}</h4>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest leading-loose">
                                    {{ $lead->role }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- Join the Team CTA -->
            <section
                class="bg-acef-dark rounded-3xl p-12 md:p-20 flex flex-col items-center text-center space-y-8 relative overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute -top-24 -left-24 w-96 h-96 bg-acef-green rounded-full blur-3xl"></div>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-white tracking-tighter leading-tight relative z-10">
                    {{ __('pages.team.cta.title') }}</h2>
                <p class="text-white/40 text-sm font-light italic leading-relaxed max-w-xl relative z-10">
                    {{ __('pages.team.cta.desc') }}
                </p>
                <a href="{{ route('get-involved') }}"
                    class="bg-acef-green text-acef-dark font-bold px-12 py-5 rounded-2xl hover:bg-white transition-all shadow-xl shadow-acef-green/20 relative z-10">
                    {{ __('pages.team.cta.btn') }}
                </a>
            </section>
        </div>
    </main>

    @include('components.footer')
</body>

</html>