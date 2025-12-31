<x-admin-layout>
    <x-slot name="header">Programmes</x-slot>
    <x-slot name="title">Programmes</x-slot>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div><h2 class="text-lg font-semibold text-gray-900 dark:text-white">All Programmes</h2><p class="text-sm text-gray-500 dark:text-gray-400">Manage organizational initiatives</p></div>
        <a href="{{ route('admin.programmes.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>Add Programme</a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-700/50"><tr><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Programme</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Category</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Order</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Status</th><th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Actions</th></tr></thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($programmes as $prog)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                    <td class="px-6 py-4"><div class="flex items-center gap-3"><span class="text-2xl">{{ $prog->icon ?: '📋' }}</span><span class="text-sm font-medium text-gray-900 dark:text-white">{{ $prog->title }}</span></div></td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $prog->category }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $prog->sort_order }}</td>
                    <td class="px-6 py-4"><span class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ $prog->is_active ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' : 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-400' }}">{{ $prog->is_active ? 'Active' : 'Inactive' }}</span></td>
                    <td class="px-6 py-4 text-right"><div class="flex items-center justify-end gap-2"><a href="{{ route('admin.programmes.edit', $prog) }}" class="p-2 text-gray-400 hover:text-emerald-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a><form method="POST" action="{{ route('admin.programmes.destroy', $prog) }}" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="p-2 text-gray-400 hover:text-red-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button></form></div></td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-12 text-center text-gray-500">No programmes yet. <a href="{{ route('admin.programmes.create') }}" class="text-emerald-600 hover:underline">Create one</a></td></tr>
                @endforelse
            </tbody>
        </table>
        @if($programmes->hasPages())<div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">{{ $programmes->links() }}</div>@endif
    </div>
</x-admin-layout>
