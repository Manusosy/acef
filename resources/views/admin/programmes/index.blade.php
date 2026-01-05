<x-app-dashboard-layout>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Programs</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Manage your organization's programs.</p>
            </div>
            <a href="{{ route('admin.programmes.create') }}" class="px-4 py-2 bg-acef-green hover:bg-emerald-600 text-white rounded-lg text-sm font-medium transition shadow-sm">
                Add New Program
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 overflow-hidden shadow-sm">
            <table class="w-full text-left">
                <thead class="bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Last Updated</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($programmes as $program)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                @if($program->image)
                                    <img src="{{ Storage::url($program->image) }}" class="w-10 h-10 rounded-lg object-cover bg-gray-100 dark:bg-gray-700">
                                @else
                                    <div class="w-10 h-10 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-lg">
                                        {{ substr($program->title, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <div class="text-base font-medium text-gray-900 dark:text-white">{{ $program->title }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-xs">{{ $program->excerpt }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                             <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $program->status_badge }}">
                                {{ ucfirst($program->status) }}
                            </span>
                        </td>
                        <td class=\"px-6 py-4 text-base text-gray-500 dark:text-gray-400\">
                            {{ $program->updated_at->diffForHumans() }}
                        </td>
                        <td class="px-6 py-4 text-right text-base font-medium">
                            <a href="{{ route('admin.programmes.edit', $program) }}" class="text-emerald-600 hover:text-emerald-900 dark:hover:text-emerald-400 mr-3">Edit</a>
                            <form action="{{ route('admin.programmes.destroy', $program) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this program?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 dark:hover:text-red-400">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                            No programs found. Start by creating one!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                {{ $programmes->links() }}
            </div>
        </div>
    </div>
</x-app-dashboard-layout>
