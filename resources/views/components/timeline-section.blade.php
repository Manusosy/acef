@props(['years'])

@if($years->count() > 0)
<section class="py-16 md:py-20 bg-acef-light-green relative overflow-hidden font-sans select-none" id="timeline-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10" 
         x-data="{ 
            activeYearId: {{ $years->last()->id }},
            isScrolling: false,
            scrollTimeout: null,
            
            init() {
                // Initial center alignment
                this.$nextTick(() => {
                    this.scrollToYear(this.activeYearId);
                });
            },

            handleScroll() {
                this.isScrolling = true;
                clearTimeout(this.scrollTimeout);
                
                // Debounce scroll stop
                this.scrollTimeout = setTimeout(() => {
                    this.isScrolling = false;
                    this.detectActiveYear();
                }, 100);
            },

            detectActiveYear() {
                const container = this.$refs.navContainer;
                const containerCenter = container.scrollLeft + (container.offsetWidth / 2);
                
                let closestId = null;
                let minDiff = Infinity;

                // Find node closest to visual center
                container.querySelectorAll('[data-year-id]').forEach(el => {
                    // Calculate center based on offsetLeft relative to container flow
                    const elCenter = el.offsetLeft + (el.offsetWidth / 2);
                    const diff = Math.abs(containerCenter - elCenter);
                    
                    if (diff < minDiff) {
                        minDiff = diff;
                        closestId = parseInt(el.dataset.yearId);
                    }
                });

                if (closestId && closestId !== this.activeYearId) {
                    this.activeYearId = closestId;
                    this.scrollToYear(closestId); // Snap to it
                }
            },

            scrollToYear(id) {
                this.activeYearId = id;
                const container = this.$refs.navContainer;
                const el = document.getElementById('year-btn-' + id);
                if (el) {
                    // Manual pixel-perfect scrolling
                    const scrollLeft = el.offsetLeft - (container.offsetWidth / 2) + (el.offsetWidth / 2);
                    container.scrollTo({ left: scrollLeft, behavior: 'smooth' });
                }
            }
         }">
        
        <!-- Header -->
        <div class="text-center mb-20">
            <h2 class="text-3xl md:text-5xl font-black text-white mb-4 tracking-tight drop-shadow-sm">
                Key Engagements & Achievements
            </h2>
            <p class="text-lg text-white/90 font-medium max-w-2xl mx-auto">
                Discover our achievements and milestones throughout the years
            </p>
        </div>

        <!-- Timeline Navigation (Carousel) -->
        <div class="relative mb-12 w-full group">
            
            <!-- Fixed Central Pointer Removed -->

            <!-- Navigation Controls (Desktop) -->


            <!-- The Track (Dotted Background) -->
            <div class="absolute top-1/2 left-0 right-0 h-0 border-t-[3px] border-dotted border-white/60 dark:border-gray-500/50 -translate-y-1/2 z-0"></div>
            
            <!-- Nodes Container -->
            <style>
                .scrollbar-hide::-webkit-scrollbar { display: none; }
                .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
            </style>
            
            <div class="relative flex items-center overflow-x-auto pb-12 pt-12 px-[50vw] scrollbar-hide snap-x snap-mandatory gap-32 md:gap-48"
                 x-ref="navContainer"
                 @scroll="handleScroll()">
                 
                @foreach($years as $index => $year)
                    <button 
                        id="year-btn-{{ $year->id }}"
                        data-year-id="{{ $year->id }}"
                        @click="scrollToYear({{ $year->id }})"
                        class="relative flex-shrink-0 group focus:outline-none transition-all duration-300 transform snap-center z-10"
                        :class="activeYearId === {{ $year->id }} ? 'scale-110' : 'scale-90 opacity-100 hover:scale-100'"
                    >
                        <!-- Square Node -->
                        <div class="w-16 h-16 md:w-20 md:h-20 flex items-center justify-center transition-all duration-300 rounded-lg shadow-xl relative overflow-hidden"
                             :class="activeYearId === {{ $year->id }} 
                                 ? 'bg-acef-green text-white shadow-2xl ring-4 ring-white/20' 
                                 : 'bg-white dark:bg-white/10 text-acef-green dark:text-white shadow-md border-0'">                            
                            <!-- Year Label (Inside) -->
                            <span class="font-black text-lg md:text-xl tracking-tighter"
                                  :class="activeYearId === {{ $year->id }} ? 'text-white' : 'text-acef-green dark:text-white'">
                                {{ $year->year }}
                            </span>
                        </div>
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Achievements Content Area -->
        <div class="relative min-h-[300px] max-w-5xl mx-auto px-4 mt-6">
            @foreach($years as $year)
                <div x-show="activeYearId === {{ $year->id }}" 
                     x-transition:enter="transition ease-out duration-700"
                     x-transition:enter-start="opacity-0 translate-y-8 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     x-transition:leave="transition ease-in duration-300 absolute top-0 w-full"
                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                     x-transition:leave-end="opacity-0 -translate-y-8 scale-95"
                     class="w-full"
                >
                    @if($year->achievements->count() > 0)
                        <div class="flex flex-col gap-12">
                            @foreach($year->achievements as $achievement)
                                <div class="bg-[#f0fdf4] rounded-lg overflow-hidden shadow-2xl shadow-[#134712]/10 border border-white/40 ring-1 ring-black/5 transform transition-all duration-500 hover:-translate-y-1">
                                    <div class="flex flex-col md:flex-row">
                                        <!-- Visual Side -->
                                        <div class="md:w-5/12 relative min-h-[300px] md:min-h-full bg-gray-100">
                                            @if(!empty($achievement->images))
                                                <div class="absolute inset-0" x-data="{ 
                                                        currentSlide: 0, 
                                                        total: {{ count($achievement->images) }},
                                                        next() { this.currentSlide = (this.currentSlide + 1) % this.total },
                                                        init() { 
                                                            if (this.total > 1) {
                                                                setInterval(() => this.next(), 5000);
                                                            }
                                                        }
                                                    }">
                                                    @foreach($achievement->images as $index => $img)
                                                        <div x-show="currentSlide === {{ $index }}" 
                                                             x-transition:enter="transition ease-in-out duration-[3000ms]"
                                                             x-transition:enter-start="opacity-0 transform scale-105"
                                                             x-transition:enter-end="opacity-100 transform scale-100"
                                                             x-transition:leave="transition ease-in-out duration-[3000ms]"
                                                             x-transition:leave-start="opacity-100 transform scale-100"
                                                             x-transition:leave-end="opacity-0 transform scale-105"
                                                             class="absolute inset-0">
                                                            <img src="{{ str_starts_with($img, 'http') ? $img : Storage::url($img) }}" class="w-full h-full object-cover">
                                                        </div>
                                                    @endforeach
                                                    
                                                    @if(count($achievement->images) > 1)
                                                        <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-2 z-20">
                                                            <template x-for="i in total">
                                                                <button @click="currentSlide = i-1" 
                                                                        class="h-1.5 rounded-full transition-all shadow-sm backdrop-blur-sm"
                                                                        :class="currentSlide === i-1 ? 'w-8 bg-white' : 'w-2 bg-white/50 hover:bg-white/80'">
                                                                </button>
                                                            </template>
                                                        </div>
                                                    @endif
                                                </div>
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-[#E5ECE6]">
                                                    <svg class="w-20 h-20 text-[#8dba8e]/30" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-5.04-6.71l-2.75 3.54-1.96-2.36L6.5 17h11l-3.54-4.71z"/></svg>
                                                </div>
                                            @endif


                                        </div>

                                        <!-- Content Side -->
                                        <div class="flex-1 p-8 md:p-12 flex flex-col justify-center relative bg-gradient-to-br from-white to-[#f0fdf4]">
                                            <div class="absolute top-0 left-12 w-[2px] h-8 bg-gradient-to-b from-[#134712] to-transparent opacity-20 md:hidden"></div>

                                            @if($achievement->location)
                                                <div class="flex items-center gap-2 text-[#134712] opacity-70 mb-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                    <span class="text-xs font-bold uppercase tracking-widest">{{ $achievement->location }}</span>
                                                </div>
                                            @endif

                                            <h3 class="text-3xl font-black text-[#134712] mb-6 leading-tight tracking-tight">
                                                {{ $achievement->title }}
                                            </h3>
                                            <div class="prose prose-lg text-[#374151] leading-relaxed">
                                                {!! $achievement->description !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-20 bg-white/50 rounded-3xl border border-white/60">
                            <p class="text-[#2d4a2d] text-lg font-medium">Stories from {{ $year->year }} are coming soon.</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
