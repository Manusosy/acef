<x-app-dashboard-layout>
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Projects Management</h1>
                <p class="text-gray-500 mt-1">Manage, add, and edit development projects across regions.</p>
            </div>
            <div class="flex items-center gap-3">
                <button class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                    Export CSV
                </button>
                <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-500 text-white rounded-lg font-medium hover:bg-emerald-600 transition-colors shadow-sm shadow-emerald-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add New Project
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm mb-6 flex flex-col md:flex-row gap-4 items-center justify-between">
            <div class="relative w-full md:w-96">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" placeholder="Search projects by title, region, or ID..." 
                       class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border-none rounded-lg text-sm focus:ring-2 focus:ring-emerald-500/20 focus:bg-white transition-all placeholder-gray-400">
            </div>
            
            <div class="flex items-center gap-3 w-full md:w-auto overflow-x-auto">
                <select class="px-4 py-2.5 bg-gray-50 border-none rounded-lg text-sm font-medium text-gray-700 focus:ring-2 focus:ring-emerald-500/20 cursor-pointer">
                    <option>All Programs</option>
                    @foreach($programmes as $programme)
                        <option value="{{ $programme->id }}">{{ $programme->title }}</option>
                    @endforeach
                </select>
                
                <select class="px-4 py-2.5 bg-gray-50 border-none rounded-lg text-sm font-medium text-gray-700 focus:ring-2 focus:ring-emerald-500/20 cursor-pointer">
                    <option>All Countries</option>
                    <!-- Add countries dynamically later -->
                    <option>Kenya</option>
                    <option>Uganda</option>
                    <option>Tanzania</option>
                </select>

                 <select class="px-4 py-2.5 bg-gray-50 border-none rounded-lg text-sm font-medium text-gray-700 focus:ring-2 focus:ring-emerald-500/20 cursor-pointer">
                    <option>Year</option>
                    <option>2024</option>
                    <option>2023</option>
                </select>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white border border-gray-100 rounded-xl shadow-sm overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 text-xs font-bold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                        <th class="p-4 w-12 text-center">
                            <input type="checkbox" class="rounded border-gray-300 text-emerald-500 focus:ring-emerald-500">
                        </th>
                        <th class="p-4">Project</th>
                        <th class="p-4">Program</th>
                        <th class="p-4">Country</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($projects as $project)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="p-4 text-center">
                             <input type="checkbox" class="rounded border-gray-300 text-emerald-500 focus:ring-emerald-500">
                        </td>
                        <td class="p-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0 border border-gray-200">
                                    @if($project->image)
                                        <img src="{{ Storage::url($project->image) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 group-hover:text-emerald-600 transition-colors">{{ $project->title }}</h3>
                                    <p class="text-xs text-gray-400">ID: ACEF-24-{{ str_pad($project->id, 3, '0', STR_PAD_LEFT) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="p-4">
                            @if($project->programme)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                {{ $project->programme->title }}
                            </span>
                            @else
                                <span class="text-gray-400 text-sm">-</span>
                            @endif
                        </td>
                        <td class="p-4">
                            <span class="text-gray-600 font-medium text-sm">{{ $project->country }}</span>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full {{ $project->status === 'completed' ? 'bg-emerald-500' : ($project->status === 'draft' ? 'bg-amber-400' : 'bg-emerald-500') }}"></span> <!-- Assuming active/completed is green, draft is yellow/amber -->
                                <span class="text-sm font-medium text-gray-700 capitalize">{{ $project->status ?? 'Active' }}</span>
                            </div>
                        </td>
                        <td class="p-4 text-right">
                             <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('admin.projects.edit', $project) }}" class="p-2 text-gray-400 hover:text-emerald-600 bg-white hover:bg-emerald-50 rounded-lg border border-transparent hover:border-emerald-100 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure?');">
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
                        <td colspan="6" class="p-8 text-center text-gray-400">
                             No projects found. <a href="{{ route('admin.projects.create') }}" class="text-emerald-600 hover:underline">Add one now</a>.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between">
                <p class="text-sm text-gray-500">
                    Showing <span class="font-bold text-gray-900">{{ $projects->firstItem() ?? 0 }}-{{ $projects->lastItem() ?? 0 }}</span> of <span class="font-bold text-gray-900">{{ $projects->total() }}</span> projects
                </p>
                <div class="flex gap-2">
                     @if($projects->onFirstPage())
                        <button disabled class="px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-400 cursor-not-allowed">Previous</button>
                    @else
                        <a href="{{ $projects->previousPageUrl() }}" class="px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">Previous</a>
                    @endif
                    
                    @if($projects->hasMorePages())
                        <a href="{{ $projects->nextPageUrl() }}" class="px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">Next</a>
                    @else
                         <button disabled class="px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-400 cursor-not-allowed">Next</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-dashboard-layout>
