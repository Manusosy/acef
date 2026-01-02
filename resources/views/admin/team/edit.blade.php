<x-app-dashboard-layout>
    <x-slot name="header">Edit Member</x-slot>
    <x-slot name="title">Edit Member</x-slot>

    <div class="max-w-4xl">
        <a href="{{ route('admin.team.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 mb-6">
            ← Back to Directory
        </a>

        <form action="{{ route('admin.team.update', $teamMember) }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-8 space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name *</label>
                    <input type="text" name="name" value="{{ old('name', $teamMember->name) }}" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Role/Position *</label>
                    <input type="text" name="role" value="{{ old('role', $teamMember->role) }}" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Group *</label>
                    <select name="group" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                        <option value="leadership" {{ $teamMember->group == 'leadership' ? 'selected' : '' }}>Leadership</option>
                        <option value="staff" {{ $teamMember->group == 'staff' ? 'selected' : '' }}>Staff / Operations</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Display Order (Optional)</label>
                    <input type="number" name="order" value="{{ old('order', $teamMember->order) }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Profile Image</label>
                    <div class="flex items-center gap-6">
                        @if($teamMember->image)
                            <img src="{{ Storage::url($teamMember->image) }}" class="w-20 h-20 rounded-full object-cover bg-gray-100">
                        @endif
                         <div x-data class="flex-1">
                             <label class="block text-xs text-gray-400 mb-1">Select image from Media Library</label>
                             <div class="relative">
                                 <input type="text" name="image" id="image_path" value="{{ $teamMember->image }}" placeholder="Click to select image..." 
                                        class="w-full pl-4 pr-10 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white cursor-pointer hover:bg-white dark:hover:bg-gray-700 transition-colors" readonly onclick="window.openMediaPicker((media) => { document.getElementById('image_path').value = media.url; })">
                                 <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                     <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                 </div>
                             </div>
                         </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-6">
                <button type="submit" class="px-6 py-2 bg-acef-green hover:bg-emerald-600 text-white font-medium rounded-lg shadow-sm">
                    Update Member
                </button>
            </div>
        </form>
    </div>
</x-app-dashboard-layout>
