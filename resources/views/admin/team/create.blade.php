<x-admin-layout>
    <x-slot name="header">Add Team Member</x-slot>
    <x-slot name="title">Add Team Member</x-slot>

    <div class="max-w-2xl">
        <a href="{{ route('admin.team.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 mb-6"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>Back</a>

        <form method="POST" action="{{ route('admin.team.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name *</label><input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Role *</label><input type="text" name="role" value="{{ old('role') }}" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                </div>
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Team Type *</label><select name="team_type" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"><option value="leadership">Leadership</option><option value="project_lead">Project Lead</option><option value="staff" selected>Staff</option></select></div>
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Bio</label><textarea name="bio" rows="3" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">{{ old('bio') }}</textarea></div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label><input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Twitter Handle</label><input type="text" name="twitter" value="{{ old('twitter') }}" placeholder="@username" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                </div>
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">LinkedIn URL</label><input type="url" name="linkedin" value="{{ old('linkedin') }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Photo</label><input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-emerald-50 file:text-emerald-700"></div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sort Order</label><input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                    <div class="flex items-center pt-6"><label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" name="is_active" value="1" checked class="w-5 h-5 rounded text-emerald-600"><span class="text-sm text-gray-700 dark:text-gray-300">Active</span></label></div>
                </div>
            </div>
            <div class="flex gap-4"><button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg">Add Member</button><a href="{{ route('admin.team.index') }}" class="px-6 py-2.5 text-gray-600 dark:text-gray-400">Cancel</a></div>
        </form>
    </div>
</x-admin-layout>
