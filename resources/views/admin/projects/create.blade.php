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
                                @foreach(\App\Models\Programme::all() as $programme)
                                    <option value="{{ $programme->id }}">{{ $programme->title }}</option>
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
                        <label class="block text-sm font-bold text-gray-700 mb-2">Target Countries</label>
                        <div x-data="{
                            availableCountries: [
                                'Angola', 'Benin', 'Cameroon', 'Democratic Republic of the Congo', 
                                'Ghana', 'Kenya', 'Liberia', 'Nigeria', 'Rwanda', 'Sierra Leone', 
                                'Tanzania', 'Uganda', 'Zambia', 'Zimbabwe'
                            ],
                            selectedCountries: [],
                            search: '',
                            filteredCountries() {
                                if (this.search === '') return [];
                                return this.availableCountries.filter(c => 
                                    c.toLowerCase().includes(this.search.toLowerCase()) && 
                                    !this.selectedCountries.includes(c)
                                );
                            },
                            addCountry(country) {
                                if (country && !this.selectedCountries.includes(country)) {
                                    this.selectedCountries.push(country);
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
                                           @keydown.enter.prevent="addCountry(filteredCountries()[0])"
                                           class="w-full pl-12 pr-5 py-3.5 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-gray-900 placeholder-gray-400">
                                    
                                    <!-- Dropdown Suggestions -->
                                    <div x-show="search.length > 0 && filteredCountries().length > 0" 
                                         class="absolute z-10 w-full mt-1 bg-white border border-gray-100 rounded-xl shadow-lg max-h-60 overflow-y-auto">
                                        <template x-for="country in filteredCountries()" :key="country">
                                            <div @click="addCountry(country)" class="px-4 py-2 hover:bg-emerald-50 cursor-pointer text-gray-700 font-medium">
                                                <span x-text="country"></span>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                                <button type="button" @click="addCountry(filteredCountries()[0])" 
                                        class="px-6 py-3.5 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition-colors">
                                    Add
                                </button>
                            </div>

                            <!-- Selected Tags -->
                            <div class="flex flex-wrap gap-3">
                                <template x-for="(country, index) in selectedCountries" :key="index">
                                    <span class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                        <span x-text="country"></span>
                                        <button type="button" @click="removeCountry(index)" class="ml-2 hover:text-emerald-900 focus:outline-none">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </span>
                                </template>
                            </div>

                            <!-- Hidden Input for Form Submission -->
                            <template x-for="country in selectedCountries">
                                <input type="hidden" name="country[]" :value="country">
                            </template>
                        </div>
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

            <!-- Additional Details (Gallery & Financials) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Gallery -->
                <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm space-y-6">
                    <h2 class="text-xl font-bold text-gray-900">Project Gallery & Media</h2>
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Featured Image</label>
                        <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:bg-emerald-50 file:text-emerald-700 file:font-semibold hover:file:bg-emerald-100">
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

                     <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Status</label>
                        <select name="status" class="w-full px-5 py-3.5 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 text-gray-900 cursor-pointer">
                            <option value="ongoing">Active / Ongoing</option>
                            <option value="draft">Pending Approval</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>
            </div>

        </form>
    </div>
</x-app-dashboard-layout>
