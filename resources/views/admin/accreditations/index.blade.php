<x-app-dashboard-layout>
    <x-slot name="header">Accreditations</x-slot>
    <x-slot name="title">Accreditations</x-slot>

    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Accreditations & Memberships</h1>
            <a href="{{ route('admin.accreditations.create') }}" class="px-4 py-2 bg-acef-green hover:bg-emerald-600 text-white font-medium rounded-lg shadow-sm">
                + Add New
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Acronym</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Description</th>
                        <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($accreditations as $acc)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 text-xs font-black rounded-lg bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                                    {{ $acc->acronym }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                {{ $acc->title }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                                {{ $acc->description }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.accreditations.edit', $acc) }}" class="text-emerald-600 hover:text-emerald-900 mr-3">Edit</a>
                                <form action="{{ route('admin.accreditations.destroy', $acc) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Delete this item?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                No accreditations found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $accreditations->links() }}
    </div>
</x-app-dashboard-layout>
