<x-app-dashboard-layout>
    <div class="space-y-8">
        <!-- Welcome Header -->
        <div class="bg-gradient-to-r from-acef-green to-emerald-700 rounded-2xl p-8 text-white shadow-lg overflow-hidden relative">
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Welcome back, {{ auth()->user()->name }}!</h1>
                    <p class="text-emerald-50/90 text-lg">Coordinator for <span class="font-bold underline">{{ $country }}</span>. Here's what's happening in your region.</p>
                </div>
                <div class="flex gap-4">
                    <a href="{{ route('admin.articles.create') }}" class="px-5 py-2.5 bg-white text-emerald-700 font-semibold rounded-xl hover:bg-emerald-50 transition-colors shadow-sm text-sm">
                        Write New Article
                    </a>
                </div>
            </div>
            <!-- Decorative circle -->
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 dark:text-blue-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Regional Articles</p>
                    <h4 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['articles'] }}</h4>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Regional Projects</p>
                    <h4 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['projects'] }}</h4>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-purple-50 dark:bg-purple-900/20 flex items-center justify-center text-purple-600 dark:text-purple-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Regional Programs</p>
                    <h4 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['programs'] }}</h4>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-amber-50 dark:bg-amber-900/20 flex items-center justify-center text-amber-600 dark:text-amber-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Pending Review</p>
                    <h4 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['pending_articles'] }}</h4>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Recent regional Articles -->
            <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <h3 class="font-bold text-gray-900 dark:text-white">Your Recent Articles</h3>
                    <a href="{{ route('admin.articles.index') }}" class="text-sm text-acef-green hover:underline font-medium">View All</a>
                </div>
                <div class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($recent_articles as $article)
                    <div class="p-6 flex items-start gap-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        @if($article->image)
                        <img src="{{ str_starts_with($article->image, 'http') ? $article->image : Storage::url($article->image) }}" class="w-20 h-20 rounded-lg object-cover shadow-sm">
                        @else
                        <div class="w-20 h-20 rounded-lg bg-gray-100 dark:bg-gray-900 flex items-center justify-center text-gray-400 text-xs">No Image</div>
                        @endif
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-xs font-semibold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">{{ $article->category->name ?? 'News' }}</span>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $article->status === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                    {{ $article->status }}
                                </span>
                            </div>
                            <h4 class="font-bold text-gray-900 dark:text-white mb-2 line-clamp-1 italic">{{ $article->title }}</h4>
                            <div class="flex items-center gap-3 text-xs text-gray-500">
                                <span class="flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ $article->created_at->format('M d, Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-8 text-center text-gray-500 italic">No articles created yet.</div>
                    @endforelse
                </div>
            </div>

            <!-- Regional Info Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-6">
                <h3 class="font-bold text-gray-900 dark:text-white mb-4">Regional Status</h3>
                <div class="space-y-4">
                    <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-900/50 border border-gray-100 dark:border-gray-700">
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-1">Assigned Country</p>
                        <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $country }}</p>
                    </div>
                    <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-900/50 border border-gray-100 dark:border-gray-700">
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-1">Role Permissions</p>
                        <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2 mt-2">
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Manage regional content
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Save as draft for review
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                View regional analytics
                            </li>
                        </ul>
                    </div>
                    <div class="mt-6">
                        <p class="text-xs text-gray-400 italic text-center">Contact Administrator for higher permissions.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-dashboard-layout>
