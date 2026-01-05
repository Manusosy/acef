<x-app-dashboard-layout>
    <div class="max-w-4xl mx-auto pb-20">
        <!-- Breadcrumb & Header -->
        <div class="mb-8">
            <nav class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-acef-green transition-colors">Dashboard</a>
                <span class="text-gray-300">/</span>
                <a href="{{ route('admin.donations.index') }}" class="hover:text-acef-green transition-colors">Donations</a>
                <span class="text-gray-300">/</span>
                <span class="text-gray-900 dark:text-white">Transaction #{{ $donation->id }}</span>
            </nav>
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">Transaction Details</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                        Processed on {{ $donation->created_at->format('F d, Y \a\t H:i A') }}
                    </p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('admin.donations.index') }}" class="px-6 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-700 font-bold text-xs uppercase tracking-widest rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">
                        Back to List
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Status Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-8 shadow-sm">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-black text-gray-900 dark:text-white uppercase tracking-tight">Payment Status</h2>
                        @if($donation->status === 'completed')
                            <span class="px-4 py-1.5 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 text-xs font-black uppercase tracking-widest rounded-lg border border-emerald-100 dark:border-emerald-800/50">Completed</span>
                        @elseif($donation->status === 'pending')
                            <span class="px-4 py-1.5 bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 text-xs font-black uppercase tracking-widest rounded-lg border border-amber-100 dark:border-amber-800/50">Pending</span>
                        @else
                            <span class="px-4 py-1.5 bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 text-xs font-black uppercase tracking-widest rounded-lg border border-red-100 dark:border-red-800/50">Failed</span>
                        @endif
                    </div>
                    
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 rounded-2xl bg-gray-50 dark:bg-gray-900 flex items-center justify-center text-2xl font-black text-gray-400 dark:text-gray-500">
                            $
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-1">Total Amount</p>
                            <span class="text-4xl font-black text-gray-900 dark:text-white">${{ number_format($donation->amount, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Transaction Data -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
                    <div class="px-8 py-6 border-b border-gray-100 dark:border-gray-700">
                        <h2 class="text-lg font-black text-gray-900 dark:text-white uppercase tracking-tight">Technical Details</h2>
                    </div>
                    <div class="divide-y divide-gray-100 dark:divide-gray-700">
                        <div class="grid grid-cols-2 p-6 hover:bg-gray-50/50 dark:hover:bg-gray-900/50 transition-colors">
                            <span class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Transaction ID</span>
                            <span class="text-sm font-mono font-medium text-gray-900 dark:text-white text-right">{{ $donation->transaction_reference ?? 'N/A' }}</span>
                        </div>
                        <div class="grid grid-cols-2 p-6 hover:bg-gray-50/50 dark:hover:bg-gray-900/50 transition-colors">
                            <span class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Gateway Reference</span>
                            <span class="text-sm font-mono font-medium text-gray-900 dark:text-white text-right">{{ $donation->gateway_reference ?? 'N/A' }}</span>
                        </div>
                        <div class="grid grid-cols-2 p-6 hover:bg-gray-50/50 dark:hover:bg-gray-900/50 transition-colors">
                            <span class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Payment Method</span>
                            <span class="text-sm font-black text-gray-900 dark:text-white text-right uppercase">{{ $donation->payment_method ?? 'Unknown' }}</span>
                        </div>
                        <div class="grid grid-cols-2 p-6 hover:bg-gray-50/50 dark:hover:bg-gray-900/50 transition-colors">
                            <span class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Currency</span>
                            <span class="text-sm font-black text-gray-900 dark:text-white text-right">USD</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Donor Info -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-8 shadow-sm">
                    <h2 class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-widest mb-6">Donor Information</h2>
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-acef-green to-emerald-600 flex items-center justify-center text-white font-black text-lg">
                            {{ substr($donation->donor_name ?? 'A', 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-base font-black text-gray-900 dark:text-white">{{ $donation->donor_name ?? 'Anonymous' }}</h3>
                            <p class="text-xs text-acef-green font-bold">Verified Donor</p>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Email Address</label>
                            <a href="mailto:{{ $donation->donor_email }}" class="text-sm font-medium text-gray-900 dark:text-white hover:text-acef-green transition-colors break-all">
                                {{ $donation->donor_email ?? 'N/A' }}
                            </a>
                        </div>
                        @if($donation->donor_phone)
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Phone Number</label>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $donation->donor_phone }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Related Campaign -->
                @if($donation->project) <!-- Assuming relation exists, fallback to general if not -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-8 shadow-sm">
                    <h2 class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-widest mb-4">Supported Campaign</h2>
                    <div class="flex items-start gap-4">
                        @if($donation->project->media_item)
                            <img src="{{ $donation->project->media_item->url }}" class="w-16 h-16 rounded-lg object-cover border border-gray-100 dark:border-gray-700">
                        @endif
                        <div>
                            <h3 class="text-sm font-bold text-gray-900 dark:text-white leading-tight mb-1">{{ $donation->project->title }}</h3>
                            <a href="{{ route('admin.projects.edit', $donation->project) }}" class="text-[10px] font-black text-acef-green uppercase tracking-widest hover:underline">View Campaign</a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-dashboard-layout>
