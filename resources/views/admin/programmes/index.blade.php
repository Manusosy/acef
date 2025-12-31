<x-app-dashboard-layout>
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Programs</h1>
                <p class="text-gray-500 mt-1">Manage the high-level programs and initiatives.</p>
            </div>
            <a href="{{ route('admin.programmes.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-500 text-white rounded-lg font-medium hover:bg-emerald-600 transition-colors shadow-sm shadow-emerald-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add New Program
            </a>
        </div>

        <!-- Filters (Hidden for now as list is likely short, but structure kept for consistency if needed) -->
        
        <!-- Table -->
        <div class="bg-white border border-gray-100 rounded-xl shadow-sm overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 text-xs font-bold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                        <th class="p-4 w-12 text-center">
                            <input type="checkbox" class="rounded border-gray-300 text-emerald-500 focus:ring-emerald-500">
                        </th>
                        <th class="p-4">Program Title</th>
                        <th class="p-4">Category</th>
                        <th class="p-4">Icon</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($programmes as $programme)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="p-4 text-center">
                             <input type="checkbox" class="rounded border-gray-300 text-emerald-500 focus:ring-emerald-500">
                        </td>
                        <td class="p-4">
                            <h3 class="font-bold text-gray-900 group-hover:text-emerald-600 transition-colors">{{ $programme->title }}</h3>
                        </td>
                        <td class="p-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-gray-100 text-gray-800">
                                {{ $programme->category ?? 'General' }}
                            </span>
                        </td>
                         <td class="p-4">
                            <span class="text-2xl">{{ $programme->icon ?? '🌱' }}</span>
                        </td>
                        <td class="p-4 text-right">
                             <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('admin.programmes.edit', $programme) }}" class="p-2 text-gray-400 hover:text-emerald-600 bg-white hover:bg-emerald-50 rounded-lg border border-transparent hover:border-emerald-100 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.programmes.destroy', $programme) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-600 bg-white hover:bg-red-50 rounded-lg border border-transparent hover:border-red-100 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-400">
                             No programs found. <a href="{{ route('admin.programmes.create') }}" class="text-emerald-600 hover:underline">Create one</a>.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-dashboard-layout>
