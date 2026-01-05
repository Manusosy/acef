<x-app-dashboard-layout>
    <x-slot name="header">Team Members</x-slot>
    <x-slot name="title">Team Members</x-slot>

    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Team Directory</h1>
            <a href="{{ route('admin.team.create') }}" class="px-4 py-2 bg-acef-green hover:bg-emerald-600 text-white font-medium rounded-lg shadow-sm">
                + Add Member
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Member</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Group</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($members as $member)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-base text-gray-500 dark:text-gray-400">{{ $member->sort_order }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0">
                                        @if($member->image)
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url($member->image) }}" alt="">
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-gray-500 dark:text-gray-400 font-bold">
                                                {{ substr($member->name, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-base font-medium text-gray-900 dark:text-white">{{ $member->name }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $member->role }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ $member->team_type === 'leadership' ? 'bg-purple-50 dark:bg-purple-900/20 text-purple-700 dark:text-purple-400' : '' }}
                                    {{ $member->team_type === 'project_lead' ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-400' : '' }}
                                    {{ $member->team_type === 'staff' ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400' : '' }}
                                ">
                                    {{ ucfirst(str_replace('_', ' ', $member->team_type)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-base font-medium">
                                <a href="{{ route('admin.team.edit', $member) }}" class="text-emerald-600 hover:text-emerald-900 dark:hover:text-emerald-400 mr-3">Edit</a>
                                <form action="{{ route('admin.team.destroy', $member) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:hover:text-red-400" onclick="return confirm('Remove this member?')">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                No team members found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $members->links() }}
    </div>
</x-app-dashboard-layout>
