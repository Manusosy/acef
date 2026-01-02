{{-- Professional Cookie Consent Banner for ACEF --}}
<div x-data="cookieConsent()" 
     x-show="!hasConsent" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="translate-y-full opacity-0"
     x-transition:enter-end="translate-y-0 opacity-100"
     x-cloak
     class="fixed bottom-0 left-0 right-0 z-50 backdrop-blur-sm"
     style="display: none;">
    
    <div class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 border-t-4 border-acef-green shadow-2xl">
        <div class="max-w-7xl mx-auto px-4 py-6 md:px-8 md:py-8">
            <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                
                {{-- Content Section --}}
                <div class="flex-1 flex items-start gap-4">
                    {{-- ACEF Logo/Icon --}}
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-acef-green rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" 
                                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    
                    {{-- Text Content --}}
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-white mb-2 flex items-center gap-2">
                            {{ __('cookie_consent.title') }}
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-acef-green/20 text-acef-green border border-acef-green/30">
                                Privacy First
                            </span>
                        </h3>
                        <p class="text-sm text-gray-300 leading-relaxed max-w-3xl">
                            {{ __('cookie_consent.message') }}
                        </p>
                        <a href="{{ route('cookies') }}" 
                           class="inline-flex items-center gap-1 mt-3 text-sm font-medium text-acef-green hover:text-white transition-colors duration-200 group"
                           target="_blank">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ __('cookie_consent.learn_more') }}
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto lg:flex-shrink-0">
                    <button @click="rejectCookies()" 
                            class="group relative px-6 py-3 text-sm font-semibold text-gray-300 bg-gray-700/50 hover:bg-gray-700 border border-gray-600 hover:border-gray-500 rounded-lg transition-all duration-200 overflow-hidden">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            {{ __('cookie_consent.reject') }}
                        </span>
                    </button>
                    
                    <button @click="acceptCookies()" 
                            class="group relative px-8 py-3 text-sm font-bold text-white bg-gradient-to-r from-acef-green to-green-600 hover:from-green-600 hover:to-acef-green rounded-lg shadow-lg hover:shadow-acef-green/50 transition-all duration-200 overflow-hidden">
                        <span class="absolute inset-0 w-full h-full bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                            </svg>
                            {{ __('cookie_consent.accept') }}
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function cookieConsent() {
    return {
        hasConsent: false,
        
        init() {
            // Check if user has already made a choice
            this.hasConsent = this.getCookie('cookie_consent') !== null;
        },
        
        acceptCookies() {
            this.setCookie('cookie_consent', 'accepted', 365);
            this.hasConsent = true;
            
            // Enable analytics or other tracking scripts here
            this.enableTracking();
            
            // Show success feedback
            this.showToast('Cookie preferences saved');
        },
        
        rejectCookies() {
            this.setCookie('cookie_consent', 'rejected', 365);
            this.hasConsent = true;
            
            // Disable non-essential cookies
            this.disableTracking();
            
            // Show feedback
            this.showToast('Only essential cookies will be used');
        },
        
        setCookie(name, value, days) {
            const expires = new Date();
            expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
            document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/;SameSite=Lax`;
        },
        
        getCookie(name) {
            const nameEQ = name + "=";
            const ca = document.cookie.split(';');
            for(let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) === ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        },
        
        enableTracking() {
            // Enable Google Analytics or other tracking
            console.log('✓ Tracking enabled - User accepted cookies');
            // Example: gtag('consent', 'update', { 'analytics_storage': 'granted' });
        },
        
        disableTracking() {
            // Disable non-essential tracking
            console.log('✓ Tracking disabled - User rejected non-essential cookies');
            // Example: gtag('consent', 'update', { 'analytics_storage': 'denied' });
        },
        
        showToast(message) {
            // Simple console feedback (you can enhance this with a toast notification)
            console.log(`✓ ${message}`);
        }
    }
}
</script>

<style>
[x-cloak] { display: none !important; }

/* Smooth backdrop blur support */
@supports (backdrop-filter: blur(10px)) {
    .backdrop-blur-sm {
        backdrop-filter: blur(10px);
    }
}
</style>
