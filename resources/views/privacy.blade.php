<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google" content="notranslate">
        <title>{{ __('legal.privacy.title') }} - ACEF</title>

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
                <a href="{{ route('home') }}" class="hover:text-acef-green transition-colors">{{ __('navigation.home') }}</a>
                <span class="mx-3 text-gray-200">/</span>
                <span class="text-acef-dark">{{ __('legal.privacy.title') }}</span>
            </nav>
        </div>

        <main class="pb-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="space-y-6 mb-16">
                    <h1 class="text-6xl md:text-7xl font-black text-acef-dark tracking-tighter leading-none">{{ __('legal.privacy.title') }}</h1>
                    <p class="text-gray-400 text-lg font-light italic leading-relaxed max-w-3xl">
                        {{ __('legal.privacy.desc') }}
                    </p>
                    <div class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-widest text-gray-300 pt-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span>{{ __('legal.privacy.last_updated') }}</span>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row gap-16 items-start">
                    <!-- Sidebar Table of Contents -->
                    <div class="lg:w-1/4 lg:sticky lg:top-32 space-y-10">
                        <div class="space-y-6">
                            <h3 class="text-[10px] font-black uppercase tracking-widest text-gray-300">{{ __('legal.privacy.toc') }}</h3>
                            <nav class="flex flex-col space-y-4">
                                <a href="#data-collection" class="text-sm font-bold text-acef-green border-l-4 border-acef-green pl-4">{{ __('legal.privacy.sections.collection') }}</a>
                                <a href="#usage" class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">{{ __('legal.privacy.sections.usage') }}</a>
                                <a href="#sharing" class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">{{ __('legal.privacy.sections.sharing') }}</a>
                                <a href="#cookies" class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">{{ __('legal.privacy.sections.cookies') }}</a>
                                <a href="#security" class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">{{ __('legal.privacy.sections.security') }}</a>
                                <a href="#rights" class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">{{ __('legal.privacy.sections.rights') }}</a>
                                <a href="#retention" class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">{{ __('legal.privacy.sections.retention') }}</a>
                            </nav>
                        </div>

                        <div class="bg-acef-green/5 rounded-[30px] p-8 space-y-6 border border-acef-green/10">
                            <h4 class="text-xl font-black text-acef-dark tracking-tight leading-tight">{{ __('legal.privacy.help_title') }}</h4>
                            <p class="text-xs text-gray-400 italic font-light">{{ __('legal.privacy.help_desc') }}</p>
                            <a href="mailto:{{ __('legal.privacy.contact.email') }}" class="text-acef-green text-xs font-black flex items-center hover:underline">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                {{ __('legal.privacy.contact.email') }}
                            </a>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="lg:w-3/4 space-y-16">
                        <!-- 01 Data Collection -->
                        <section id="data-collection" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">01</span>
                                <h2 class="text-3xl font-black text-acef-dark tracking-tight">{{ __('legal.privacy.data_collection.title') }}</h2>
                            </div>
                            <div class="space-y-6">
                                <p class="text-gray-400 font-light italic leading-relaxed">{{ __('legal.privacy.data_collection.desc') }}</p>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="p-8 bg-gray-50 rounded-[30px] border border-gray-100 space-y-4 shadow-sm">
                                        <h4 class="font-black text-acef-dark tracking-tight">{{ __('legal.privacy.data_collection.personal.title') }}</h4>
                                        <ul class="text-sm text-gray-400 space-y-2 italic font-light">
                                            <li class="flex items-start"><span class="mr-2 text-acef-green">•</span> {{ __('legal.privacy.data_collection.personal.item') }}</li>
                                        </ul>
                                    </div>
                                    <div class="p-8 bg-gray-50 rounded-[30px] border border-gray-100 space-y-4 shadow-sm">
                                        <h4 class="font-black text-acef-dark tracking-tight">{{ __('legal.privacy.data_collection.donation.title') }}</h4>
                                        <ul class="text-sm text-gray-400 space-y-2 italic font-light">
                                            <li class="flex items-start"><span class="mr-2 text-acef-green">•</span> {{ __('legal.privacy.data_collection.donation.item') }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- 02 Usage -->
                        <section id="usage" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">02</span>
                                <h2 class="text-3xl font-black text-acef-dark tracking-tight">{{ __('legal.privacy.usage.title') }}</h2>
                            </div>
                            <div class="space-y-6">
                                <p class="text-gray-400 font-light italic leading-relaxed">{{ __('legal.privacy.usage.desc') }}</p>
                                <div class="bg-gray-50 rounded-[30px] p-10 border border-gray-100 italic space-y-4 shadow-sm">
                                    <ul class="space-y-4 text-sm text-gray-400 font-light">
                                        @foreach(__('legal.privacy.usage.items') as $item)
                                        <li class="flex items-start">
                                            <span class="text-acef-green mr-3 font-bold">✓</span>
                                            <span>{!! $item !!}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </section>

                        <!-- 03 Sharing -->
                        <section id="sharing" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">03</span>
                                <h2 class="text-3xl font-black text-acef-dark tracking-tight">{{ __('legal.privacy.sharing.title') }}</h2>
                            </div>
                            <div class="space-y-8">
                                <div class="bg-orange-50/50 border border-orange-100 rounded-[30px] p-8 flex items-center space-x-4">
                                    <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center text-orange-500 shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    </div>
                                    <p class="text-sm font-bold text-orange-800 tracking-tight italic">{{ __('legal.privacy.sharing.warning') }}</p>
                                </div>
                                <p class="text-gray-400 font-light italic leading-relaxed">
                                    {{ __('legal.privacy.sharing.desc') }}
                                </p>
                            </div>
                        </section>

                        <!-- 04 Cookies -->
                        <section id="cookies" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">04</span>
                                <h2 class="text-3xl font-black text-acef-dark tracking-tight">{{ __('legal.privacy.cookies_tracking.title') }}</h2>
                            </div>
                            <div class="bg-gray-50 rounded-[40px] p-10 space-y-8 border border-gray-100 shadow-sm">
                                <p class="text-gray-400 font-light italic leading-relaxed">{{ __('legal.privacy.cookies_tracking.desc') }}</p>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="flex items-start space-x-4">
                                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-acef-green shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                        </div>
                                        <div class="space-y-1">
                                            <h5 class="font-black text-acef-dark text-sm">{{ __('legal.privacy.cookies_tracking.analytical.title') }}</h5>
                                            <p class="text-xs text-gray-400 italic font-light">{{ __('legal.privacy.cookies_tracking.analytical.desc') }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start space-x-4">
                                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-acef-green shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        <div class="space-y-1">
                                            <h5 class="font-black text-acef-dark text-sm">{{ __('legal.privacy.cookies_tracking.functional.title') }}</h5>
                                            <p class="text-xs text-gray-400 italic font-light">{{ __('legal.privacy.cookies_tracking.functional.desc') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- 05 Security -->
                        <section id="security" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">05</span>
                                <h2 class="text-3xl font-black text-acef-dark tracking-tight">{{ __('legal.privacy.security.title') }}</h2>
                            </div>
                            <p class="text-gray-400 font-light italic leading-relaxed text-sm">
                                {{ __('legal.privacy.security.desc') }}
                            </p>
                        </section>

                        <!-- 06 Rights -->
                        <section id="rights" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">06</span>
                                <h2 class="text-3xl font-black text-acef-dark tracking-tight">{{ __('legal.privacy.rights.title') }}</h2>
                            </div>
                            <div class="space-y-8">
                                <p class="text-gray-400 font-light italic leading-relaxed text-sm">{{ __('legal.privacy.rights.desc') }}</p>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach(__('legal.privacy.rights.list') as $right)
                                    <div class="px-6 py-4 bg-gray-50 rounded-2xl flex items-center space-x-3 shadow-sm">
                                        <svg class="w-4 h-4 text-acef-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        <span class="text-xs font-bold text-acef-dark">{{ $right }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        <!-- 07 Retention -->
                        <section id="retention" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">07</span>
                                <h2 class="text-3xl font-black text-acef-dark tracking-tight">{{ __('legal.privacy.retention.title') }}</h2>
                            </div>
                            <p class="text-gray-400 font-light italic leading-relaxed text-sm">
                                {{ __('legal.privacy.retention.desc') }}
                            </p>
                        </section>

                        <!-- Contact CTA -->
                        <div class="bg-acef-green rounded-[40px] p-10 md:p-12 space-y-8 flex flex-col md:flex-row items-center justify-between gap-8">
                            <div class="space-y-4 max-w-lg">
                                <div class="w-12 h-12 bg-acef-dark rounded-2xl flex items-center justify-center text-acef-green shadow-xl">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                                </div>
                                <h3 class="text-3xl font-black text-acef-dark tracking-tighter">{{ __('legal.privacy.contact.title') }}</h3>
                                <p class="text-acef-dark font-light italic text-sm">
                                    {{ __('legal.privacy.contact.desc') }}
                                </p>
                            </div>
                            <div class="space-y-4 w-full md:w-auto">
                                <div class="bg-white/90 backdrop-blur px-8 py-5 rounded-2xl flex items-center space-x-4 border border-white/20 shadow-sm">
                                    <div class="text-acef-green font-bold text-xs uppercase tracking-widest">{{ __('legal.privacy.contact.hq') }}</div>
                                    <div class="font-black text-acef-dark text-sm">{{ __('legal.privacy.contact.location') }}</div>
                                </div>
                                <div class="bg-white/90 backdrop-blur px-8 py-5 rounded-2xl flex items-center space-x-4 border border-white/20 shadow-sm">
                                    <div class="text-acef-green font-bold text-xs uppercase tracking-widest">{{ __('legal.privacy.contact.email_label') }}</div>
                                    <div class="font-black text-acef-dark text-sm">{{ __('legal.privacy.contact.email') }}</div>
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
