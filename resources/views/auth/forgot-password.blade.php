<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ACEF') }} - Forgot Password</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <div class="min-h-screen flex items-center justify-center p-6">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="p-8 text-center bg-acef-dark text-white">
                <div class="flex justify-center mb-4">
                    <div class="w-12 h-12 bg-acef-green rounded-xl flex items-center justify-center text-acef-dark">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                    </div>
                </div>
                <h2 class="text-2xl font-bold">Forgot Password?</h2>
                <p class="text-gray-400 text-sm mt-2">No problem. Just let us know your email address.</p>
            </div>

            <div class="p-8">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <div class="mb-6 text-sm text-gray-600">
                    {{ __('We will email you a password reset link that will allow you to choose a new one.') }}
                </div>

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div class="space-y-2">
                        <label for="email" class="text-xs font-bold uppercase text-gray-900">Email Address</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                               class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-acef-green focus:ring-2 focus:ring-acef-green/20 outline-none transition-all text-gray-900 placeholder-gray-400"
                               placeholder="name@acef.org">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between">
                         <a href="{{ route('login') }}" class="text-sm font-medium text-gray-500 hover:text-gray-900">
                            ← Back to Login
                        </a>
                        <button type="submit" class="bg-acef-green text-acef-dark font-bold px-6 py-3 rounded-xl hover:bg-green-400 hover:shadow-lg hover:shadow-green-400/20 transition-all transform hover:-translate-y-0.5">
                            Email Reset Link
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
