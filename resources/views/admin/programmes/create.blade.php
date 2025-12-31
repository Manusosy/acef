<x-app-dashboard-layout>
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Add Program</h1>
                <p class="text-gray-500 mt-1">Define a new strategic program.</p>
            </div>
            <a href="{{ route('admin.programmes.index') }}" class="px-4 py-2 bg-white border border-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                Cancel
            </a>
        </div>

        <form action="{{ route('admin.programmes.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Program Title *</label>
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Sustainable Agriculture" 
                           class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500/20 text-gray-900 placeholder-gray-400 font-medium" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Category</label>
                    <input type="text" name="category" value="{{ old('category') }}" placeholder="e.g. Agriculture" 
                           class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500/20 text-gray-900 placeholder-gray-400">
                </div>

                <div>
                     <label class="block text-sm font-bold text-gray-700 mb-2">Icon (Emoji)</label>
                     <div class="flex items-center gap-4">
                        <input type="text" name="icon" value="{{ old('icon', '🌱') }}" placeholder="🌱" 
                               class="w-20 px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500/20 text-gray-900 text-center text-2xl">
                        <p class="text-sm text-gray-500">Paste an emoji here to represent the program.</p>
                     </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="4" placeholder="Briefly describe what this program aims to achieve..." 
                              class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500/20 text-gray-900 placeholder-gray-400"></textarea>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full py-4 bg-emerald-500 text-white font-bold rounded-xl hover:bg-emerald-600 transition-colors shadow-lg shadow-emerald-200">
                        Create Program
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-dashboard-layout>
