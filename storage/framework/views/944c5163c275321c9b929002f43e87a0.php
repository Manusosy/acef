<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" translate="no" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" content="notranslate">
    <title><?php echo e(__('navigation.about')); ?> - ACEF</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <?php
        $generalSettings = \App\Models\Setting::getGroup('general');
        $siteFavicon = $generalSettings['site_favicon'] ?? null;
        $aboutPage = \App\Models\Page::where('slug', 'about')->first();
        $heroSlides = $aboutPage ? $aboutPage->activeHeroSlides()->with('media')->get() : collect();
    ?>

    <?php if($siteFavicon): ?>
        <link rel="icon" type="image/x-icon" href="<?php echo e(Storage::url($siteFavicon)); ?>">
    <?php endif; ?>
</head>

<body class="antialiased font-sans bg-white dark:bg-gray-900 overflow-x-hidden transition-colors duration-500">
    <?php echo $__env->make('components.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => ['page' => $aboutPage,'slides' => $heroSlides,'breadcrumb' => ''.e(__('navigation.about')).' ACEF','title' => ''.__('pages.about.hero_title').'','subtitle' => ''.e(__('pages.about.hero_subtitle')).'','imageUrl' => '/mission_vision_africa_1766827653058.png']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['page' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($aboutPage),'slides' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($heroSlides),'breadcrumb' => ''.e(__('navigation.about')).' ACEF','title' => ''.__('pages.about.hero_title').'','subtitle' => ''.e(__('pages.about.hero_subtitle')).'','image-url' => '/mission_vision_africa_1766827653058.png']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal04f02f1e0f152287a127192de01fe241)): ?>
<?php $attributes = $__attributesOriginal04f02f1e0f152287a127192de01fe241; ?>
<?php unset($__attributesOriginal04f02f1e0f152287a127192de01fe241); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal04f02f1e0f152287a127192de01fe241)): ?>
<?php $component = $__componentOriginal04f02f1e0f152287a127192de01fe241; ?>
<?php unset($__componentOriginal04f02f1e0f152287a127192de01fe241); ?>
<?php endif; ?>

    <main>
        <!-- Who We Are Section -->
        <section x-data="{ shown: false }" x-intersect.once.margin.0px.0px.-100px.0px="shown = true" 
                 class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" :class="{ 'animate-fade-in-up': shown }">
                <div class="flex flex-col lg:flex-row gap-20 items-center">
                    <div class="w-full lg:w-1/2 relative">
                        <div class="relative z-10 rounded-xl overflow-hidden shadow-2xl h-[280px] sm:h-[400px] lg:h-auto lg:aspect-[4/3] w-full max-w-xl mx-auto bg-gray-100">
                            <?php if(isset($whoWeAreImages) && $whoWeAreImages->isNotEmpty()): ?>
                                <div x-data="{ 
                                    active: 0, 
                                    count: <?php echo e($whoWeAreImages->count()); ?>,
                                    timer: null,
                                    next() { this.active = (this.active + 1) % this.count },
                                    start() { this.timer = setInterval(() => this.next(), 8000) },
                                    stop() { clearInterval(this.timer) }
                                }" x-init="start()" @mouseenter="stop()" @mouseleave="start()" class="relative w-full h-full">
                                    
                                    <?php $__currentLoopData = $whoWeAreImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div x-show="active === <?php echo e($index); ?>"
                                             x-transition:enter="transition ease-in-out duration-[2000ms]"
                                             x-transition:enter-start="opacity-0 -translate-y-full"
                                             x-transition:enter-end="opacity-100 translate-y-0"
                                             x-transition:leave="transition ease-in-out duration-[2000ms]"
                                             x-transition:leave-start="opacity-100 translate-y-0"
                                             x-transition:leave-end="opacity-0 translate-y-full"
                                             class="absolute inset-0 w-full h-full">
                                            <?php if($image->media): ?>
                                                <img src="<?php echo e($image->media->url); ?>" alt="<?php echo e($image->caption ?? 'ACEF Work'); ?>" 
                                                     class="w-full h-full object-cover">
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    
                                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-1.5 z-20">
                                        <template x-for="i in count" :key="i">
                                            <div :class="active === i-1 ? 'bg-acef-green w-4' : 'bg-white/50 w-1'"
                                                    class="h-1 rounded-full transition-all duration-300"></div>
                                        </template>
                                    </div>
                                </div>
                            <?php else: ?>
                                <img src="/mission_vision_africa_1766827653058.png" alt="Who We Are"
                                    class="w-full h-full object-cover">
                            <?php endif; ?>
                        </div>
                        <!-- Decorative Accents -->
                        <div class="absolute -top-4 -left-4 w-20 h-20 border-2 border-acef-green rounded-xl -z-0 opacity-20"></div>
                    </div>
                    <div class="lg:w-1/2 space-y-6">
                        <div class="space-y-4">
                            <h2 class="text-5xl font-black text-acef-dark tracking-tighter">
                                <?php echo __('pages.about.who_we_are_title'); ?>

                            </h2>
                            <div class="w-16 h-1.5 bg-acef-green rounded-full"></div>
                        </div>
                        <p class="text-xl text-acef-dark font-normal leading-relaxed">
                            <?php echo __('pages.about.who_we_are_text'); ?>

                        </p>
                    </div>
                </div>

                <!-- MVV Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-24">
                    <div
                        class="bg-acef-gray p-10 rounded-2xl border border-black/5 hover:shadow-xl transition-all h-full flex flex-col text-center">
                        <h3 class="text-2xl font-bold text-acef-dark mb-4"><?php echo e(__('pages.about.mission_title')); ?></h3>
                        <p class="text-gray-500 leading-relaxed font-light"><?php echo e(__('pages.about.mission_desc')); ?></p>
                    </div>
                    <div
                        class="bg-acef-gray p-10 rounded-2xl border border-black/5 hover:shadow-xl transition-all h-full flex flex-col text-center">
                        <h3 class="text-2xl font-bold text-acef-dark mb-4"><?php echo e(__('pages.about.vision_title')); ?></h3>
                        <p class="text-gray-500 leading-relaxed font-light"><?php echo e(__('pages.about.vision_desc')); ?></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Founder Section -->
        <section x-data="{ shown: false }" x-intersect.once.margin.0px.0px.-100px.0px="shown = true"
                 class="py-24 bg-acef-dark relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" :class="{ 'animate-fade-in-up': shown }">
                <div class="flex flex-col md:flex-row items-center gap-16">
                    <div class="md:w-1/3 flex justify-center">
                        <div class="relative">
                            <div class="w-64 h-64 rounded-full overflow-hidden border-4 border-acef-green shadow-2xl bg-gray-100">
                                <?php if(isset($founder) && $founder && $founder->image): ?>
                                    <img src="<?php echo e(Storage::url($founder->image)); ?>" alt="<?php echo e($founder->name); ?>"
                                        class="w-full h-full object-cover">
                                <?php else: ?>
                                    <img src="/mission_vision_africa_1766827653058.png" alt="Founder Placeholder"
                                        class="w-full h-full object-cover">
                                <?php endif; ?>
                            </div>
                            <div
                                class="absolute -bottom-2 -right-2 bg-acef-green w-10 h-10 rounded-full flex items-center justify-center shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M13.293 6.293a1 1 0 011.414 0l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414-1.414L16.586 13H5a1 1 0 110-2h11.586l-3.293-3.293a1 1 0 010-1.414z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="md:w-2/3 text-white space-y-6">
                        <p class="text-acef-green font-bold tracking-widest uppercase text-xs">
                            <?php echo e(__('pages.about.founder_title')); ?></p>
                        <h2 class="text-4xl font-bold leading-tight">
                            <?php echo __('pages.about.founder_quote'); ?>

                        </h2>
                        <div class="space-y-4 text-white/60 font-light leading-relaxed">
                            <p>
                                <?php echo e(__('pages.about.founder_text_1')); ?>

                            </p>
                            <p>
                                <?php echo e(__('pages.about.founder_text_2')); ?>

                            </p>
                        </div>
                        <div class="pt-4">
                            <p class="font-bold text-xl uppercase tracking-tighter"><?php echo e(__('pages.about.founder_name')); ?>

                            </p>
                            <p class="text-acef-green text-sm italic"><?php echo e(__('pages.about.founder_role')); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Core Values -->
        <section x-data="{ shown: false }" x-intersect.once.margin.0px.0px.-100px.0px="shown = true"
                 class="py-24 bg-acef-gray/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" :class="{ 'animate-fade-in-up': shown }">
                <div class="text-center space-y-4 mb-20">
                    <p class="text-acef-green font-bold tracking-widest uppercase text-sm">
                        <?php echo e(__('pages.about.values_title')); ?></p>
                    <h2 class="text-5xl font-black text-acef-dark tracking-tighter">
                        <?php echo e(__('pages.about.values_heading')); ?></h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php $__currentLoopData = __('pages.about.values'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div
                            class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all group flex flex-col items-center text-center space-y-6">
                            <div
                                class="w-16 h-16 bg-acef-green/5 rounded-2xl flex items-center justify-center text-acef-green group-hover:bg-acef-green group-hover:text-white transition-all duration-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="<?php echo e($v['icon']); ?>"></path>
                                </svg>
                            </div>
                            <div class="space-y-2">
                                <h4 class="text-xl font-bold text-acef-dark tracking-tight"><?php echo e($v['title']); ?></h4>
                                <p class="text-gray-500 font-light italic leading-relaxed"><?php echo e($v['desc']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>

        <!-- Strategic Objectives -->
        <section x-data="{ shown: false }" x-intersect.once.margin.0px.0px.-100px.0px="shown = true"
                 class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" :class="{ 'animate-fade-in-up': shown }">
                <div class="text-center mb-16 space-y-4">
                    <p class="text-acef-green font-bold tracking-widest uppercase text-sm">
                        <?php echo e(__('pages.about.strategic_focus')); ?></p>
                    <h2 class="text-5xl font-black text-acef-dark tracking-tighter">
                        <?php echo e(__('pages.about.objectives_heading')); ?></h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php $__currentLoopData = __('pages.about.objectives'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $obj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div
                            class="p-8 rounded-2xl border border-gray-100 hover:border-acef-green/30 hover:shadow-xl transition-all group">
                            <div class="flex items-start space-x-4">
                                <div
                                    class="w-1.5 h-8 bg-acef-green rounded-full group-hover:scale-y-125 transition-transform">
                                </div>
                                <div class="space-y-2">
                                    <h4
                                        class="text-xl font-bold text-acef-dark group-hover:text-acef-green transition-colors">
                                        <?php echo e($obj['title']); ?></h4>
                                    <p class="text-gray-500 font-light leading-relaxed"><?php echo e($obj['desc']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>

        <!-- Journey Timeline -->
        <section x-data="{ shown: false }" x-intersect.once.margin.0px.0px.-100px.0px="shown = true"
                 class="py-24 bg-white overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" :class="{ 'animate-fade-in-up': shown }">
                <h2 class="text-center text-4xl font-black text-acef-dark mb-20 tracking-tighter">
                    <?php echo e(__('pages.about.journey_heading')); ?></h2>

                <div class="relative">
                    <!-- Vertical line with progress -->
                    <div class="absolute left-1/2 -translate-x-1/2 h-full w-1 bg-gray-100 rounded-full overflow-hidden">
                        <div id="journey-progress" class="w-full bg-acef-green origin-top h-0 transition-all duration-300"></div>
                    </div>

                    <div class="space-y-24">
                        <?php $__currentLoopData = __('pages.about.journey'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="relative flex items-center justify-between" x-data="{ shown: false }" x-intersect.threshold.0.3="shown = true">
                                <?php if($loop->odd): ?>
                                    <div class="w-5/12 text-right pr-12 transition-all duration-1000 ease-out transform"
                                         :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-20'">
                                        <span class="text-acef-green font-black text-xl mb-2 block"><?php echo e($step['year']); ?></span>
                                        <h4 class="text-xl font-bold text-acef-dark mb-2"><?php echo e($step['title']); ?></h4>
                                        <p class="text-gray-500"><?php echo e($step['desc']); ?></p>
                                    </div>
                                    <div
                                        class="absolute left-1/2 -translate-x-1/2 w-6 h-6 rounded-full bg-acef-green border-4 border-white shadow-lg z-10 transition-all duration-700 delay-300"
                                        :class="shown ? 'scale-100 opacity-100' : 'scale-0 opacity-0'">
                                    </div>
                                    <div class="w-5/12"></div>
                                <?php else: ?>
                                    <div class="w-5/12"></div>
                                    <div
                                        class="absolute left-1/2 -translate-x-1/2 w-6 h-6 rounded-full bg-acef-green border-4 border-white shadow-lg z-10 transition-all duration-700 delay-300"
                                        :class="shown ? 'scale-100 opacity-100' : 'scale-0 opacity-0'">
                                    </div>
                                    <div class="w-5/12 pl-12 transition-all duration-1000 ease-out transform"
                                         :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-20'">
                                        <span class="text-acef-green font-black text-xl mb-2 block"><?php echo e($step['year']); ?></span>
                                        <h4 class="text-xl font-bold text-acef-dark mb-2"><?php echo e($step['title']); ?></h4>
                                        <p class="text-gray-500"><?php echo e($step['desc']); ?></p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section x-data="{ shown: false }" x-intersect.once.margin.0px.0px.-100px.0px="shown = true"
                 class="py-24 bg-acef-gray">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16" :class="{ 'animate-fade-in-up': shown }">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end gap-6">
                    <div class="space-y-4 text-left">
                        <h2 class="text-5xl font-black text-acef-dark tracking-tighter">
                            <?php echo e(__('pages.about.team_heading')); ?></h2>
                        <p class="text-gray-500 font-light italic"><?php echo e(__('pages.about.team_subheading')); ?></p>
                    </div>
                    <a href="<?php echo e(route('team')); ?>" class="text-acef-green font-bold flex items-center group sm:pb-2">
                        <?php echo e(__('buttons.view_all_team')); ?> <svg
                            class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
                    <?php $__currentLoopData = $leadership; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="group">
                            <div
                                class="relative rounded-2xl overflow-hidden mb-6 aspect-square grayscale group-hover:grayscale-0 transition-all duration-500 shadow-xl bg-gray-100">
                                <?php if($member->image): ?>
                                    <img src="<?php echo e(Storage::url($member->image)); ?>"
                                        alt="<?php echo e($member->name); ?>"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <h4 class="text-xl font-bold text-acef-dark"><?php echo e($member->name); ?></h4>
                            <p class="text-acef-green font-medium text-sm"><?php echo e($member->role); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    </main>

    <?php echo $__env->make('components.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const journeySection = document.querySelector('.relative.flex.items-center.justify-between').closest('section');
            const progressLine = document.getElementById('journey-progress');
            
            if (journeySection && progressLine) {
                const updateProgress = () => {
                    const rect = journeySection.getBoundingClientRect();
                    const windowHeight = window.innerHeight;
                    
                    if (rect.top < windowHeight && rect.bottom > 0) {
                        const totalHeight = rect.height;
                        const scrollIn = windowHeight - rect.top;
                        const progress = Math.min(100, Math.max(0, (scrollIn / (totalHeight + windowHeight/2)) * 120));
                        progressLine.style.height = `${progress}%`;
                    }
                };

                window.addEventListener('scroll', updateProgress);
                updateProgress();
            }
        });
    </script>
</body>

</html><?php /**PATH C:\Users\ADMIN\Desktop\aceflaravel\acef\resources\views/about.blade.php ENDPATH**/ ?>