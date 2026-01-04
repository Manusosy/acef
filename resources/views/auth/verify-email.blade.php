<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-[60vh] text-center">
        <!-- Icon -->
        <div class="mb-8 relative">
            <div class="w-32 h-32 bg-emerald-50 rounded-3xl flex items-center justify-center transform -rotate-3">
                <div class="w-20 h-20 bg-acef-green rounded-2xl flex items-center justify-center text-white transform rotate-3 shadow-xl">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <!-- Status Indicator -->
                <div class="absolute -top-2 -right-2 w-8 h-8 bg-yellow-400 rounded-full border-4 border-white flex items-center justify-center animate-pulse">
                    <span class="block w-2 h-2 bg-white rounded-full"></span>
                </div>
            </div>
        </div>

        <!-- Heading -->
        <h1 class="text-3xl font-black text-gray-900 mb-4 tracking-tight">Verify Your Email</h1>

        <!-- Description -->
        <div class="text-gray-500 max-w-md mx-auto mb-10 leading-relaxed font-light space-y-4">
            <p>
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?') }}
            </p>
            <p class="text-sm">
                {{ __('If you didn\'t receive the email, we will gladly send you another.') }}
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-8 font-medium text-sm text-acef-green bg-emerald-50 px-6 py-3 rounded-xl border border-emerald-100">
                {{ __('A new verification link has been sent to your email address.') }}
            </div>
        @endif

        <!-- Actions -->
        <div class="flex flex-col items-center gap-6 w-full max-w-sm">
            <form method="POST" action="{{ route('verification.send') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full bg-acef-green hover:bg-emerald-600 active:bg-emerald-700 text-white font-bold py-4 px-8 rounded-2xl shadow-xl shadow-emerald-200/50 transform hover:-translate-y-1 active:translate-y-0 transition-all duration-200 flex items-center justify-center gap-3 group cursor-pointer">
                    <span>{{ __('Resend Verification Email') }}</span>
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-gray-400 hover:text-acef-green font-semibold text-sm transition-colors flex items-center gap-2 group">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
        
        <div class="mt-16 text-xs text-gray-400 font-medium">
            © {{ date('Y') }} ACEF NGO. All rights reserved.
        </div>
    </div>
</x-guest-layout>
