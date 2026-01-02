@extends('layouts.app')

@section('title', '503 - Maintenance Mode')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-cyan-50 dark:from-gray-900 dark:to-gray-800 px-4">
    <div class="max-w-2xl w-full text-center">
        
        {{-- Error Code --}}
        <div class="mb-8">
            <h1 class="text-9xl font-black text-blue-500 opacity-20">503</h1>
        </div>
        
        {{-- Error Message --}}
        <div class="mb-8">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                {{ __('errors.503.title') }}
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-400 leading-relaxed">
                {{ __('errors.503.message') }}
            </p>
        </div>
        
        {{-- Illustration --}}
        <div class="mb-8">
            <svg class="w-64 h-64 mx-auto text-blue-300 dark:text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
        </div>
        
        {{-- Status Updates --}}
        <div class="mb-8 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                {{ __('errors.503.status_title') }}
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ __('errors.503.status_message') }}
            </p>
        </div>
        
        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button onclick="location.reload()" 
                    class="inline-flex items-center justify-center px-8 py-3 text-base font-semibold text-white bg-acef-green hover:bg-acef-dark rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                {{ __('errors.503.refresh') }}
            </button>
        </div>
    </div>
</div>
@endsection
