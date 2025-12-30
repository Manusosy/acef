<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" content="notranslate">
    <title>{{ __('pages.resources.hero_title') }} - ACEF</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans bg-gray-50 overflow-x-hidden">
    @include('components.header')

    <!-- Knowledge Hub Hero -->
    <section class="pt-40 pb-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8">
            <h1 class="text-6xl md:text-8xl font-black text-acef-dark tracking-tighter">
                {{ __('pages.resources.hero_title') }}</h1>
            <p class="text-gray-400 max-w-3xl mx-auto text-lg md:text-xl font-light leading-relaxed italic">
                {{ __('pages.resources.hero_desc') }}
            </p>
        </div>
    </section>

    <main class="pb-24">
        <!-- Filter Hub -->
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 sticky top-20 z-40 bg-gray-50/80 backdrop-blur-xl py-6 border-b border-gray-100">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-6">
                <div class="relative w-full lg:w-96">
                    <input type="text" placeholder="{{ __('pages.resources.search_placeholder') }}"
                        class="w-full pl-12 pr-6 py-4 bg-white border-none rounded-2xl shadow-sm text-sm focus:ring-2 focus:ring-acef-green">
                    <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-300" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>

                <div class="flex flex-wrap items-center justify-center gap-3">
                    <button
                        class="px-6 py-3 bg-acef-green text-acef-dark font-black rounded-xl text-sm transition-all shadow-lg shadow-acef-green/20">{{ __('pages.resources.filters.all') }}</button>
                    <button
                        class="px-6 py-3 bg-white text-gray-500 font-bold rounded-xl text-sm border border-gray-100 hover:bg-gray-50 transition-all">{{ __('pages.resources.filters.climate_action') }}</button>
                    <button
                        class="px-6 py-3 bg-white text-gray-500 font-bold rounded-xl text-sm border border-gray-100 hover:bg-gray-50 transition-all">{{ __('pages.resources.filters.waste_management') }}</button>
                    <button
                        class="px-6 py-3 bg-white text-gray-500 font-bold rounded-xl text-sm border border-gray-100 hover:bg-gray-50 transition-all">{{ __('pages.resources.filters.wash') }}</button>
                    <button
                        class="px-6 py-3 bg-white text-gray-500 font-bold rounded-xl text-sm border border-gray-100 hover:bg-gray-50 transition-all">{{ __('pages.resources.filters.policy') }}</button>
                    <button
                        class="px-6 py-3 bg-white text-gray-500 font-bold rounded-xl text-sm border border-gray-100 hover:bg-gray-50 transition-all">{{ __('pages.resources.filters.education') }}</button>
                </div>
            </div>
        </div>

        <!-- Resources Grid -->
        <section class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @php
                        $translated_items = __('pages.resources.items');
                        // Metadata that isn't translated but needs to be associated
                        $meta = [
                            ['size' => '1.2 MB', 'date' => '2025', 'locked' => false, 'color' => 'acef-green'],
                            ['size' => '2.5 MB', 'date' => '2025', 'locked' => false, 'color' => 'acef-green'],
                            ['size' => '2.4 MB', 'date' => '2024', 'locked' => false, 'color' => 'acef-green'],
                            ['size' => '1.8 MB', 'date' => '2024', 'locked' => false, 'color' => 'acef-green'],
                            ['size' => '3.2 MB', 'date' => '2024', 'locked' => true, 'color' => 'gray-400'],
                            ['size' => '5.1 MB', 'date' => '2023', 'locked' => false, 'color' => 'acef-green'],
                            ['size' => '1.2 MB', 'date' => '2024', 'locked' => true, 'color' => 'gray-400'],
                            ['size' => '4.3 MB', 'date' => '2023', 'locked' => false, 'color' => 'acef-green'],
                        ];
                    @endphp

                    @foreach($translated_items as $index => $res)
                        @php
                            $m = $meta[$index] ?? ['size' => '', 'date' => '', 'locked' => false, 'color' => 'gray-400'];
                        @endphp
                        <div
                            class="bg-white p-10 rounded-[40px] border border-gray-100 shadow-sm hover:shadow-2xl transition-all flex flex-col justify-between h-[420px] group relative overflow-hidden">
                            @if($m['locked'])
                                <div class="absolute top-8 right-8 text-gray-300">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            @endif

                            <div class="space-y-6">
                                <span
                                    class="bg-{{ $m['color'] == 'acef-green' ? 'acef-green/10' : 'gray-100' }} text-{{ $m['color'] == 'acef-green' ? 'acef-green' : 'gray-400' }} px-4 py-1.5 rounded-xl text-[10px] font-bold uppercase tracking-widest inline-block">
                                    {{ $res['type'] }}
                                </span>
                                <div class="space-y-4">
                                    <h3
                                        class="text-2xl font-black text-acef-dark leading-tight group-hover:text-acef-green transition-colors">
                                        {{ $res['title'] }}
                                    </h3>
                                    <p class="text-gray-400 text-sm leading-relaxed font-light italic">
                                        {{ $res['desc'] }}
                                    </p>
                                </div>
                            </div>

                            <div class="space-y-6">
                                <div class="flex justify-between items-center text-xs font-bold text-gray-300">
                                    <span>{{ $m['size'] }}</span>
                                    <span>{{ $m['date'] }}</span>
                                </div>

                                @if($m['locked'])
                                    <button
                                        class="w-full py-5 bg-gray-50 text-acef-dark font-black rounded-2xl flex items-center justify-center space-x-2 border-2 border-gray-100/50 cursor-not-allowed">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span>{{ __('pages.resources.members_only_btn') }}</span>
                                    </button>
                                @else
                                    <button
                                        class="w-full py-5 bg-acef-green text-acef-dark font-black rounded-2xl flex items-center justify-center space-x-3 hover:bg-white border-2 border-transparent hover:border-acef-green transition-all shadow-xl shadow-acef-green/20 group/btn">
                                        <svg class="w-5 h-5 group-hover/btn:translate-y-1 transition-transform" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                        </svg>
                                        <span>{{ __('pages.resources.download_btn') }}</span>
                                    </button>
                                @endif
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