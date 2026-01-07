<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google" content="notranslate">
        <title>{{ __('pages.partners.hero_title') }} - ACEF</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @php
            $partnersPage = \App\Models\Page::where('slug', 'partners')->first();
            $heroSlides = $partnersPage ? $partnersPage->activeHeroSlides()->with('media')->get() : collect();
        @endphp
    </head>
    <body class="antialiased font-sans bg-white overflow-x-hidden">
        @include('components.header')

        <x-hero 
            :page="$partnersPage"
            :slides="$heroSlides"
            breadcrumb="{{ __('navigation.partners') }}"
            title="{{ __('pages.partners.hero_title') }}"
            subtitle="{{ __('pages.partners.hero_desc') }}"
            image-url="/mission_vision_africa_1766827653058.png"
        />

        <main class="pb-24" x-data="{ 
            selectedPartner: null,
            openModal(partner) {
                this.selectedPartner = partner;
                document.body.style.overflow = 'hidden';
            },
            closeModal() {
                this.selectedPartner = null;
                document.body.style.overflow = 'auto';
            }
        }">
            @php
                $partners = \App\Models\Partner::where('is_active', true)->orderBy('sort_order')->get();
                $strategicPartners = $partners->where('category', 'strategic');
                $institutionalPartners = $partners->where('category', 'institutional');
                $implementationPartners = $partners->where('category', 'implementation');
            @endphp

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-24 pt-16 md:pt-24">
                
                <!-- Strategic & Institutional Partners -->
                @if($strategicPartners->count() > 0 || $institutionalPartners->count() > 0)
                <section x-data="{ shown: false }" x-intersect.once.margin.0px.0px.-100px.0px="shown = true"
                         class="space-y-16">
                    <div class="text-center space-y-4" :class="{ 'animate-fade-in-up': shown }">
                        <p class="text-acef-green font-bold text-xs uppercase tracking-widest">{{ __('pages.partners.strategic_title') }}</p>
                        <h2 class="text-4xl font-bold text-acef-dark tracking-tight leading-tight">{{ __('pages.partners.institutional_backing') }}</h2>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 px-4 md:px-12">
                        @foreach($strategicPartners->concat($institutionalPartners) as $partner)
                        <div @click="openModal({{ json_encode($partner) }})" class="bg-gray-50 aspect-video rounded-[32px] flex items-center justify-center border border-gray-100 grayscale hover:grayscale-0 hover:bg-white hover:shadow-xl hover:shadow-emerald-500/5 transition-all group cursor-pointer overflow-hidden p-6">
                            @if($partner->logo)
                                <img src="{{ Storage::url($partner->logo) }}" alt="{{ $partner->name }}" class="max-w-full max-h-full object-contain group-hover:scale-110 transition-transform">
                            @else
                                <span class="text-gray-300 font-bold text-xl group-hover:text-acef-dark transition-colors">{{ $partner->name }}</span>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif

                <!-- Implementation Partners -->
                @if($implementationPartners->count() > 0)
                <section x-data="{ shown: false }" x-intersect.once.margin.0px.0px.-100px.0px="shown = true"
                         class="space-y-16 py-24 bg-gray-50/50 rounded-[60px] border border-gray-100">
                    <div class="text-center space-y-4" :class="{ 'animate-fade-in-up': shown }">
                        <p class="text-acef-green font-bold text-xs uppercase tracking-widest">{{ __('pages.partners.ground_operations') }}</p>
                        <h2 class="text-4xl font-bold text-acef-dark tracking-tight leading-tight">{{ __('pages.partners.regional_implementation') }}</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-12 px-12">
                        @foreach($implementationPartners as $partner)
                        <div @click="openModal({{ json_encode($partner) }})" class="bg-white p-10 rounded-[40px] shadow-sm hover:shadow-xl transition-all cursor-pointer group space-y-6">
                            <div class="h-16 flex items-center">
                                @if($partner->logo)
                                    <img src="{{ Storage::url($partner->logo) }}" alt="{{ $partner->name }}" class="h-full w-auto object-contain">
                                @else
                                    <h4 class="text-xl font-bold text-acef-dark tracking-tight">{{ $partner['name'] }}</h4>
                                @endif
                            </div>
                            <p class="text-sm font-light text-gray-400 italic leading-relaxed line-clamp-3">{{ $partner['description'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif

                <!-- Call to Partnership -->
                <section x-data="{ shown: false }" x-intersect.once.margin.0px.0px.-100px.0px="shown = true"
                         class="flex flex-col md:flex-row items-center justify-between gap-12 p-12 md:p-20 bg-acef-deep-green rounded-[50px]">
                    <div class="space-y-6 max-w-xl" :class="{ 'animate-fade-in-up': shown }">
                        <h2 class="text-4xl md:text-5xl font-bold text-white tracking-tighter leading-tight">{{ __('pages.partners.cta.title') }}</h2>
                        <p class="text-white/80 font-light italic leading-relaxed">
                            {{ __('pages.partners.cta.desc') }}
                        </p>
                    </div>
                    <a href="{{ route('contact') }}" class="bg-acef-dark text-white font-bold px-12 py-5 rounded-2xl hover:bg-white hover:text-acef-dark transition-all shadow-xl shadow-black/10">
                        {{ __('pages.partners.cta.btn') }}
                    </a>
                </section>
            </div>

            <!-- Partner Detail Modal -->
            <template x-teleport="body">
                <div x-show="selectedPartner" class="fixed inset-0 z-[100] flex items-center justify-center p-4 lg:p-8" x-cloak>
                    <!-- Backdrop -->
                    <div x-show="selectedPartner" x-transition.opacity @click="closeModal()" class="fixed inset-0 bg-acef-dark/95 backdrop-blur-xl"></div>
                    
                    <!-- Modal Content -->
                    <div x-show="selectedPartner" x-transition.scale @click.away="closeModal()" class="bg-white dark:bg-gray-900 w-full max-w-2xl rounded-[40px] shadow-2xl relative overflow-hidden flex flex-col max-h-[90vh]">
                        <!-- Close Button -->
                        <button @click="closeModal()" class="absolute top-6 right-6 w-12 h-12 rounded-2xl bg-gray-50 dark:bg-gray-800 flex items-center justify-center text-gray-400 hover:text-emerald-500 transition-all z-20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>

                        <div class="overflow-y-auto w-full p-8 md:p-12 space-y-8">
                            <!-- Logo & Type -->
                            <div class="flex items-center gap-6">
                                <template x-if="selectedPartner?.logo">
                                    <div class="w-24 h-24 rounded-3xl bg-gray-50 flex items-center justify-center p-4">
                                        <img :src="'/storage/' + selectedPartner.logo" class="max-w-full max-h-full object-contain">
                                    </div>
                                </template>
                                <div>
                                    <p class="text-emerald-500 font-bold text-xs uppercase tracking-[0.2em] mb-1" x-text="selectedPartner?.category"></p>
                                    <h2 class="text-3xl md:text-4xl font-bold text-acef-dark dark:text-white tracking-tighter" x-text="selectedPartner?.name"></h2>
                                </div>
                            </div>

                            <!-- Description -->
                             <div class="space-y-4">
                                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest">About the Partnership</h4>
                                <p class="text-lg text-gray-600 dark:text-gray-400 font-light leading-relaxed italic" x-text="selectedPartner?.description || 'No detailed information available.'"></p>
                            </div>

                            <!-- CTA -->
                            <div class="pt-8 border-t border-gray-100 dark:border-gray-800">
                                <template x-if="selectedPartner?.website">
                                    <a :href="selectedPartner.website" target="_blank" class="inline-flex items-center gap-3 px-8 py-4 bg-acef-dark dark:bg-emerald-600 text-white rounded-2xl font-bold uppercase text-xs tracking-widest hover:scale-105 transition-all shadow-xl shadow-emerald-500/20">
                                        Visit Website
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </a>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </main>

        @include('components.footer')
    </body>
</html>
