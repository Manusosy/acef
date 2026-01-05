@props([
    'page' => null,
    'slides' => [],
    'title' => null,
    'subtitle' => null,
    'breadcrumb' => null,
    'height' => 'h-[60vh]',
    'minHeight' => 'min-h-[500px]',
    'centered' => false,
])

@php
    $hasSlider = $page && $page->hero_slider_enabled && count($slides) > 0;
    $sliderDelay = $page ? ($page->hero_slider_delay ?? 5000) : 5000;
@endphp

<section class="relative {{ $height }} {{ $minHeight }} flex items-center overflow-hidden" 
         @if($hasSlider)
            x-data="{ 
                active: 0, 
                count: {{ count($slides) }},
                next() { this.active = (this.active + 1) % this.count },
                init() { setInterval(() => this.next(), {{ $sliderDelay }}) }
            }"
         @endif>
    
    @if($hasSlider)
        @foreach($slides as $index => $slide)
            <div x-show="active === {{ $index }}" 
                 x-transition:enter="transition ease-in-out duration-[3000ms]"
                 x-transition:enter-start="opacity-0 transform scale-105"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in-out duration-[3000ms]"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-105"
                 class="absolute inset-0 z-0">
                <img src="{{ $slide->media ? $slide->media->url : $slide->image_url }}" 
                     alt="{{ $slide->title ?? $page?->title }}" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent"></div>
            </div>
        @endforeach
    @else
        <!-- Single Static Hero (Homepage Baseline) -->
        <div class="absolute inset-0 z-0">
            @if(isset($image))
                {{ $image }}
            @else
                <img src="{{ $attributes->get('image-url', '/hero_marine_ecosystem_1766827540454.png') }}" 
                     alt="{{ $title ?? 'ACEF' }}" 
                     class="w-full h-full object-cover">
            @endif
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent"></div>
        </div>
    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full {{ $hasSlider ? '' : 'pt-20' }} {{ $centered ? 'flex flex-col items-center text-center' : '' }}">
        <div class="max-w-4xl space-y-6 {{ $centered ? 'mx-auto' : '' }}">
            @if($breadcrumb)
                <span class="inline-block py-2 px-6 rounded-full bg-acef-green text-white font-bold text-sm tracking-wider uppercase opacity-100 shadow-lg">
                    {{ $breadcrumb }}
                </span>
            @endif

            <h1 class="text-4xl md:text-7xl font-black text-white leading-tight tracking-tighter animate-fade-in-up">
                {!! $title ?? ($page ? $page->title : '') !!}
            </h1>

            @if($subtitle)
                <p class="text-lg md:text-xl font-medium text-white leading-relaxed max-w-2xl animate-fade-in-up delay-100 italic drop-shadow-md">
                    {!! $subtitle !!}
                </p>
            @endif

            @if(isset($actions))
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6 pt-4 animate-fade-in-up delay-200">
                    {{ $actions }}
                </div>
            @endif
        </div>
    </div>

    @if($hasSlider)
        <!-- Slider Indicators -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-20 flex gap-3">
            <template x-for="i in count" :key="i">
                <button @click="active = i-1" 
                        :class="active === i-1 ? 'bg-acef-green w-8' : 'bg-white/30 w-2 hover:bg-white/50'"
                        class="h-2 rounded-full transition-all duration-500"></button>
            </template>
        </div>
    @else
        <!-- Scroll Indicator (Homepage Style) -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 text-white animate-bounce hidden md:block">
            <svg class="w-6 h-6 text-acef-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
    @endif
</section>
