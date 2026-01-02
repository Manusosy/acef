<x-app-dashboard-layout>
    <x-slot name="header">Edit Project</x-slot>
    <x-slot name="title">Edit Project</x-slot>

    <div class="max-w-4xl">
        <!-- Back Link -->
        <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Projects
        </a>

        <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Project Details</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title *</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $project->title) }}" required
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category *</label>
                        <input type="text" name="category" id="category" value="{{ old('category', $project->category) }}" required
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                    </div>

                    <!-- Program Associated -->
                    <div>
                        <label for="programme_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Program Associated *</label>
                        <select name="programme_id" id="programme_id" required
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500">
                            <option value="">Select a program</option>
                            @foreach($programmes as $programme)
                                <option value="{{ $programme->id }}" {{ old('programme_id', $project->programme_id) == $programme->id ? 'selected' : '' }}>{{ $programme->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Country Selector (Admins Only) -->
                    @if(auth()->user()->isAdmin())
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Target Countries *</label>
                        <div x-data="{
                            availableCountries: {{ json_encode(config('acef.countries')) }},
                            selectedCountries: {{ json_encode($project->country ?? []) }},
                            search: '',
                            filteredCountries() {
                                if (this.search === '') return [];
                                return Object.entries(this.availableCountries).filter(([code, name]) => 
                                    (name.toLowerCase().includes(this.search.toLowerCase()) || code.toLowerCase().includes(this.search.toLowerCase())) && 
                                    !this.selectedCountries.includes(code)
                                ).map(([code, name]) => code);
                            },
                            getCountryName(code) {
                                return this.availableCountries[code] || code;
                            },
                            addCountry(code) {
                                if (code && !this.selectedCountries.includes(code)) {
                                    this.selectedCountries.push(code);
                                    this.search = '';
                                }
                            }
                        }" class="space-y-3">
                            <div class="flex items-center gap-2 relative">
                                <input type="text" x-model="search" placeholder="Search and select countries..." 
                                       @keydown.enter.prevent="if(filteredCountries().length > 0) addCountry(filteredCountries()[0])"
                                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500">
                                
                                <div x-show="search.length > 0 && filteredCountries().length > 0" 
                                     class="absolute z-50 top-full mt-1 w-full bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl shadow-lg max-h-48 overflow-y-auto">
                                    <template x-for="code in filteredCountries()" :key="code">
                                        <div @click="addCountry(code)" class="px-4 py-2 hover:bg-emerald-50 dark:hover:bg-emerald-900/30 cursor-pointer text-gray-700 dark:text-gray-300">
                                            <span x-text="getCountryName(code)"></span>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-2">
                                <template x-for="(code, index) in selectedCountries" :key="index">
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300 border border-emerald-100 dark:border-emerald-800">
                                        <span x-text="getCountryName(code)"></span>
                                        <button type="button" @click="selectedCountries.splice(index, 1)" class="ml-2 focus:outline-none">&times;</button>
                                        <input type="hidden" name="country[]" :value="code">
                                    </span>
                                </template>
                            </div>
                        </div>
                    </div>
                    @else
                        @foreach($project->country as $code)
                            <input type="hidden" name="country[]" value="{{ $code }}">
                        @endforeach
                    @endif

                    <!-- Status (Admins Only) -->
                    @if(auth()->user()->isAdmin())
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status *</label>
                        <select name="status" id="status" required
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                            <option value="starting" {{ old('status', $project->status) === 'starting' ? 'selected' : '' }}>Starting Soon</option>
                            <option value="ongoing" {{ old('status', $project->status) === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="completed" {{ old('status', $project->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    @else
                        <input type="hidden" name="status" value="{{ $project->status }}">
                    @endif

                    <!-- Goal Amount -->
                    <div>
                        <label for="goal_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Goal Amount ($)</label>
                        <input type="number" name="goal_amount" id="goal_amount" value="{{ old('goal_amount', $project->goal_amount) }}" step="0.01" min="0"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                    </div>

                    <!-- Raised Amount -->
                    <div>
                        <label for="raised_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Raised Amount ($)</label>
                        <input type="number" name="raised_amount" id="raised_amount" value="{{ old('raised_amount', $project->raised_amount) }}" step="0.01" min="0"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                    </div>

                    <!-- Start Date -->
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Start Date</label>
                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                    </div>

                    <!-- End Date -->
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">End Date</label>
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $project->end_date?->format('Y-m-d')) }}"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description *</label>
                        <textarea name="description" id="description" rows="5" required
                                  class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">{{ old('description', $project->description) }}</textarea>
                    </div>

                    <!-- Objectives (Repeater) -->
                    <div class="md:col-span-2 space-y-2" x-data="{ objectives: {{ json_encode($project->objectives ?? ['']) }} }">
                        <div class="flex items-center justify-between">
                             <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Key Objectives</label>
                             <button type="button" @click="objectives.push('')" class="text-xs text-acef-green font-bold hover:text-emerald-700">+ Add Objective</button>
                        </div>
                        <div class="space-y-2">
                            <template x-for="(objective, index) in objectives" :key="index">
                                <div class="flex gap-2">
                                    <input type="text" :name="'objectives[' + index + ']'" x-model="objectives[index]" placeholder="Enter objective..." class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm">
                                    <button type="button" @click="objectives.splice(index, 1)" class="text-red-500 hover:text-red-700 font-bold px-2">&times;</button>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Voices (Repeater) -->
                    <div class="md:col-span-2 space-y-2" x-data="{ 
                        voices: {{ json_encode($project->voices ?? []) }},
                        addVoice() { this.voices.push({ name: '', role: '', quote: '' }); }
                    }">
                        <div class="flex items-center justify-between">
                             <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Voices & Testimonials</label>
                             <button type="button" @click="addVoice()" class="text-xs text-acef-green font-bold hover:text-emerald-700">+ Add Testimonial</button>
                        </div>
                        <div class="space-y-3">
                            <template x-for="(voice, index) in voices" :key="index">
                                <div class="p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg border border-gray-200 dark:border-gray-600 space-y-2 relative group">
                                    <button type="button" @click="voices.splice(index, 1)" class="absolute top-2 right-2 text-gray-400 hover:text-red-500 opacity-0 group-hover:opacity-100 transition-opacity">&times;</button>
                                    <div class="grid grid-cols-2 gap-2">
                                        <input type="text" :name="'voices[' + index + '][name]'" x-model="voice.name" placeholder="Name" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-xs">
                                        <input type="text" :name="'voices[' + index + '][role]'" x-model="voice.role" placeholder="Role" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-xs">
                                    </div>
                                    <textarea :name="'voices[' + index + '][quote]'" x-model="voice.quote" rows="2" placeholder="Quote..." class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-xs"></textarea>
                                </div>
                            </template>
                             <div x-show="voices.length === 0" class="text-center py-4 text-gray-400 text-xs italic">No testimonials added yet.</div>
                        </div>
                    </div>

                    <!-- Current Image -->
                    @if($project->image)
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Current Image</label>
                            <div class="w-32 h-32 rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-700">
                                <img src="{{ Storage::url($project->image) }}" alt="" class="w-full h-full object-cover">
                            </div>
                        </div>
                    @endif

                    <!-- Image -->
                    <div class="md:col-span-2">
                        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ $project->image ? 'Replace Image' : 'Project Image' }}</label>
                        <input type="file" name="image" id="image" accept="image/*"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-emerald-50 file:text-emerald-700 dark:file:bg-emerald-900/30 dark:file:text-emerald-400">
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Max 2MB. Supported formats: JPEG, PNG, GIF, WebP</p>
                    </div>

                    <!-- Gallery -->
                     <div class="md:col-span-2" x-data="{ 
                        gallery: {{ json_encode($project->gallery ?? []) }},
                        selectGalleryImage() {
                            if (window.openMediaPicker) {
                                window.openMediaPicker((media) => {
                                    this.gallery.push(media.url);
                                });
                            }
                        }
                    }">
                        <div class="flex items-center justify-between mb-2">
                             <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Project Gallery</label>
                             <button type="button" @click="selectGalleryImage()" class="text-xs bg-emerald-50 text-emerald-700 px-3 py-1 rounded-lg font-bold hover:bg-emerald-100">Add Image</button>
                        </div>
                        <div class="grid grid-cols-4 gap-3">
                            <template x-for="(img, index) in gallery" :key="index">
                                <div class="relative aspect-square rounded-lg overflow-hidden group">
                                    <img :src="img.startsWith('http') || img.startsWith('/') ? img : '/storage/' + img" class="w-full h-full object-cover">
                                    <input type="hidden" name="gallery[]" :value="img">
                                    <button type="button" @click="gallery.splice(index, 1)" class="absolute inset-0 bg-black/50 text-white opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                                        &times;
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Partners -->
                    <div class="md:col-span-2">
                         <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Supporting Partners</label>
                         <div class="space-y-2 max-h-48 overflow-y-auto border border-gray-200 dark:border-gray-600 rounded-lg p-3 bg-white dark:bg-gray-700">
                            @foreach($partners as $partner)
                                <label class="flex items-center gap-3 p-2 hover:bg-gray-50 dark:hover:bg-gray-600 rounded-lg cursor-pointer">
                                    <input type="checkbox" name="partners[]" value="{{ $partner->id }}" 
                                           {{ $project->partners->contains($partner->id) ? 'checked' : '' }}
                                           class="rounded border-gray-300 dark:border-gray-500 text-emerald-600 focus:ring-emerald-500">
                                    @if($partner->logo)
                                        <img src="{{ Storage::url($partner->logo) }}" class="h-6 w-6 object-contain bg-white rounded p-0.5">
                                    @else
                                        <div class="h-6 w-6 bg-gray-100 rounded flex items-center justify-center text-xs font-bold text-gray-500">{{ substr($partner->name, 0, 1) }}</div>
                                    @endif
                                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ $partner->name }}</span>
                                </label>
                            @endforeach
                         </div>
                    </div>

                    <!-- Toggles (Admins Only) -->
                    @if(auth()->user()->isAdmin())
                    <div class="md:col-span-2 flex flex-wrap gap-6">
                        <input type="hidden" name="is_featured" value="0">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}
                                   class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-emerald-600 focus:ring-emerald-500">
                            <span class="text-sm text-gray-700 dark:text-gray-300">Featured Project</span>
                        </label>
                        
                        <input type="hidden" name="is_active" value="0">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $project->is_active) ? 'checked' : '' }}
                                   class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-emerald-600 focus:ring-emerald-500">
                            <span class="text-sm text-gray-700 dark:text-gray-300">Active</span>
                        </label>
                    </div>
                    @else
                        <input type="hidden" name="is_featured" value="{{ $project->is_featured ? '1' : '0' }}">
                        <input type="hidden" name="is_active" value="{{ $project->is_active ? '1' : '0' }}">
                    @endif
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-4">
                <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-colors">
                    Update Project
                </button>
                <a href="{{ route('admin.projects.index') }}" class="px-6 py-2.5 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-dashboard-layout>
