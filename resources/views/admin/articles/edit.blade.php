<x-app-dashboard-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Article</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Update article content and settings.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.articles.index') }}" class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 font-medium rounded-lg">
                    Cancel
                </a>
                <button type="submit" form="article-form" name="action" value="draft" class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 font-medium rounded-lg">
                    Save
                </button>
                <button type="submit" form="article-form" name="action" value="publish" class="px-4 py-2 bg-acef-green hover:bg-emerald-600 text-white font-medium rounded-lg shadow-sm">
                    {{ auth()->user()->isAdmin() ? 'Update Article' : 'Submit for Review' }}
                </button>
            </div>
        </div>

        <form id="article-form" method="POST" action="{{ route('admin.articles.update', $article) }}" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @csrf
            @method('PUT')

            <!-- Main Content (Left 2 Columns) -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-6 shadow-sm">
                    <div class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Article Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $article->title) }}" required class="w-full text-xl px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-acef-green focus:border-transparent transition-all">
                        </div>
                        
                        <!-- Rich Text Editor -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Content</label>
                            <x-rich-text-editor name="content" :value="old('content', $article->content)" />
                        </div>

                        <div>
                            <label for="excerpt" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Excerpt</label>
                            <textarea name="excerpt" id="excerpt" rows="3" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-white">{{ old('excerpt', $article->excerpt) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar (Right Column) -->
            <div class="space-y-6">
                <!-- Publishing Options -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-5 shadow-sm">
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-4 uppercase text-xs tracking-wider">Publishing</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">Current Status:</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $article->status === 'published' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                {{ ucfirst($article->status) }}
                            </span>
                        </div>
                        
                         @if(auth()->user()->isAdmin())
                         <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Change Status</label>
                            <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-acef-green text-sm">
                                <option value="published" {{ $article->status === 'published' ? 'selected' : '' }}>Published</option>
                                <option value="draft" {{ $article->status === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="pending" {{ $article->status === 'pending' ? 'selected' : '' }}>Pending Review</option>
                            </select>
                        </div>
                        @else
                            <input type="hidden" name="status" value="draft">
                        @endif
                        
                        <div class="pt-4 border-t border-gray-100 dark:border-gray-700">
                             <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $article->is_featured) ? 'checked' : '' }} class="rounded border-gray-300 text-acef-green focus:ring-acef-green">
                                <span class="text-sm text-gray-700 dark:text-gray-300">Feature this article</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Featured Image -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-5 shadow-sm">
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-4 uppercase text-xs tracking-wider">Featured Image</h3>
                    <div x-data="{ 
                        imagePreview: '{{ $article->image ? (str_starts_with($article->image, 'http') ? $article->image : Storage::url($article->image)) : '' }}',
                        selectImage() {
                            window.openMediaPicker((item) => {
                                this.imagePreview = item.url;
                                document.getElementById('image_path').value = item.url; // Use URL or ID? Controller logic expects path/url
                            });
                        }
                    }">
                         <div class="relative w-full h-48 bg-gray-100 dark:bg-gray-900 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 flex items-center justify-center overflow-hidden hover:border-acef-green dark:hover:border-acef-green transition-colors cursor-pointer" @click="selectImage()">
                            <template x-if="!imagePreview">
                                <div class="text-center p-4">
                                    <svg class="w-8 h-8 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-sm text-gray-500">Select Image</span>
                                </div>
                            </template>
                            <template x-if="imagePreview">
                                <img :src="imagePreview" class="w-full h-full object-cover">
                            </template>
                        </div>
                        <input type="hidden" name="image" id="image_path" value="{{ $article->image }}">
                        <p class="mt-2 text-xs text-center text-gray-500">Recommended size: 1200x630px</p>
                    </div>
                </div>

                <!-- Article Metadata -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-5 shadow-sm">
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-4 uppercase text-xs tracking-wider">Article Metadata</h3>
                    
                    <div class="space-y-4">
                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Category</label>
                            <select name="category_id" id="category_id" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-acef-green text-sm">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Country (Admins Only) -->
                        @if(auth()->user()->isAdmin())
                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Country</label>
                            <select name="country" id="country" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-acef-green text-sm">
                                <option value="">All Countries (Global)</option>
                                @foreach($countries as $code => $name)
                                    <option value="{{ $code }}" {{ old('country', $article->country) == $code ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @else
                            <input type="hidden" name="country" value="{{ $article->country }}">
                        @endif

                        <!-- Read Time -->
                         <div>
                            <label for="read_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Estimated Read Time (mins)</label>
                            <div class="relative">
                                <input type="number" name="read_time" id="read_time" value="{{ old('read_time', $article->read_time) }}" min="1" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-acef-green text-sm pr-12">
                                <span class="absolute right-3 top-2 text-sm text-gray-500">mins</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tags -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-5 shadow-sm"
                     x-data="{ tags: {{ json_encode($article->tags ?? []) }}, newTag: '' }">
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-4 uppercase text-xs tracking-wider">Tags</h3>
                    
                    <div class="space-y-3">
                        <div class="flex gap-2">
                            <input type="text" x-model="newTag" @keydown.enter.prevent="if(newTag.trim() !== '') { tags.push(newTag.trim()); newTag = ''; }" placeholder="Add a new tag" class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-white text-sm focus:ring-acef-green">
                            <button type="button" @click="if(newTag.trim() !== '') { tags.push(newTag.trim()); newTag = ''; }" class="px-3 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-medium hover:bg-gray-200 dark:hover:bg-gray-600">Add</button>
                        </div>
                        
                        <div class="flex flex-wrap gap-2">
                            <template x-for="(tag, index) in tags" :key="index">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300">
                                    <span x-text="tag"></span>
                                    <button type="button" @click="tags.splice(index, 1)" class="ml-1.5 text-emerald-600 dark:text-emerald-400 hover:text-emerald-800 dark:hover:text-emerald-200 focus:outline-none">
                                        &times;
                                    </button>
                                </span>
                            </template>
                        </div>
                        <!-- Hidden input to send tags to server -->
                        <input type="hidden" name="tags" :value="JSON.stringify(tags)">
                        <p class="text-xs text-gray-500">Separate tags with comma or enter.</p>
                    </div>
                </div>

            </div>
        </form>
    </div>
</x-app-dashboard-layout>
