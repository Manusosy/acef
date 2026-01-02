<x-app-dashboard-layout>
    <x-slot name="header">Edit Page: {{ $page->title }}</x-slot>
    <x-slot name="title">Edit Page</x-slot>

    <div class="max-w-4xl">
        <a href="{{ route('admin.pages.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Pages
        </a>

        <form method="POST" action="{{ route('admin.pages.update', $page) }}" class="space-y-6">
            @csrf @method('PUT')

            <!-- Basic Info -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Page Details</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title *</label>
                        <input type="text" name="title" value="{{ old('title', $page->title) }}" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>
                    <div class="flex items-center gap-6">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_published" value="1" {{ $page->is_published ? 'checked' : '' }} class="w-5 h-5 rounded text-emerald-600">
                            <span class="text-sm text-gray-700 dark:text-gray-300">Published</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="has_hero" value="1" {{ $page->has_hero ? 'checked' : '' }} class="w-5 h-5 rounded text-emerald-600">
                            <span class="text-sm text-gray-700 dark:text-gray-300">Has Hero Section</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Hero Settings -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6" x-data="{ hasHero: {{ $page->has_hero ? 'true' : 'false' }} }">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Hero Section</h3>
                    @if($page->has_hero)
                        <a href="{{ route('admin.heroes.edit', $page) }}" class="text-sm text-emerald-600 hover:underline">Manage Slides →</a>
                    @endif
                </div>
                <div class="space-y-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="hero_slider_enabled" value="1" {{ $page->hero_slider_enabled ? 'checked' : '' }} class="w-5 h-5 rounded text-emerald-600">
                        <span class="text-sm text-gray-700 dark:text-gray-300">Enable Image Slider</span>
                    </label>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Slider Delay (ms)</label>
                        <input type="number" name="hero_slider_delay" value="{{ old('hero_slider_delay', $page->hero_slider_delay) }}" min="1000" max="30000" step="500" class="w-40 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>
                </div>
            </div>

            <!-- SEO Settings -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">SEO Settings</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" placeholder="{{ $page->title }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                        <p class="mt-1 text-xs text-gray-500">Leave empty to use page title</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Meta Description</label>
                        <textarea name="meta_description" rows="3" maxlength="160" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white" placeholder="Brief description for search engines (max 160 characters)">{{ old('meta_description', $page->meta_description) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500"><span id="metaCharCount">{{ strlen($page->meta_description ?? '') }}</span>/160 characters</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg">Save Changes</button>
                <a href="{{ route('admin.pages.index') }}" class="px-6 py-2.5 text-gray-600 dark:text-gray-400">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        document.querySelector('[name="meta_description"]').addEventListener('input', function() {
            document.getElementById('metaCharCount').textContent = this.value.length;
        });
    </script>
</x-app-dashboard-layout>
