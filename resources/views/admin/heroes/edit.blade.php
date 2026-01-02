<x-app-dashboard-layout>
    <x-slot name="header">Hero Section: {{ $page->title }}</x-slot>
    <x-slot name="title">Hero Settings</x-slot>

    <div class="max-w-4xl">
        <a href="{{ route('admin.pages.edit', $page) }}" class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Page
        </a>

        <!-- Hero Settings -->
        <form method="POST" action="{{ route('admin.heroes.update', $page) }}" class="mb-6">
            @csrf @method('PUT')
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Hero Settings</h3>
                <div class="flex flex-wrap items-center gap-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="has_hero" value="1" {{ $page->has_hero ? 'checked' : '' }} class="w-5 h-5 rounded text-emerald-600">
                        <span class="text-sm text-gray-700 dark:text-gray-300">Enable Hero</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="hero_slider_enabled" value="1" {{ $page->hero_slider_enabled ? 'checked' : '' }} class="w-5 h-5 rounded text-emerald-600">
                        <span class="text-sm text-gray-700 dark:text-gray-300">Slider Mode</span>
                    </label>
                    <div class="flex items-center gap-2">
                        <label class="text-sm text-gray-700 dark:text-gray-300">Delay:</label>
                        <input type="number" name="hero_slider_delay" value="{{ $page->hero_slider_delay }}" min="1000" max="30000" step="500" class="w-24 px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm">
                        <span class="text-xs text-gray-500">ms</span>
                    </div>
                    <button type="submit" class="ml-auto px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm rounded-lg">Save Settings</button>
                </div>
            </div>
        </form>

        <!-- Slides -->
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Hero Slides</h3>
                <button onclick="openMediaPicker(addSlide)" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add Slide
                </button>
            </div>

            <div id="slidesContainer" class="space-y-4">
                @forelse($page->heroSlides as $slide)
                    <div class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg" data-slide-id="{{ $slide->id }}">
                        <div class="w-24 h-16 rounded-lg overflow-hidden bg-gray-200 dark:bg-gray-600 flex-shrink-0">
                            @if($slide->media)
                                <img src="{{ $slide->media->url }}" alt="" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $slide->title ?: 'Untitled Slide' }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $slide->subtitle ?: 'No subtitle' }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="px-2 py-1 text-xs rounded-full {{ $slide->is_active ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' : 'bg-gray-100 text-gray-600 dark:bg-gray-600 dark:text-gray-400' }}">
                                {{ $slide->is_active ? 'Active' : 'Inactive' }}
                            </span>
                            <button onclick="deleteSlide({{ $slide->id }})" class="p-2 text-gray-400 hover:text-red-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </div>
                @empty
                    <div id="noSlides" class="py-8 text-center text-gray-500 dark:text-gray-400">
                        <p>No slides yet. Add images from the Media Library.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @include('admin.media.partials.picker')

    <script>
        async function addSlide(mediaId, mediaUrl) {
            const response = await fetch('{{ route("admin.heroes.slides.store", $page) }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ media_id: mediaId })
            });
            if (response.ok) location.reload();
        }

        async function deleteSlide(slideId) {
            if (!confirm('Remove this slide?')) return;
            const response = await fetch(`/admin/heroes/slides/${slideId}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            });
            if (response.ok) location.reload();
        }
    </script>
</x-app-dashboard-layout>
