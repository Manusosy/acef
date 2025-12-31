<x-admin-layout>
    <x-slot name="header">Edit Programme</x-slot>
    <x-slot name="title">Edit Programme</x-slot>
    <div class="max-w-2xl">
        <a href="{{ route('admin.programmes.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 mb-6"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>Back</a>
        <form method="POST" action="{{ route('admin.programmes.update', $programme) }}" class="space-y-6">@csrf @method('PUT')
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 space-y-4">
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title *</label><input type="text" name="title" value="{{ old('title', $programme->title) }}" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category *</label><input type="text" name="category" value="{{ old('category', $programme->category) }}" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Icon</label><input type="text" name="icon" value="{{ old('icon', $programme->icon) }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                </div>
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description *</label><textarea name="description" rows="4" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">{{ old('description', $programme->description) }}</textarea></div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Stats Label</label><input type="text" name="stats_label" value="{{ old('stats_label', $programme->stats_label) }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sort Order</label><input type="number" name="sort_order" value="{{ old('sort_order', $programme->sort_order) }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                </div>
                <label class="flex items-center gap-3"><input type="checkbox" name="is_active" value="1" {{ $programme->is_active ? 'checked' : '' }} class="w-5 h-5 rounded text-emerald-600"><span class="text-sm text-gray-700 dark:text-gray-300">Active</span></label>
            </div>
            <div class="flex gap-4"><button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg">Update</button><a href="{{ route('admin.programmes.index') }}" class="px-6 py-2.5 text-gray-600">Cancel</a></div>
        </form>
    </div>
</x-admin-layout>
