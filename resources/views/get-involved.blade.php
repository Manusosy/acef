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

        @php
            $getInvolvedPage = \App\Models\Page::where('slug', 'get-involved')->first();
            $heroSlides = $getInvolvedPage ? $getInvolvedPage->activeHeroSlides()->with('media')->get() : collect();
        @endphp
    </head>
    <body class="antialiased font-sans bg-white dark:bg-gray-900 overflow-x-hidden transition-colors">
        @include('components.header')

        <x-hero 
            :page="$getInvolvedPage"
            :slides="$heroSlides"
            breadcrumb="{{ __('navigation.get_involved') }}"
            title="{{ __('pages.get_involved.hero_title') }}"
            subtitle="{{ __('pages.get_involved.hero_desc') }}"
            image-url="/mission_vision_africa_1766827653058.png"
        />

                <!-- Three Impact Stats Overlay -->
                <div class="max-w-5xl mx-auto -mt-16 relative z-20">
                    <div class="bg-acef-dark rounded-3xl p-10 flex flex-wrap items-center justify-around gap-8 border border-white/10 shadow-2xl" x-data="{
                        stats: [
                            @foreach(__('pages.home.stats') as $stat)
                            { value: {{ (int)str_replace(['+', '%', ','], '', $stat['value']) }}, label: '{{ $stat['label'] }}', current: 0, suffix: '{{ preg_replace('/[0-9,]/', '', $stat['value']) }}' },
                            @endforeach
                        ],
                        startCount() {
                            this.stats.forEach(stat => {
                                let start = 0;
                                let end = stat.value;
                                let duration = 2000;
                                let startTime = null;
    
                                const step = (timestamp) => {
                                    if (!startTime) startTime = timestamp;
                                    const progress = Math.min((timestamp - startTime) / duration, 1);
                                    stat.current = Math.floor(progress * (end - start) + start);
                                    if (progress < 1) {
                                        window.requestAnimationFrame(step);
                                    }
                                };
                                window.requestAnimationFrame(step);
                            });
                        }
                    }" x-intersect.once="startCount()">
                        <template x-for="stat in stats">
                            <div class="text-center space-y-1">
                                <span class="text-4xl font-bold text-acef-green" x-text="stat.current.toLocaleString() + stat.suffix">0</span>
                                <p class="text-xs font-bold text-white/40 uppercase tracking-widest" x-text="stat.label"></p>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </section>

        <main class="py-24 bg-gray-50/30 dark:bg-gray-900 transition-colors">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row gap-12 items-start">
                    <!-- Application Form Column -->
                    <div x-data="{ tab: 'volunteer' }" class="lg:w-2/3 bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-colors">
                        <!-- Custom Tab Header -->
                        <div class="flex border-b border-gray-100 dark:border-gray-700">
                            <button @click="tab = 'volunteer'" 
                                :class="tab === 'volunteer' ? 'border-acef-green text-acef-dark dark:text-white' : 'border-transparent text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700'"
                                class="flex-1 py-8 flex items-center justify-center space-x-3 font-bold tracking-tight border-b-4 transition-all">
                                <span>{{ __('pages.get_involved.tabs.volunteer') }}</span>
                            </button>
                            <button @click="tab = 'partner'" 
                                :class="tab === 'partner' ? 'border-acef-green text-acef-dark dark:text-white' : 'border-transparent text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700'"
                                class="flex-1 py-8 flex items-center justify-center space-x-3 font-bold tracking-tight border-b-4 transition-all">
                                <span>{{ __('pages.get_involved.tabs.partner') }}</span>
                            </button>
                            <button @click="tab = 'collaborate'" 
                                :class="tab === 'collaborate' ? 'border-acef-green text-acef-dark dark:text-white' : 'border-transparent text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700'"
                                class="flex-1 py-8 flex items-center justify-center space-x-3 font-bold tracking-tight border-b-4 transition-all">
                                <span>{{ __('pages.get_involved.tabs.collaborate') }}</span>
                            </button>
                        </div>

                        <div class="p-12 md:p-16 space-y-10">
                            
                            <!-- Volunteer Form -->
                            <div x-show="tab === 'volunteer'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-8">
                                <div class="space-y-4">
                                    <h2 class="text-4xl font-bold text-acef-dark dark:text-white tracking-tighter">{{ __('pages.get_involved.volunteer_form.title') }}</h2>
                                    <p class="text-gray-400 font-light italic text-sm">{{ __('pages.get_involved.volunteer_form.subtitle') }}</p>
                                </div>
                            <form class="space-y-8" action="mailto:info@acef-ngo.org" method="POST" enctype="text/plain">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                        <div class="space-y-3">
                                            <label class="text-xs font-bold uppercase text-acef-dark dark:text-gray-300 tracking-widest">{{ __('pages.get_involved.volunteer_form.first_name') }}</label>
                                            <input type="text" name="first_name" placeholder="Jane" required class="w-full px-8 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green text-acef-dark dark:text-white transition-all">
                                        </div>
                                        <div class="space-y-3">
                                            <label class="text-xs font-bold uppercase text-acef-dark dark:text-gray-300 tracking-widest">{{ __('pages.get_involved.volunteer_form.last_name') }}</label>
                                            <input type="text" name="last_name" placeholder="Doe" required class="w-full px-8 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green text-acef-dark dark:text-white transition-all">
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                        <div class="space-y-3">
                                            <label class="text-xs font-bold uppercase text-acef-dark dark:text-gray-300 tracking-widest">{{ __('pages.get_involved.volunteer_form.email') }}</label>
                                            <input type="email" name="email" placeholder="jane@example.com" required class="w-full px-8 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green text-acef-dark dark:text-white transition-all">
                                        </div>
                                        <div class="space-y-3">
                                            <label class="text-xs font-bold uppercase text-acef-dark dark:text-gray-300 tracking-widest">{{ __('pages.get_involved.volunteer_form.location') }}</label>
                                            <div class="relative">
                                                <input type="text" name="location" placeholder="{{ __('pages.get_involved.volunteer_form.location_placeholder') }}" required class="w-full pl-12 pr-8 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green text-acef-dark dark:text-white transition-all">
                                                <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="space-y-3">
                                        <label class="text-xs font-bold uppercase text-acef-dark dark:text-gray-300 tracking-widest">{{ __('pages.get_involved.volunteer_form.interests_label') }}</label>
                                        <select name="interest" required class="w-full px-8 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green transition-all text-gray-500 dark:text-gray-300">
                                            @foreach(__('pages.get_involved.volunteer_form.interests') as $interest)
                                                <option value="{{ $interest }}">{{ $interest }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="space-y-3">
                                        <label class="text-xs font-bold uppercase text-acef-dark dark:text-gray-300 tracking-widest">{{ __('pages.get_involved.volunteer_form.motivation_label') }}</label>
                                        <textarea name="motivation" rows="5" placeholder="{{ __('pages.get_involved.volunteer_form.motivation_placeholder') }}" required class="w-full px-8 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green text-acef-dark dark:text-white transition-all"></textarea>
                                    </div>

                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" name="newsletter" id="newsletter_vol" class="rounded text-acef-green focus:ring-acef-green bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700">
                                        <label for="newsletter_vol" class="text-xs font-bold text-gray-400 italic">{{ __('pages.get_involved.volunteer_form.newsletter') }}</label>
                                    </div>

                                    <button class="w-full py-5 bg-acef-green text-acef-dark font-bold rounded-2xl flex items-center justify-center space-x-3 hover:bg-acef-dark hover:text-white transition-all shadow-xl shadow-acef-green/20">
                                        <span>{{ __('pages.get_involved.volunteer_form.submit_btn') }}</span>
                                        <svg class="w-6 h-6 rotate-[-45deg]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                    </button>
                                </form>
                            </div>

                            <!-- Partner Form -->
                            <div x-show="tab === 'partner'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-8" style="display: none;">
                                <div class="space-y-4">
                                    <h2 class="text-4xl font-bold text-acef-dark dark:text-white tracking-tighter">{{ __('pages.get_involved.partner_form.title') }}</h2>
                                    <p class="text-gray-400 font-light italic text-sm">{{ __('pages.get_involved.partner_form.subtitle') }}</p>
                                </div>
                                <form class="space-y-8" action="mailto:partnerships@acef-ngo.org" method="POST" enctype="text/plain">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                        <div class="space-y-3">
                                            <label class="text-xs font-bold uppercase text-acef-dark dark:text-gray-300 tracking-widest">{{ __('pages.get_involved.partner_form.org_name') }}</label>
                                            <input type="text" name="org_name" required class="w-full px-8 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green text-acef-dark dark:text-white transition-all">
                                        </div>
                                        <div class="space-y-3">
                                            <label class="text-xs font-bold uppercase text-acef-dark dark:text-gray-300 tracking-widest">{{ __('pages.get_involved.partner_form.org_website') }}</label>
                                            <input type="url" name="website" placeholder="https://" required class="w-full px-8 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green text-acef-dark dark:text-white transition-all">
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                        <div class="space-y-3">
                                            <label class="text-xs font-bold uppercase text-acef-dark dark:text-gray-300 tracking-widest">{{ __('pages.get_involved.partner_form.contact_person') }}</label>
                                            <input type="text" name="contact_person" required class="w-full px-8 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green text-acef-dark dark:text-white transition-all">
                                        </div>
                                        <div class="space-y-3">
                                            <label class="text-xs font-bold uppercase text-acef-dark dark:text-gray-300 tracking-widest">{{ __('pages.get_involved.partner_form.email') }}</label>
                                            <input type="email" name="email" required class="w-full px-8 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green text-acef-dark dark:text-white transition-all">
                                        </div>
                                    </div>

                                    <div class="space-y-3">
                                        <label class="text-xs font-bold uppercase text-acef-dark dark:text-gray-300 tracking-widest">{{ __('pages.get_involved.partner_form.partnership_type_label') }}</label>
                                        <select name="partnership_type" required class="w-full px-8 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green transition-all text-gray-500 dark:text-gray-300">
                                            @foreach(__('pages.get_involved.partner_form.partnership_types') as $type)
                                                <option value="{{ $type }}">{{ $type }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="space-y-3">
                                        <label class="text-xs font-bold uppercase text-acef-dark dark:text-gray-300 tracking-widest">{{ __('pages.get_involved.partner_form.message_label') }}</label>
                                        <textarea name="message" rows="5" placeholder="{{ __('pages.get_involved.partner_form.message_placeholder') }}" required class="w-full px-8 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green text-acef-dark dark:text-white transition-all"></textarea>
                                    </div>

                                    <button class="w-full py-5 bg-acef-dark dark:bg-gray-900 text-white font-black rounded-2xl flex items-center justify-center space-x-3 hover:bg-acef-green hover:text-acef-dark transition-all shadow-xl">
                                        <span>{{ __('pages.get_involved.partner_form.submit_btn') }}</span>
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                    </button>
                                </form>
                            </div>

                            <!-- Collaborate Form -->
                            <div x-show="tab === 'collaborate'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-8" style="display: none;">
                                <div class="space-y-4">
                                    <h2 class="text-4xl font-bold text-acef-dark dark:text-white tracking-tighter">{{ __('pages.get_involved.collaborate_form.title') }}</h2>
                                    <p class="text-gray-400 font-light italic text-sm">{{ __('pages.get_involved.collaborate_form.subtitle') }}</p>
                                </div>
                                <form class="space-y-8" action="mailto:info@acef-ngo.org" method="POST" enctype="text/plain">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                        <div class="space-y-3">
                                            <label class="text-xs font-bold uppercase text-acef-dark dark:text-gray-300 tracking-widest">{{ __('pages.get_involved.collaborate_form.name') }}</label>
                                            <input type="text" name="name" required class="w-full px-8 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green text-acef-dark dark:text-white transition-all">
                                        </div>
                                        <div class="space-y-3">
                                            <label class="text-xs font-bold uppercase text-acef-dark dark:text-gray-300 tracking-widest">{{ __('pages.get_involved.collaborate_form.role') }}</label>
                                            <input type="text" name="role" placeholder="e.g. Journalist, Researcher" required class="w-full px-8 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green text-acef-dark dark:text-white transition-all">
                                        </div>
                                    </div>

                                    <div class="space-y-3">
                                        <label class="text-xs font-bold uppercase text-acef-dark dark:text-gray-300 tracking-widest">{{ __('pages.get_involved.collaborate_form.email') }}</label>
                                        <input type="email" name="email" required class="w-full px-8 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green text-acef-dark dark:text-white transition-all">
                                    </div>

                                    <div class="space-y-3">
                                        <label class="text-xs font-bold uppercase text-acef-dark dark:text-gray-300 tracking-widest">{{ __('pages.get_involved.collaborate_form.collaboration_type_label') }}</label>
                                        <select name="collaboration_type" required class="w-full px-8 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green transition-all text-gray-500 dark:text-gray-300">
                                            @foreach(__('pages.get_involved.collaborate_form.collaboration_types') as $type)
                                                <option value="{{ $type }}">{{ $type }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="space-y-3">
                                        <label class="text-xs font-bold uppercase text-acef-dark dark:text-gray-300 tracking-widest">{{ __('pages.get_involved.collaborate_form.message_label') }}</label>
                                        <textarea name="message" rows="5" placeholder="{{ __('pages.get_involved.collaborate_form.message_placeholder') }}" required class="w-full px-8 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green text-acef-dark dark:text-white transition-all"></textarea>
                                    </div>

                                    <button class="w-full py-5 bg-acef-dark dark:bg-gray-900 text-white font-black rounded-2xl flex items-center justify-center space-x-3 hover:bg-acef-green hover:text-acef-dark transition-all shadow-xl">
                                        <span>{{ __('pages.get_involved.collaborate_form.submit_btn') }}</span>
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>

                    <!-- Right Column: Donation Side & Testimonial -->
                    <div class="lg:w-1/3 space-y-8">
                        <!-- Quick Donate -->
                        <div class="bg-white dark:bg-gray-800 rounded-3xl p-10 border border-gray-100 dark:border-gray-700 shadow-sm space-y-8 transition-colors">
                            <div class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </div>
                            <h3 class="text-2xl font-bold text-acef-dark dark:text-white tracking-tighter">{{ __('pages.get_involved.quick_donate.title') }}</h3>
                            <p class="text-gray-400 text-sm font-light italic leading-relaxed">
                                {{ __('pages.get_involved.quick_donate.desc') }}
                            </p>
                            
                            <div class="grid grid-cols-3 gap-3">
                                <button class="py-3 bg-gray-50 dark:bg-gray-700 rounded-xl font-bold text-xs text-gray-400 dark:text-gray-300 hover:bg-acef-green hover:text-acef-dark transition-all">$25</button>
                                <button class="py-3 bg-acef-green rounded-xl font-bold text-xs text-acef-dark">$50</button>
                                <button class="py-3 bg-gray-50 dark:bg-gray-700 rounded-xl font-bold text-xs text-gray-400 dark:text-gray-300 hover:bg-acef-green hover:text-acef-dark transition-all">$100</button>
                            </div>
                            
                            <div class="relative">
                                <span class="absolute left-6 top-1/2 -translate-y-1/2 font-bold text-gray-300">$</span>
                                <input type="text" value="50" class="w-full pl-10 pr-6 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl font-bold text-acef-dark dark:text-white outline-none focus:ring-2 focus:ring-acef-green">
                            </div>

                            <a href="{{ route('donate') }}" class="block w-full py-5 bg-acef-gold text-acef-dark font-bold rounded-2xl hover:bg-white hover:text-acef-dark transition-all text-center shadow-lg">
                                {{ __('pages.get_involved.quick_donate.btn') }}
                            </a>
                        </div>

                        <!-- Testimonial -->
                        <div class="bg-acef-green/5 border border-acef-green/10 rounded-3xl p-10 space-y-8">
                            <div class="flex text-acef-green">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            </div>
                            <p class="text-acef-dark dark:text-gray-100 font-light italic leading-relaxed">
                                {!! __('pages.get_involved.testimonial.quote') !!}
                            </p>
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 rounded-full overflow-hidden grayscale">
                                    <img src="/hero_marine_ecosystem_1766827540454.png" alt="{{ __('pages.get_involved.testimonial.author') }}" class="w-full h-full object-cover">
                                </div>
                                <div class="space-y-0.5">
                                    <h4 class="font-bold text-sm text-acef-dark dark:text-white">{{ __('pages.get_involved.testimonial.author') }}</h4>
                                    <p class="text-xs font-bold text-acef-green uppercase tracking-widest">{{ __('pages.get_involved.testimonial.role') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Digital Impact CTA -->
                <div class="mt-32 bg-acef-dark rounded-3xl p-12 md:p-20 flex flex-col md:flex-row items-center justify-between gap-12 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute top-0 right-0 w-96 h-96 bg-acef-green rounded-full blur-3xl"></div>
                    </div>
                    
                    <div class="space-y-6 relative z-10 max-w-xl">
                        <h2 class="text-4xl md:text-5xl font-bold text-white tracking-tighter">{{ __('pages.get_involved.digital_cta.title') }}</h2>
                        <p class="text-white/40 text-sm font-light leading-relaxed italic">
                            {{ __('pages.get_involved.digital_cta.desc') }}
                        </p>
                        <div class="flex flex-wrap gap-6 pt-4">
                            @if($admin && $admin->business_card)
                            <a href="{{ Storage::url($admin->business_card) }}" download class="flex items-center space-x-2 text-acef-green font-bold text-xs hover:text-white transition-all">
                                <span>Download Business Card</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            </a>
                            @else
                            <button class="flex items-center space-x-2 text-acef-green font-bold text-xs hover:text-white transition-all">
                                <span>{{ __('pages.get_involved.digital_cta.media_kit') }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            </button>
                            @endif
                            <a href="https://twitter.com/intent/tweet?text=I'm%20supporting%20ACEF%20in%20their%20mission%20to%20drive%20climate%20resilience%20across%20Africa!%20Join%20us%20at%20https://acef-ngo.org" target="_blank" class="flex items-center space-x-2 text-acef-green font-bold text-xs hover:text-white transition-all">
                                <span>{{ __('pages.get_involved.digital_cta.share_twitter') }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                            </a>
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
