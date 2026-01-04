<x-app-dashboard-layout>
    <style>
        body { overflow: hidden; }
    </style>
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
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
                <button type="submit" form="createProjectForm" name="save_draft" value="1" class="px-5 py-2.5 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition-colors">
                    Save Draft
                </button>
                <button type="submit" form="createProjectForm" name="publish" value="1" class="px-6 py-2.5 bg-emerald-500 text-white font-bold rounded-xl hover:bg-emerald-600 transition-colors shadow-lg shadow-emerald-200 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Publish Project
                </button>
            </div>
        </div>

        <form id="createProjectForm" action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            
             @if ($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 p-4 mb-6">
                    <div class="flex items-center gap-3 text-red-700 font-bold mb-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        There were errors with your submission:
                    </div>
                    <ul class="list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Basic Information -->
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm space-y-6">
                <!-- ... header ... -->
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Project Title *</label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Community Reforestation Initiative 2024" 
                               class="w-full px-5 py-3.5 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-gray-900 placeholder-gray-400 font-medium transition-all" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                         <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Category *</label>
                            <select name="category" class="w-full px-5 py-3.5 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-gray-900 cursor-pointer" required>
                                <option value="">Select a category</option>
                                @foreach(\App\Models\Project::CATEGORIES as $cat)
                                    <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Program Associated *</label>
                            <select name="programme_id" class="w-full px-5 py-3.5 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-gray-900 cursor-pointer">
                                <option value="">Select a program</option>
                                @foreach($programmes as $programme)
                                    <option value="{{ $programme->id }}" {{ old('programme_id') == $programme->id ? 'selected' : '' }}>{{ $programme->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Implementation Year *</label>
                            <input type="number" name="start_date" placeholder="2024"  value="2024"
                                   class="w-full px-5 py-3.5 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-gray-900 font-medium">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Location/Region *</label>
                            <input type="text" name="location" value="{{ old('location') }}" placeholder="e.g. Kwale County, Kilifi" 
                                   class="w-full px-5 py-3.5 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-gray-900 placeholder-gray-400 font-medium transition-all" required>
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
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm space-y-6" x-data="{ objectives: {{ json_encode(old('objectives', [''])) }} }">
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
                voices: {{ json_encode(old('voices', [])) }},
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

            <!-- Media, Gallery & Partners (Top Level Grid) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Left Card: Featured Image & Partners -->
                <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm space-y-6">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">Featured Media & Partners</h2>
                    </div>

                    <div class="space-y-8">
                        <!-- Featured Image -->
                        <div x-data="{ preview: null, mediaId: null, 
                            selectFromLibrary() {
                                if (window.openMediaPicker) {
                                    window.openMediaPicker((media) => {
                                        this.preview = media.url;
                                        this.mediaId = media.id;
                                    });
                                }
                            }
                        }">
                            <label class="block text-sm font-bold text-gray-700 mb-3">Featured Image *</label>
                            
                            <!-- Preview Area -->
                            <div class="mb-4 relative group">
                                <div class="w-full h-64 rounded-2xl bg-gray-50 border-2 border-dashed border-gray-200 flex items-center justify-center overflow-hidden" 
                                     :class="{ 'border-emerald-500 bg-emerald-50': preview }">
                                    <template x-if="!preview">
                                        <div class="text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-300" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <p class="mt-1 text-sm text-gray-500">No image selected</p>
                                        </div>
                                    </template>
                                    <template x-if="preview">
                                        <img :src="preview" class="w-full h-full object-cover">
                                    </template>
                                    
                                    <!-- Overlay Remove Button -->
                                    <template x-if="preview">
                                        <button type="button" @click="preview = null; mediaId = null; $refs.fileInput.value = ''" 
                                                class="absolute top-2 right-2 bg-white/90 text-red-500 p-2 rounded-full shadow-sm hover:bg-white transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </template>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col gap-3">
                                 <label class="cursor-pointer block">
                                    <span class="sr-only">Choose file</span>
                                    <input type="file" x-ref="fileInput" name="image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all border border-gray-200 rounded-lg"
                                           @change="if ($event.target.files[0]) { 
                                               preview = URL.createObjectURL($event.target.files[0]); 
                                               mediaId = null;
                                           }">
                                </label>

                                <div class="relative">
                                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                        <div class="w-full border-t border-gray-200"></div>
                                    </div>
                                    <div class="relative flex justify-center">
                                        <span class="bg-white px-2 text-sm text-gray-400">or</span>
                                    </div>
                                </div>

                                <button type="button" @click="selectFromLibrary()" 
                                        class="w-full px-4 py-2.5 bg-gray-50 text-gray-600 font-semibold rounded-xl hover:bg-gray-100 transition-colors flex items-center justify-center gap-2 border border-gray-200 border-dashed">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    Select from Media Library
                                </button>
                            </div>
                            <!-- Hidden input for media ID -->
                            <input type="hidden" name="media_id" :value="mediaId">
                        </div>

                        <!-- Supporting Partners (Dropdown) -->
                         <div x-data="{ 
                            open: false,
                            selectedCount: 0,
                            updateCount() {
                                this.selectedCount = document.querySelectorAll('input[name=\'partners[]\']:checked').length;
                            }
                         }">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Supporting Partners</label>
                            <div class="relative">
                                <button type="button" @click="open = !open" @click.away="open = false" 
                                        class="w-full flex items-center justify-between px-5 py-3.5 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-gray-900 font-medium transition-all text-left">
                                    <span x-text="selectedCount > 0 ? selectedCount + ' Partner(s) Selected' : 'Select Partners'"></span>
                                    <svg class="w-5 h-5 text-gray-400 transform transition-transform" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </button>
                                
                                <div x-show="open" 
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="absolute z-10 mt-2 w-full bg-white rounded-xl shadow-lg border border-gray-100 max-h-60 overflow-y-auto p-2">
                                    @foreach($partners as $partner)
                                        <label class="flex items-center gap-3 p-3 hover:bg-gray-50 rounded-lg cursor-pointer transition-colors group">
                                            <input type="checkbox" name="partners[]" value="{{ $partner->id }}" @change="updateCount()"
                                                class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 w-5 h-5">
                                            @if($partner->logo)
                                                <img src="{{ Storage::url($partner->logo) }}" class="h-8 w-8 object-contain bg-white rounded border border-gray-100 p-0.5">
                                            @else
                                                <div class="h-8 w-8 bg-gray-100 rounded flex items-center justify-center text-xs font-bold text-gray-500">{{ substr($partner->name, 0, 1) }}</div>
                                            @endif
                                            <span class="text-sm font-medium text-gray-700 group-hover:text-gray-900">{{ $partner->name }}</span>
                                        </label>
                                    @endforeach
                                    @if($partners->isEmpty())
                                        <div class="p-4 text-center text-gray-500 text-sm">No partners available. <a href="{{ route('admin.partners.create') }}" class="text-emerald-600 font-bold hover:underline">Create one?</a></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Card: Project Gallery -->
                <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm space-y-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900">Project Gallery</h2>
                        </div>
                    </div>

                    <div x-data="{ 
                        gallery: {{ json_encode(old('gallery', [])) }},
                        selectGalleryImage() {
                            if (window.openMediaPicker) {
                                window.openMediaPicker((media) => {
                                    this.gallery.push(media.url);
                                });
                            }
                        }
                    }">
                        <div class="flex items-center justify-end mb-4">
                            <button type="button" @click="selectGalleryImage()" 
                                    class="text-xs bg-emerald-50 text-emerald-700 px-3 py-1.5 rounded-lg font-bold hover:bg-emerald-100 transition-colors flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Add Image
                            </button>
                        </div>
                        
                         <!-- Empty State -->
                        <div x-show="gallery.length === 0" class="border-2 border-dashed border-gray-200 rounded-2xl h-[400px] flex flex-col items-center justify-center text-center p-8 bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer" @click="selectGalleryImage()">
                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mb-4 text-gray-400">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <h3 class="text-sm font-bold text-gray-900 mb-1">Gallery is Empty</h3>
                            <p class="text-xs text-gray-500 mb-4">Add photos to showcase the project.</p>
                            <span class="text-emerald-600 text-sm font-bold hover:underline">Select Images from Library</span>
                        </div>

                        <!-- Gallery Grid -->
                        <div x-show="gallery.length > 0" class="grid grid-cols-2 lg:grid-cols-3 gap-4">
                            <template x-for="(img, index) in gallery" :key="index">
                                <div class="relative aspect-square rounded-2xl overflow-hidden group border border-gray-100 shadow-sm">
                                    <img :src="img.startsWith('http') || img.startsWith('/') ? img : '/storage/' + img" class="w-full h-full object-cover">
                                    <input type="hidden" name="gallery[]" :value="img">
                                    <button type="button" @click="gallery.splice(index, 1)" 
                                            class="absolute top-2 right-2 w-8 h-8 bg-black/50 hover:bg-red-500 text-white rounded-full flex items-center justify-center transition-all opacity-0 group-hover:opacity-100 backdrop-blur-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </div>
                            </template>
                            <!-- Add More Button Card -->
                            <button type="button" @click="selectGalleryImage()" class="aspect-square rounded-2xl border-2 border-dashed border-gray-200 hover:border-emerald-500 hover:bg-emerald-50 flex flex-col items-center justify-center transition-all group">
                                <svg class="w-8 h-8 text-gray-300 group-hover:text-emerald-500 mb-2 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                <span class="text-xs font-bold text-gray-400 group-hover:text-emerald-600 transition-colors">Add More</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Financials & Status -->
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm space-y-6">
                <h2 class="text-xl font-bold text-gray-900">Financial Overview & Status</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                     <div class="space-y-6">
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
                         <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Video URL</label>
                            <input type="url" name="video_url" placeholder="https://youtube.com/..." 
                                   class="w-full px-5 py-3.5 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 text-gray-900">
                        </div>
                     </div>
                     
                     <div class="space-y-6">
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
            </div>
        </form>
    </div>
</x-app-dashboard-layout>
