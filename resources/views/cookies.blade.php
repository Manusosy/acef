<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cookies Policy - ACEF</title>

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
            <span class="text-acef-dark">Cookies Policy</span>
        </nav>
    </div>

    <main class="pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-6 mb-16">
                <h1 class="text-6xl md:text-7xl font-black text-acef-dark tracking-tighter leading-none">Cookie Policy
                </h1>
                <p class="text-gray-400 text-lg font-light italic leading-relaxed max-w-3xl">
                    This Cookie Policy explains what cookies are, how and why they are used on this website, and how you
                    can manage your cookie preferences. This policy is designed to comply with the General Data
                    Protection Regulation (GDPR), the ePrivacy Directive, and other applicable data protection laws.
                </p>
                <div
                    class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-widest text-gray-300 pt-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                    <span>Last Updated: December 29, 2024</span>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-16 items-start">
                <!-- Sidebar Table of Contents -->
                <div class="lg:w-1/4 lg:sticky lg:top-32 space-y-10">
                    <div class="space-y-6">
                        <h3 class="text-[10px] font-black uppercase tracking-widest text-gray-300">Table of Contents
                        </h3>
                        <nav class="flex flex-col space-y-4">
                            <a href="#what-are-cookies"
                                class="text-sm font-bold text-acef-green border-l-4 border-acef-green pl-4">1. What Are
                                Cookies?</a>
                            <a href="#how-we-use"
                                class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">2. How
                                We Use Cookies</a>
                            <a href="#types"
                                class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">3.
                                Types of Cookies</a>
                            <a href="#managing"
                                class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">4.
                                Managing Cookies</a>
                            <a href="#gdpr"
                                class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">5. GDPR
                                Rights</a>
                            <a href="#changes"
                                class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">6.
                                Policy Changes</a>
                            <a href="#contact"
                                class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">7.
                                Contact Us</a>
                        </nav>
                    </div>
                </div>

                <!-- Content -->
                <div class="lg:w-3/4 space-y-16">
                    <!-- 01 What Are Cookies -->
                    <section id="what-are-cookies" class="space-y-10 scroll-mt-32">
                        <div class="flex items-center space-x-6">
                            <span
                                class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">01</span>
                            <h2 class="text-3xl font-black text-acef-dark tracking-tight">What Are Cookies?</h2>
                        </div>
                        <div class="space-y-6">
                            <p class="text-gray-400 font-light italic leading-relaxed">
                                Cookies are small text files that are placed on your computer, smartphone, tablet, or
                                other internet-enabled device when you visit a website. Cookies are widely used to make
                                websites work efficiently, improve user experience, and provide information to website
                                owners.
                            </p>
                            <div class="bg-gray-50 rounded-[30px] p-8 border border-gray-100 space-y-4">
                                <h4 class="font-black text-acef-dark">Information Collected</h4>
                                <ul class="space-y-2 text-sm text-gray-400 font-light italic">
                                    <li class="flex items-start"><span class="mr-2 text-acef-green">•</span> Your device
                                        type and browser</li>
                                    <li class="flex items-start"><span class="mr-2 text-acef-green">•</span> Your IP
                                        address (in anonymized or pseudonymized form where applicable)</li>
                                    <li class="flex items-start"><span class="mr-2 text-acef-green">•</span> Pages
                                        visited and actions taken on the website</li>
                                    <li class="flex items-start"><span class="mr-2 text-acef-green">•</span> Preferences
                                        such as language or region</li>
                                </ul>
                            </div>
                            <p class="text-gray-400 font-light italic leading-relaxed">
                                Cookies <strong>do not typically identify you personally</strong> unless combined with
                                other information. However, under GDPR, cookies that can identify or profile users are
                                considered <strong>personal data</strong>.
                            </p>
                        </div>
                    </section>

                    <!-- 02 How We Use Cookies -->
                    <section id="how-we-use" class="space-y-10 scroll-mt-32">
                        <div class="flex items-center space-x-6">
                            <span
                                class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">02</span>
                            <h2 class="text-3xl font-black text-acef-dark tracking-tight">How We Use Cookies</h2>
                        </div>
                        <div class="space-y-8">
                            <p class="text-gray-400 font-light italic leading-relaxed">We use cookies for several
                                important purposes to ensure our website operates effectively and securely, and to
                                enhance your experience as a visitor.</p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div
                                    class="p-8 bg-gray-50 rounded-[30px] border border-gray-100 space-y-4 hover:shadow-lg transition-shadow">
                                    <h4 class="font-black text-acef-dark">Functionality & Performance</h4>
                                    <ul class="space-y-2 text-sm text-gray-400 font-light italic">
                                        <li class="flex items-start"><span class="mr-2 text-acef-green">✓</span> Enable
                                            core features & navigation</li>
                                        <li class="flex items-start"><span class="mr-2 text-acef-green">✓</span>
                                            Remember user preferences</li>
                                        <li class="flex items-start"><span class="mr-2 text-acef-green">✓</span> Monitor
                                            traffic & usage trends</li>
                                    </ul>
                                </div>
                                <div
                                    class="p-8 bg-gray-50 rounded-[30px] border border-gray-100 space-y-4 hover:shadow-lg transition-shadow">
                                    <h4 class="font-black text-acef-dark">Experience & Security</h4>
                                    <ul class="space-y-2 text-sm text-gray-400 font-light italic">
                                        <li class="flex items-start"><span class="mr-2 text-acef-green">✓</span>
                                            Customize content</li>
                                        <li class="flex items-start"><span class="mr-2 text-acef-green">✓</span> Reduce
                                            repeated entry</li>
                                        <li class="flex items-start"><span class="mr-2 text-acef-green">✓</span> Prevent
                                            misuse & unauthorized access</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="bg-acef-green/5 border border-acef-green/10 p-6 rounded-2xl">
                                <p class="text-sm text-acef-dark font-bold italic">
                                    We do not use cookies for invasive profiling or for selling personal data.
                                </p>
                            </div>
                        </div>
                    </section>

                    <!-- 03 Types of Cookies -->
                    <section id="types" class="space-y-10 scroll-mt-32">
                        <div class="flex items-center space-x-6">
                            <span
                                class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">03</span>
                            <h2 class="text-3xl font-black text-acef-dark tracking-tight">Types of Cookies We Use</h2>
                        </div>
                        <div class="space-y-6">

                            <!-- 3.1 -->
                            <div class="p-8 bg-white border border-gray-100 rounded-[30px] shadow-sm space-y-4">
                                <h3 class="text-xl font-black text-acef-dark">3.1 Strictly Necessary Cookies</h3>
                                <p class="text-sm text-gray-400 font-light italic">These cookies are essential for the
                                    website to function properly. They enable core functionality such as security,
                                    network management, and accessibility.</p>
                                <div class="flex flex-wrap gap-4 text-xs font-bold uppercase tracking-widest pt-2">
                                    <span class="px-3 py-1 bg-gray-100 text-gray-500 rounded-lg">Legal Basis: Legitimate
                                        Interest</span>
                                    <span class="px-3 py-1 bg-acef-green/10 text-acef-green rounded-lg">Consent:
                                        No</span>
                                </div>
                            </div>

                            <!-- 3.2 -->
                            <div class="p-8 bg-white border border-gray-100 rounded-[30px] shadow-sm space-y-4">
                                <h3 class="text-xl font-black text-acef-dark">3.2 Performance and Analytics Cookies</h3>
                                <p class="text-sm text-gray-400 font-light italic">These cookies help us understand how
                                    visitors interact with the website by collecting information anonymously. The data
                                    is used solely to improve website performance and user experience.</p>
                                <div class="flex flex-wrap gap-4 text-xs font-bold uppercase tracking-widest pt-2">
                                    <span class="px-3 py-1 bg-gray-100 text-gray-500 rounded-lg">Legal Basis:
                                        Consent</span>
                                    <span class="px-3 py-1 bg-orange-100 text-orange-600 rounded-lg">Consent: Yes</span>
                                </div>
                            </div>

                            <!-- 3.3 -->
                            <div class="p-8 bg-white border border-gray-100 rounded-[30px] shadow-sm space-y-4">
                                <h3 class="text-xl font-black text-acef-dark">3.3 Functionality Cookies</h3>
                                <p class="text-sm text-gray-400 font-light italic">Functionality cookies allow the
                                    website to remember choices you make and provide enhanced, more personalized
                                    features.</p>
                                <div class="flex flex-wrap gap-4 text-xs font-bold uppercase tracking-widest pt-2">
                                    <span class="px-3 py-1 bg-gray-100 text-gray-500 rounded-lg">Legal Basis:
                                        Consent</span>
                                    <span class="px-3 py-1 bg-orange-100 text-orange-600 rounded-lg">Consent: Yes</span>
                                </div>
                            </div>

                            <!-- 3.4 -->
                            <div class="p-8 bg-white border border-gray-100 rounded-[30px] shadow-sm space-y-4">
                                <h3 class="text-xl font-black text-acef-dark">3.4 Third-Party Cookies</h3>
                                <p class="text-sm text-gray-400 font-light italic">Some cookies are placed by
                                    third-party services that appear on our pages. These third parties may collect data
                                    in accordance with their own privacy policies.</p>
                                <p class="text-xs text-gray-400 pt-2">Examples: Analytics providers, embedded maps,
                                    social media tools.</p>
                            </div>

                        </div>
                    </section>

                    <!-- 04 Managing Cookies -->
                    <section id="managing" class="space-y-10 scroll-mt-32">
                        <div class="flex items-center space-x-6">
                            <span
                                class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">04</span>
                            <h2 class="text-3xl font-black text-acef-dark tracking-tight">Managing Cookies</h2>
                        </div>
                        <div class="space-y-8">
                            <p class="text-gray-400 font-light italic leading-relaxed">
                                You have full control over your cookie preferences.
                            </p>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                                    <h4 class="font-bold text-acef-dark mb-2">Consent Banner</h4>
                                    <p class="text-xs text-gray-400">Accept all, reject non-essential, or customize by
                                        category on your first visit.</p>
                                </div>
                                <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                                    <h4 class="font-bold text-acef-dark mb-2">Browser Settings</h4>
                                    <p class="text-xs text-gray-400">Manage or delete cookies directly through your
                                        browser settings.</p>
                                </div>
                                <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                                    <h4 class="font-bold text-acef-dark mb-2">Withdraw Consent</h4>
                                    <p class="text-xs text-gray-400">Update preferences or clear cookies at any time to
                                        withdraw consent.</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 05 GDPR Rights -->
                    <section id="gdpr" class="space-y-10 scroll-mt-32">
                        <div class="flex items-center space-x-6">
                            <span
                                class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">05</span>
                            <h2 class="text-3xl font-black text-acef-dark tracking-tight">GDPR & Your Rights</h2>
                        </div>
                        <div class="bg-gray-800 rounded-[30px] p-10 text-white space-y-6">
                            <p class="font-light leading-relaxed opacity-80">Under GDPR, if cookies involve personal
                                data, you have the following rights:</p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm font-bold">
                                <div class="flex items-center"><span
                                        class="w-2 h-2 bg-acef-green rounded-full mr-3"></span> Right to be informed
                                </div>
                                <div class="flex items-center"><span
                                        class="w-2 h-2 bg-acef-green rounded-full mr-3"></span> Right of access</div>
                                <div class="flex items-center"><span
                                        class="w-2 h-2 bg-acef-green rounded-full mr-3"></span> Right to rectification
                                </div>
                                <div class="flex items-center"><span
                                        class="w-2 h-2 bg-acef-green rounded-full mr-3"></span> Right to erasure</div>
                                <div class="flex items-center"><span
                                        class="w-2 h-2 bg-acef-green rounded-full mr-3"></span> Right to restrict
                                    processing</div>
                                <div class="flex items-center"><span
                                        class="w-2 h-2 bg-acef-green rounded-full mr-3"></span> Right to data
                                    portability</div>
                            </div>
                        </div>
                    </section>

                    <!-- 06 Changes -->
                    <section id="changes" class="space-y-10 scroll-mt-32">
                        <div class="flex items-center space-x-6">
                            <span
                                class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">06</span>
                            <h2 class="text-3xl font-black text-acef-dark tracking-tight">Changes to Policy</h2>
                        </div>
                        <p class="text-gray-400 font-light italic leading-relaxed">
                            We may update this Cookie Policy from time to time to reflect legal changes, technology
                            updates, or changes to our services. Any updates will be posted on this page with a revised
                            "Last updated" date.
                        </p>
                    </section>

                    <!-- Contact CTA -->
                    <div id="contact"
                        class="bg-acef-green rounded-[40px] p-10 md:p-12 space-y-8 flex flex-col md:flex-row items-center justify-between gap-8">
                        <div class="space-y-4 max-w-lg">
                            <div
                                class="w-12 h-12 bg-acef-dark rounded-2xl flex items-center justify-center text-acef-green">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z" />
                                </svg>
                            </div>
                            <h3 class="text-3xl font-black text-acef-dark tracking-tighter">Contact Us</h3>
                            <p class="text-acef-dark font-light italic text-sm">
                                Africa Climate and Environment Foundation (ACEF)<br>
                                Nairobi, Kenya
                            </p>
                        </div>
                        <div class="space-y-4 w-full md:w-auto">
                            <div
                                class="bg-white/90 backdrop-blur px-8 py-5 rounded-2xl flex items-center space-x-4 border border-white/20">
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