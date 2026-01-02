@extends('layouts.app')

@section('title', 'Search Results - ' . $query)

@section('content')
    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 bg-acef-dark overflow-hidden">
        <div class="absolute inset-0 bg-[url('/images/pattern.svg')] opacity-5"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight mb-6">
                Search Results
            </h1>
            <p class="text-xl text-gray-400 max-w-2xl mx-auto">
                Showing results for "<span class="text-acef-green">{{ $query }}</span>"
            </p>
            
            <!-- Search Bar in Hero -->
            <div class="max-w-2xl mx-auto mt-8">
                <form action="{{ route('search') }}" method="GET" class="relative">
                    <input type="text" name="q" value="{{ $query }}" placeholder="Search again..." 
                           class="w-full pl-6 pr-14 py-4 bg-white/10 border border-white/20 rounded-2xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-acef-green focus:border-transparent transition-all backdrop-blur-sm">
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 p-2 text-acef-green hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Results Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($results->count() > 0)
                <div class="space-y-6">
                    @foreach($results as $result)
                        <a href="{{ $result->url }}" class="block p-8 bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 transition-all group">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-widest 
                                    @if($result->type == 'Programme') bg-blue-50 text-blue-600
                                    @elseif($result->type == 'Project') bg-purple-50 text-purple-600
                                    @elseif($result->type == 'Resource') bg-emerald-50 text-emerald-600
                                    @elseif($result->type == 'News') bg-orange-50 text-orange-600
                                    @endif">
                                    {{ $result->type }}
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 group-hover:text-acef-green transition-colors mb-2">
                                {{ $result->title }}
                            </h3>
                            <p class="text-gray-500 text-sm leading-relaxed">
                                {{ $result->snippet }}...
                            </p>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No results found</h3>
                    <p class="text-gray-500">We couldn't find anything matching your search. Try different keywords.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
