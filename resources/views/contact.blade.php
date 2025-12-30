<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" content="notranslate">
    <title>{{ __('pages.contact.hero_title') }} - ACEF</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans bg-white overflow-x-hidden">
    @include('components.header')

    <!-- Contact Hero -->
    <section class="pt-40 pb-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="relative rounded-[50px] overflow-hidden min-h-[400px] flex items-center justify-center text-center p-12 md:p-20">
                <!-- Background with Gradient/Image -->
                <div class="absolute inset-0 z-0">
                    <img src="/hero_marine_ecosystem_1766827540454.png" alt="Contact Hero"
                        class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-r from-acef-dark/95 via-acef-dark/70 to-acef-dark/40">
                    </div>
                </div>

                <div class="relative z-10 max-w-3xl space-y-8">
                    <h1 class="text-6xl md:text-8xl font-black text-white tracking-tighter leading-none">
                        {{ __('pages.contact.hero_title') }}</h1>
                    <p class="text-white/60 text-lg md:text-xl font-light italic leading-relaxed">
                        {{ __('pages.contact.hero_desc') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <main class="pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-20">
                <!-- Contact Form -->
                <div class="lg:w-3/5 space-y-12">
                    <div class="space-y-4">
                        <h2 class="text-5xl font-black text-acef-dark tracking-tighter">
                            {{ __('pages.contact.form_title') }}</h2>
                        <p class="text-gray-400 font-light italic">{{ __('pages.contact.form_subtitle') }}</p>
                    </div>

                    <form class="space-y-8">
                        <div class="space-y-4">
                            <label
                                class="text-xs font-black uppercase tracking-widest text-acef-dark">{{ __('pages.contact.form.topic_label') }}</label>
                            <select
                                class="w-full px-8 py-5 bg-gray-50 border-none rounded-2xl text-gray-500 focus:ring-2 focus:ring-acef-green transition-all outline-none">
                                <option>{{ __('pages.contact.form.topic_placeholder') }}</option>
                                @foreach(__('pages.contact.topics') as $topic)
                                    <option>{{ $topic }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-4">
                                <label
                                    class="text-xs font-black uppercase tracking-widest text-acef-dark">{{ __('pages.contact.form.name_label') }}</label>
                                <input type="text" placeholder="{{ __('pages.contact.form.name_placeholder') }}"
                                    class="w-full px-8 py-5 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-acef-green transition-all outline-none">
                            </div>
                            <div class="space-y-4">
                                <label
                                    class="text-xs font-black uppercase tracking-widest text-acef-dark">{{ __('pages.contact.form.email_label') }}</label>
                                <input type="email" placeholder="{{ __('pages.contact.form.email_placeholder') }}"
                                    class="w-full px-8 py-5 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-acef-green transition-all outline-none">
                            </div>
                        </div>

                        <div class="space-y-4">
                            <label
                                class="text-xs font-black uppercase tracking-widest text-acef-dark">{{ __('pages.contact.form.org_label') }}</label>
                            <input type="text" placeholder="{{ __('pages.contact.form.org_placeholder') }}"
                                class="w-full px-8 py-5 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-acef-green transition-all outline-none">
                        </div>

                        <div class="space-y-4">
                            <label
                                class="text-xs font-black uppercase tracking-widest text-acef-dark">{{ __('pages.contact.form.message_label') }}</label>
                            <textarea rows="6" placeholder="{{ __('pages.contact.form.message_placeholder') }}"
                                class="w-full px-8 py-5 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-acef-green transition-all outline-none"></textarea>
                        </div>

                        <button
                            class="bg-acef-green text-acef-dark font-black px-12 py-5 rounded-2xl hover:bg-acef-dark hover:text-white transition-all shadow-xl shadow-acef-green/20">
                            {{ __('pages.contact.form.submit_btn') }}
                        </button>
                        <p class="text-[10px] text-gray-300 font-bold uppercase tracking-widest">
                            {{ __('pages.contact.form.privacy_note') }}</p>
                    </form>
                </div>

                <!-- Sidebar Info -->
                <div class="lg:w-2/5 space-y-10">
                    <!-- Regional Offices -->
                    <div class="bg-white border border-gray-100 rounded-[40px] p-10 shadow-sm space-y-10">
                        <div class="flex items-center space-x-3 text-acef-green">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <h3 class="text-2xl font-black text-acef-dark tracking-tighter">
                                {{ __('pages.contact.regional_offices') }}</h3>
                        </div>

                        <div
                            class="space-y-6 max-h-[400px] overflow-y-auto pr-4 scrollbar-thin scrollbar-thumb-acef-green/20">
                            @php
                                $offices = [
                                    ['name' => 'Kenya', 'email' => 'acef.ken@gmail.com'],
                                    ['name' => 'Cameroon', 'email' => 'acef.cam@gmail.com'],
                                    ['name' => 'Rwanda', 'email' => 'acef.rwa@gmail.com'],
                                    ['name' => 'Togo', 'email' => 'acef.togo@gmail.com'],
                                    ['name' => 'Burundi', 'email' => 'acef.burundi@gmail.com'],
                                    ['name' => 'Benin', 'email' => 'acef.benin@gmail.com'],
                                    ['name' => 'Guinea Bissau', 'email' => 'acef.guineabissau@gmail.com'],
                                    ['name' => 'Côte d\'Ivoire', 'email' => 'acef.cote@gmail.com'],
                                    ['name' => 'Ghana', 'email' => 'acef.ghana@gmail.com'],
                                    ['name' => 'Equatorial Guinea', 'email' => 'acef.equatorial@gmail.com'],
                                    ['name' => 'Chad', 'email' => 'acef.chad@gmail.com'],
                                    ['name' => 'Democratic Republic of Congo', 'email' => 'acef.rdc@gmail.com'],
                                    ['name' => 'Central African Republic', 'email' => 'acef.centraf@gmail.com'],
                                    ['name' => 'Gabonese Republic', 'email' => 'acef.gabrepublic@gmail.com'],
                                ];
                            @endphp
                            @foreach($offices as $office)
                                <div class="space-y-1">
                                    <h4 class="font-bold text-acef-dark text-sm flex items-center">
                                        <span class="w-1.5 h-1.5 bg-acef-green rounded-full mr-2"></span>
                                        ACEF {{ $office['name'] }}
                                    </h4>
                                    <a href="mailto:{{ $office['email'] }}"
                                        class="text-acef-green text-[10px] font-bold pl-3.5 hover:underline transition-all">
                                        {{ $office['email'] }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Connect on Social -->
                    <div class="bg-acef-green/5 border border-acef-green/10 rounded-[40px] p-10 space-y-6">
                        <h3 class="text-2xl font-black text-acef-dark tracking-tighter">
                            {{ __('pages.contact.social_title') }}</h3>
                        <p class="text-gray-400 text-sm font-light italic">{{ __('pages.contact.social_desc') }}</p>
                        <div class="flex items-center space-x-4">
                            <a href="#"
                                class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-acef-dark hover:bg-acef-dark hover:text-white transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.045 4.126H5.078z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-acef-dark hover:bg-acef-dark hover:text-white transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-acef-dark hover:bg-acef-dark hover:text-white transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Mini Map Preview -->
                    <div
                        class="relative bg-gray-100 rounded-[40px] aspect-video overflow-hidden border border-gray-100 shadow-sm group">
                        <img src="/map_africa_impact_1766827796711.png" alt="Map Preview"
                            class="w-full h-full object-cover grayscale opacity-50">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <button
                                class="bg-white/80 backdrop-blur-md px-6 py-3 rounded-xl font-black text-xs text-acef-dark flex items-center space-x-2 shadow-lg border border-white hover:bg-white transition-all">
                                <svg class="w-4 h-4 text-acef-green" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                <span>{{ __('pages.contact.view_map_btn') }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('components.footer')
</body>

</html>