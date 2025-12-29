<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Privacy Policy - ACEF</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-white overflow-x-hidden">
        @include('components.header')

        <!-- Simple Breadcrumb -->
        <div class="pt-32 pb-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex text-xs font-bold uppercase tracking-widest text-gray-300">
                <a href="{{ route('home') }}" class="hover:text-acef-green transition-colors">Home</a>
                <span class="mx-3 text-gray-200">/</span>
                <span class="text-acef-dark">Privacy Policy</span>
            </nav>
        </div>

        <main class="pb-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="space-y-6 mb-16">
                    <h1 class="text-6xl md:text-7xl font-black text-acef-dark tracking-tighter leading-none">Privacy Policy</h1>
                    <p class="text-gray-400 text-lg font-light italic leading-relaxed max-w-3xl">
                        At the Africa Climate and Environment Foundation (ACEF), we value your privacy. This policy outlines how we collect, use, and protect your personal information when you engage with our platform, donate, or volunteer.
                    </p>
                    <div class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-widest text-gray-300 pt-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span>Last Updated: December 21, 2024</span>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row gap-16 items-start">
                    <!-- Sidebar Table of Contents -->
                    <div class="lg:w-1/4 lg:sticky lg:top-32 space-y-10">
                        <div class="space-y-6">
                            <h3 class="text-[10px] font-black uppercase tracking-widest text-gray-300">Table of Contents</h3>
                            <nav class="flex flex-col space-y-4">
                                <a href="#data-collection" class="text-sm font-bold text-acef-green border-l-4 border-acef-green pl-4">1. Data Collection</a>
                                <a href="#usage" class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">2. Usage of Information</a>
                                <a href="#sharing" class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">3. Data Sharing & Third Parties</a>
                                <a href="#cookies" class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">4. Cookies & Tracking</a>
                                <a href="#security" class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">5. Data Security</a>
                                <a href="#rights" class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">6. Your Rights</a>
                                <a href="#retention" class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">7. Data Retention</a>
                            </nav>
                        </div>

                        <div class="bg-acef-green/5 rounded-[30px] p-8 space-y-6 border border-acef-green/10">
                            <h4 class="text-xl font-black text-acef-dark tracking-tight leading-tight">Privacy Question?</h4>
                            <p class="text-xs text-gray-400 italic">Our data protection officer is ready to help with any privacy concerns.</p>
                            <a href="mailto:privacy@acef-ngo.org" class="text-acef-green text-xs font-black flex items-center hover:underline">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                privacy@acef-ngo.org
                            </a>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="lg:w-3/4 space-y-16">
                        <!-- 01 Data Collection -->
                        <section id="data-collection" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">01</span>
                                <h2 class="text-3xl font-black text-acef-dark tracking-tight">Data Collection</h2>
                            </div>
                            <div class="space-y-6">
                                <p class="text-gray-400 font-light italic leading-relaxed">We collect essential information to facilitate your engagement with ACEF's initiatives. The types of data we collect include:</p>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="p-8 bg-gray-50 rounded-[30px] border border-gray-100 space-y-4">
                                        <h4 class="font-black text-acef-dark tracking-tight">Personal Information</h4>
                                        <ul class="text-sm text-gray-400 space-y-2 italic font-light">
                                            <li class="flex items-start"><span class="mr-2 text-acef-green">•</span> Name, email address, and phone number when you register for programs or contact us.</li>
                                        </ul>
                                    </div>
                                    <div class="p-8 bg-gray-50 rounded-[30px] border border-gray-100 space-y-4">
                                        <h4 class="font-black text-acef-dark tracking-tight">Donation Details</h4>
                                        <ul class="text-sm text-gray-400 space-y-2 italic font-light">
                                            <li class="flex items-start"><span class="mr-2 text-acef-green">•</span> Transaction history, payment information processing via third-party providers (we do not store credit card info directly).</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- 02 Usage -->
                        <section id="usage" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">02</span>
                                <h2 class="text-3xl font-black text-acef-dark tracking-tight">Usage of Information</h2>
                            </div>
                            <div class="space-y-6">
                                <p class="text-gray-400 font-light italic leading-relaxed">Your data is used exclusively to facilitate our organizational goals:</p>
                                <div class="bg-gray-50 rounded-[30px] p-10 border border-gray-100 italic space-y-4">
                                    <ul class="space-y-4 text-sm text-gray-400 font-light">
                                        <li class="flex items-start">
                                            <span class="text-acef-green mr-3 font-bold">✓</span>
                                            <span><strong>Communication:</strong> To send you newsletters, impact reports, and updates on your favorite initiatives.</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="text-acef-green mr-3 font-bold">✓</span>
                                            <span><strong>Volunteer Coordination:</strong> To match your skills with appropriate projects and manage onsite logistics for field missions.</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="text-acef-green mr-3 font-bold">✓</span>
                                            <span><strong>Donation Processing:</strong> To provide tax-deductible receipts and acknowledge your financial contributions.</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="text-acef-green mr-3 font-bold">✓</span>
                                            <span><strong>Analytics:</strong> To understand website traffic patterns and improve our user interface and outreach strategies.</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </section>

                        <!-- 03 Sharing -->
                        <section id="sharing" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">03</span>
                                <h2 class="text-3xl font-black text-acef-dark tracking-tight">Data Sharing & Third Parties</h2>
                            </div>
                            <div class="space-y-8">
                                <div class="bg-orange-50/50 border border-orange-100 rounded-[30px] p-8 flex items-center space-x-4">
                                    <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center text-orange-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    </div>
                                    <p class="text-sm font-bold text-orange-800 tracking-tight italic">We do not sell, trade, or rent your personal information to marketing others.</p>
                                </div>
                                <p class="text-gray-400 font-light italic leading-relaxed">
                                    We may share generic aggregated demographic information not linked to any personal identification information regarding visitors and users with our partners, trusted affiliates, and advertisers for the purposes outlined above. We may use third-party service providers to help us operate our business and the Site or administer activities on our behalf, such as sending out newsletters or surveys.
                                </p>
                            </div>
                        </section>

                        <!-- 04 Cookies -->
                        <section id="cookies" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">04</span>
                                <h2 class="text-3xl font-black text-acef-dark tracking-tight">Cookies & Tracking</h2>
                            </div>
                            <div class="bg-gray-50 rounded-[40px] p-10 space-y-8 border border-gray-100">
                                <p class="text-gray-400 font-light italic leading-relaxed">Our website uses "cookies" to enhance your user experience. Your web browser places cookies on your hard drive for record-keeping purposes and sometimes to track information about them. You may choose to set your web browser to refuse cookies, or to alert you when cookies are being sent.</p>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="flex items-start space-x-4">
                                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-acef-green shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                        </div>
                                        <div class="space-y-1">
                                            <h5 class="font-black text-acef-dark text-sm">Analytical Cookies</h5>
                                            <p class="text-xs text-gray-400 italic font-light">Helps us track traffic sources and site performance.</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start space-x-4">
                                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-acef-green shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        <div class="space-y-1">
                                            <h5 class="font-black text-acef-dark text-sm">Functional Cookies</h5>
                                            <p class="text-xs text-gray-400 italic font-light">Remembers your preference and settings.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- 05 Security -->
                        <section id="security" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">05</span>
                                <h2 class="text-3xl font-black text-acef-dark tracking-tight">Data Security</h2>
                            </div>
                            <p class="text-gray-400 font-light italic leading-relaxed">
                                We adopt appropriate data collection, storage, and processing practices and security measures to protect against unauthorized access, alteration, disclosure, or destruction of your personal information, username, password, transaction information, and data stored on our Site.
                            </p>
                        </section>

                        <!-- 06 Rights -->
                        <section id="rights" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">06</span>
                                <h2 class="text-3xl font-black text-acef-dark tracking-tight">Your Rights</h2>
                            </div>
                            <div class="space-y-8">
                                <p class="text-gray-400 font-light italic leading-relaxed">Under applicable data protection laws (including the Kenya Data Protection Act, 2019), you have the right to:</p>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="px-6 py-4 bg-gray-50 rounded-2xl flex items-center space-x-3">
                                        <svg class="w-4 h-4 text-acef-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        <span class="text-xs font-bold text-acef-dark">Access your personal data</span>
                                    </div>
                                    <div class="px-6 py-4 bg-gray-50 rounded-2xl flex items-center space-x-3">
                                        <svg class="w-4 h-4 text-acef-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        <span class="text-xs font-bold text-acef-dark">Correct inaccuracies in your data</span>
                                    </div>
                                    <div class="px-6 py-4 bg-gray-50 rounded-2xl flex items-center space-x-3">
                                        <svg class="w-4 h-4 text-acef-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        <span class="text-xs font-bold text-acef-dark">Request erasure of your data</span>
                                    </div>
                                    <div class="px-6 py-4 bg-gray-50 rounded-2xl flex items-center space-x-3">
                                        <svg class="w-4 h-4 text-acef-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        <span class="text-xs font-bold text-acef-dark">Withdraw consent for marketing</span>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- 07 Retention -->
                        <section id="retention" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">07</span>
                                <h2 class="text-3xl font-black text-acef-dark tracking-tight">Data Retention</h2>
                            </div>
                            <p class="text-gray-400 font-light italic leading-relaxed">
                                We retain personal information for as long as necessary to fulfill the purposes for which it was collected, including for the purposes of satisfying any legal, accounting, or reporting requirements.
                            </p>
                        </section>

                        <!-- Contact CTA -->
                        <div class="bg-acef-green rounded-[40px] p-10 md:p-12 space-y-8 flex flex-col md:flex-row items-center justify-between gap-8">
                            <div class="space-y-4 max-w-lg">
                                <div class="w-12 h-12 bg-acef-dark rounded-2xl flex items-center justify-center text-acef-green">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                                </div>
                                <h3 class="text-3xl font-black text-acef-dark tracking-tighter">Contact Us</h3>
                                <p class="text-acef-dark font-light italic text-sm">
                                    If you have any questions about this Privacy Policy, the practices of this site, or your dealings with this site, please contact us.
                                </p>
                            </div>
                            <div class="space-y-4 w-full md:w-auto">
                                <div class="bg-white/90 backdrop-blur px-8 py-5 rounded-2xl flex items-center space-x-4 border border-white/20">
                                    <div class="text-acef-green font-bold text-xs uppercase tracking-widest">Headquarters</div>
                                    <div class="font-black text-acef-dark text-sm">Nairobi, Kenya</div>
                                </div>
                                <div class="bg-white/90 backdrop-blur px-8 py-5 rounded-2xl flex items-center space-x-4 border border-white/20">
                                    <div class="text-acef-green font-bold text-xs uppercase tracking-widest">Email Us</div>
                                    <div class="font-black text-acef-dark text-sm">privacy@acef-ngo.org</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        @include('components.footer')
    </body>
</html>
