<x-app-dashboard-layout>
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">Edit Achievement</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Update visual details and media.</p>
        </div>
        <form action="{{ route('admin.timeline-achievements.destroy', $timelineAchievement) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this achievement?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:text-red-900 font-medium text-sm flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                Delete Achievement
            </button>
        </form>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 max-w-4xl">
        <form action="{{ route('admin.timeline-achievements.update', $timelineAchievement) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Year</label>
                    <select name="timeline_year_id" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                        @foreach($years as $y)
                            <option value="{{ $y->id }}" {{ $timelineAchievement->timeline_year_id == $y->id ? 'selected' : '' }}>{{ $y->year }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Location</label>
                    <input type="text" name="location" value="{{ $timelineAchievement->location }}" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title</label>
                <input type="text" name="title" value="{{ $timelineAchievement->title }}" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                <x-rich-text-editor name="description" :value="$timelineAchievement->description" />
            </div>

            <div class="mb-6">
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Images</label>
                
                <div x-data="{ 
                    images: {{ json_encode($timelineAchievement->images ?? []) }},
                    selectImages() {
                        if (window.openMediaPicker) {
                            window.openMediaPicker((selected) => {
                                const newImages = Array.isArray(selected) ? selected : [selected];
                                newImages.forEach(img => {
                                    if (!this.images.includes(img.url)) {
                                        this.images.push(img.url);
                                    }
                                });
                            }, { multiple: true });
                        }
                    }
                }" class="space-y-4">
                    
                    <!-- Hidden inputs for form submission -->
                    <template x-for="img in images">
                        <input type="hidden" name="images[]" :value="img">
                    </template>

                    <!-- Preview Grid -->
                    <div x-show="images.length > 0" class="grid grid-cols-2 md:grid-cols-4 gap-4">
                         <template x-for="(img, index) in images" :key="index">
                            <div class="relative group aspect-square rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                                <img :src="img.startsWith('http') || img.startsWith('/') ? img : '/storage/' + img" class="w-full h-full object-cover">
                                <button type="button" @click="images.splice(index, 1)" class="absolute top-1 right-1 bg-red-600 text-white rounded-full p-1 opacity-100 md:opacity-0 md:group-hover:opacity-100 transition-opacity shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                        </template>
                    </div>

                    <!-- Empty State / Add Button -->
                    <div @click="selectImages()" class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-8 text-center hover:border-acef-green hover:bg-green-50 dark:hover:bg-gray-700 transition-colors cursor-pointer group">
                        <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-acef-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 font-medium group-hover:text-acef-green">Managed Images from Library</p>
                        <p class="text-xs text-gray-500 mt-1">Select multiple images to add. Click images above to remove.</p>
                    </div>
                </div>
            </div>

            <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                 <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Order</label>
                    <input type="number" name="order" value="{{ $timelineAchievement->order }}" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                </div>
                 <div class="flex items-center mt-6">
                    <input type="checkbox" name="is_visible" value="1" {{ $timelineAchievement->is_visible ? 'checked' : '' }} class="rounded border-gray-300 text-acef-green focus:ring-acef-green">
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Visible on website</span>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('admin.timeline-years.edit', $timelineAchievement->timeline_year_id) }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-acef-green text-white rounded-lg hover:bg-green-700">Update Achievement</button>
            </div>
        </form>
    </div>
</x-app-dashboard-layout>
