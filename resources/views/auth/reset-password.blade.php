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
<body class="font-sans antialiased bg-gray-50 text-gray-900 flex items-center justify-center min-h-screen p-6">
    
    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl p-10 space-y-8">
        
        <!-- Header -->
        <div class="text-center space-y-4">
            <div class="inline-flex justify-center mb-2">
                <div class="w-16 h-16 bg-emerald-50 rounded-2xl flex items-center justify-center text-acef-green transform rotate-3">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12.9 2.5a2.5 2.5 0 0 1 3.8 0l2 2.6a1 1 0 0 1 .2.6v12.6a3 3 0 0 1-3 3h-12a3 3 0 0 1-3-3V5.7a1 1 0 0 1 .2-.6l2-2.6a2.5 2.5 0 0 1 3.8 0L9.4 6h5.2l-1.7-3.5zm-1.8 1.4-1.3 2.6H8.2L6.9 3.9a.5.5 0 0 0-.8 0l-1.6 2 8-3.4 8 3.4-1.6-2a.5.5 0 0 0-.8 0L16.8 6.5h-5.7zM18 8H6v10.1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V8zm-6.5 2a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3zm0 5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3z"/></svg>
                </div>
            </div>
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Reset Password</h1>
            <p class="text-acef-green font-medium text-sm">Choose a strong password to secure your account.</p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('password.store') }}" class="space-y-6" x-data="{ 
            password: '', 
            show: false,
            showConfirm: false,
            get strength() {
                if (this.password.length === 0) return 0;
                if (this.password.length < 8) return 1;
                if (this.password.length >= 8 && /[A-Z]/.test(this.password) && /[0-9]/.test(this.password)) return 3;
                return 2;
            },
            get strengthLabel() {
                return ['Weak', 'Weak', 'Medium', 'Strong'][this.strength];
            },
            get strengthColor() {
                return ['bg-gray-200', 'bg-red-500', 'bg-yellow-500', 'bg-acef-green'][this.strength];
            },
            get strengthTextColor() {
                return ['text-gray-400', 'text-red-500', 'text-yellow-600', 'text-acef-green'][this.strength];
            }
        }">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email (Hidden/Readonly usually, but Laravel needs it) -->
            <input type="hidden" name="email" value="{{ old('email', $request->email) }}">

            <!-- New Password -->
            <div class="space-y-2">
                <label for="password" class="text-xs font-bold uppercase text-gray-900 tracking-wider">New Password</label>
                <div class="relative">
                    <input :type="show ? 'text' : 'password'" id="password" name="password" x-model="password" required autocomplete="new-password"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-acef-green focus:ring-4 focus:ring-acef-green/10 outline-none transition-all text-gray-900 placeholder-gray-400 text-sm"
                           placeholder="••••••••">
                    <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                        <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Strength Meter -->
            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100" x-show="password.length > 0" x-transition>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-gray-500">Strength</span>
                    <span class="text-xs font-bold transition-colors duration-300" :class="strengthTextColor" x-text="strengthLabel"></span>
                </div>
                <div class="h-1.5 w-full bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full transition-all duration-500 ease-out" :class="strengthColor" :style="'width: ' + (strength * 33.33) + '%'"></div>
                </div>
                <div class="flex items-center gap-2 mt-3 transition-colors duration-300" :class="password.length >= 8 ? 'text-acef-green' : 'text-gray-400'">
                    <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-xs font-medium">At least 8 characters</span>
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="space-y-2">
                <label for="password_confirmation" class="text-xs font-bold uppercase text-gray-900 tracking-wider">Confirm New Password</label>
                <div class="relative">
                    <input :type="showConfirm ? 'text' : 'password'" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-acef-green focus:ring-4 focus:ring-acef-green/10 outline-none transition-all text-gray-900 placeholder-gray-400 text-sm"
                           placeholder="••••••••">
                    <button type="button" @click="showConfirm = !showConfirm" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                        <svg x-show="!showConfirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <svg x-show="showConfirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-acef-green text-white font-bold py-4 rounded-xl hover:bg-emerald-500 hover:shadow-lg hover:shadow-acef-green/20 transition-all transform hover:-translate-y-1">
                Reset Password
            </button>

            <!-- Back to Login -->
            <div class="text-center">
                <a href="{{ route('login') }}" class="text-gray-400 hover:text-gray-600 text-sm font-medium transition-colors flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Back to Login
                </a>
            </div>
        </form>

        <div class="pt-6 border-t border-gray-100 text-center">
            <p class="text-xs text-gray-300">© {{ date('Y') }} ACEF. Secure System.</p>
        </div>
    </div>
</body>
</html>
