<x-app-dashboard-layout>
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Create Program</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Add a new program with impact stories and focus areas.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.programmes.index') }}" class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 font-medium rounded-lg">
                    Cancel
                </a>
                <button type="submit" form="program-form" name="action" value="draft" class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 font-medium rounded-lg">
                    Save
                </button>
                <button type="submit" form="program-form" name="action" value="publish" class="px-4 py-2 bg-acef-green hover:bg-emerald-600 text-white font-medium rounded-lg shadow-sm">
                    {{ auth()->user()->isAdmin() ? 'Publish Program' : 'Submit for Review' }}
                </button>
            </div>
        </div>

        <form id="program-form" method="POST" action="{{ route('admin.programmes.store') }}" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @csrf

            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Info -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-6 shadow-sm space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Program Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required class="w-full text-xl px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-acef-green">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                        <x-rich-text-editor name="content" :value="old('content')" />
                    </div>

                    <div>
                        <label for="excerpt" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Excerpt</label>
                        <textarea name="excerpt" id="excerpt" rows="3" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-white">{{ old('excerpt') }}</textarea>
                    </div>
                </div>

                <!-- Impact Stories (JSON Repeater) -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-6 shadow-sm" x-data="{ 
                    stories: [],
                    addStory() { this.stories.push({ title: '', number: '', description: '' }); }
                }">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-gray-900 dark:text-white">Impact Stories</h3>
                        <button type="button" @click="addStory()" class="text-sm text-acef-green font-medium hover:text-emerald-700">+ Add Story</button>
                    </div>
                    
                    <div class="space-y-4">
                        <template x-for="(story, index) in stories" :key="index">
                            <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700 relative group">
                                <button type="button" @click="stories.splice(index, 1)" class="absolute top-2 right-2 text-gray-400 hover:text-red-500 opacity-0 group-hover:opacity-100 transition-opacity">&times;</button>
                                <div class="grid grid-cols-2 gap-4 mb-3">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500 mb-1">Title (e.g. Beneficiaries)</label>
                                        <input type="text" x-model="story.title" class="w-full px-3 py-1.5 border border-gray-300 dark:border-gray-600 rounded text-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500 mb-1">Number (e.g. 500+)</label>
                                        <input type="text" x-model="story.number" class="w-full px-3 py-1.5 border border-gray-300 dark:border-gray-600 rounded text-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 mb-1">Description</label>
                                    <textarea x-model="story.description" rows="2" class="w-full px-3 py-1.5 border border-gray-300 dark:border-gray-600 rounded text-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-white"></textarea>
                                </div>
                            </div>
                        </template>
                        <div x-show="stories.length === 0" class="text-center py-8 text-gray-400 text-sm">No impact stories added yet.</div>
                    </div>
                    <input type="hidden" name="impact_stories" :value="JSON.stringify(stories)">
                </div>

                <!-- Focus Areas (JSON Repeater) -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-6 shadow-sm" x-data="{ 
                    areas: [],
                    newArea: '',
                    addArea() { if(this.newArea.trim()) { this.areas.push(this.newArea.trim()); this.newArea = ''; } }
                }">
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-4">Focus Areas</h3>
                    <div class="flex gap-2 mb-4">
                        <input type="text" x-model="newArea" @keydown.enter.prevent="addArea()" placeholder="Add focus area..." class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-white text-sm">
                        <button type="button" @click="addArea()" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-white font-medium rounded-lg text-sm">Add</button>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <template x-for="(area, index) in areas" :key="index">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300 border border-emerald-100 dark:border-emerald-800">
                                <span x-text="area"></span>
                                <button type="button" @click="areas.splice(index, 1)" class="ml-2 text-emerald-500 hover:text-emerald-800">&times;</button>
                            </span>
                        </template>
                    </div>
                    <input type="hidden" name="focus_areas" :value="JSON.stringify(areas)">
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Status -->
                <!-- Status (Admins Only) -->
                 <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-5 shadow-sm">
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-4 uppercase text-xs tracking-wider">Publishing</h3>
                    @if(auth()->user()->isAdmin())
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Status</label>
                        <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-acef-green text-sm">
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>
                    @else
                        <div class="flex items-center gap-2 text-amber-600 bg-amber-50 dark:bg-amber-900/20 p-2 rounded-lg text-xs font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Saves as Draft for Admin Review
                        </div>
                    @endif
                </div>

                <!-- Featured Image -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-5 shadow-sm">
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-4 uppercase text-xs tracking-wider">Featured Image</h3>
                    <div x-data="{ 
                        imagePreview: null,
                        selectImage() {
                            window.openMediaPicker((item) => {
                                this.imagePreview = item.url;
                                document.getElementById('image_path').value = item.url;
                            });
                        }
                    }">
                         <div class="relative w-full h-40 bg-gray-100 dark:bg-gray-900 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 flex items-center justify-center overflow-hidden hover:border-acef-green dark:hover:border-acef-green transition-colors cursor-pointer" @click="selectImage()">
                            <template x-if="imagePreview">
                                <img :src="imagePreview" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!imagePreview">
                                <span class="text-xs text-gray-500 font-medium">Select Image</span>
                            </template>
                        </div>
                        <input type="hidden" name="image" id="image_path">
                    </div>
                </div>

                <!-- Hero Image removed as per user request (using Featured Image) -->

                <!-- Key Details -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-5 shadow-sm space-y-4">
                    <h3 class="font-semibold text-gray-900 dark:text-white uppercase text-xs tracking-wider">Program Details</h3>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Category</label>
                        <input type="text" name="category" placeholder="e.g. Agriculture" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-900 text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Icon (Emoji or SVG)</label>
                        <input type="text" name="icon" placeholder="e.g. 🌱" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-900 text-sm">
                    </div>

                    <div>
                        @if(auth()->user()->isAdmin())
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Target Countries</label>
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
                            }
                        }" class="space-y-3">
                            <div class="flex items-center gap-2">
                                <input type="text" x-model="search" placeholder="Search countries..." 
                                       @keydown.enter.prevent="if(filteredCountries().length > 0) addCountry(filteredCountries()[0])"
                                       class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900 text-sm">
                                <div x-show="search.length > 0 && filteredCountries().length > 0" 
                                     class="absolute z-50 mt-10 w-64 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl shadow-lg max-h-48 overflow-y-auto">
                                    <template x-for="code in filteredCountries()" :key="code">
                                        <div @click="addCountry(code)" class="px-4 py-2 hover:bg-emerald-50 dark:hover:bg-emerald-900/30 cursor-pointer text-gray-700 dark:text-gray-300 text-sm">
                                            <span x-text="getCountryName(code)"></span>
                                        </div>
                                    </template>
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <template x-for="(code, index) in selectedCountries" :key="index">
                                    <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300 border border-emerald-100 dark:border-emerald-800">
                                        <span x-text="getCountryName(code)"></span>
                                        <button type="button" @click="selectedCountries.splice(index, 1)" class="ml-1.5 focus:outline-none">&times;</button>
                                        <input type="hidden" name="country[]" :value="code">
                                    </span>
                                </template>
                            </div>
                        </div>
                        @else
                            <input type="hidden" name="country[]" value="{{ auth()->user()->country }}">
                        @endif
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Duration</label>
                        <input type="text" name="duration" placeholder="e.g. 5 Years" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-900 text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Location (Text Detail)</label>
                        <input type="text" name="location" placeholder="e.g. Rift Valley, Kenya" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-900 text-sm">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">Funding Goal ($)</label>
                            <input type="number" name="funding_goal" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-900 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">Raised So Far ($)</label>
                            <input type="number" name="funding_raised" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-900 text-sm">
                        </div>
                    </div>

                    <div class="space-y-3 pt-2 border-t border-gray-100 dark:border-gray-700">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Impact Stats</label>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="col-span-2">
                                <label class="block text-[10px] font-medium text-gray-500 mb-1">Beneficiaries (e.g. 12,500+)</label>
                                <input type="text" name="stats[beneficiaries]" class="w-full px-3 py-1.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900 text-xs">
                            </div>
                            <div>
                                <label class="block text-[10px] font-medium text-gray-500 mb-1">Trees (e.g. 50,000)</label>
                                <input type="text" name="stats[trees]" class="w-full px-3 py-1.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900 text-xs">
                            </div>
                            <div>
                                <label class="block text-[10px] font-medium text-gray-500 mb-1">Communities (e.g. 12)</label>
                                <input type="text" name="stats[communities]" class="w-full px-3 py-1.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900 text-xs">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Factsheet (PDF)</label>
                         <div x-data="{ 
                            fileName: null,
                            selectFile() {
                                window.openMediaPicker((item) => {
                                    this.fileName = item.original_filename;
                                    document.getElementById('factsheet_path').value = item.url;
                                });
                            }
                        }">
                            <div class="flex gap-2">
                                <input type="hidden" name="factsheet" id="factsheet_path">
                                <input type="text" readonly :value="fileName" placeholder="No file selected" class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-800 text-sm text-gray-500">
                                <button type="button" @click="selectFile()" class="px-3 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg text-sm font-medium hover:bg-gray-300">Select</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-dashboard-layout>
