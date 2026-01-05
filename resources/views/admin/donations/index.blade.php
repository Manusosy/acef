<x-app-dashboard-layout>
    <div class="space-y-8 pb-10">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <nav class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-acef-green transition-colors">Admin Dashboard</a>
                    <span class="text-gray-300">/</span>
                    <span class="text-gray-900 dark:text-white">Donations & Activity</span>
                </nav>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Donations & Payments</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Track financial impact, manage campaigns, and monitor donor activity.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-acef-dark dark:bg-acef-green text-white dark:text-acef-dark font-black text-xs uppercase tracking-widest rounded-xl hover:bg-emerald-600 dark:hover:bg-emerald-400 transition-all shadow-lg hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                    New Campaign
                </a>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white dark:bg-gray-800 p-8 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm relative overflow-hidden group">
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Global Impact (Total)</h4>
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 flex items-center justify-center font-bold">USD</div>
                    </div>
                    <div class="flex items-end gap-3">
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">${{ number_format($stats['total_raised'], 0) }}</span>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-3">Cumulative funding raised</p>
                </div>
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-emerald-50/30 rounded-full blur-2xl"></div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-8 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm relative overflow-hidden group">
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Active Supporters</h4>
                        <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-900/30 text-blue-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/></svg>
                        </div>
                    </div>
                    <div class="flex items-end gap-3">
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['active_donors']) }}</span>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-3">Unique impact partners</p>
                </div>
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-blue-50/30 rounded-full blur-2xl"></div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-8 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm relative overflow-hidden group">
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Avg. Contribution</h4>
                        <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-900/30 text-amber-600 flex items-center justify-center">
                          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11 4a1 1 0 10-2 0v4a1 1 0 102 0V7zm-3 1a1 1 0 10-2 0v3a1 1 0 102 0V8zM8 9a1 1 0 00-2 0v2a1 1 0 102 0V9z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>
                    <div class="flex items-end gap-3">
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">${{ number_format($stats['avg_donation'], 0) }}</span>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-3">Mean donation per session</p>
                </div>
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-amber-50/30 rounded-full blur-2xl"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Recent Transactions -->
            <div class="lg:col-span-2 space-y-6">
                <div class="flex items-center justify-between px-2">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">Recent Transactions</h2>
                    <form action="{{ route('admin.donations.index') }}" method="GET" class="relative group">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search donors..." class="pl-10 pr-4 py-2 bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-700 rounded-xl text-xs text-gray-900 dark:text-white focus:ring-2 focus:ring-acef-green outline-none transition-all w-48 group-focus-within:w-64">
                        <svg class="w-4 h-4 absolute left-3 top-2.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </form>
                </div>

                <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-50/50 dark:bg-gray-700/50 border-b border-gray-100 dark:border-gray-700 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    <th class="px-6 py-4">Donor</th>
                                    <th class="px-6 py-4">Amount</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4">Date</th>
                                    <th class="px-6 py-4 text-right"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                                @forelse($donations as $donation)
                                <tr class="group hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="text-base font-medium text-gray-900 dark:text-white">{{ $donation->donor_name ?? 'Anonymous' }}</span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $donation->donor_email ?? 'No Email' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-base font-medium text-gray-900 dark:text-white">${{ number_format($donation->amount, 2) }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($donation->status === 'completed')
                                            <span class="px-3 py-1 bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300 text-xs font-medium rounded-full">Success</span>
                                        @elseif($donation->status === 'pending')
                                            <span class="px-3 py-1 bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300 text-xs font-medium rounded-full">Pending</span>
                                        @else
                                            <span class="px-3 py-1 bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300 text-xs font-medium rounded-full">Failed</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $donation->created_at->format('M d, Y') }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('admin.donations.show', $donation) }}" class="text-gray-300 hover:text-acef-green transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5h8m-8 4h8m-8 4h8m-8 4h8M3 5h4M3 9h4M3 13h4M3 17h4"/></svg>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500 text-sm font-medium italic">No transactions found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($donations->hasPages())
                    <div class="px-6 py-4 bg-gray-50/50 dark:bg-gray-900/50 border-t border-gray-100 dark:border-gray-700">
                        {{ $donations->links() }}
                    </div>
                    @endif
                </div>
            </div>

            <!-- Active Campaigns -->
            <div class="space-y-6">
                <div class="flex items-center justify-between px-2">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">Impact Hubs</h2>
                    <a href="{{ route('admin.projects.index') }}" class="text-xs font-semibold text-acef-green uppercase tracking-wider hover:underline">All Campaigns</a>
                </div>

                <div class="space-y-4">
                    @forelse($campaigns as $campaign)
                    <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl p-5 shadow-sm group hover:border-acef-green transition-all transform hover:-translate-y-1">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 rounded-xl bg-gray-100 dark:bg-gray-900 overflow-hidden border border-gray-100 dark:border-gray-700 shrink-0">
                                @if($campaign->media_item)
                                    <img src="{{ $campaign->media_item->url }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-base font-medium text-gray-900 dark:text-white truncate group-hover:text-acef-green transition-colors">{{ $campaign->title }}</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wider">{{ $campaign->programme->title ?? 'Main Fund' }}</p>
                            </div>
                        </div>

                        @php
                            $percent = $campaign->goal_amount > 0 ? min(100, round(($campaign->raised_amount / $campaign->goal_amount) * 100)) : 0;
                        @endphp
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-semibold text-gray-900 dark:text-white uppercase tracking-wider">${{ number_format($campaign->raised_amount) }} raised</span>
                                <span class="text-xs font-semibold text-acef-green uppercase tracking-wider">{{ $percent }}%</span>
                            </div>
                            <div class="w-full bg-gray-100 dark:bg-gray-900 rounded-full h-1.5 overflow-hidden">
                                <div class="bg-acef-green h-full rounded-full transition-all duration-1000" style="width: {{ $percent }}%"></div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="bg-gray-50 dark:bg-gray-900/50 rounded-xl p-8 border border-dashed border-gray-200 dark:border-gray-700 text-center">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">No Active Campaigns</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-dashboard-layout>
