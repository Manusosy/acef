<footer class="bg-acef-dark text-white pt-20 pb-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 border-b border-white/10 pb-16">
            <!-- Brand & Social -->
            <div class="space-y-6">
                <a href="/" class="text-acef-green font-bold text-3xl tracking-tighter italic">ACEF</a>
                <p class="text-white/60 leading-relaxed">
                    Dedicated to protecting marine ecosystems and promoting sustainable conservation across Africa for a
                    greener future.
                </p>
                <div class="flex space-x-4">
                    <!-- Social Icons placeholders -->
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-acef-green transition-colors text-white/80 hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-acef-green transition-colors text-white/80 hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-semibold mb-6">Quick Links</h4>
                <ul class="space-y-4 text-white/60">
                    <li><a href="{{ route('about') }}" class="hover:text-acef-green transition-colors">About Us</a></li>
                    <li><a href="{{ route('programmes') }}" class="hover:text-acef-green transition-colors">Our
                            Programmes</a></li>
                    <li><a href="{{ route('projects') }}" class="hover:text-acef-green transition-colors">Ongoing
                            Projects</a></li>
                    <li><a href="{{ route('impact') }}" class="hover:text-acef-green transition-colors">Our Impact</a>
                    </li>
                    <li><a href="{{ route('resources') }}" class="hover:text-acef-green transition-colors">Knowledge
                            Hub</a></li>
                </ul>
            </div>

            <!-- Resources -->
            <div>
                <h4 class="text-lg font-semibold mb-6">Resources</h4>
                <ul class="space-y-4 text-white/60">
                    <li><a href="{{ route('resources') }}"
                            class="hover:text-acef-green transition-colors">Publications</a></li>
                    <li><a href="{{ route('impact') }}" class="hover:text-acef-green transition-colors">Annual
                            Reports</a></li>
                    <li><a href="{{ route('news') }}" class="hover:text-acef-green transition-colors">Newsletters</a>
                    </li>
                    <li><a href="{{ route('gallery') }}" class="hover:text-acef-green transition-colors">Gallery</a>
                    </li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h4 class="text-lg font-semibold mb-6">Stay Updated</h4>
                <p class="text-white/60 mb-6 font-light">Subscribe to our newsletter to receive the latest updates.</p>
                <form class="space-y-3">
                    <input type="email" placeholder="Your Email"
                        class="w-full bg-white/5 border border-white/10 rounded-full px-6 py-3 focus:outline-none focus:border-acef-green transition-colors text-white placeholder:text-white/20">
                    <button
                        class="w-full bg-acef-green py-3 rounded-full font-semibold hover:bg-opacity-90 transition-all shadow-lg">Subscribe</button>
                </form>
            </div>
        </div>

        <div class="pt-10 flex flex-col md:flex-row justify-between items-center text-white/40 text-sm">
            <p>&copy; 2025 ACEF. All rights reserved.</p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="{{ route('privacy') }}" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="{{ route('terms') }}" class="hover:text-white transition-colors">Terms of Service</a>
                <a href="{{ route('cookies') }}" class="hover:text-white transition-colors">Cookies Policy</a>
            </div>
        </div>
    </div>
</footer>