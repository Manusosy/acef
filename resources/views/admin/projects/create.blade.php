<x-app-dashboard-layout>
    <div class="max-w-5xl mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Create Project</h1>
                <p class="text-gray-500 mt-1">Add a new development project to the platform.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.projects.index') }}" class="px-4 py-2 bg-white border border-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" form="createProjectForm" class="px-6 py-2 bg-emerald-500 text-white font-medium rounded-lg hover:bg-emerald-600 transition-colors shadow-sm shadow-emerald-200">
                    Create Project
                </button>
            </div>
        </div>

        <form id="createProjectForm" action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @csrf

            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Details -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Project Title *</label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Reforestation in Mount Kenya" 
                               class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500/20 text-gray-900 placeholder-gray-400 font-medium" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                        <textarea name="description" rows="6" placeholder="Describe the project goals, impact, and activities..." 
                                  class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500/20 text-gray-900 placeholder-gray-400"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Location</label>
                            <input type="text" name="location" value="{{ old('location') }}" placeholder="e.g. Nyeri, Kenya" 
                                   class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500/20 text-gray-900 placeholder-gray-400">
                        </div>
                         <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Country</label>
                            <select name="country" class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500/20 text-gray-900 cursor-pointer">
                                <option value="Kenya">Kenya</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Tanzania">Tanzania</option>
                                <option value="Rwanda">Rwanda</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Financials -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-6">
                    <h3 class="text-lg font-bold text-gray-900">Financials</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                         <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Goal Amount ($)</label>
                            <input type="number" name="goal_amount" value="{{ old('goal_amount') }}" placeholder="50000" 
                                   class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500/20 text-gray-900 placeholder-gray-400">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Raised Amount ($)</label>
                            <input type="number" name="raised_amount" value="{{ old('raised_amount', 0) }}" placeholder="0" 
                                   class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500/20 text-gray-900 placeholder-gray-400">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Status & Publish -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-4">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Status & Visibility</h3>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" class="w-full px-4 py-2 bg-gray-50 border-none rounded-lg focus:ring-2 focus:ring-emerald-500/20 text-gray-900 text-sm">
                            <option value="draft">Draft</option>
                            <option value="ongoing" selected>Ongoing</option>
                            <option value="completed">Completed</option>
                            <option value="archived">Archived</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Program</label>
                        <select name="programme_id" class="w-full px-4 py-2 bg-gray-50 border-none rounded-lg focus:ring-2 focus:ring-emerald-500/20 text-gray-900 text-sm">
                            <option value="">Select Program</option>
                            @foreach(\App\Models\Programme::all() as $programme)
                                <option value="{{ $programme->id }}">{{ $programme->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <select name="category" class="w-full px-4 py-2 bg-gray-50 border-none rounded-lg focus:ring-2 focus:ring-emerald-500/20 text-gray-900 text-sm">
                            <option value="Reforestation">Reforestation</option>
                            <option value="Energy">Energy</option>
                            <option value="Water">Water</option>
                            <option value="Agriculture">Agriculture</option>
                            <option value="Economic Growth">Economic Growth</option>
                            <option value="Health & WASH">Health & WASH</option>
                        </select>
                    </div>
                </div>

                <!-- Featured Image -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-4">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Cover Image</h3>
                    
                    <div class="relative w-full aspect-video bg-gray-50 rounded-xl border-2 border-dashed border-gray-200 hover:border-emerald-400 transition-colors flex flex-col items-center justify-center text-center p-4 cursor-pointer group">
                        <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        
                        <div class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-900">Click to upload</p>
                        <p class="text-xs text-gray-500 mt-1">SVG, PNG, JPG (Max. 2MB)</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-dashboard-layout>
