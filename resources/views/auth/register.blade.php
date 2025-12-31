<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ACEF') }} - Register</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <div class="min-h-screen flex">
        <!-- Left Side - Brand & Hero -->
        <div class="hidden lg:flex w-1/2 bg-acef-dark relative items-center justify-center overflow-hidden">
            <!-- Background Image -->
            <div class="absolute inset-0 z-0">
                <img src="/mission_vision_africa_1766827653058.png" alt="Landscape" class="w-full h-full object-cover opacity-40">
                <div class="absolute inset-0 bg-gradient-to-t from-acef-dark via-acef-dark/20 to-transparent"></div>
            </div>
            
            <div class="relative z-10 w-full max-w-2xl px-12 text-white">
                <div class="mb-12">
                    <div class="flex items-center space-x-3 mb-8">
                        <div class="w-12 h-12 bg-acef-green rounded-xl flex items-center justify-center text-acef-dark">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                        </div>
                        <span class="text-3xl font-bold tracking-tighter">ACEF</span>
                    </div>
                    <h1 class="text-6xl font-black leading-tight tracking-tight mb-6">Join the Movement for Change.</h1>
                    <p class="text-xl text-gray-300 font-light leading-relaxed">Create your account to access resources, manage projects, and contribute to ACEF's mission.</p>
                </div>
            </div>
        </div>

        <!-- Right Side - Register Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white overflow-y-auto">
            <div class="w-full max-w-md space-y-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 tracking-tight mb-2">Create Account</h2>
                    <p class="text-gray-500 text-sm">Fill in your details to get started.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div class="space-y-2">
                        <label for="name" class="text-xs font-bold uppercase text-gray-900">Full Name</label>
                        <input id="name" type="text" name="name" :value="old('name')" required autofocus 
                               class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-acef-green focus:ring-2 focus:ring-acef-green/20 outline-none transition-all text-gray-900 placeholder-gray-400"
                               placeholder="John Doe">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Role Selection -->
                    <div class="space-y-2" x-data="{ role: '' }">
                        <label for="role_id" class="text-xs font-bold uppercase text-gray-900">I am joining as a...</label>
                        <div class="relative">
                            <select id="role_id" name="role_id" x-model="role" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-acef-green focus:ring-2 focus:ring-acef-green/20 outline-none transition-all text-gray-900 bg-white appearance-none cursor-pointer">
                                <option value="" disabled selected>Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                        <p x-show="role" class="text-xs text-acef-green font-medium" x-transition>
                            <span x-show="role != '' && $el.closest('select').options[$el.closest('select').selectedIndex].text.includes('Coordinator')">
                                Note: Country Coordinators require an @acef-ngo.org email address.
                            </span>
                        </p>
                        <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="space-y-2">
                        <label for="email" class="text-xs font-bold uppercase text-gray-900">Email Address</label>
                        <input id="email" type="email" name="email" :value="old('email')" required 
                               class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-acef-green focus:ring-2 focus:ring-acef-green/20 outline-none transition-all text-gray-900 placeholder-gray-400"
                               placeholder="name@acef.org">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="space-y-2" x-data="{ show: false }">
                        <label for="password" class="text-xs font-bold uppercase text-gray-900">Password</label>
                        <div class="relative">
                            <input :type="show ? 'text' : 'password'" id="password" name="password" required autocomplete="new-password"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-acef-green focus:ring-2 focus:ring-acef-green/20 outline-none transition-all text-gray-900 placeholder-gray-400"
                                   placeholder="••••••••">
                            <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-2">
                        <label for="password_confirmation" class="text-xs font-bold uppercase text-gray-900">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                               class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-acef-green focus:ring-2 focus:ring-acef-green/20 outline-none transition-all text-gray-900 placeholder-gray-400"
                               placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <button type="submit" class="bg-acef-green text-acef-dark font-bold py-4 px-8 rounded-xl hover:bg-green-400 hover:shadow-lg hover:shadow-green-400/20 transition-all transform hover:-translate-y-0.5">
                            Register
                        </button>
                    </div>
                </form>

                <div class="pt-8 border-t border-gray-100 text-center space-y-4">
                    <p class="text-xs text-gray-400">© {{ date('Y') }} Africa Climate and Environment Foundation. Secure Server.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
