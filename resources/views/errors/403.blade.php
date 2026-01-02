@extends('layouts.app')

@section('title', '403 - Access Forbidden')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-red-50 to-orange-50 dark:from-gray-900 dark:to-gray-800 px-4">
    <div class="max-w-2xl w-full text-center">
        
        {{-- Error Code --}}
        <div class="mb-8">
            <h1 class="text-9xl font-black text-red-500 opacity-20">403</h1>
        </div>
        
        {{-- Error Message --}}
        <div class="mb-8">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                {{ __('errors.403.title') }}
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-400 leading-relaxed">
                {{ __('errors.403.message') }}
            </p>
        </div>
        
        {{-- Illustration --}}
        <div class="mb-8">
            <svg class="w-64 h-64 mx-auto text-red-300 dark:text-red-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
        </div>
        
        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('home') }}" 
               class="inline-flex items-center justify-center px-8 py-3 text-base font-semibold text-white bg-acef-green hover:bg-acef-dark rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                {{ __('errors.403.go_home') }}
            </a>
            
            @auth
            <a href="{{ route('dashboard') }}" 
               class="inline-flex items-center justify-center px-8 py-3 text-base font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 rounded-lg transition-colors duration-200">
                {{ __('errors.403.go_dashboard') }}
            </a>
            @endauth
        </div>
    </div>
</div>
@endsection
