<x-app-dashboard-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">User Management</h1>
                <p class="text-gray-500 text-sm mt-1">Manage platform administrators, editors, and viewer permissions.</p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-emerald-500 text-white font-medium rounded-xl hover:bg-emerald-600 transition-colors shadow-lg shadow-emerald-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                Add New User
            </a>
        </div>

        <!-- Filters -->
        <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm flex flex-col md:flex-row gap-4 items-center justify-between">
            <div class="flex items-center gap-2 w-full md:w-auto">
                <button class="flex items-center gap-2 px-4 py-2.5 bg-gray-50 text-gray-700 font-medium rounded-xl hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filter
                </button>
                <select class="px-4 py-2.5 bg-gray-50 border-none rounded-xl text-sm font-medium text-gray-700 focus:ring-2 focus:ring-emerald-500/20 cursor-pointer">
                    <option>All Roles</option>
                    <option>Administrator</option>
                    <option>Editor</option>
                    <option>Viewer</option>
                </select>
                <select class="px-4 py-2.5 bg-gray-50 border-none rounded-xl text-sm font-medium text-gray-700 focus:ring-2 focus:ring-emerald-500/20 cursor-pointer">
                    <option>All Status</option>
                    <option>Active</option>
                    <option>Inactive</option>
                </select>
            </div>
            
            <div class="text-sm font-medium text-gray-500">
                <span class="text-gray-900 font-bold">{{ $users->total() }}</span> users found
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 text-xs font-bold text-gray-400 uppercase tracking-wider bg-gray-50/30">
                        <th class="p-6 w-12 text-center">
                            <input type="checkbox" class="rounded border-gray-300 text-emerald-500 focus:ring-emerald-500 h-5 w-5">
                        </th>
                        <th class="p-6">User</th>
                        <th class="p-6">Role</th>
                        <th class="p-6">Status</th>
                        <th class="p-6">Last Active</th>
                        <th class="p-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="p-6 text-center">
                             <input type="checkbox" class="rounded border-gray-300 text-emerald-500 focus:ring-emerald-500 h-5 w-5">
                        </td>
                        <td class="p-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-lg">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900">{{ $user->name }}</h3>
                                    <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="p-6">
                            @if($user->isAdmin())
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-bold bg-purple-100 text-purple-700">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l5-5z" clip-rule="evenodd"/></svg>
                                    Administrator
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-bold bg-blue-100 text-blue-700">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/></svg>
                                    Coordinator
                                </span>
                            @endif
                        </td>
                        <td class="p-6">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                Active
                            </span>
                        </td>
                        <td class="p-6">
                            <div class="flex items-center gap-2 text-sm text-gray-500">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $user->updated_at->diffForHumans() }}
                            </div>
                        </td>
                        <td class="p-6 text-right">
                             <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="#" class="p-2 text-gray-400 hover:text-emerald-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                </a>
                                <button class="p-2 text-gray-400 hover:text-red-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-gray-400">
                             No users found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-end gap-3">
                 @if($users->onFirstPage())
                    <button disabled class="px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-400 cursor-not-allowed">Previous</button>
                @else
                    <a href="{{ $users->previousPageUrl() }}" class="px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">Previous</a>
                @endif
                
                @if($users->hasMorePages())
                    <a href="{{ $users->nextPageUrl() }}" class="px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">Next</a>
                @else
                     <button disabled class="px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-400 cursor-not-allowed">Next</button>
                @endif
            </div>
        </div>
    </div>
</x-app-dashboard-layout>
