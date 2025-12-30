<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google" content="notranslate">
        <title>{{ __('pages.get_involved.hero_title') }} - ACEF</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-white overflow-x-hidden">
        @include('components.header')

        <!-- Get Involved Hero -->
        <section class="pt-40 pb-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="relative rounded-[50px] overflow-hidden min-h-[460px] flex items-center justify-center text-center p-12 md:p-20">
                    <div class="absolute inset-0 z-0">
                        <img src="/mission_vision_africa_1766827653058.png" alt="Join Movement" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/60 backdrop-blur-[2px]"></div>
                    </div>
                    
                    <div class="relative z-10 max-w-3xl space-y-8">
                        <h1 class="text-6xl md:text-8xl font-black text-white tracking-tighter leading-none">{{ __('pages.get_involved.hero_title') }}</h1>
                        <p class="text-white/70 text-lg md:text-xl font-light italic leading-relaxed">
                            {{ __('pages.get_involved.hero_desc') }}
                        </p>
                    </div>
                </div>

                <!-- Three Impact Stats Overlay -->
                <div class="max-w-5xl mx-auto -mt-16 relative z-20">
                    <div class="bg-acef-dark rounded-[30px] p-10 flex flex-wrap items-center justify-around gap-8 border border-white/10 shadow-2xl">
                        @foreach(__('pages.get_involved.stats') as $stat)
                        <div class="text-center space-y-1">
                            <span class="text-4xl font-black text-acef-green">{{ $stat['value'] }}</span>
                            <p class="text-[10px] font-bold text-white/40 uppercase tracking-widest">{{ $stat['label'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <main class="py-24 bg-gray-50/30">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row gap-12 items-start">
                    <!-- Application Form Column -->
                    <div class="lg:w-2/3 bg-white rounded-[50px] shadow-sm border border-gray-100 overflow-hidden">
                        <!-- Custom Tab Header -->
                        <div class="flex border-b border-gray-100">
                            <button class="flex-1 py-8 flex items-center justify-center space-x-3 bg-white text-acef-dark font-black tracking-tight border-b-4 border-acef-green transition-all">
                                <span>🤝</span>
                                <span>{{ __('pages.get_involved.tabs.volunteer') }}</span>
                            </button>
                            <button class="flex-1 py-8 flex items-center justify-center space-x-3 text-gray-400 font-bold tracking-tight hover:bg-gray-50 transition-all">
                                <span>🚀</span>
                                <span>{{ __('pages.get_involved.tabs.partner') }}</span>
                            </button>
                            <button class="flex-1 py-8 flex items-center justify-center space-x-3 text-gray-400 font-bold tracking-tight hover:bg-gray-50 transition-all">
                                <span>🌍</span>
                                <span>{{ __('pages.get_involved.tabs.collaborate') }}</span>
                            </button>
                        </div>

                        <div class="p-12 md:p-16 space-y-10">
                            <div class="space-y-4">
                                <h2 class="text-4xl font-black text-acef-dark tracking-tighter">{{ __('pages.get_involved.volunteer_form.title') }}</h2>
                                <p class="text-gray-400 font-light italic text-sm">{{ __('pages.get_involved.volunteer_form.subtitle') }}</p>
                            </div>

                            <form class="space-y-8">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="space-y-3">
                                        <label class="text-[10px] font-black uppercase text-acef-dark tracking-widest">{{ __('pages.get_involved.volunteer_form.first_name') }}</label>
                                        <input type="text" placeholder="Jane" class="w-full px-8 py-4 bg-gray-50 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green transition-all">
                                    </div>
                                    <div class="space-y-3">
                                        <label class="text-[10px] font-black uppercase text-acef-dark tracking-widest">{{ __('pages.get_involved.volunteer_form.last_name') }}</label>
                                        <input type="text" placeholder="Doe" class="w-full px-8 py-4 bg-gray-50 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green transition-all">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="space-y-3">
                                        <label class="text-[10px] font-black uppercase text-acef-dark tracking-widest">{{ __('pages.get_involved.volunteer_form.email') }}</label>
                                        <input type="email" placeholder="jane@example.com" class="w-full px-8 py-4 bg-gray-50 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green transition-all">
                                    </div>
                                    <div class="space-y-3">
                                        <label class="text-[10px] font-black uppercase text-acef-dark tracking-widest">{{ __('pages.get_involved.volunteer_form.location') }}</label>
                                        <div class="relative">
                                            <input type="text" placeholder="{{ __('pages.get_involved.volunteer_form.location_placeholder') }}" class="w-full pl-12 pr-8 py-4 bg-gray-50 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green transition-all">
                                            <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-3">
                                    <label class="text-[10px] font-black uppercase text-acef-dark tracking-widest">{{ __('pages.get_involved.volunteer_form.interests_label') }}</label>
                                    <select class="w-full px-8 py-4 bg-gray-50 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green transition-all text-gray-500">
                                        @foreach(__('pages.get_involved.volunteer_form.interests') as $interest)
                                            <option>{{ $interest }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="space-y-3">
                                    <label class="text-[10px] font-black uppercase text-acef-dark tracking-widest">{{ __('pages.get_involved.volunteer_form.motivation_label') }}</label>
                                    <textarea rows="5" placeholder="{{ __('pages.get_involved.volunteer_form.motivation_placeholder') }}" class="w-full px-8 py-4 bg-gray-50 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green transition-all"></textarea>
                                </div>

                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" id="newsletter" class="rounded text-acef-green focus:ring-acef-green">
                                    <label for="newsletter" class="text-xs font-bold text-gray-400 italic">{{ __('pages.get_involved.volunteer_form.newsletter') }}</label>
                                </div>

                                <button class="w-full py-5 bg-acef-green text-acef-dark font-black rounded-2xl flex items-center justify-center space-x-3 hover:bg-acef-dark hover:text-white transition-all shadow-xl shadow-acef-green/20">
                                    <span>{{ __('pages.get_involved.volunteer_form.submit_btn') }}</span>
                                    <svg class="w-6 h-6 rotate-[-45deg]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Right Column: Donation Side & Testimonial -->
                    <div class="lg:w-1/3 space-y-8">
                        <!-- Quick Donate -->
                        <div class="bg-white rounded-[50px] p-10 border border-gray-100 shadow-sm space-y-8">
                            <div class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </div>
                            <h3 class="text-2xl font-black text-acef-dark tracking-tighter">{{ __('pages.get_involved.quick_donate.title') }}</h3>
                            <p class="text-gray-400 text-sm font-light italic leading-relaxed">
                                {{ __('pages.get_involved.quick_donate.desc') }}
                            </p>
                            
                            <div class="grid grid-cols-3 gap-3">
                                <button class="py-3 bg-gray-50 rounded-xl font-black text-xs text-gray-400 hover:bg-acef-green hover:text-acef-dark transition-all">$25</button>
                                <button class="py-3 bg-acef-green rounded-xl font-black text-xs text-acef-dark">$50</button>
                                <button class="py-3 bg-gray-50 rounded-xl font-black text-xs text-gray-400 hover:bg-acef-green hover:text-acef-dark transition-all">$100</button>
                            </div>
                            
                            <div class="relative">
                                <span class="absolute left-6 top-1/2 -translate-y-1/2 font-bold text-gray-300">$</span>
                                <input type="text" value="50" class="w-full pl-10 pr-6 py-4 bg-gray-50 border-none rounded-2xl font-black text-acef-dark">
                            </div>

                            <button class="w-full py-5 bg-acef-dark text-white font-black rounded-2xl hover:bg-acef-green hover:text-acef-dark transition-all">
                                {{ __('pages.get_involved.quick_donate.btn') }}
                            </button>
                        </div>

                        <!-- Testimonial -->
                        <div class="bg-acef-green/5 border border-acef-green/10 rounded-[50px] p-10 space-y-8">
                            <div class="flex text-acef-green">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            </div>
                            <p class="text-acef-dark font-light italic leading-relaxed">
                                {{ __('pages.get_involved.testimonial.quote') }}
                            </p>
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 rounded-full overflow-hidden grayscale">
                                    <img src="/hero_marine_ecosystem_1766827540454.png" alt="Sarah Jenkins" class="w-full h-full object-cover">
                                </div>
                                <div class="space-y-0.5">
                                    <h4 class="font-black text-sm text-acef-dark">{{ __('pages.get_involved.testimonial.author') }}</h4>
                                    <p class="text-[10px] font-bold text-acef-green uppercase tracking-widest">{{ __('pages.get_involved.testimonial.role') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Digital Impact CTA -->
                <div class="mt-32 bg-acef-dark rounded-[50px] p-12 md:p-20 flex flex-col md:flex-row items-center justify-between gap-12 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute top-0 right-0 w-96 h-96 bg-acef-green rounded-full blur-3xl"></div>
                    </div>
                    
                    <div class="space-y-6 relative z-10 max-w-xl">
                        <h2 class="text-4xl md:text-5xl font-black text-white tracking-tighter">{{ __('pages.get_involved.digital_cta.title') }}</h2>
                        <p class="text-white/40 text-sm font-light leading-relaxed italic">
                            {{ __('pages.get_involved.digital_cta.desc') }}
                        </p>
                        <div class="flex flex-wrap gap-6 pt-4">
                            <button class="flex items-center space-x-2 text-acef-green font-black text-xs hover:text-white transition-all">
                                <span>{{ __('pages.get_involved.digital_cta.media_kit') }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            </button>
                            <button class="flex items-center space-x-2 text-acef-green font-black text-xs hover:text-white transition-all">
                                <span>{{ __('pages.get_involved.digital_cta.share_twitter') }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex space-x-4 relative z-10">
                        <div class="w-32 h-40 bg-white rounded-2xl rotate-[-6deg] shadow-2xl p-2 border border-black/5">
                            <img src="/project_tree_planting_1766827726209.png" class="w-full h-full object-cover rounded-xl grayscale">
                        </div>
                        <div class="w-32 h-40 bg-white border border-black/5 rounded-2xl rotate-[6deg] shadow-2xl p-2">
                             <img src="/project_solar_panels_1766827705821.png" class="w-full h-full object-cover rounded-xl grayscale">
                        </div>
                    </div>
                </div>
            </div>
        </main>

        @include('components.footer')
    </body>
</html>
