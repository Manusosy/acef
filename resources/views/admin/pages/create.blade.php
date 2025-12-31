<x-admin-layout>
    <x-slot name="header">Create Page</x-slot>
    <x-slot name="title">Create Page</x-slot>
    <div class="max-w-2xl">
        <a href="{{ route('admin.pages.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 mb-6"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>Back</a>
        <form method="POST" action="{{ route('admin.pages.store') }}" class="space-y-6">@csrf
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 space-y-4">
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title *</label><input type="text" name="title" value="{{ old('title') }}" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Slug</label><input type="text" name="slug" value="{{ old('slug') }}" placeholder="auto-generated from title" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                <div class="flex gap-4">
                    <label class="flex items-center gap-2"><input type="checkbox" name="is_published" value="1" checked class="w-5 h-5 rounded text-emerald-600"><span class="text-sm text-gray-700 dark:text-gray-300">Published</span></label>
                    <label class="flex items-center gap-2"><input type="checkbox" name="has_hero" value="1" class="w-5 h-5 rounded text-emerald-600"><span class="text-sm text-gray-700 dark:text-gray-300">Has Hero</span></label>
                </div>
            </div>
            <div class="flex gap-4"><button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg">Create Page</button><a href="{{ route('admin.pages.index') }}" class="px-6 py-2.5 text-gray-600">Cancel</a></div>
        </form>
    </div>
</x-admin-layout>
