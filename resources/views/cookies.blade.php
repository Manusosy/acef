<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" content="notranslate">
    <title>{{ __('legal.cookies.title') }} - ACEF</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans bg-white overflow-x-hidden">
    @include('components.header')

    <!-- Simple Breadcrumb -->
    <div class="pt-32 pb-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex text-xs font-bold uppercase tracking-widest text-gray-300">
            <a href="{{ route('home') }}"
                class="hover:text-acef-green transition-colors">{{ __('navigation.home') }}</a>
            <span class="mx-3 text-gray-200">/</span>
            <span class="text-acef-dark">{{ __('legal.cookies.title') }}</span>
        </nav>
    </div>

    <main class="pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-6 mb-16">
                <h1 class="text-6xl md:text-7xl font-black text-acef-dark tracking-tighter leading-none">
                    {{ __('legal.cookies.title') }}
                </h1>
                <p class="text-gray-600 text-lg font-light italic leading-relaxed max-w-3xl">
                    {{ __('legal.cookies.desc') }}
                </p>
                <div
                    class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-widest text-gray-300 pt-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                    <span>{{ __('legal.cookies.last_updated') }}</span>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-16 items-start">
                <!-- Sidebar Table of Contents -->
                <div class="lg:w-1/4 lg:sticky lg:top-32 space-y-10">
                    <div class="space-y-6">
                        <h3 class="text-[10px] font-black uppercase tracking-widest text-gray-300">
                            {{ __('legal.cookies.toc') }}
                        </h3>
                        <nav class="flex flex-col space-y-4">
                            <a href="#what-are-cookies"
                                class="text-sm font-bold text-acef-green border-l-4 border-acef-green pl-4">{{ __('legal.cookies.sections.what_are_cookies') }}</a>
                            <a href="#how-we-use"
                                class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">{{ __('legal.cookies.sections.how_we_use') }}</a>
                            <a href="#types"
                                class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">{{ __('legal.cookies.sections.types') }}</a>
                            <a href="#managing"
                                class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">{{ __('legal.cookies.sections.managing') }}</a>
                            <a href="#gdpr"
                                class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">{{ __('legal.cookies.sections.gdpr') }}</a>
                            <a href="#changes"
                                class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">{{ __('legal.cookies.sections.changes') }}</a>
                            <a href="#contact"
                                class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">{{ __('legal.cookies.sections.contact') }}</a>
                        </nav>
                    </div>
                </div>

                <!-- Content -->
                <div class="lg:w-3/4 space-y-16">
                    <!-- 01 What Are Cookies -->
                    <section id="what-are-cookies" class="space-y-10 scroll-mt-32">
                        <div class="flex items-center space-x-6">
                            <span
                                class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">01</span>
                            <h2 class="text-3xl font-black text-acef-dark tracking-tight">
                                {{ __('legal.cookies.what_are_cookies.title') }}</h2>
                        </div>
                        <div class="space-y-6">
                            <p class="text-gray-600 font-light italic leading-relaxed">
                                {{ __('legal.cookies.what_are_cookies.desc') }}
                            </p>
                            <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100 space-y-4">
                                <h4 class="font-black text-acef-dark">
                                    {{ __('legal.cookies.what_are_cookies.info_collected_title') }}</h4>
                                <ul class="space-y-2 text-sm text-gray-600 font-light italic">
                                    @foreach(__('legal.cookies.what_are_cookies.info_collected') as $item)
                                        <li class="flex items-start"><span class="mr-2 text-acef-green">•</span> {{ $item }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <p class="text-gray-600 font-light italic leading-relaxed">
                                {!! __('legal.cookies.what_are_cookies.personal_data_note') !!}
                            </p>
                        </div>
                    </section>

                    <!-- 02 How We Use Cookies -->
                    <section id="how-we-use" class="space-y-10 scroll-mt-32">
                        <div class="flex items-center space-x-6">
                            <span
                                class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">02</span>
                            <h2 class="text-3xl font-black text-acef-dark tracking-tight">
                                {{ __('legal.cookies.how_we_use.title') }}</h2>
                        </div>
                        <div class="space-y-8">
                            <p class="text-gray-600 font-light italic leading-relaxed">
                                {{ __('legal.cookies.how_we_use.desc') }}</p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div
                                    class="p-8 bg-gray-50 rounded-3xl border border-gray-100 space-y-4 hover:shadow-lg transition-shadow">
                                    <h4 class="font-black text-acef-dark">
                                        {{ __('legal.cookies.how_we_use.functionality.title') }}</h4>
                                    <ul class="space-y-2 text-sm text-gray-600 font-light italic">
                                        @foreach(__('legal.cookies.how_we_use.functionality.items') as $item)
                                            <li class="flex items-start"><span class="mr-2 text-acef-green">✓</span>
                                                {{ $item }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div
                                    class="p-8 bg-gray-50 rounded-3xl border border-gray-100 space-y-4 hover:shadow-lg transition-shadow">
                                    <h4 class="font-black text-acef-dark">
                                        {{ __('legal.cookies.how_we_use.experience.title') }}</h4>
                                    <ul class="space-y-2 text-sm text-gray-600 font-light italic">
                                        @foreach(__('legal.cookies.how_we_use.experience.items') as $item)
                                            <li class="flex items-start"><span class="mr-2 text-acef-green">✓</span>
                                                {{ $item }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="bg-acef-green/5 border border-acef-green/10 p-6 rounded-2xl">
                                <p class="text-sm text-acef-dark font-bold italic">
                                    {{ __('legal.cookies.how_we_use.invasive_note') }}
                                </p>
                            </div>
                        </div>
                    </section>

                    <!-- 03 Types of Cookies -->
                    <section id="types" class="space-y-10 scroll-mt-32">
                        <div class="flex items-center space-x-6">
                            <span
                                class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">03</span>
                            <h2 class="text-3xl font-black text-acef-dark tracking-tight">
                                {{ __('legal.cookies.types.title') }}</h2>
                        </div>
                        <div class="space-y-6">

                            <!-- 3.1 -->
                            <div class="p-8 bg-white border border-gray-100 rounded-3xl shadow-sm space-y-4">
                                <h3 class="text-xl font-black text-acef-dark">
                                    {{ __('legal.cookies.types.strictly_necessary.title') }}</h3>
                                <p class="text-sm text-gray-600 font-light italic">
                                    {{ __('legal.cookies.types.strictly_necessary.desc') }}</p>
                                <div class="flex flex-wrap gap-4 text-xs font-bold uppercase tracking-widest pt-2">
                                    <span
                                        class="px-3 py-1 bg-gray-100 text-gray-500 rounded-lg">{{ __('legal.cookies.types.strictly_necessary.legal_basis') }}</span>
                                    <span
                                        class="px-3 py-1 bg-acef-green/10 text-acef-green rounded-lg">{{ __('legal.cookies.types.strictly_necessary.consent') }}</span>
                                </div>
                            </div>

                            <!-- 3.2 -->
                            <div class="p-8 bg-white border border-gray-100 rounded-3xl shadow-sm space-y-4">
                                <h3 class="text-xl font-black text-acef-dark">
                                    {{ __('legal.cookies.types.performance.title') }}</h3>
                                <p class="text-sm text-gray-600 font-light italic">
                                    {{ __('legal.cookies.types.performance.desc') }}</p>
                                <div class="flex flex-wrap gap-4 text-xs font-bold uppercase tracking-widest pt-2">
                                    <span
                                        class="px-3 py-1 bg-gray-100 text-gray-500 rounded-lg">{{ __('legal.cookies.types.performance.legal_basis') }}</span>
                                    <span
                                        class="px-3 py-1 bg-orange-100 text-orange-600 rounded-lg">{{ __('legal.cookies.types.performance.consent') }}</span>
                                </div>
                            </div>

                            <!-- 3.3 -->
                            <div class="p-8 bg-white border border-gray-100 rounded-3xl shadow-sm space-y-4">
                                <h3 class="text-xl font-black text-acef-dark">
                                    {{ __('legal.cookies.types.functionality.title') }}</h3>
                                <p class="text-sm text-gray-600 font-light italic">
                                    {{ __('legal.cookies.types.functionality.desc') }}</p>
                                <div class="flex flex-wrap gap-4 text-xs font-bold uppercase tracking-widest pt-2">
                                    <span
                                        class="px-3 py-1 bg-gray-100 text-gray-500 rounded-lg">{{ __('legal.cookies.types.functionality.legal_basis') }}</span>
                                    <span
                                        class="px-3 py-1 bg-orange-100 text-orange-600 rounded-lg">{{ __('legal.cookies.types.functionality.consent') }}</span>
                                </div>
                            </div>

                            <!-- 3.4 -->
                            <div class="p-8 bg-white border border-gray-100 rounded-3xl shadow-sm space-y-4">
                                <h3 class="text-xl font-black text-acef-dark">
                                    {{ __('legal.cookies.types.third_party.title') }}</h3>
                                <p class="text-sm text-gray-600 font-light italic">
                                    {{ __('legal.cookies.types.third_party.desc') }}</p>
                                <p class="text-xs text-gray-600 pt-2">
                                    {{ __('legal.cookies.types.third_party.examples') }}</p>
                            </div>

                        </div>
                    </section>

                    <!-- 04 Managing Cookies -->
                    <section id="managing" class="space-y-10 scroll-mt-32">
                        <div class="flex items-center space-x-6">
                            <span
                                class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">04</span>
                            <h2 class="text-3xl font-black text-acef-dark tracking-tight">
                                {{ __('legal.cookies.managing.title') }}</h2>
                        </div>
                        <div class="space-y-8">
                            <p class="text-gray-600 font-light italic leading-relaxed">
                                {{ __('legal.cookies.managing.desc') }}
                            </p>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                                    <h4 class="font-bold text-acef-dark mb-2">
                                        {{ __('legal.cookies.managing.banner.title') }}</h4>
                                    <p class="text-xs text-gray-600 italic font-light">
                                        {{ __('legal.cookies.managing.banner.desc') }}</p>
                                </div>
                                <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                                    <h4 class="font-bold text-acef-dark mb-2">
                                        {{ __('legal.cookies.managing.browser.title') }}</h4>
                                    <p class="text-xs text-gray-600 italic font-light">
                                        {{ __('legal.cookies.managing.browser.desc') }}</p>
                                </div>
                                <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                                    <h4 class="font-bold text-acef-dark mb-2">
                                        {{ __('legal.cookies.managing.withdraw.title') }}</h4>
                                    <p class="text-xs text-gray-600 italic font-light">
                                        {{ __('legal.cookies.managing.withdraw.desc') }}</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 05 GDPR Rights -->
                    <section id="gdpr" class="space-y-10 scroll-mt-32">
                        <div class="flex items-center space-x-6">
                            <span
                                class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">05</span>
                            <h2 class="text-3xl font-black text-acef-dark tracking-tight">
                                {{ __('legal.cookies.gdpr.title') }}</h2>
                        </div>
                        <div class="bg-gray-800 rounded-3xl p-10 text-white space-y-6">
                            <p class="font-light leading-relaxed opacity-80 italic">{{ __('legal.cookies.gdpr.desc') }}
                            </p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm font-bold">
                                @foreach(__('legal.cookies.gdpr.rights') as $right)
                                    <div class="flex items-center"><span
                                            class="w-2 h-2 bg-acef-green rounded-full mr-3"></span> {{ $right }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    <!-- 06 Changes -->
                    <section id="changes" class="space-y-10 scroll-mt-32">
                        <div class="flex items-center space-x-6">
                            <span
                                class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">06</span>
                            <h2 class="text-3xl font-black text-acef-dark tracking-tight">
                                {{ __('legal.cookies.changes.title') }}</h2>
                        </div>
                        <p class="text-gray-600 font-light italic leading-relaxed">
                            {{ __('legal.cookies.changes.desc') }}
                        </p>
                    </section>

                    <!-- Contact CTA -->
                    <div id="contact"
                        class="bg-acef-green rounded-3xl p-10 md:p-12 space-y-8 flex flex-col md:flex-row items-center justify-between gap-8">
                        <div class="space-y-4 max-w-lg">
                            <div
                                class="w-12 h-12 bg-acef-dark rounded-2xl flex items-center justify-center text-acef-green">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z" />
                                </svg>
                            </div>
                            <h3 class="text-3xl font-black text-acef-dark tracking-tighter">
                                {{ __('legal.cookies.contact.title') }}</h3>
                            <p class="text-acef-dark font-light italic text-sm">
                                {!! __('legal.cookies.contact.address') !!}
                            </p>
                        </div>
                        <div class="space-y-4 w-full md:w-auto">
                            <div
                                class="bg-white/90 backdrop-blur px-8 py-5 rounded-2xl flex items-center space-x-4 border border-white/20">
                                <div class="text-acef-green font-bold text-xs uppercase tracking-widest">
                                    {{ __('legal.cookies.contact.email_label') }}</div>
                                <div class="font-black text-acef-dark text-sm">{{ __('legal.cookies.contact.email') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('components.footer')
</body>

</html>