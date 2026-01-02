<x-app-dashboard-layout>
    <x-slot name="header">Edit Accreditation</x-slot>
    <x-slot name="title">Edit Accreditation</x-slot>

    <div class="max-w-4xl">
        <a href="{{ route('admin.accreditations.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 mb-6">
            ← Back to List
        </a>

        <form action="{{ route('admin.accreditations.update', $accreditation) }}" method="POST" class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-8 space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title *</label>
                    <input type="text" name="title" value="{{ old('title', $accreditation->title) }}" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                </div>

                <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Acronym/Short Code</label>
                <input type="text" name="acronym" value="{{ old('acronym', $accreditation->acronym) }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Logo</label>
                <div class="flex items-center gap-6">
                    @if($accreditation->image)
                        <div class="w-20 h-20 bg-gray-100 rounded-xl flex items-center justify-center p-2 border border-gray-200">
                             <img src="{{ Storage::url($accreditation->image) }}" class="w-full h-full object-contain">
                        </div>
                    @endif
                    <div x-data class="flex-1">
                         <label class="block text-xs text-gray-400 mb-1">Select image from Media Library</label>
                         <div class="relative">
                             <input type="text" name="image" id="image_path" value="{{ $accreditation->image }}" placeholder="Click to select image..." 
                                    class="w-full pl-4 pr-10 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white cursor-pointer hover:bg-white dark:hover:bg-gray-700 transition-colors" readonly onclick="window.openMediaPicker((media) => { document.getElementById('image_path').value = media.url; })">
                             <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                 <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                             </div>
                         </div>
                     </div>
                </div>
            </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description *</label>
                    <textarea name="description" rows="3" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">{{ old('description', $accreditation->description) }}</textarea>
                </div>
            </div>

            <div class="flex justify-end pt-6">
                <button type="submit" class="px-6 py-2 bg-acef-green hover:bg-emerald-600 text-white font-medium rounded-lg shadow-sm">
                    Update Item
                </button>
            </div>
        </form>
    </div>
</x-app-dashboard-layout>
