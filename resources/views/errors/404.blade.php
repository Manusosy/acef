@extends('layouts.app')

@section('title', '404 - Page Not Found')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 px-4">
    <div class="max-w-2xl w-full text-center">
        
        {{-- Error Code --}}
        <div class="mb-8">
            <h1 class="text-9xl font-black text-acef-green opacity-20">404</h1>
        </div>
        
        {{-- Error Message --}}
        <div class="mb-8">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                {{ __('errors.404.title') }}
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-400 leading-relaxed">
                {{ __('errors.404.message') }}
            </p>
        </div>
        
        {{-- Illustration --}}
        <div class="mb-8">
            <svg class="w-64 h-64 mx-auto text-gray-300 dark:text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        
        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('home') }}" 
               class="inline-flex items-center justify-center px-8 py-3 text-base font-semibold text-white bg-acef-green hover:bg-acef-dark rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                {{ __('errors.404.go_home') }}
            </a>
            
            <button onclick="window.history.back()" 
                    class="inline-flex items-center justify-center px-8 py-3 text-base font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 rounded-lg transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                {{ __('errors.404.go_back') }}
            </button>
        </div>
        
        {{-- Helpful Links --}}
        <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                {{ __('errors.404.helpful_links') }}
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('about') }}" class="text-sm text-acef-green hover:text-acef-dark font-medium">{{ __('nav.about') }}</a>
                <a href="{{ route('programmes') }}" class="text-sm text-acef-green hover:text-acef-dark font-medium">{{ __('nav.programmes') }}</a>
                <a href="{{ route('projects') }}" class="text-sm text-acef-green hover:text-acef-dark font-medium">{{ __('nav.projects') }}</a>
                <a href="{{ route('contact') }}" class="text-sm text-acef-green hover:text-acef-dark font-medium">{{ __('nav.contact') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
