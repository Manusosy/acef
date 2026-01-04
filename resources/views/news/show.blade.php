<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" content="notranslate">
    <title>{{ $article->title }} - ACEF</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans bg-white dark:bg-gray-950 transition-colors duration-300">
    @include('components.header')
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
                <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300 text-xs font-bold uppercase tracking-wider rounded-lg mb-4">
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
                <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" class="w-full h-[400px] md:h-[500px] object-cover rounded-lg shadow-lg">
            </div>
            @endif

            <div class="max-w-4xl mx-auto flex gap-12 relative">
                <!-- Share Sidebar (Desktop) -->
                <div class="hidden lg:flex flex-col gap-4 sticky top-24 h-max w-12 flex-shrink-0">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2" style="writing-mode: vertical-rl; text-orientation: mixed;">Share</span>
                    
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:text-[#1877F2] hover:border-[#1877F2] transition-colors" title="Share on Facebook">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </a>

                    <!-- X / Twitter -->
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->title) }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:text-black dark:hover:text-white hover:border-black dark:hover:border-white transition-colors" title="Share on X">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>

                    <!-- LinkedIn -->
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:text-[#0A66C2] hover:border-[#0A66C2] transition-colors" title="Share on LinkedIn">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                    </a>

                     <!-- WhatsApp -->
                     <a href="https://wa.me/?text={{ urlencode($article->title . ' ' . url()->current()) }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:text-[#25D366] hover:border-[#25D366] transition-colors" title="Share on WhatsApp">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.008-.57-.008-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    </a>
                </div>

                <!-- Main Article Content -->
                <div class="flex-1 min-w-0">
                    <div class="prose prose-lg dark:prose-invert prose-emerald max-w-none 
                        dark:!text-white 
                        dark:prose-headings:!text-white 
                        dark:prose-p:!text-white 
                        dark:prose-lead:!text-white
                        dark:prose-strong:!text-white
                        dark:prose-ul:!text-white
                        dark:prose-ol:!text-white
                        dark:prose-li:!text-white
                        dark:prose-blockquote:!text-white
                        dark:prose-a:text-acef-green">
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
    @include('components.footer')
</body>
</html>
