<x-app-dashboard-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <nav class="flex text-sm text-gray-500 mb-1">
                    <a href="{{ route('admin.projects.index') }}" class="hover:text-emerald-600">Projects</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-900">Add New</span>
                </nav>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">Add New Project</h1>
                <p class="text-gray-500">Create a new project entry, upload media, and manage content.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.projects.index') }}" class="px-5 py-2.5 bg-white border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" form="createProjectForm" class="px-6 py-2.5 bg-emerald-500 text-white font-bold rounded-xl hover:bg-emerald-600 transition-colors shadow-lg shadow-emerald-200 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Save Project
                </button>
            </div>
        </div>

        <form id="createProjectForm" action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Basic Information -->
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm space-y-6">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-sm">i</div>
                    <h2 class="text-xl font-bold text-gray-900">Basic Information</h2>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Project Title *</label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Community Reforestation Initiative 2024" 
                               class="w-full px-5 py-3.5 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-gray-900 placeholder-gray-400 font-medium transition-all" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Program Associated *</label>
                            <select name="programme_id" class="w-full px-5 py-3.5 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-gray-900 cursor-pointer">
                                <option value="">Select a program</option>
                                @foreach($programmes as $programme)
                                    <option value="{{ $programme->id }}" {{ old('programme_id') == $programme->id ? 'selected' : '' }}>{{ $programme->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Implementation Year *</label>
                            <input type="number" name="start_date" placeholder="2024"  value="2024"
                                   class="w-full px-5 py-3.5 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-gray-900 font-medium">
                        </div>
                    </div>

                    <div>
                        @if(auth()->user()->isAdmin())
                        <label class="block text-sm font-bold text-gray-700 mb-2">Target Countries</label>
                        <div x-data="{
                            availableCountries: {{ json_encode(config('acef.countries')) }},
                            selectedCountries: {{ json_encode(old('country', [])) }},
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
                            },
                            removeCountry(index) {
                                this.selectedCountries.splice(index, 1);
                            }
                        }" class="space-y-3">
                            
                            <!-- Search & Add -->
                            <div class="flex items-center gap-3 relative">
                                <div class="relative flex-1">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </span>
                                    <input type="text" x-model="search" placeholder="Search and select countries (e.g. Kenya, Uganda)" 
                                           @keydown.enter.prevent="if(filteredCountries().length > 0) addCountry(filteredCountries()[0])"
                                           class="w-full pl-12 pr-5 py-3.5 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-gray-900 placeholder-gray-400">
                                    
                                    <!-- Dropdown Suggestions -->
                                    <div x-show="search.length > 0 && filteredCountries().length > 0" 
                                         class="absolute z-10 w-full mt-1 bg-white border border-gray-100 rounded-xl shadow-lg max-h-60 overflow-y-auto">
                                        <template x-for="code in filteredCountries()" :key="code">
                                            <div @click="addCountry(code)" class="px-4 py-2 hover:bg-emerald-50 cursor-pointer text-gray-700 font-medium">
                                                <span x-text="getCountryName(code)"></span>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                                <button type="button" @click="if(filteredCountries().length > 0) addCountry(filteredCountries()[0])" 
                                        class="px-6 py-3.5 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition-colors">
                                    Add
                                </button>
                            </div>

                            <!-- Selected Tags -->
                            <div class="flex flex-wrap gap-3">
                                <template x-for="(code, index) in selectedCountries" :key="index">
                                    <span class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                        <span x-text="getCountryName(code)"></span>
                                        <button type="button" @click="removeCountry(index)" class="ml-2 hover:text-emerald-900 focus:outline-none">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </span>
                                </template>
                            </div>

                            <!-- Hidden Input for Form Submission -->
                            <template x-for="code in selectedCountries">
                                <input type="hidden" name="country[]" :value="code">
                            </template>
                        </div>
                        @else
                            <input type="hidden" name="country[]" value="{{ auth()->user()->country }}">
                        @endif
                    </div>
                </div>
            </div>

            <!-- Project Description -->
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm space-y-6">
                <div class="flex items-center gap-3 mb-2">
                     <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 011.414.586l5.414 5.414a1 1 0 01.586 1.414V19a2 2 0 01-2 2z"/></svg>
                    <h2 class="text-xl font-bold text-gray-900">Project Description</h2>
                </div>

                <div class="rounded-xl overflow-hidden">
                    <x-rich-text-editor 
                        name="description" 
                        placeholder="Write a detailed description of the project, its goals, and expected impact..." 
                    />
                </div>
            </div>

            <!-- Objectives (Repeater) -->
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm space-y-6" x-data="{ objectives: [''] }">
                <div class="flex items-center justify-between">
                     <h2 class="text-xl font-bold text-gray-900">Key Objectives</h2>
                     <button type="button" @click="objectives.push('')" class="text-sm text-emerald-600 font-bold hover:text-emerald-700">+ Add Objective</button>
                </div>
                <div class="space-y-3">
                    <template x-for="(objective, index) in objectives" :key="index">
                        <div class="flex gap-2">
                            <input type="text" :name="'objectives[' + index + ']'" x-model="objectives[index]" placeholder="Enter objective..." class="flex-1 px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500">
                            <button type="button" @click="objectives.splice(index, 1)" class="text-red-500 hover:text-red-700 font-bold px-2">&times;</button>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Voices (Repeater) -->
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm space-y-6" x-data="{ 
                voices: [],
                addVoice() { this.voices.push({ name: '', role: '', quote: '' }); }
            }">
                <div class="flex items-center justify-between">
                     <h2 class="text-xl font-bold text-gray-900">Voices & Testimonials</h2>
                     <button type="button" @click="addVoice()" class="text-sm text-emerald-600 font-bold hover:text-emerald-700">+ Add Testimonial</button>
                </div>
                <div class="space-y-4">
                    <template x-for="(voice, index) in voices" :key="index">
                        <div class="p-4 bg-gray-50 rounded-xl border border-gray-200 space-y-3 relative">
                            <button type="button" @click="voices.splice(index, 1)" class="absolute top-2 right-2 text-gray-400 hover:text-red-500 opacity-0 group-hover:opacity-100 transition-opacity">&times;</button>
                            <div class="grid grid-cols-2 gap-4">
                                <input type="text" :name="'voices[' + index + '][name]'" x-model="voice.name" placeholder="Name (e.g. Sarah J.)" class="w-full px-3 py-2 border border-gray-200 rounded-lg">
                                <input type="text" :name="'voices[' + index + '][role]'" x-model="voice.role" placeholder="Role (e.g. Farmer)" class="w-full px-3 py-2 border border-gray-200 rounded-lg">
                            </div>
                            <textarea :name="'voices[' + index + '][quote]'" x-model="voice.quote" rows="2" placeholder="Quote..." class="w-full px-3 py-2 border border-gray-200 rounded-lg"></textarea>
                        </div>
                    </template>
                     <div x-show="voices.length === 0" class="text-center py-4 text-gray-400 text-sm">No testimonials added yet.</div>
                </div>
            </div>

            <!-- Additional Details (Gallery & Financials) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Gallery -->
                <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm space-y-6">
                    <h2 class="text-xl font-bold text-gray-900">Project Gallery & Media</h2>
                    
                    <div x-data="{ 
                        preview: null,
                        mediaId: null,
                        selectFromLibrary() {
                            if (window.openMediaPicker) {
                                window.openMediaPicker((media) => {
                                    this.preview = media.url;
                                    this.mediaId = media.id;
                                });
                            }
                        }
                    }">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Featured Image</label>
                        
                        <!-- Preview -->
                        <div x-show="preview" class="mb-4 relative group">
                            <img :src="preview" class="w-full h-48 object-cover rounded-xl border-2 border-gray-100">
                            <button type="button" @click="preview = null; mediaId = null" 
                                    class="absolute top-2 right-2 bg-red-500 text-white p-2 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3">
                            <button type="button" @click="selectFromLibrary()" 
                                    class="flex-1 px-4 py-2.5 bg-emerald-50 text-emerald-700 font-semibold rounded-xl hover:bg-emerald-100 transition-colors flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Choose from Library
                            </button>
                            <label class="flex-1 cursor-pointer">
                                <input type="file" name="image" accept="image/*" class="hidden" 
                                       @change="if ($event.target.files[0]) { 
                                           preview = URL.createObjectURL($event.target.files[0]); 
                                           mediaId = null;
                                       }">
                                <div class="w-full px-4 py-2.5 bg-gray-50 text-gray-700 font-semibold rounded-xl hover:bg-gray-100 transition-colors text-center">
                                    Upload New
                                </div>
                            </label>
                        </div>
                        
                        <!-- Hidden input for media ID -->
                        <input type="hidden" name="media_id" :value="mediaId">
                    </div>

                    <!-- Gallery (Multi-Select / Repeater) -->
                     <div x-data="{ 
                        gallery: [],
                        selectGalleryImage() {
                            if (window.openMediaPicker) {
                                window.openMediaPicker((media) => {
                                    this.gallery.push(media.url);
                                });
                            }
                        }
                    }">
                        <div class="flex items-center justify-between mb-2">
                             <label class="block text-sm font-bold text-gray-700">Project Gallery</label>
                             <button type="button" @click="selectGalleryImage()" class="text-xs bg-emerald-50 text-emerald-700 px-3 py-1 rounded-lg font-bold hover:bg-emerald-100">Add Image</button>
                        </div>
                        <div class="grid grid-cols-3 gap-2 mb-4">
                            <template x-for="(img, index) in gallery" :key="index">
                                <div class="relative aspect-square rounded-lg overflow-hidden group">
                                    <img :src="img" class="w-full h-full object-cover">
                                    <input type="hidden" name="gallery[]" :value="img">
                                    <button type="button" @click="gallery.splice(index, 1)" class="absolute inset-0 bg-black/50 text-white opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                                        &times;
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Partners -->
                    <div>
                         <label class="block text-sm font-bold text-gray-700 mb-2">Supporting Partners</label>
                         <div class="space-y-2 max-h-48 overflow-y-auto border border-gray-200 rounded-xl p-3">
                            @foreach($partners as $partner)
                                <label class="flex items-center gap-3 p-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                                    <input type="checkbox" name="partners[]" value="{{ $partner->id }}" class="rounded border-gray-300 text-emerald-500 focus:ring-emerald-500">
                                    @if($partner->logo)
                                        <img src="{{ Storage::url($partner->logo) }}" class="h-6 w-6 object-contain">
                                    @else
                                        <div class="h-6 w-6 bg-gray-100 rounded flex items-center justify-center text-xs font-bold text-gray-500">{{ substr($partner->name, 0, 1) }}</div>
                                    @endif
                                    <span class="text-sm text-gray-700">{{ $partner->name }}</span>
                                </label>
                            @endforeach
                         </div>
                    </div>

                    </div>

                    <!-- Gallery (Multi-Select / Repeater) -->
                     <div x-data="{ 
                        gallery: [],
                        selectGalleryImage() {
                            if (window.openMediaPicker) {
                                window.openMediaPicker((media) => {
                                    this.gallery.push(media.url);
                                });
                            }
                        }
                    }">
                        <div class="flex items-center justify-between mb-2">
                             <label class="block text-sm font-bold text-gray-700">Project Gallery</label>
                             <button type="button" @click="selectGalleryImage()" class="text-xs bg-emerald-50 text-emerald-700 px-3 py-1 rounded-lg font-bold hover:bg-emerald-100">Add Image</button>
                        </div>
                        <div class="grid grid-cols-3 gap-2 mb-4">
                            <template x-for="(img, index) in gallery" :key="index">
                                <div class="relative aspect-square rounded-lg overflow-hidden group">
                                    <img :src="img" class="w-full h-full object-cover">
                                    <input type="hidden" name="gallery[]" :value="img">
                                    <button type="button" @click="gallery.splice(index, 1)" class="absolute inset-0 bg-black/50 text-white opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                                        &times;
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Partners -->
                    <div>
                         <label class="block text-sm font-bold text-gray-700 mb-2">Supporting Partners</label>
                         <div class="space-y-2 max-h-48 overflow-y-auto border border-gray-200 rounded-xl p-3">
                            @foreach($partners as $partner)
                                <label class="flex items-center gap-3 p-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                                    <input type="checkbox" name="partners[]" value="{{ $partner->id }}" class="rounded border-gray-300 text-emerald-500 focus:ring-emerald-500">
                                    @if($partner->logo)
                                        <img src="{{ Storage::url($partner->logo) }}" class="h-6 w-6 object-contain">
                                    @endif
                                    <span class="text-sm text-gray-700">{{ $partner->name }}</span>
                                </label>
                            @endforeach
                         </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Video URL</label>
                        <input type="url" name="video_url" placeholder="https://youtube.com/..." 
                               class="w-full px-5 py-3.5 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 text-gray-900">
                    </div>
                </div>

                <!-- Financials -->
                <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm space-y-6">
                    <h2 class="text-xl font-bold text-gray-900">Financial Overview</h2>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Goal ($)</label>
                            <input type="number" name="goal_amount" value="{{ old('goal_amount') }}" 
                                   class="w-full px-5 py-3.5 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 text-gray-900 font-bold">
                        </div>
                        <div>
                             <label class="block text-sm font-bold text-gray-700 mb-2">Raised ($)</label>
                            <input type="number" name="raised_amount" value="{{ old('raised_amount', 0) }}" 
                                   class="w-full px-5 py-3.5 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 text-gray-900 font-bold">
                        </div>
                    </div>

                     @if(auth()->user()->isAdmin())
                     <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Status</label>
                        <select name="status" class="w-full px-5 py-3.5 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 text-gray-900 cursor-pointer">
                            <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Active / Ongoing</option>
                            <option value="starting" {{ old('status') == 'starting' ? 'selected' : '' }}>Starting / Planned</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="rounded border-gray-300 text-emerald-500 focus:ring-emerald-500">
                            <span class="text-sm font-bold text-gray-700">Feature this project</span>
                        </label>
                    </div>
                    @else
                        <input type="hidden" name="status" value="starting">
                    @endif
                </div>
            </div>

        </form>
    </div>
</x-app-dashboard-layout>
