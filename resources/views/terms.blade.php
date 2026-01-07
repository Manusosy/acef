<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google" content="notranslate">
        <title>{{ __('legal.terms.title') }} - ACEF</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-white dark:bg-gray-900 overflow-x-hidden transition-colors duration-500">
        @include('components.header')

        <!-- Simple Breadcrumb -->
        <div class="pt-32 pb-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex text-xs font-bold uppercase tracking-widest text-gray-300">
                <a href="{{ route('home') }}" class="hover:text-acef-green transition-colors">{{ __('navigation.home') }}</a>
                <span class="mx-3 text-gray-200 dark:text-gray-700">/</span>
                <span class="text-acef-dark dark:text-white">{{ __('legal.terms.title') }}</span>
            </nav>
        </div>

        <main class="pb-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="space-y-6 mb-16">
                    <h1 class="text-6xl md:text-7xl font-black text-acef-dark dark:text-white tracking-tighter leading-none">{{ __('legal.terms.title') }}</h1>
                    <p class="text-gray-600 dark:text-gray-400 text-lg font-light italic leading-relaxed max-w-3xl">
                        {{ __('legal.terms.desc') }}
                    </p>
                    <div class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-widest text-gray-300 dark:text-gray-600 pt-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span>{{ __('legal.terms.last_updated') }}</span>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row gap-16 items-start">
                    <!-- Sidebar Table of Contents -->
                    <div class="lg:w-1/4 lg:sticky lg:top-32 space-y-10">
                        <div class="space-y-6">
                            <h3 class="text-[10px] font-black uppercase tracking-widest text-gray-300 dark:text-gray-600">{{ __('legal.terms.toc') }}</h3>
                            <nav class="flex flex-col space-y-4">
                                <a href="#acceptance" class="text-sm font-bold text-acef-green border-l-4 border-acef-green pl-4">{{ __('legal.terms.sections.acceptance') }}</a>
                                <a href="#donations" class="text-sm font-bold text-gray-400 dark:text-gray-500 hover:text-acef-dark dark:hover:text-white transition-all pl-5">{{ __('legal.terms.sections.donations') }}</a>
                                <a href="#intellectual-property" class="text-sm font-bold text-gray-400 dark:text-gray-500 hover:text-acef-dark dark:hover:text-white transition-all pl-5">{{ __('legal.terms.sections.ip') }}</a>
                                <a href="#prohibited-use" class="text-sm font-bold text-gray-400 dark:text-gray-500 hover:text-acef-dark dark:hover:text-white transition-all pl-5">{{ __('legal.terms.sections.prohibited') }}</a>
                                <a href="#liability" class="text-sm font-bold text-gray-400 dark:text-gray-500 hover:text-acef-dark dark:hover:text-white transition-all pl-5">{{ __('legal.terms.sections.liability') }}</a>
                                <a href="#termination" class="text-sm font-bold text-gray-400 dark:text-gray-500 hover:text-acef-dark dark:hover:text-white transition-all pl-5">{{ __('legal.terms.sections.termination') }}</a>
                                <a href="#governing-law" class="text-sm font-bold text-gray-400 dark:text-gray-500 hover:text-acef-dark dark:hover:text-white transition-all pl-5">{{ __('legal.terms.sections.law') }}</a>
                            </nav>
                        </div>

                        <div class="p-8 bg-gray-50 dark:bg-gray-800/50 rounded-3xl border border-gray-100 dark:border-gray-700 space-y-6">
                            <div class="w-12 h-12 bg-acef-green rounded-2xl flex items-center justify-center text-acef-dark">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <h4 class="text-xl font-black text-acef-dark dark:text-white tracking-tight leading-tight">{{ __('legal.terms.safety_title') }}</h4>
                            <p class="text-xs text-gray-600 dark:text-gray-400 italic font-light">{{ __('legal.terms.safety_desc') }}</p>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="lg:w-3/4 space-y-16">
                        <!-- 01 Acceptance -->
                         <section id="acceptance" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 dark:bg-acef-green/20 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg border border-acef-green/20">01</span>
                                <h2 class="text-3xl font-black text-acef-dark dark:text-white tracking-tight">{{ __('legal.terms.acceptance.title') }}</h2>
                            </div>
                            <div class="space-y-6">
                                <p class="text-gray-600 dark:text-gray-400 font-light italic leading-relaxed">{{ __('legal.terms.acceptance.desc') }}</p>
                                <div class="bg-acef-dark/5 dark:bg-white/5 p-8 rounded-3xl border border-acef-green/20">
                                    <p class="text-acef-dark dark:text-acef-green font-bold text-sm leading-relaxed italic">
                                        {{ __('legal.terms.acceptance.warning') }}
                                    </p>
                                </div>
                            </div>
                        </section>

                        <!-- 02 Donations -->
                         <section id="donations" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 dark:bg-acef-green/20 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg border border-acef-green/20">02</span>
                                <h2 class="text-3xl font-black text-acef-dark dark:text-white tracking-tight">{{ __('legal.terms.donations.title') }}</h2>
                            </div>
                            <div class="space-y-6">
                                <p class="text-gray-600 dark:text-gray-400 font-light italic leading-relaxed">{{ __('legal.terms.donations.desc') }}</p>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="p-8 bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-700 rounded-3xl space-y-3">
                                        <h4 class="font-black text-acef-dark dark:text-white text-sm uppercase tracking-tight">{{ __('legal.terms.donations.finality.title') }}</h4>
                                        <p class="text-xs text-gray-600 dark:text-gray-400 font-light italic leading-relaxed">{{ __('legal.terms.donations.finality.desc') }}</p>
                                    </div>
                                    <div class="p-8 bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-700 rounded-3xl space-y-3">
                                        <h4 class="font-black text-acef-dark dark:text-white text-sm uppercase tracking-tight">{{ __('legal.terms.donations.tax.title') }}</h4>
                                        <p class="text-xs text-gray-600 dark:text-gray-400 font-light italic leading-relaxed">{{ __('legal.terms.donations.tax.desc') }}</p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- 03 Intellectual Property -->
                         <section id="intellectual-property" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 dark:bg-acef-green/20 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg border border-acef-green/20">03</span>
                                <h2 class="text-3xl font-black text-acef-dark dark:text-white tracking-tight">{{ __('legal.terms.ip.title') }}</h2>
                            </div>
                            <div class="space-y-6">
                                <p class="text-gray-600 dark:text-gray-400 font-light italic leading-relaxed">{{ __('legal.terms.ip.desc') }}</p>
                                <div class="bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-700 rounded-3xl p-10 text-acef-dark dark:text-gray-300 italic font-light text-sm">
                                    {{ __('legal.terms.ip.usage') }}
                                </div>
                            </div>
                        </section>

                        <!-- 04 Prohibited Use -->
                         <section id="prohibited-use" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 dark:bg-acef-green/20 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg border border-acef-green/20">04</span>
                                <h2 class="text-3xl font-black text-acef-dark dark:text-white tracking-tight">{{ __('legal.terms.prohibited.title') }}</h2>
                            </div>
                            <div class="space-y-6">
                                <p class="text-gray-600 dark:text-gray-400 font-light italic leading-relaxed">{{ __('legal.terms.prohibited.desc') }}</p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-12 gap-y-4">
                                    @foreach(__('legal.terms.prohibited.list') as $item)
                                    <div class="flex items-center space-x-3 text-xs font-black text-acef-dark dark:text-gray-300">
                                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                        <span>{{ $item }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        <!-- 05 Limitation of Liability -->
                         <section id="liability" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 dark:bg-acef-green/20 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg border border-acef-green/20">05</span>
                                <h2 class="text-3xl font-black text-acef-dark dark:text-white tracking-tight">{{ __('legal.terms.liability.title') }}</h2>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 font-light italic leading-relaxed text-sm">
                                {{ __('legal.terms.liability.desc') }}
                            </p>
                        </section>

                        <!-- 06 Termination -->
                         <section id="termination" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 dark:bg-acef-green/20 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg border border-acef-green/20">06</span>
                                <h2 class="text-3xl font-black text-acef-dark dark:text-white tracking-tight">{{ __('legal.terms.termination.title') }}</h2>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 font-light italic leading-relaxed text-sm">
                                {{ __('legal.terms.termination.desc') }}
                            </p>
                        </section>

                        <!-- 07 Governing Law -->
                         <section id="governing-law" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 dark:bg-acef-green/20 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg border border-acef-green/20">07</span>
                                <h2 class="text-3xl font-black text-acef-dark dark:text-white tracking-tight">{{ __('legal.terms.law.title') }}</h2>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 font-light italic leading-relaxed text-sm">
                                {{ __('legal.terms.law.desc') }}
                            </p>
                        </section>

                        <!-- Contact CTA -->
                        <div id="contact" class="bg-acef-green rounded-3xl p-10 md:p-12 flex flex-col md:flex-row items-center justify-between gap-12 animate-on-scroll">
                            <div class="space-y-6 max-w-lg text-left">
                                <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center text-white">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                                </div>
                                <div class="space-y-2">
                                    <h3 class="text-3xl font-black text-white tracking-tighter">{{ __('legal.terms.contact.title') }}</h3>
                                    <p class="text-white/80 font-medium italic text-sm leading-relaxed">
                                        {{ __('legal.terms.contact.desc') }}
                                    </p>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 gap-1 w-full md:w-auto">
                                <div class="bg-white/10 dark:bg-black/20 backdrop-blur-sm px-8 py-5 rounded-2xl flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-6 border border-white/20">
                                    <div class="text-white font-black text-[10px] uppercase tracking-[0.2em] opacity-60">{{ __('legal.terms.contact.email_label') }}</div>
                                    <div class="font-black text-white text-sm tracking-tight">{{ __('legal.terms.contact.email') }}</div>
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
