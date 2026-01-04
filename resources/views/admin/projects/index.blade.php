<x-app-dashboard-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Projects</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Oversee, track, and manage all environmental initiatives and programs.</p>
            </div>
            <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-500 text-white font-bold rounded-xl hover:bg-emerald-600 transition-colors shadow-lg shadow-emerald-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Create New Project
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Active -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm flex items-center justify-between">
                <div>
                    <h4 class="text-gray-500 dark:text-gray-400 text-sm font-medium mb-1">Active Projects</h4>
                    <span class="text-3xl font-bold text-gray-900 dark:text-white">{{ \App\Models\Project::where('status', 'ongoing')->count() }}</span>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/></svg>
                </div>
            </div>
            <!-- Pending -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                <div>
                    <h4 class="text-gray-500 text-sm font-medium mb-1">Pending Approval</h4>
                    <span class="text-3xl font-bold text-gray-900">{{ \App\Models\Project::where('status', 'draft')->count() }}</span>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                </div>
            </div>
            <!-- Completed -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                <div>
                    <h4 class="text-gray-500 text-sm font-medium mb-1">Completed</h4>
                    <span class="text-3xl font-bold text-gray-900">{{ \App\Models\Project::where('status', 'completed')->count() }}</span>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                </div>
            </div>
        </div>

        <!-- Filters + Table Container -->
        <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl shadow-sm overflow-hidden">
            <!-- Filter Bar -->
            <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex flex-col md:flex-row gap-4 justify-between items-center">
                <div class="flex items-center gap-2">
                    <button class="px-4 py-2 bg-gray-50 text-gray-900 font-bold rounded-lg text-sm hover:bg-gray-100 transition-colors">All</button>
                    <button class="px-4 py-2 text-gray-500 font-medium rounded-lg text-sm hover:bg-gray-50 hover:text-gray-900 transition-colors">Active</button>
                    <button class="px-4 py-2 text-gray-500 font-medium rounded-lg text-sm hover:bg-gray-50 hover:text-gray-900 transition-colors">Completed</button>
                </div>
                <div class="flex items-center gap-3 w-full md:w-auto">
                    <button class="flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-bold text-gray-700 hover:bg-gray-50">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        Filter
                    </button>
                    <button class="flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-bold text-gray-700 hover:bg-gray-50">
                         <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/></svg>
                        Sort
                    </button>
                </div>
            </div>

            <!-- Table -->
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 text-xs font-bold text-gray-400 uppercase tracking-wider bg-gray-50/30">
                        <th class="p-6 w-12 text-center">
                            <input type="checkbox" class="rounded border-gray-300 text-emerald-500 focus:ring-emerald-500 h-5 w-5">
                        </th>
                        <th class="p-6">Project Name</th>
                        <th class="p-6">Region</th>
                        <th class="p-6">Status</th>
                        <th class="p-6">Progress</th>
                        <th class="p-6">Partners</th>
                        <th class="p-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($projects as $project)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/30 transition-colors group">
                        <td class="p-6 text-center">
                             <input type="checkbox" class="rounded border-gray-300 text-emerald-500 focus:ring-emerald-500 h-5 w-5">
                        </td>
                        <td class="p-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0 border border-gray-200">
                                    @if($project->image)
                                        <img src="{{ Storage::url($project->image) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-50">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-acef-green transition-colors">{{ $project->title }}</h3>
                                    <p class="text-xs text-gray-400 font-medium">ID: PRJ-2024-{{ str_pad($project->id, 3, '0', STR_PAD_LEFT) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="p-6">
                            @php
                                $countryCount = is_array($project->country) ? count($project->country) : (empty($project->country) ? 0 : 1);
                            @endphp
                            <span class="text-gray-700 font-medium text-sm">{{ $countryCount }} {{ Str::plural('Country', $countryCount) }}</span>
                        </td>
                        <td class="p-6">
                             <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold capitalize
                                {{ $project->status === 'ongoing' ? 'bg-emerald-100 text-emerald-700' : ($project->status === 'draft' ? 'bg-amber-100 text-amber-700' : 'bg-blue-100 text-blue-700') }}">
                                {{ $project->status === 'ongoing' ? 'Active' : $project->status }}
                            </span>
                        </td>
                        <td class="p-6">
                            @php
                                $percent = $project->goal_amount > 0 ? min(100, round(($project->raised_amount / $project->goal_amount) * 100)) : 0;
                            @endphp
                            <div class="w-32">
                                <div class="flex justify-between mb-1">
                                    <span class="text-xs font-bold text-gray-700">{{ $percent }}%</span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-1.5">
                                    <div class="bg-emerald-500 h-1.5 rounded-full" style="width: {{ $percent }}%"></div>
                                </div>
                            </div>
                        </td>
                       <td class="p-6">
                            <div class="flex -space-x-3">
                                @foreach($project->partners->take(3) as $partner)
                                    <div class="w-8 h-8 rounded-full border-2 border-white bg-white overflow-hidden shadow-sm" title="{{ $partner->name }}">
                                        @if($partner->logo)
                                            <img src="{{ Storage::url($partner->logo) }}" alt="" class="w-full h-full object-contain p-1">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-[10px] font-black text-emerald-500">
                                                {{ substr($partner->name, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                                @if($project->partners->count() > 3)
                                    <div class="w-8 h-8 rounded-full border-2 border-white bg-gray-50 flex items-center justify-center text-[10px] font-black text-gray-500 shadow-sm">
                                        +{{ $project->partners->count() - 3 }}
                                    </div>
                                @endif
                                @if($project->partners->isEmpty())
                                    <span class="text-xs text-gray-400 italic font-medium">None</span>
                                @endif
                            </div>
                        </td>
                        <td class="p-6 text-right">
                             <div class="flex items-center justify-end gap-2 text-gray-400">
                                <a href="{{ route('admin.projects.edit', $project) }}" class="p-2 hover:text-emerald-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                </a>
                                <button class="p-2 hover:text-red-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-12 text-center text-gray-400">
                             No projects found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
             <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-end gap-3">
                 {{ $projects->links() }}
            </div>
        </div>
    </div>
</x-app-dashboard-layout>
