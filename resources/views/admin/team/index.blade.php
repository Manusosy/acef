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
                <thead class="bg-gray-50 dark:bg-gray-900/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Member</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Group</th>
                        <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($members as $member)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $member->order }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0">
                                        @if($member->image)
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url($member->image) }}" alt="">
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 font-bold">
                                                {{ substr($member->name, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $member->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $member->role }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $member->group === 'leadership' ? 'bg-purple-50 text-purple-700' : 'bg-blue-50 text-blue-700' }}">
                                    {{ ucfirst($member->group) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.team.edit', $member) }}" class="text-emerald-600 hover:text-emerald-900 mr-3">Edit</a>
                                <form action="{{ route('admin.team.destroy', $member) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Remove this member?')">Remove</button>
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
