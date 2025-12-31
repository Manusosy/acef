<x-admin-layout>
    <x-slot name="header">Team Members</x-slot>
    <x-slot name="title">Team Members</x-slot>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">All Team Members</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Manage your organization's team</p>
        </div>
        <a href="{{ route('admin.team.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            Add Member
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @forelse($members as $member)
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow">
                <div class="h-32 bg-gradient-to-br from-emerald-500/20 to-teal-500/20 flex items-center justify-center">
                    @if($member->image)
                        <img src="{{ Storage::url($member->image) }}" alt="" class="w-20 h-20 rounded-full object-cover border-4 border-white dark:border-gray-800 shadow">
                    @else
                        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white text-2xl font-bold border-4 border-white dark:border-gray-800 shadow">
                            {{ strtoupper(substr($member->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <div class="p-4 text-center">
                    <h3 class="font-semibold text-gray-900 dark:text-white">{{ $member->name }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">{{ $member->role }}</p>
                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ $member->team_type === 'leadership' ? 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400' : ($member->team_type === 'project_lead' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-400') }}">
                        {{ ucfirst(str_replace('_', ' ', $member->team_type)) }}
                    </span>
                </div>
                <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700 flex justify-center gap-2">
                    <a href="{{ route('admin.team.edit', $member) }}" class="p-2 text-gray-400 hover:text-emerald-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a>
                    <form method="POST" action="{{ route('admin.team.destroy', $member) }}" onsubmit="return confirm('Remove this member?')">@csrf @method('DELETE')<button type="submit" class="p-2 text-gray-400 hover:text-red-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button></form>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-gray-500 dark:text-gray-400">No team members yet. <a href="{{ route('admin.team.create') }}" class="text-emerald-600 hover:underline">Add one</a></div>
        @endforelse
    </div>
    @if($members->hasPages())<div class="mt-6">{{ $members->links() }}</div>@endif
</x-admin-layout>
