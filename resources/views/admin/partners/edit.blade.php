<x-app-dashboard-layout>
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('admin.partners.index') }}" class="w-12 h-12 rounded-2xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 flex items-center justify-center text-gray-400 hover:text-emerald-600 transition-all shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Partner</h1>
                <p class="text-sm text-gray-500">Update information for {{ $partner->name }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.partners.update', $partner) }}" class="space-y-8">
            @csrf
            @method('PUT')
            
            <div class="bg-white dark:bg-gray-800 rounded-[32px] border border-gray-100 dark:border-gray-700 p-8 shadow-sm">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Partner Logo -->
                    <div x-data="{ 
                        preview: '{{ $partner->logo ? Storage::url($partner->logo) : '' }}',
                        selectImage() {
                            window.openMediaPicker((item) => {
                                this.preview = item.url;
                                $refs.logoInput.value = item.url;
                            });
                        }
                    }" class="md:col-span-1">
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4">Partner Logo</label>
                        <div @click="selectImage()" class="relative group cursor-pointer aspect-video bg-gray-50 dark:bg-gray-900 rounded-[24px] border-2 border-dashed border-gray-200 dark:border-gray-700 flex items-center justify-center overflow-hidden hover:border-emerald-500/50 transition-all">
                            <template x-if="preview">
                                <img :src="preview" class="w-full h-full object-contain p-6 group-hover:scale-110 transition-transform">
                            </template>
                            <template x-if="!preview">
                                <div class="flex flex-col items-center gap-2">
                                    <div class="w-12 h-12 rounded-2xl bg-white dark:bg-gray-800 shadow-sm flex items-center justify-center text-gray-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                    </div>
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Select Logo</span>
                                </div>
                            </template>
                            <div class="absolute inset-0 bg-emerald-600/0 group-hover:bg-emerald-600/5 flex items-center justify-center transition-all">
                                <span class="px-5 py-2.5 bg-white/95 dark:bg-gray-800/95 rounded-xl text-[10px] font-black uppercase tracking-widest opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 transition-all shadow-2xl border border-gray-100 dark:border-gray-700">Open Library</span>
                            </div>
                        </div>
                        <input type="hidden" name="logo" x-ref="logoInput" value="{{ $partner->logo }}">
                    </div>

                    <!-- Basic Stats & Type -->
                    <div class="space-y-6">
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Partner Name</label>
                            <input type="text" name="name" value="{{ old('name', $partner->name) }}" required class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl text-sm font-semibold focus:ring-2 focus:ring-emerald-500/20 dark:text-gray-300" placeholder="e.g. UN@Environment">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Category</label>
                            <select name="category" required class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl text-sm font-semibold focus:ring-2 focus:ring-emerald-500/20 dark:text-gray-300">
                                <option value="strategic" {{ $partner->category === 'strategic' ? 'selected' : '' }}>Strategic Partner</option>
                                <option value="institutional" {{ $partner->category === 'institutional' ? 'selected' : '' }}>Institutional Backing</option>
                                <option value="implementation" {{ $partner->category === 'implementation' ? 'selected' : '' }}>Implementation Partner</option>
                            </select>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Description / About</label>
                        <textarea name="description" rows="4" class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl text-sm font-semibold focus:ring-2 focus:ring-emerald-500/20 dark:text-gray-300" placeholder="Write a brief overview of the partner...">{{ old('description', $partner->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Website URL</label>
                        <input type="url" name="website" value="{{ old('website', $partner->website) }}" class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl text-sm font-semibold focus:ring-2 focus:ring-emerald-500/20 dark:text-gray-300" placeholder="https://example.com">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $partner->sort_order) }}" class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl text-sm font-semibold focus:ring-2 focus:ring-emerald-500/20 dark:text-gray-300">
                    </div>

                    <!-- Toggles -->
                    <div class="md:col-span-2 flex flex-wrap gap-8 pt-4">
                        <label class="relative inline-flex items-center cursor-pointer group">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ $partner->is_active ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-emerald-500"></div>
                            <span class="ml-3 text-[10px] font-black text-gray-400 uppercase tracking-widest group-hover:text-emerald-600 transition-colors">Active Partner</span>
                        </label>

                        <label class="relative inline-flex items-center cursor-pointer group">
                            <input type="checkbox" name="show_on_homepage" value="1" class="sr-only peer" {{ $partner->show_on_homepage ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-emerald-500"></div>
                            <span class="ml-3 text-[10px] font-black text-gray-400 uppercase tracking-widest group-hover:text-emerald-600 transition-colors">Show on Homepage Slider</span>
                        </label>
                    </div>
                </div>

                <div class="mt-12 flex justify-end">
                    <button type="submit" class="px-12 py-4 bg-acef-dark text-white rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] hover:scale-105 active:scale-95 transition-all shadow-2xl shadow-emerald-500/20">
                        Update Partner
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-dashboard-layout>
