<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'page' => null,
    'slides' => [],
    'title' => null,
    'subtitle' => null,
    'breadcrumb' => null,
    'height' => 'h-[60vh]',
    'minHeight' => 'min-h-[500px]',
    'centered' => false,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'page' => null,
    'slides' => [],
    'title' => null,
    'subtitle' => null,
    'breadcrumb' => null,
    'height' => 'h-[60vh]',
    'minHeight' => 'min-h-[500px]',
    'centered' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $hasSlider = $page && $page->hero_slider_enabled && count($slides) > 0;
    $sliderDelay = $page ? ($page->hero_slider_delay ?? 5000) : 5000;
?>

<section <?php echo e($attributes->merge(['class' => "relative $height $minHeight overflow-hidden", 'style' => 'display: grid !important; place-items: center !important; align-content: center !important;'])); ?>

         <?php if($hasSlider): ?>
            x-data="{ 
                active: 0, 
                count: <?php echo e(count($slides)); ?>,
                next() { this.active = (this.active + 1) % this.count },
                init() { setInterval(() => this.next(), <?php echo e($sliderDelay); ?>) }
            }"
         <?php endif; ?>>
    
    <?php if($hasSlider): ?>
        <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div x-show="active === <?php echo e($index); ?>" 
                 x-transition:enter="transition ease-in-out duration-[3000ms]"
                 x-transition:enter-start="opacity-0 transform scale-105"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in-out duration-[3000ms]"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-105"
                 class="absolute inset-0 z-0">
                <img src="<?php echo e($slide->media ? $slide->media->url : $slide->image_url); ?>" 
                     alt="<?php echo e($slide->title ?? $page?->title); ?>" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/60 sm:bg-transparent sm:bg-gradient-to-r sm:from-black/90 sm:via-black/50 sm:to-transparent"></div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <!-- Single Static Hero (Homepage Baseline) -->
        <div class="absolute inset-0 z-0">
            <?php if(isset($image)): ?>
                <?php echo e($image); ?>

            <?php else: ?>
                <img src="<?php echo e($attributes->get('image-url', '/hero_marine_ecosystem_1766827540454.png')); ?>" 
                     alt="<?php echo e($title ?? 'ACEF'); ?>" 
                     class="w-full h-full object-cover">
            <?php endif; ?>
            <div class="absolute inset-0 bg-black/60 sm:bg-transparent sm:bg-gradient-to-r sm:from-black/90 sm:via-black/50 sm:to-transparent"></div>
        </div>
    <?php endif; ?>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full pt-36 pb-20 <?php echo e($centered ? 'flex flex-col items-center text-center' : ''); ?>">
        <div class="max-w-4xl space-y-6 md:space-y-8 <?php echo e($centered ? 'mx-auto' : ''); ?>">
            <?php if($hasSlider): ?>
                
                <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div x-show="active === <?php echo e($index); ?>" 
                         x-transition:enter="transition ease-in-out duration-1000"
                         x-transition:enter-start="opacity-0 transform translate-y-4"
                         x-transition:enter-end="opacity-100 transform translate-y-0">
                        
                        <?php if($breadcrumb): ?>
                            <p class="text-acef-green font-bold tracking-widest uppercase text-sm mb-2">
                                <?php echo e($breadcrumb); ?>

                            </p>
                        <?php endif; ?>

                        <h1 class="text-4xl md:text-6xl font-black text-white leading-tight tracking-tighter animate-fade-in-up">
                            <?php echo $slide->title ?: ($title ?? ($page ? $page->title : '')); ?>

                        </h1>

                        <?php if($slide->subtitle || $subtitle): ?>
                            <p class="text-lg md:text-xl font-medium text-white leading-relaxed max-w-2xl animate-fade-in-up delay-100 italic drop-shadow-md">
                                <?php echo $slide->subtitle ?: $subtitle; ?>

                            </p>
                        <?php endif; ?>

                        <?php if($slide->button_text && $slide->button_link): ?>
                            
                            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6 pt-4 animate-fade-in-up delay-200">
                                <a href="<?php echo e($slide->button_link); ?>"
                                    class="bg-acef-green text-white px-8 py-4 rounded-xl font-bold text-lg hover:scale-105 transition-transform shadow-2xl shadow-acef-green/30 flex items-center justify-center group gap-2">
                                    <?php echo e($slide->button_text); ?>

                                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        <?php elseif(isset($actions)): ?>
                            
                            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6 pt-4 animate-fade-in-up delay-200">
                                <?php echo e($actions); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                
                <?php if($breadcrumb): ?>
                    <p class="text-acef-green font-bold tracking-widest uppercase text-sm mb-2">
                        <?php echo e($breadcrumb); ?>

                    </p>
                <?php endif; ?>

                <h1 class="text-4xl md:text-6xl font-black text-white leading-tight tracking-tighter animate-fade-in-up">
                    <?php echo $title ?? ($page ? $page->title : ''); ?>

                </h1>

                <?php if($subtitle): ?>
                    <p class="text-lg md:text-xl font-medium text-white leading-relaxed max-w-2xl animate-fade-in-up delay-100 italic drop-shadow-md">
                        <?php echo $subtitle; ?>

                    </p>
                <?php endif; ?>

                <?php if(isset($actions)): ?>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6 pt-4 animate-fade-in-up delay-200">
                        <?php echo e($actions); ?>

                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php if($hasSlider): ?>
        <!-- Slider Indicators -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-20 flex gap-3">
            <template x-for="i in count" :key="i">
                <button @click="active = i-1" 
                        :class="active === i-1 ? 'bg-acef-green w-8' : 'bg-white/30 w-2 hover:bg-white/50'"
                        class="h-2 rounded-full transition-all duration-500"></button>
            </template>
        </div>
    <?php else: ?>
        <!-- Scroll Indicator (Homepage Style) -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 text-white animate-bounce hidden md:block">
            <svg class="w-6 h-6 text-acef-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
    <?php endif; ?>
</section>
<?php /**PATH C:\Users\ADMIN\Desktop\aceflaravel\acef\resources\views/components/hero.blade.php ENDPATH**/ ?>