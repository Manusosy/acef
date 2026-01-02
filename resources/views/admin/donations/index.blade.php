<x-app-dashboard-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <nav class="flex items-center gap-2 text-xs text-gray-400 mb-1">
                    <a href="#" class="hover:text-emerald-600">Dashboard</a>
                    <span>/</span>
                    <span class="text-gray-900 font-medium">Donations & Payments</span>
                </nav>
                <h1 class="text-3xl font-black text-gray-900 dark:text-white leading-tight">Donations & Payments</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Configure gateways, manage campaigns, and track financial impact.</p>
            </div>
            <button class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-500 text-white font-black rounded-xl hover:bg-emerald-600 transition-all shadow-lg shadow-emerald-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                Create New Campaign
            </button>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm relative overflow-hidden group">
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Raised</h4>
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-500 flex items-center justify-center font-bold text-xs">$</div>
                    </div>
                    <div class="flex items-end gap-3">
                        <span class="text-4xl font-black text-gray-900 dark:text-white">${{ number_format($stats['total_raised'], 0) }}</span>
                        <span class="mb-1 text-xs font-bold text-emerald-500 bg-emerald-50 px-2 py-0.5 rounded-full flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                            12%
                        </span>
                    </div>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-2">vs. last month</p>
                </div>
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-emerald-50/30 rounded-full blur-2xl group-hover:bg-emerald-50/50 transition-colors"></div>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm relative overflow-hidden group">
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Active Donors</h4>
                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-500 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/></svg>
                        </div>
                    </div>
                    <div class="flex items-end gap-3">
                        <span class="text-4xl font-black text-gray-900">{{ number_format($stats['active_donors']) }}</span>
                        <span class="mb-1 text-xs font-bold text-emerald-500 bg-emerald-50 px-2 py-0.5 rounded-full flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                            5%
                        </span>
                    </div>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-2">vs. last month</p>
                </div>
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-blue-50/30 rounded-full blur-2xl group-hover:bg-blue-50/50 transition-colors"></div>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm relative overflow-hidden group">
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Avg. Donation</h4>
                        <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-500 flex items-center justify-center font-bold text-xs">
                          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11 4a1 1 0 10-2 0v4a1 1 0 102 0V7zm-3 1a1 1 0 10-2 0v3a1 1 0 102 0V8zM8 9a1 1 0 00-2 0v2a1 1 0 102 0V9z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>
                    <div class="flex items-end gap-3">
                        <span class="text-4xl font-black text-gray-900">${{ number_format($stats['avg_donation'], 0) }}</span>
                        <span class="mb-1 text-xs font-bold text-red-500 bg-red-50 px-2 py-0.5 rounded-full flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                            2%
                        </span>
                    </div>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-2">vs. last month</p>
                </div>
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-amber-50/30 rounded-full blur-2xl group-hover:bg-amber-50/50 transition-colors"></div>
            </div>
        </div>

        <!-- Payment Gateways -->
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-black text-gray-900 dark:text-white leading-tight">Payment Gateways</h2>
                <a href="#" class="text-xs font-bold text-emerald-600 hover:underline">View Documentation</a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($gateways as $gateway)
                <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm flex items-start gap-6 transition-all hover:shadow-md">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0 
                        {{ $gateway['id'] === 'stripe' ? 'bg-indigo-600 text-white' : 
                          ($gateway['id'] === 'mpesa' ? 'bg-emerald-600 text-white' : 
                          ($gateway['id'] === 'paypal' ? 'bg-blue-900 text-white' : 'bg-emerald-400 text-white')) }}">
                        <span class="text-2xl font-black">{{ substr($gateway['name'], 0, 1) }}</span>
                    </div>
                    <div class="flex-1 space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-black text-gray-900 dark:text-white">{{ $gateway['name'] }}</h3>
                                <p class="text-xs text-gray-400 dark:text-gray-500 font-medium">{{ $gateway['desc'] }}</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="flex items-center gap-1.5 text-[10px] font-black uppercase tracking-widest {{ $gateway['connected'] ? 'text-emerald-500' : 'text-gray-300' }}">
                                    <div class="w-1.5 h-1.5 rounded-full {{ $gateway['connected'] ? 'bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.4)] animate-pulse' : 'bg-gray-300' }}"></div>
                                    {{ $gateway['connected'] ? 'Connected' : 'Disconnected' }}
                                </span>
                                <div class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer" {{ $gateway['connected'] ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-gray-100 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                                </div>
                            </div>
                        </div>
                        
                        @if($gateway['connected'])
                        <div class="bg-gray-50 dark:bg-gray-900 rounded-2xl p-4 relative group">
                            <label class="block text-[8px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-1">Publishable Key</label>
                            <div class="flex items-center justify-between">
                                <code class="text-xs text-gray-600 dark:text-gray-400 font-medium font-mono">{{ $gateway['key'] }}</code>
                                <button class="text-gray-300 hover:text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </button>
                            </div>
                        </div>
                        @else
                        <button class="w-full py-3 border border-dashed border-gray-200 rounded-2xl text-xs font-black text-gray-400 uppercase tracking-widest hover:bg-gray-50 hover:border-emerald-200 hover:text-emerald-500 transition-all">
                            Configure Integration
                        </button>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Active Campaigns -->
        <div class="space-y-6">
            <h2 class="text-xl font-black text-gray-900 dark:text-white leading-tight">Active Campaigns</h2>
            <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-3xl shadow-sm overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50/50 dark:bg-gray-900/50 border-b border-gray-50 dark:border-gray-700 text-[10px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest">
                            <th class="px-8 py-5">Campaign Name</th>
                            <th class="px-8 py-5">Goal Amount</th>
                            <th class="px-8 py-5">Raised Progress</th>
                            <th class="px-8 py-5">Status</th>
                            <th class="px-8 py-5 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                        @forelse($campaigns as $campaign)
                        <tr class="group hover:bg-gray-50/30 dark:hover:bg-gray-700/30 transition-colors">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-gray-100 dark:bg-gray-700 overflow-hidden border border-gray-200/50 dark:border-gray-600/50">
                                        @if($campaign->image)
                                            <img src="{{ Storage::url($campaign->image) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-black text-gray-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-acef-green transition-colors">{{ $campaign->title }}</h4>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ $campaign->programme->title ?? 'General' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-sm font-black text-gray-900 dark:text-white">${{ number_format($campaign->goal_amount, 0) }}</span>
                            </td>
                            <td class="px-8 py-6">
                                @php
                                    $percent = $campaign->goal_amount > 0 ? min(100, round(($campaign->raised_amount / $campaign->goal_amount) * 100)) : 0;
                                @endphp
                                <div class="w-48">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs font-black text-gray-900">${{ number_format($campaign->raised_amount, 0) }}</span>
                                        <span class="text-[10px] font-black text-emerald-500">{{ $percent }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-2 shadow-inner">
                                        <div class="bg-emerald-500 h-2 rounded-full transition-all duration-1000" style="width: {{ $percent }}%"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-emerald-100 italic">Active</span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <button class="p-2 text-gray-300 hover:text-gray-900 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-12 text-center text-gray-400 text-sm font-medium italic">No active campaigns found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-dashboard-layout>
