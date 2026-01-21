<?php if (isset($component)) { $__componentOriginal042bf45a5a9c7fed57eef9c73c080db3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal042bf45a5a9c7fed57eef9c73c080db3 = $attributes; } ?>
<?php $component = App\View\Components\AppDashboardLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-dashboard-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppDashboardLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> Who We Are Images <?php $__env->endSlot(); ?>
     <?php $__env->slot('title', null, []); ?> Manage Carousel <?php $__env->endSlot(); ?>

    <div class="max-w-5xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Carousel Images</h3>
            <button x-data @click="$dispatch('open-media-picker', { callback: 'addImage', options: { multiple: true } })" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Image
            </button>
        </div>

        <div id="imagesContainer" class="space-y-4" x-data="{ 
            editingId: null,
            async updateImage(id) {
                const form = document.querySelector(`#image-form-${id}`);
                const formData = new FormData(form);
                const data = Object.fromEntries(formData.entries());
                data.is_active = formData.get('is_active') === '1';

                const response = await fetch(`/admin/who-we-are-images/${id}`, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>', 'Accept': 'application/json' },
                    body: JSON.stringify(data)
                });
                if (response.ok) {
                    this.editingId = null;
                    location.reload();
                }
            }
        }">
            <?php $__empty_1 = true; $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700 shadow-sm transition-all group" :class="editingId === <?php echo e($image->id); ?> ? 'ring-2 ring-emerald-500' : ''">
                    <div class="flex items-start gap-6 p-4">
                        <!-- Image Preview -->
                        <div class="w-40 h-28 rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-900 flex-shrink-0 border border-gray-200 dark:border-gray-700">
                            <?php if($image->media): ?>
                                <img src="<?php echo e($image->media->url); ?>" alt="" class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0" x-show="editingId !== <?php echo e($image->id); ?>">
                            <div class="flex items-center gap-3 mb-2">
                                <?php if($image->country): ?>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/></svg>
                                        <?php echo e($image->country); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="text-xs text-gray-400 italic">No country specified</span>
                                <?php endif; ?>
                                
                                <span class="px-2 py-0.5 text-[10px] font-bold uppercase rounded-full <?php echo e($image->is_active ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30' : 'bg-gray-200 text-gray-600 dark:bg-gray-600'); ?>">
                                    <?php echo e($image->is_active ? 'Active' : 'Inactive'); ?>

                                </span>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-300 line-clamp-2"><?php echo e($image->caption ?: 'No caption provided'); ?></p>
                        </div>

                        <!-- Edit Form -->
                        <div class="flex-1 min-w-0" x-show="editingId === <?php echo e($image->id); ?>" x-cloak>
                            <form id="image-form-<?php echo e($image->id); ?>" class="space-y-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Country</label>
                                        <input type="text" name="country" value="<?php echo e($image->country); ?>" class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-emerald-500 focus:border-emerald-500" placeholder="e.g. Kenya">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                                        <select name="is_active" class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-emerald-500 focus:border-emerald-500">
                                            <option value="1" <?php echo e($image->is_active ? 'selected' : ''); ?>>Active</option>
                                            <option value="0" <?php echo e(!$image->is_active ? 'selected' : ''); ?>>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Caption</label>
                                    <textarea name="caption" rows="2" class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-emerald-500 focus:border-emerald-500" placeholder="Image description..."><?php echo e($image->caption); ?></textarea>
                                </div>
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" @click="editingId = null" class="px-3 py-1.5 text-xs font-medium text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Cancel</button>
                                    <button type="button" @click="updateImage(<?php echo e($image->id); ?>)" class="px-3 py-1.5 text-xs font-medium bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg">Save Changes</button>
                                </div>
                            </form>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-col items-center gap-2" x-show="editingId !== <?php echo e($image->id); ?>">
                            <button @click="editingId = <?php echo e($image->id); ?>" class="p-2 text-gray-400 hover:text-emerald-600 transition-colors rounded-lg hover:bg-emerald-50 dark:hover:bg-emerald-900/20" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </button>
                            <button onclick="deleteImage(<?php echo e($image->id); ?>)" class="p-2 text-gray-400 hover:text-red-600 transition-colors rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20" title="Delete">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 2 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                            <div class="cursor-move p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 handle">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 border-dashed">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">No images yet</h3>
                    <p class="text-gray-500 text-sm mb-4">Add images to showcase your work across different countries.</p>
                    <button x-data @click="$dispatch('open-media-picker', { callback: 'addImage', options: { multiple: true } })" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg">
                        Add First Image
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Media Picker Component -->
    <!-- Media Picker Component (Included in Layout) -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <script>
        // Media Picker Handler
        window.addImage = function(media) {
            // Normalize to array if single object returned
            const items = Array.isArray(media) ? media : [media];
            
            fetch('<?php echo e(route("admin.who-we-are.store")); ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>', 'Accept': 'application/json' },
                body: JSON.stringify({ media_items: items.map(m => m.id) })
            }).then(() => location.reload());
        }

        // Delete Handler
        function deleteImage(id) {
            if (!confirm('Are you sure?')) return;
            fetch(`/admin/who-we-are-images/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' }
            }).then(() => location.reload());
        }

        // Sorting
        new Sortable(document.getElementById('imagesContainer'), {
            animation: 150,
            handle: '.handle',
            onEnd: function() {
                const order = Array.from(this.el.children).map((el, index) => {
                    const match = el.getAttribute('x-data')?.match(/image-form-(\d+)/) || 
                                  el.querySelector('form')?.id.match(/image-form-(\d+)/) ||
                                  [null, el.querySelector('button[onclick^="deleteImage"]')?.getAttribute('onclick').match(/\d+/)[0]];
                    return match[1];
                });
                
                fetch('<?php echo e(route("admin.who-we-are.reorder")); ?>', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
                    body: JSON.stringify({ order })
                });
            }
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal042bf45a5a9c7fed57eef9c73c080db3)): ?>
<?php $attributes = $__attributesOriginal042bf45a5a9c7fed57eef9c73c080db3; ?>
<?php unset($__attributesOriginal042bf45a5a9c7fed57eef9c73c080db3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal042bf45a5a9c7fed57eef9c73c080db3)): ?>
<?php $component = $__componentOriginal042bf45a5a9c7fed57eef9c73c080db3; ?>
<?php unset($__componentOriginal042bf45a5a9c7fed57eef9c73c080db3); ?>
<?php endif; ?>
<?php /**PATH C:\Users\ADMIN\Desktop\aceflaravel\acef\resources\views/admin/who-we-are/index.blade.php ENDPATH**/ ?>