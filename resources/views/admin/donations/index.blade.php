<x-admin-layout>
    <x-slot name="header">Donations</x-slot>
    <x-slot name="title">Donations</x-slot>

    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Donations History</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">Track all incoming donations and payments</p>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 mb-6">
        <form method="GET" class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search donor, email, or reference..." 
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
            </div>
            <select name="status" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                <option value="">All Status</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Failed</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg">Filter</button>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-700/50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Donor</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Method</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($donations as $donation)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="px-6 py-4">
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $donation->is_anonymous ? 'Anonymous' : ($donation->donor_name ?? 'Unknown') }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $donation->donor_email }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ $donation->currency }} {{ number_format($donation->amount, 2) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-medium uppercase text-gray-500 dark:text-gray-400">
                                {{ $donation->payment_method }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $colors = [
                                    'completed' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
                                    'pending' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
                                    'failed' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
                                ];
                            @endphp
                            <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ $colors[$donation->status] ?? 'bg-gray-100' }}">
                                {{ ucfirst($donation->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right text-sm text-gray-500">
                            {{ $donation->created_at->format('M d, Y H:i') }}
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-6 py-12 text-center text-gray-500">No donations yet.</td></tr>
                @endforelse
            </tbody>
        </table>
        @if($donations->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">{{ $donations->links() }}</div>
        @endif
    </div>
</x-admin-layout>
