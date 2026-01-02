<x-app-layout>
    <div class="bg-gray-50 dark:bg-gray-900 min-h-screen py-12 lg:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumb -->
            <nav class="flex text-sm text-gray-500 dark:text-gray-400 mb-8">
                <a href="{{ route('home') }}" class="hover:text-acef-green">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('news') }}" class="hover:text-acef-green">News</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900 dark:text-white truncate">{{ $category ?? $article->category->name }}</span>
            </nav>

            <div class="max-w-4xl mx-auto">
                <!-- Category Badge -->
                <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300 text-xs font-bold uppercase tracking-wider rounded-sm mb-4">
                    {{ $article->category->name }}
                </span>

                <!-- Title -->
                <h1 class="text-3xl md:text-5xl font-bold text-gray-900 dark:text-white leading-tight mb-6">
                    {{ $article->title }}
                </h1>

                <!-- Meta -->
                <div class="flex items-center gap-4 mb-8 border-b border-gray-200 dark:border-gray-700 pb-8">
                    @if($article->author)
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($article->author->name) }}&background=0D9488&color=fff" alt="{{ $article->author->name }}" class="w-10 h-10 rounded-full">
                        <div>
                            <div class="text-sm font-bold text-gray-900 dark:text-white">{{ $article->author->name }}</div>
                            <div class="text-xs text-gray-500">{{ $article->published_at->format('F d, Y') }} • {{ $article->read_time ?? 5 }} min read</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Featured Image -->
            @if($article->image)
            <div class="max-w-5xl mx-auto mb-12">
                <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" class="w-full h-[400px] md:h-[500px] object-cover rounded-2xl shadow-lg">
            </div>
            @endif

            <div class="max-w-4xl mx-auto flex gap-12 relative">
                <!-- Share Sidebar (Desktop) -->
                <div class="hidden lg:flex flex-col gap-4 sticky top-24 h-max w-12 flex-shrink-0">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2" style="writing-mode: vertical-rl; text-orientation: mixed;">Share</span>
                    <a href="#" class="w-10 h-10 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:text-acef-green hover:border-acef-green transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:text-acef-green hover:border-acef-green transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:text-acef-green hover:border-acef-green transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                </div>

                <!-- Main Article Content -->
                <div class="flex-1 min-w-0">
                    <div class="prose prose-lg dark:prose-invert prose-emerald max-w-none">
                        {!! $article->content !!}
                    </div>

                    <!-- Tags -->
                    @if(is_array($article->tags) && count($article->tags) > 0)
                    <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
                        <h4 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider mb-4">Tags</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($article->tags as $tag)
                                <a href="#" class="px-3 py-1 bg-gray-100 dark:bg-gray-800 hover:bg-acef-green hover:text-white dark:hover:bg-acef-green dark:hover:text-white rounded-full text-sm text-gray-600 dark:text-gray-400 transition-colors">
                                    #{{ $tag }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Related Articles -->
            @if($related->count() > 0)
            <div class="max-w-7xl mx-auto mt-20 pt-12 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Related Articles</h2>
                    <a href="{{ route('news') }}" class="flex items-center text-acef-green hover:text-emerald-700 font-medium">
                        View All
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($related as $relatedArticle)
                    <article class="group">
                        <a href="{{ route('news.show', $relatedArticle) }}" class="block overflow-hidden rounded-xl mb-4">
                            @if($relatedArticle->image)
                                <img src="{{ Storage::url($relatedArticle->image) }}" alt="{{ $relatedArticle->title }}" class="w-full h-48 object-cover transform group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-48 bg-gray-200 dark:bg-gray-700"></div>
                            @endif
                        </a>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-xs font-bold text-acef-green uppercase tracking-wider">{{ $relatedArticle->category->name }}</span>
                            <span class="w-1 h-1 rounded-full bg-gray-300 dark:bg-gray-600"></span>
                            <span class="text-xs text-gray-500">{{ $relatedArticle->published_at->format('M d, Y') }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-acef-green transition-colors">
                            <a href="{{ route('news.show', $relatedArticle) }}">{{ $relatedArticle->title }}</a>
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-2">{{ $relatedArticle->excerpt }}</p>
                    </article>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
