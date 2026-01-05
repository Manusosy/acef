<x-app-dashboard-layout>
    <div class="mb-8 flex flex-col md:flex-row justify-between md:items-center gap-4">
        <div>
            <h1 class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">Timeline</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Manage global engagements and achievements by year.</p>
        </div>
        <a href="{{ route('admin.timeline-years.create') }}" class="inline-flex items-center justify-center bg-acef-green hover:bg-green-700 text-white font-bold px-6 py-3 rounded-xl transition-all transform hover:scale-105 shadow-lg shadow-green-500/20">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Add New Year
        </a>
    </div>

    @if($years->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($years as $year)
        <div class="group bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100 dark:border-gray-700 relative overflow-hidden">
            <!-- Decorative Backing -->
            <div class="absolute top-0 right-0 p-4 opacity-10 font-black text-6xl text-gray-900 dark:text-white pointer-events-none select-none">
                {{ $year->year }}
            </div>

            <div class="relative z-10">
                <div class="flex justify-between items-start mb-4">
                    <h2 class="text-4xl font-black text-acef-dark dark:text-white tracking-tight">{{ $year->year }}</h2>
                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $year->is_visible ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400' }}">
                        {{ $year->is_visible ? 'Published' : 'Draft' }}
                    </span>
                </div>
                
                <div class="flex items-center gap-4 text-gray-600 dark:text-gray-400 mb-8">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-acef-green check-circle" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="font-bold text-gray-900 dark:text-white">{{ $year->achievements_count }}</span>
                        <span class="ml-1 text-sm">Achievements</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('admin.timeline-years.edit', $year) }}" class="col-span-2 flex items-center justify-center w-full px-4 py-3 bg-gray-50 hover:bg-acef-green hover:text-white dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 font-bold rounded-xl transition-colors group-hover:bg-acef-green group-hover:text-white">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Manage Content
                    </a>
                    
                    <form action="{{ route('admin.timeline-years.destroy', $year) }}" method="POST" class="col-span-2 mt-2" onsubmit="return confirm('Are you sure? This will delete all achievements for this year.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg text-sm font-medium transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Delete Year
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-20 bg-gray-50 dark:bg-gray-800 rounded-3xl border-2 border-dashed border-gray-200 dark:border-gray-700">
        <div class="w-20 h-20 bg-white dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">No Timeline Years Found</h3>
        <p class="text-gray-500 mb-8 max-w-sm mx-auto">Start building your global engagements timeline by adding your first year.</p>
        <a href="{{ route('admin.timeline-years.create') }}" class="inline-flex items-center px-6 py-3 bg-acef-green text-white font-bold rounded-xl hover:bg-green-700 transition-colors">
            Create First Year
        </a>
    </div>
    @endif
</x-app-dashboard-layout>
