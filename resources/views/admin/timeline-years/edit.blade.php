<x-app-dashboard-layout>
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Year: {{ $timelineYear->year }}</h1>
        <a href="{{ route('admin.timeline-years.index') }}" class="text-gray-500 hover:text-gray-700">Back to List</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Year Details -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h2 class="text-lg font-bold mb-4 text-gray-900 dark:text-white">Year Settings</h2>
                <form action="{{ route('admin.timeline-years.update', $timelineYear) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Year</label>
                        <input type="number" name="year" value="{{ $timelineYear->year }}" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Order</label>
                        <input type="number" name="order" value="{{ $timelineYear->order }}" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    </div>

                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_visible" value="1" {{ $timelineYear->is_visible ? 'checked' : '' }} class="rounded border-gray-300 text-acef-green focus:ring-acef-green">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Visible</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full px-4 py-2 bg-acef-green text-white rounded-lg hover:bg-green-700">Update Year</button>
                </form>
            </div>
        </div>

        <!-- Achievements List -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Achievements</h2>
                    <a href="{{ route('admin.timeline-achievements.create', ['year_id' => $timelineYear->id]) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded text-sm">
                        Add Achievement
                    </a>
                </div>
                
                @if($timelineYear->achievements->count() > 0)
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Media</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Achievement Details</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Order</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Visibility</th>
                            <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($timelineYear->achievements as $achievement)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if(!empty($achievement->images) && count($achievement->images) > 0)
                                    <div class="flex -space-x-2 overflow-hidden">
                                        @foreach(array_slice($achievement->images, 0, 3) as $img)
                                            <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white object-cover" src="{{ Storage::url($img) }}" alt="Preview">
                                        @endforeach
                                        @if(count($achievement->images) > 3)
                                            <div class="h-10 w-10 rounded-full ring-2 ring-white bg-gray-100 flex items-center justify-center text-xs font-bold text-gray-500">
                                                +{{ count($achievement->images) - 3 }}
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-gray-900 dark:text-white">{{ $achievement->title }}</div>
                                <div class="text-xs text-gray-500 flex items-center mt-1">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    {{ $achievement->location ?? 'No Location' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                <span class="px-2 py-1 bg-gray-100 rounded text-xs font-mono">{{ $achievement->order }}</span>
                            </td>
                             <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-bold rounded-full {{ $achievement->is_visible ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $achievement->is_visible ? 'Visible' : 'Hidden' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.timeline-achievements.edit', $achievement) }}" class="text-acef-green hover:text-green-900 font-bold mr-3">Edit</a>
                                <form action="{{ route('admin.timeline-achievements.destroy', $achievement) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this achievement?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-bold">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <div class="p-6 text-center text-gray-500">No achievements recorded for this year yet.</div>
                @endif
            </div>
        </div>
    </div>
</x-app-dashboard-layout>
