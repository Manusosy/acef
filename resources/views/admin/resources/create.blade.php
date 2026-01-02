<x-app-dashboard-layout>
    <x-slot name="header">Add Resource</x-slot>
    <x-slot name="title">Add Resource</x-slot>

    <div class="max-w-4xl">
        <a href="{{ route('admin.resources.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 mb-6">
            ← Back to Resources
        </a>

        <form action="{{ route('admin.resources.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-8 space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title *</label>
                    <input type="text" name="title" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                    <textarea name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Type *</label>
                    <select name="type" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                        <option value="Report">Report</option>
                        <option value="Policy">Policy</option>
                        <option value="Publication">Publication</option>
                        <option value="Guide">Guide</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category (Filter)</label>
                    <input type="text" name="category" placeholder="e.g. Climate Action" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Year *</label>
                    <input type="text" name="year" value="{{ date('Y') }}" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">File (PDF, Doc, etc.) *</label>
                    <div x-data class="flex-1">
                         <label class="block text-xs text-gray-400 mb-1">Select file from Media Library</label>
                         <div class="relative">
                             <input type="text" name="file_path" id="file_path" placeholder="Click to select file..." required 
                                    class="w-full pl-4 pr-10 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white cursor-pointer hover:bg-white dark:hover:bg-gray-700 transition-colors" readonly onclick="window.openMediaPicker((media) => { document.getElementById('file_path').value = media.path; })">
                             <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                 <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                             </div>
                         </div>
                    </div>
                </div>

                <div class="md:col-span-2 pt-4">
                    <label class="flex items-center gap-3">
                        <input type="checkbox" name="is_locked" value="1" class="w-5 h-5 rounded border-gray-300 text-acef-green focus:ring-acef-green">
                        <span class="text-sm text-gray-700 dark:text-gray-300">Members Only (Locked)</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end pt-6">
                <button type="submit" class="px-6 py-2 bg-acef-green hover:bg-emerald-600 text-white font-medium rounded-lg shadow-sm">
                    Upload Resource
                </button>
            </div>
        </form>
    </div>
</x-app-dashboard-layout>
