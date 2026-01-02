<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" content="notranslate">
    <title>{{ __('pages.accreditations.hero_title') }} - ACEF</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans bg-white dark:bg-gray-900 overflow-x-hidden transition-colors">
    @include('components.header')

    <!-- Accreditations Hero -->
    <section class="pt-40 pb-24 bg-white dark:bg-gray-900 text-center transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <h1 class="text-6xl md:text-8xl font-black text-acef-dark dark:text-white tracking-tighter leading-none">
                {{ __('pages.accreditations.hero_title') }}</h1>
            <p class="text-gray-400 text-lg md:text-xl font-light italic leading-relaxed max-w-3xl mx-auto">
                {{ __('pages.accreditations.hero_desc') }}
            </p>
        </div>
    </section>

    <main class="pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-24">

            <!-- Main Accreditations -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($accreditations as $acc)
                    <div
                        class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-8 space-y-6 border border-gray-100 dark:border-gray-700 hover:border-acef-green dark:hover:border-acef-green transition-all group flex flex-col justify-between shadow-sm hover:shadow-xl">
                        <div class="w-16 h-16 bg-white dark:bg-gray-700 rounded-xl shadow-sm flex items-center justify-center text-acef-green text-xs font-black group-hover:bg-acef-green group-hover:text-white transition-colors overflow-hidden p-2">
                            @if($acc->image)
                                <img src="{{ Storage::url($acc->image) }}" alt="{{ $acc->acronym }}" class="w-full h-full object-contain">
                            @else
                                {{ $acc->acronym }}
                            @endif
                        </div>
                        <div class="space-y-2">
                            <h3 class="text-lg font-black text-acef-dark dark:text-white tracking-tight">{{ $acc->title }}</h3>
                            <p class="text-[12px] text-gray-600 dark:text-gray-400 font-light leading-relaxed">
                                {{ $acc->description }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Legal Standings -->
            <section class="bg-acef-green/5 border border-acef-green/10 rounded-2xl p-12 md:p-20 space-y-12">
                <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="space-y-4 max-w-xl">
                        <p class="text-acef-green font-bold text-[10px] uppercase tracking-widest">
                            {{ __('pages.accreditations.legal.framework') }}</p>
                        <h2 class="text-4xl font-black text-acef-dark dark:text-white tracking-tight">
                            {{ __('pages.accreditations.legal.title') }}</h2>
                        <p class="text-gray-600 dark:text-gray-400 font-light italic leading-relaxed">
                            {{ __('pages.accreditations.legal.desc') }}</p>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        <div
                            class="bg-white dark:bg-gray-800 px-8 py-5 rounded-xl shadow-sm border border-black/5 dark:border-white/10 font-black text-acef-dark dark:text-white text-xs uppercase tracking-widest leading-loose">
                            {{ __('pages.accreditations.legal.kenya') }}</div>
                        <div
                            class="bg-white dark:bg-gray-800 px-8 py-5 rounded-xl shadow-sm border border-black/5 dark:border-white/10 font-black text-acef-dark dark:text-white text-xs uppercase tracking-widest leading-loose">
                            {{ __('pages.accreditations.legal.cameroon') }}</div>
                    </div>
                </div>
            </section>

            <!-- Transparency Seal -->
            <section class="flex flex-col items-center text-center space-y-10 max-w-4xl mx-auto py-12">
                <div
                    class="w-24 h-24 bg-white dark:bg-gray-800 rounded-full shadow-2xl flex items-center justify-center text-acef-green scale-150 mb-10 border border-gray-50 dark:border-gray-700">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                        </path>
                    </svg>
                </div>
                <h2 class="text-4xl font-black text-acef-dark dark:text-white tracking-tighter">
                    {{ __('pages.accreditations.transparency.title') }}</h2>
                <p class="text-gray-400 font-light italic leading-relaxed">
                    {{ __('pages.accreditations.transparency.desc') }}
                </p>
                <div class="flex space-x-8 pt-4">
                    <a href="{{ route('impact') }}"
                        class="text-acef-green font-black text-sm border-b-2 border-acef-green transition-all hover:text-acef-dark hover:border-acef-dark">{{ __('pages.accreditations.transparency.link') }}</a>
                </div>
            </section>
        </div>
    </main>

    @include('components.footer')
</body>

</html>