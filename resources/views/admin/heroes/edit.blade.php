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

            <div id="slidesContainer" class="space-y-6" x-data="{ 
                editingSlide: null,
                async updateSlide(id) {
                    const form = document.querySelector(`#slide-form-${id}`);
                    const formData = new FormData(form);
                    const data = Object.fromEntries(formData.entries());
                    data.is_active = formData.get('is_active') === '1';

                    const response = await fetch(`/admin/heroes/slides/${id}`, {
                        method: 'PUT',
                        headers: { 
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(data)
                    });
                    
                    if (response.ok) {
                        this.editingSlide = null;
                        location.reload();
                    }
                }
            }">
                @forelse($page->heroSlides as $slide)
                    <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl overflow-hidden border border-gray-100 dark:border-gray-600 transition-all" :class="editingSlide === {{ $slide->id }} ? 'ring-2 ring-emerald-500' : ''">
                        <div class="flex items-center gap-4 p-4">
                            <div class="w-32 h-20 rounded-lg overflow-hidden bg-gray-200 dark:bg-gray-600 flex-shrink-0 cursor-move">
                                @if($slide->media)
                                    <img src="{{ $slide->media->url }}" alt="" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0" x-show="editingSlide !== {{ $slide->id }}">
                                <div class="flex items-center gap-2 mb-1">
                                    <p class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ $slide->title ?: 'Untitled Slide' }}</p>
                                    <span class="px-2 py-0.5 text-[10px] font-bold uppercase rounded-full {{ $slide->is_active ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30' : 'bg-gray-200 text-gray-600 dark:bg-gray-600' }}">
                                        {{ $slide->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-1 italic">{{ $slide->subtitle ?: 'No subtitle provided' }}</p>
                            </div>

                            <div class="flex items-center gap-2" x-show="editingSlide !== {{ $slide->id }}">
                                <button @click="editingSlide = {{ $slide->id }}" class="p-2 text-gray-400 hover:text-emerald-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </button>
                                <button onclick="deleteSlide({{ $slide->id }})" class="p-2 text-gray-400 hover:text-red-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                        </div>

                        <!-- Edit Form -->
                        <div x-show="editingSlide === {{ $slide->id }}" x-collapse class="border-t border-gray-100 dark:border-gray-600 p-4 bg-white dark:bg-gray-800">
                            <form id="slide-form-{{ $slide->id }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-[10px] font-bold uppercase text-gray-400 mb-1">Slide Title</label>
                                        <input type="text" name="title" value="{{ $slide->title }}" class="w-full px-3 py-2 text-sm border border-gray-200 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 outline-none focus:ring-2 focus:ring-emerald-500">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold uppercase text-gray-400 mb-1">Subtitle / Description</label>
                                        <textarea name="subtitle" rows="2" class="w-full px-3 py-2 text-sm border border-gray-200 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 outline-none focus:ring-2 focus:ring-emerald-500">{{ $slide->subtitle }}</textarea>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label class="block text-[10px] font-bold uppercase text-gray-400 mb-1">Button Text</label>
                                            <input type="text" name="button_text" value="{{ $slide->button_text }}" class="w-full px-3 py-2 text-sm border border-gray-200 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 outline-none focus:ring-2 focus:ring-emerald-500 text-gray-900 dark:text-white">
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-bold uppercase text-gray-400 mb-1">Button Link</label>
                                            <input type="text" name="button_link" value="{{ $slide->button_link }}" class="w-full px-3 py-2 text-sm border border-gray-200 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 outline-none focus:ring-2 focus:ring-emerald-500 text-gray-900 dark:text-white">
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="checkbox" name="is_active" value="1" {{ $slide->is_active ? 'checked' : '' }} class="w-4 h-4 rounded text-emerald-600">
                                            <span class="text-xs font-bold text-gray-600 dark:text-gray-300">Visible on Site</span>
                                        </label>
                                        <div class="flex items-center gap-2">
                                            <button type="button" @click="editingSlide = null" class="px-3 py-1.5 text-xs font-bold text-gray-500 hover:text-gray-700 transition-colors">Cancel</button>
                                            <button type="button" @click="updateSlide({{ $slide->id }})" class="px-4 py-1.5 bg-emerald-600 text-white text-xs font-bold rounded-lg hover:bg-emerald-700 transition-colors shadow-lg shadow-emerald-600/20">Save Slide</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @empty
                    <div id="noSlides" class="py-12 text-center text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700/30 rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-600">
                        <svg class="w-12 h-12 mx-auto mb-3 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p class="font-medium">No slides established yet.</p>
                        <p class="text-xs mt-1 italic">Add high-resolution images from the Media Library to build your hero.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @include('admin.media.partials.picker')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('slidesContainer');
            if (container && window.Sortable) {
                new Sortable(container, {
                    animation: 150,
                    handle: '.cursor-move',
                    ghostClass: 'opacity-50',
                    onEnd: async (evt) => {
                        const slides = Array.from(container.querySelectorAll('[data-slide-id]'));
                        const order = slides.map(s => s.getAttribute('data-slide-id'));
                        
                        await fetch('{{ route("admin.heroes.slides.reorder", $page) }}', {
                            method: 'POST',
                            headers: { 
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ order })
                        });
                    }
                });
            }
        });

        async function addSlide(item) {
            if (!item || !item.id) {
                console.error('No item selected or invalid item structure');
                return;
            }
            const response = await fetch('{{ route("admin.heroes.slides.store", $page) }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ media_id: item.id })
            });
            if (response.ok) location.reload();
        }

        async function deleteSlide(slideId) {
            if (!confirm('Permanently remove this slide from the site structure?')) return;
            const response = await fetch(`/admin/heroes/slides/${slideId}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            });
            if (response.ok) location.reload();
        }
    </script>
</x-app-dashboard-layout>
