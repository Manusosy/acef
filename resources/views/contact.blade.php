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

<body class="antialiased font-sans bg-white dark:bg-gray-900 overflow-x-hidden">
    @include('components.header')

    <!-- Contact Hero -->
    <section class="pt-40 pb-24 bg-white dark:bg-gray-900">
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
                        <p class="text-gray-400 dark:text-gray-500 font-light italic">{{ __('pages.contact.form_subtitle') }}</p>
                    </div>

                    <form class="space-y-8" action="mailto:info@acef-ngo.org" method="POST" enctype="text/plain">
                        <div class="space-y-4">
                            <label
                                class="text-xs font-black uppercase tracking-widest text-acef-dark">{{ __('pages.contact.form.topic_label') }}</label>
                            <select name="topic" required
                                class="w-full px-8 py-5 bg-gray-50 dark:bg-gray-800 border-none rounded-2xl text-gray-500 dark:text-white focus:ring-2 focus:ring-acef-green transition-all outline-none">
                                <option value="" disabled selected>{{ __('pages.contact.form.topic_placeholder') }}</option>
                                @foreach(__('pages.contact.topics') as $topic)
                                    <option value="{{ $topic }}">{{ $topic }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-4">
                                <label
                                    class="text-xs font-black uppercase tracking-widest text-acef-dark">{{ __('pages.contact.form.name_label') }}</label>
                                <input type="text" name="name" placeholder="{{ __('pages.contact.form.name_placeholder') }}" required
                                    class="w-full px-8 py-5 bg-gray-50 dark:bg-gray-800 border-none rounded-2xl focus:ring-2 focus:ring-acef-green transition-all outline-none dark:text-white">
                            </div>
                            <div class="space-y-4">
                                <label
                                    class="text-xs font-black uppercase tracking-widest text-acef-dark">{{ __('pages.contact.form.email_label') }}</label>
                                <input type="email" name="email" placeholder="{{ __('pages.contact.form.email_placeholder') }}" required
                                    class="w-full px-8 py-5 bg-gray-50 dark:bg-gray-800 border-none rounded-2xl focus:ring-2 focus:ring-acef-green transition-all outline-none dark:text-white">
                            </div>
                        </div>

                        <div class="space-y-4">
                            <label
                                class="text-xs font-black uppercase tracking-widest text-acef-dark">{{ __('pages.contact.form.org_label') }}</label>
                            <input type="text" name="organization" placeholder="{{ __('pages.contact.form.org_placeholder') }}"
                                class="w-full px-8 py-5 bg-gray-50 dark:bg-gray-800 border-none rounded-2xl focus:ring-2 focus:ring-acef-green transition-all outline-none dark:text-white">
                        </div>

                        <div class="space-y-4">
                            <label
                                class="text-xs font-black uppercase tracking-widest text-acef-dark">{{ __('pages.contact.form.message_label') }}</label>
                            <textarea name="message" rows="6" placeholder="{{ __('pages.contact.form.message_placeholder') }}" required
                                class="w-full px-8 py-5 bg-gray-50 dark:bg-gray-800 border-none rounded-2xl focus:ring-2 focus:ring-acef-green transition-all outline-none dark:text-white"></textarea>
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
                    <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-[40px] p-10 shadow-sm space-y-10">
                        <div class="flex items-center space-x-3 text-acef-green">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <h3 class="text-2xl font-black text-acef-dark dark:text-white tracking-tighter">
                                {{ __('pages.contact.regional_offices') }}</h3>
                        </div>

                        <div
                            class="space-y-6 max-h-[400px] overflow-y-auto pr-4 scrollbar-thin scrollbar-thumb-acef-green/20">
                            @php
                                $offices = [
                                    ['name' => 'Kenya', 'email' => 'kenya@acef-ngo.org'],
                                    ['name' => 'Cameroon', 'email' => 'cameroon@acef-ngo.org'],
                                    ['name' => 'Sierra Leone', 'email' => 'sierraleone@acef-ngo.org'],
                                    ['name' => 'Benin', 'email' => 'benin@acef-ngo.org'],
                                    ['name' => 'Nigeria', 'email' => 'nigeria@acef-ngo.org'],
                                    ['name' => 'DR Congo', 'email' => 'drcongo@acef-ngo.org'],
                                    ['name' => 'Zimbabwe', 'email' => 'zimbabwe@acef-ngo.org'],
                                    ['name' => 'Tanzania', 'email' => 'tanzania@acef-ngo.org'],
                                    ['name' => 'Uganda', 'email' => 'uganda@acef-ngo.org'],
                                    ['name' => 'Zambia', 'email' => 'zambia@acef-ngo.org'],
                                    ['name' => 'Liberia', 'email' => 'liberia@acef-ngo.org'],
                                    ['name' => 'Ghana', 'email' => 'ghana@acef-ngo.org'],
                                    ['name' => 'Rwanda', 'email' => 'rwanda@acef-ngo.org'],
                                    ['name' => 'Angola', 'email' => 'angola@acef-ngo.org'],
                                ];
                            @endphp
                            @foreach($offices as $office)
                                <div class="space-y-2 py-2">
                                    <h4 class="font-bold text-acef-dark dark:text-white text-lg flex items-center">
                                        <span class="w-2 h-2 bg-acef-green rounded-full mr-3"></span>
                                        ACEF {{ $office['name'] }}
                                    </h4>
                                    <a href="mailto:{{ $office['email'] }}"
                                        class="text-acef-green text-sm font-bold pl-5 hover:underline transition-all block">
                                        {{ $office['email'] }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Connect on Social -->
                    <div class="bg-acef-green/5 border border-acef-green/10 rounded-[40px] p-10 space-y-6">
                        <h3 class="text-2xl font-black text-acef-dark dark:text-white tracking-tighter">
                            {{ __('pages.contact.social_title') }}</h3>
                        <p class="text-gray-400 dark:text-gray-500 text-sm font-light italic">{{ __('pages.contact.social_desc') }}</p>
                        <div class="flex items-center space-x-4">
                            <!-- Facebook -->
                            <a href="https://www.facebook.com/share/172ZDMd2dL/" target="_blank" rel="noopener noreferrer"
                                class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-acef-dark hover:bg-acef-dark hover:text-white transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </a>
                            <!-- X (Twitter) -->
                            <a href="https://x.com/ACEFngo?t=H00D4LR0XgHHRHS73lQ76A&s=09" target="_blank" rel="noopener noreferrer"
                                class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-acef-dark hover:bg-acef-dark hover:text-white transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.045 4.126H5.078z" />
                                </svg>
                            </a>
                            <!-- Instagram -->
                            <a href="https://www.instagram.com/acefngo?igsh=MXE3YXRmd2hvZ2xodg==" target="_blank" rel="noopener noreferrer"
                                class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-acef-dark hover:bg-acef-dark hover:text-white transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.23 5-5V7c0-2.76-2.24-5-5-5H7zm0 2h10c1.66 0 3 1.34 3 3v10c0 1.66-1.34 3-3 3H7c-1.66 0-3-1.34-3-3V7c0-1.66 1.34-3 3-3zm10 2a1 1 0 1 0 0 2 1 1 0 0 0 0-2zM12 7c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0 2c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3z"/>
                                </svg>
                            </a>
                            <!-- LinkedIn -->
                            <a href="https://www.linkedin.com/company/acef-africa-climate-and-environment-foundation/" target="_blank" rel="noopener noreferrer"
                                class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-acef-dark hover:bg-acef-dark hover:text-white transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                </svg>
                            </a>
                            <!-- YouTube -->
                            <a href="https://www.youtube.com/@acef-africaclimateandenvir6363" target="_blank" rel="noopener noreferrer"
                                class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-acef-dark hover:bg-acef-dark hover:text-white transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Download Business Card -->
                    @if($admin && $admin->business_card)
                    <div class="bg-acef-dark rounded-[40px] p-10 space-y-6 relative overflow-hidden group shadow-2xl">
                        <div class="absolute inset-0 z-0">
                            <img src="{{ Storage::url($admin->business_card) }}" alt="Card Background" class="w-full h-full object-cover blur-sm opacity-20 group-hover:scale-110 transition-transform duration-700">
                        </div>
                        <div class="relative z-10 space-y-6">
                            <div class="w-12 h-12 bg-acef-green rounded-2xl flex items-center justify-center text-acef-dark shadow-xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                            </div>
                            <div class="space-y-2">
                                <h3 class="text-2xl font-black text-white tracking-tighter">Download Business Card</h3>
                                <p class="text-white/40 text-xs font-light italic leading-relaxed">Get our official contact details directly to your device for offline access.</p>
                            </div>
                            <a href="{{ Storage::url($admin->business_card) }}" download class="inline-flex items-center space-x-3 bg-acef-green text-acef-dark font-black px-8 py-4 rounded-xl hover:bg-white hover:scale-105 transition-all shadow-lg active:scale-95 group/btn">
                                <span>Download Card</span>
                                <svg class="w-5 h-5 group-hover/btn:translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            </a>
                        </div>
                    </div>
                    @endif
                </div> <!-- Sidebar -->
            </div> <!-- Flex -->
        </div> <!-- Container -->
    </main>

    @include('components.footer')
</body>

</html>