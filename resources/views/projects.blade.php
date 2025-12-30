<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" content="notranslate">
    <title>{{ strip_tags(__('pages.projects_page.hero_title')) }} - ACEF</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans bg-white overflow-x-hidden">
    @include('components.header')

    <!-- Projects Hero -->
    <section class="relative h-[60vh] min-h-[500px] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="/hero_marine_ecosystem_1766827540454.png" alt="Projects" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-acef-dark via-acef-dark/40 to-transparent"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full pt-20">
            <div class="max-w-3xl space-y-6">
                <span
                    class="bg-acef-green/20 backdrop-blur-md text-acef-green px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider border border-acef-green/30">
                    {{ __('pages.projects_page.badge') }}
                </span>
                <h1 class="text-5xl md:text-7xl font-black text-white leading-tight tracking-tighter">
                    {!! __('pages.projects_page.hero_title') !!}
                </h1>
                <p class="text-lg md:text-xl text-white/70 font-light leading-relaxed max-w-2xl italic">
                    {{ __('pages.projects_page.hero_subtitle') }}
                </p>
            </div>
        </div>
    </section>

    <main class="bg-gray-50 min-h-screen" x-data="{
        category: '',
        country: '',
        status: '',
        search: '',
        checkVisible(item) {
            // Normalise search
            const searchLower = this.search.toLowerCase();
            const titleMatch = item.title.toLowerCase().includes(searchLower);
            const catMatch = item.category.toLowerCase().includes(searchLower);
            
            // Category Filter
            const matchesCategory = this.category === '' || item.category === this.category;
            
            // Country Filter (Location usually contains 'City, Country')
            const matchesCountry = this.country === '' || item.location.includes(this.country);
            
            // Status Filter
            const matchesStatus = this.status === '' || item.status === this.status;

            return (titleMatch || catMatch) && matchesCategory && matchesCountry && matchesStatus;
        }
    }">
        <!-- Filter Bar -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-30 -mt-12">
            <div
                class="bg-white p-6 rounded-3xl shadow-2xl border border-gray-100 flex flex-wrap items-center justify-between gap-6">
                <div class="flex flex-wrap items-center gap-4">
                    <select x-model="category"
                        class="bg-gray-50 border-none rounded-2xl py-3 px-6 text-sm font-bold text-gray-500 focus:ring-2 focus:ring-acef-green">
                        <option value="">{{ __('pages.projects_page.filter_category') }}</option>
                        <option value="{{ __('pages.filters.categories.reforestation') }}">{{ __('pages.filters.categories.reforestation') }}</option>
                        <option value="{{ __('pages.filters.categories.energy') }}">{{ __('pages.filters.categories.energy') }}</option>
                        <option value="{{ __('pages.filters.categories.water') }}">{{ __('pages.filters.categories.water') }}</option>
                        <option value="{{ __('pages.filters.categories.agriculture') }}">{{ __('pages.filters.categories.agriculture') }}</option>
                    </select>
                    <select x-model="country"
                        class="bg-gray-50 border-none rounded-2xl py-3 px-6 text-sm font-bold text-gray-500 focus:ring-2 focus:ring-acef-green">
                        <option value="">{{ __('pages.projects_page.filter_country') }}</option>
                        <option value="{{ __('pages.filters.countries.kenya') }}">{{ __('pages.filters.countries.kenya') }}</option>
                        <option value="{{ __('pages.filters.countries.uganda') }}">{{ __('pages.filters.countries.uganda') }}</option>
                        <option value="{{ __('pages.filters.countries.tanzania') }}">{{ __('pages.filters.countries.tanzania') }}</option>
                        <option value="{{ __('pages.filters.countries.rwanda') }}">{{ __('pages.filters.countries.rwanda') }}</option>
                    </select>
                    <select x-model="status"
                        class="bg-gray-50 border-none rounded-2xl py-3 px-6 text-sm font-bold text-gray-500 focus:ring-2 focus:ring-acef-green">
                        <option value="">{{ __('pages.projects_page.filter_status') }}</option>
                        <option value="{{ __('pages.projects_page.status.ongoing') }}">{{ __('pages.projects_page.status.ongoing') }}</option>
                        <option value="{{ __('pages.projects_page.status.completed') }}">{{ __('pages.projects_page.status.completed') }}</option>
                        <option value="{{ __('pages.projects_page.status.starting') }}">{{ __('pages.projects_page.status.starting') }}</option>
                    </select>
                </div>

                <div class="relative flex-1 max-w-sm">
                    <input type="text" x-model="search" placeholder="{{ __('pages.projects_page.search_placeholder') }}"
                        class="w-full pl-12 pr-6 py-3 bg-gray-50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-acef-green">
                    <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Projects Grid -->
        <section class="py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach(__('pages.projects_page.list') as $proj)
                        <div x-show="checkVisible({{ json_encode($proj) }})" x-transition
                            class="bg-white rounded-[40px] overflow-hidden shadow-sm hover:shadow-2xl transition-all group">
                            <div class="relative aspect-[4/3] overflow-hidden">
                                <img src="{{ $proj['image'] }}" alt="{{ $proj['title'] }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute top-6 left-6">
                                    <span
                                        class="bg-white/90 backdrop-blur-md text-acef-dark px-4 py-1.5 rounded-xl text-[10px] font-bold uppercase tracking-wider shadow-sm">
                                        {{ $proj['category'] }}
                                    </span>
                                </div>
                                @if($proj['status'] === 'Completed')
                                    <div class="absolute top-6 right-6">
                                        <span
                                            class="bg-acef-green text-acef-dark px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l5-5z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Funded
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <div class="p-10 space-y-6">
                                <div class="space-y-2">
                                    <div
                                        class="flex items-center text-acef-green text-[10px] font-bold uppercase tracking-widest">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $proj['location'] }}
                                    </div>
                                    <h3
                                        class="text-2xl font-black text-acef-dark leading-tight group-hover:text-acef-green transition-colors">
                                        {{ $proj['title'] }}
                                    </h3>
                                </div>

                                <div class="space-y-2">
                                    <div class="flex justify-between text-xs font-bold whitespace-nowrap">
                                        <span class="text-acef-dark">{{ $proj['raised'] }} raised</span>
                                        <span class="text-gray-400">{{ $proj['goal_percent'] }}%</span>
                                    </div>
                                    <div class="h-2 w-full bg-gray-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-acef-green rounded-full transition-all duration-1000"
                                            style="width: {{ $proj['goal_percent'] }}%"></div>
                                    </div>
                                </div>

                                <div class="flex justify-between items-center pt-2">
                                    <span
                                        class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $proj['status'] === 'Ongoing' ? 'bg-acef-green/10 text-acef-green' : ($proj['status'] === 'Completed' ? 'bg-blue-100 text-blue-600' : 'bg-orange-100 text-orange-600') }}">
                                        {{ $proj['status'] }}
                                    </span>
                                    <a href="{{ route('projects') }}"
                                        class="text-acef-dark font-black text-xs flex items-center hover:text-acef-green transition-colors">
                                        {{ $proj['status'] === 'Completed' ? 'View Impact' : 'View Project' }}
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-center pt-12">
                    <button
                        class="bg-white border-2 border-gray-100 text-acef-dark font-black px-12 py-4 rounded-2xl hover:bg-acef-dark hover:text-white hover:border-acef-dark transition-all flex items-center space-x-2">
                        <span>{{ __('pages.projects_page.load_more') }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        </section>
    </main>

    @include('components.footer')
</body>

</html>