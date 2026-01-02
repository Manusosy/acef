<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ACEF') }} - Reset Password</title>
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
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                </div>
                <h2 class="text-2xl font-bold">Reset Password</h2>
                <p class="text-gray-400 text-sm mt-2">Enter your new password below.</p>
            </div>

            <div class="p-8">
                <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="space-y-2">
                        <label for="email" class="text-xs font-bold uppercase text-gray-900">Email Address</label>
                        <input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus 
                               class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-acef-green focus:ring-2 focus:ring-acef-green/20 outline-none transition-all text-gray-900 placeholder-gray-400"
                               value="{{ old('email', $request->email) }}">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <label for="password" class="text-xs font-bold uppercase text-gray-900">New Password</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                               class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-acef-green focus:ring-2 focus:ring-acef-green/20 outline-none transition-all text-gray-900 placeholder-gray-400">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-2">
                        <label for="password_confirmation" class="text-xs font-bold uppercase text-gray-900">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                               class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-acef-green focus:ring-2 focus:ring-acef-green/20 outline-none transition-all text-gray-900 placeholder-gray-400">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <button type="submit" class="w-full bg-acef-green text-acef-dark font-bold py-4 rounded-xl hover:bg-green-400 hover:shadow-lg hover:shadow-green-400/20 transition-all transform hover:-translate-y-0.5">
                        Reset Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
