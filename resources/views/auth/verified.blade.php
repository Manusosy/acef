<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-[60vh] text-center">
        <!-- Success Icon -->
        <div class="mb-8 relative">
            <div class="w-32 h-32 bg-emerald-50 rounded-3xl flex items-center justify-center transform rotate-3">
                <div class="w-20 h-20 bg-acef-green rounded-2xl flex items-center justify-center text-white transform -rotate-3 shadow-xl">
                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12.9 2.5a2.5 2.5 0 0 1 3.8 0l2 2.6a1 1 0 0 1 .2.6v12.6a3 3 0 0 1-3 3h-12a3 3 0 0 1-3-3V5.7a1 1 0 0 1 .2-.6l2-2.6a2.5 2.5 0 0 1 3.8 0L9.4 6h5.2l-1.7-3.5zm-1.8 1.4-1.3 2.6H8.2L6.9 3.9a.5.5 0 0 0-.8 0l-1.6 2 8-3.4 8 3.4-1.6-2a.5.5 0 0 0-.8 0L16.8 6.5h-5.7zM18 8H6v10.1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V8zm-6.5 2a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3zm0 5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3z" style="display:none;"/> <!-- Simplified Rocket or similar -->
                        <path d="M2.227 12.392l6.57-2.673L14.77 2.05a1.216 1.216 0 012.274 0l2.365 4.966 5.378 1.115a1.216 1.216 0 01.378 2.22l-7.79 6.224 1.766 8.525a1.216 1.216 0 01-1.764 1.282L12 23.4l-6.958 4.246a1.216 1.216 0 01-1.86-1.155l1.328-7.85-5.705-5.56a1.216 1.216 0 01.674-2.062l.748-.035z" style="display:none;"/>
                        
                        <!-- Rocket Icon (Custom) -->
                         <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" style="display:none;" />
                         
                         <!-- Using a generic Check/Rocket SVG -->
                         <path d="M4.5 9.75a6 6 0 016-6h.003c.53 0 1.047.058 1.543.167A6.476 6.476 0 0116.5 9.75c0 3.195-2.28 5.85-5.352 6.574A11.96 11.96 0 014.5 9.75zM19.5 9.75a6 6 0 00-6-6 .75.75 0 000 1.5 4.5 4.5 0 119 0 .75.75 0 001.5 0 6 6 0 00-4.5 5.834z" style="display:none;"/>

                         <!-- Rocket Launch Icon -->
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Heading -->
        <h1 class="text-3xl font-black text-gray-900 mb-4 tracking-tight">Account Setup Complete!</h1>
        
        <!-- Description -->
        <p class="text-gray-500 max-w-md mx-auto mb-10 leading-relaxed font-light">
            Your administrator account has been successfully configured. You now have full access to manage programs, impact reports, and stakeholder data.
        </p>

        <!-- Actions -->
        <div class="flex flex-col items-center gap-6 w-full max-w-xs">
            <a href="{{ route('dashboard') }}" class="w-full bg-acef-green hover:bg-emerald-500 text-white font-bold py-4 px-8 rounded-xl shadow-lg shadow-acef-green/20 transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2 group">
                Go to Dashboard
                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            
            <a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-600 font-medium text-sm transition-colors">
                Visit Public Site
            </a>
        </div>
        
        <div class="mt-12 text-xs text-gray-400">
            Need help getting started? <a href="#" class="text-acef-green hover:underline">Read the Admin Guide</a>
        </div>
    </div>
</x-guest-layout>
