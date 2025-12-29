<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Terms of Service - ACEF</title>

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
                <span class="text-acef-dark">Terms of Service</span>
            </nav>
        </div>

        <main class="pb-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="space-y-6 mb-16">
                    <h1 class="text-6xl md:text-7xl font-black text-acef-dark tracking-tighter leading-none">Terms of Service</h1>
                    <p class="text-gray-400 text-lg font-light italic leading-relaxed max-w-3xl">
                        Welcome to the Africa Climate and Environment Foundation (ACEF). As a youth-led Pan-African organization, we are committed to transparency, integrity, and the ethical use of our digital platforms to drive climate action.
                    </p>
                    <div class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-widest text-gray-300 pt-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span>Last Updated: December 21, 2024</span>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row gap-16 items-start">
                    <!-- Table of Contents -->
                    <div class="lg:w-1/4 lg:sticky lg:top-32 space-y-10">
                        <div class="space-y-6">
                            <h3 class="text-[10px] font-black uppercase tracking-widest text-gray-300">Table of Contents</h3>
                            <nav class="flex flex-col space-y-4">
                                <a href="#acceptance" class="text-sm font-bold text-acef-green border-l-4 border-acef-green pl-4">1. Acceptance of Terms</a>
                                <a href="#usage" class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">2. Mission-Aligned Usage</a>
                                <a href="#ip" class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">3. Intellectual Property</a>
                                <a href="#stewardship" class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">4. Donations & Stewardship</a>
                                <a href="#conduct" class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">5. Community Conduct</a>
                                <a href="#liability" class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">6. Limitation of Liability</a>
                                <a href="#governing-law" class="text-sm font-bold text-gray-400 hover:text-acef-dark transition-all pl-5">7. Governing Law</a>
                            </nav>
                        </div>

                        <div class="bg-acef-green/5 rounded-[30px] p-8 space-y-6 border border-acef-green/10">
                            <h4 class="text-xl font-black text-acef-dark tracking-tight leading-tight">Need Clarification?</h4>
                            <p class="text-xs text-gray-400 italic">Our legal team is available to answer your questions regarding these terms.</p>
                            <a href="mailto:legal@acef-ngo.org" class="text-acef-green text-xs font-black flex items-center hover:underline">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                legal@acef-ngo.org
                            </a>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="lg:w-3/4 space-y-16">
                        <!-- 01 Acceptance -->
                        <section id="acceptance" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">01</span>
                                <h2 class="text-3xl font-black text-acef-dark tracking-tight">Acceptance of Terms</h2>
                            </div>
                            <p class="text-gray-400 font-light italic leading-relaxed">
                                By accessing the ACEF website, engaging with our resources, or participating in our programmes, you agree to comply with these Terms of Service. These terms govern your use of our digital platforms, including our Knowledge Hub, advocacy tools, and donation portals. If you do not agree with any part of these terms, you may not access our services.
                            </p>
                        </section>

                        <!-- 02 Usage -->
                        <section id="usage" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">02</span>
                                <h2 class="text-3xl font-black text-acef-dark tracking-tight">Mission-Aligned Usage</h2>
                            </div>
                            <div class="space-y-8">
                                <p class="text-gray-400 font-light italic leading-relaxed">ACEF provides a platform for climate action, environmental education, and sustainable development. Users agree to use the site only for lawful purposes that align with our mission to empower African youth and communities.</p>
                                <div class="bg-red-50/50 border border-red-100 rounded-[30px] p-10 space-y-6">
                                    <h4 class="font-black text-red-600 flex items-center">
                                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                        Prohibited Activities
                                    </h4>
                                    <ul class="text-sm text-red-800 space-y-3 font-medium italic pl-4">
                                        <li>• Misrepresenting affiliation with ACEF for personal or commercial gain.</li>
                                        <li>• Postings, uploads, or sharing content that is hateful, racially discriminatory, or promotes illegal activities.</li>
                                        <li>• Attempting to disrupt digital security or gain unauthorized access to our systems.</li>
                                    </ul>
                                </div>
                            </div>
                        </section>

                        <!-- 03 IP -->
                        <section id="ip" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">03</span>
                                <h2 class="text-3xl font-black text-acef-dark tracking-tight">Intellectual Property & Knowledge Sovereignty</h2>
                            </div>
                            <div class="space-y-8">
                                <p class="text-gray-400 font-light italic leading-relaxed">In line with our value of Knowledge Sovereignty, ACEF produces original research, educational curricula, and Climate Literacy materials.</p>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="p-8 bg-gray-50 rounded-[30px] border border-gray-100 space-y-4">
                                        <h4 class="font-black text-acef-dark tracking-tight">Educational Resources</h4>
                                        <p class="text-xs text-gray-400 italic font-light leading-relaxed">You may freely share resources for non-commercial educational purposes, provided ACEF is credited.</p>
                                    </div>
                                    <div class="p-8 bg-gray-50 rounded-[30px] border border-gray-100 space-y-4">
                                        <h4 class="font-black text-acef-dark tracking-tight">Proprietary Research</h4>
                                        <p class="text-xs text-gray-400 italic font-light leading-relaxed">ACEF retains full copyright on strategic data, white papers, and research trials unless stated otherwise in individual licenses.</p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- 04 Stewardship -->
                        <section id="stewardship" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">04</span>
                                <h2 class="text-3xl font-black text-acef-dark tracking-tight">Donations & Financial Stewardship</h2>
                            </div>
                            <div class="space-y-6">
                                <p class="text-gray-400 font-light italic leading-relaxed">ACEF operates with integrity and transparency in handling all funds. Donations made through our website are processed securely via independent payment partners (e.g., Stripe, PayPal).</p>
                                <div class="flex flex-wrap gap-4">
                                    <span class="px-6 py-3 bg-acef-green/10 text-acef-green text-[10px] font-black uppercase tracking-widest rounded-xl">Secure Platforms</span>
                                    <span class="px-6 py-3 bg-acef-green/10 text-acef-green text-[10px] font-black uppercase tracking-widest rounded-xl">Anti-Fraud Monitored</span>
                                    <span class="px-6 py-3 bg-acef-green/10 text-acef-green text-[10px] font-black uppercase tracking-widest rounded-xl">Transparency Reports</span>
                                </div>
                                <p class="text-xs text-gray-300 italic font-light leading-relaxed pt-2">Donations are usually non-refundable unless a clerical error occurred during transaction processing which is rare.</p>
                            </div>
                        </section>

                        <!-- 05 Conduct -->
                        <section id="conduct" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">05</span>
                                <h2 class="text-3xl font-black text-acef-dark tracking-tight">Community & Volunteer Conduct</h2>
                            </div>
                            <div class="space-y-6">
                                <p class="text-gray-400 font-light italic leading-relaxed">As a member of the ACEF community (Volunteer, Partner, or Ambassador), you agree to uphold our core values of Inclusivity, Diversity, and Pan-African Unity.</p>
                                <p class="text-gray-400 font-light italic leading-relaxed">We maintain a zero-tolerance policy towards harassment, discrimination, or hate speech based on gender, region, religion, or background. We reserve the right to terminate the account or membership of any individual violating these community standards.</p>
                            </div>
                        </section>

                        <!-- 06 Liability -->
                        <section id="liability" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">06</span>
                                <h2 class="text-3xl font-black text-acef-dark tracking-tight">Limitation of Liability</h2>
                            </div>
                            <p class="text-gray-400 font-light italic leading-relaxed">
                                While we strive to provide accurate and up-to-date information regarding climate research and policy, ACEF does not warrant the completeness of the materials on this site. We are not liable for any direct or indirect damages arising from the use of our shared resources or reliance on our climate impact forecasts.
                            </p>
                        </section>

                        <!-- 07 Law -->
                        <section id="governing-law" class="space-y-10 scroll-mt-32">
                            <div class="flex items-center space-x-6">
                                <span class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green font-black text-lg">07</span>
                                <h2 class="text-3xl font-black text-acef-dark tracking-tight">Governing Law</h2>
                            </div>
                            <p class="text-gray-400 font-light italic leading-relaxed">
                                These Terms of Service shall be governed by and construed in accordance with the laws of Kenya and Cameroon, where ACEF is officially registered. Any disputes shall be subject to the exclusive jurisdiction of the courts in these jurisdictions.
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
                                    For any questions regarding these Terms of Service or to report a violation, please contact our administrative team.
                                </p>
                            </div>
                            <div class="space-y-4 w-full md:w-auto">
                                <div class="bg-white/90 backdrop-blur px-8 py-5 rounded-2xl flex items-center space-x-4 border border-white/20">
                                    <div class="text-acef-green font-bold text-xs uppercase tracking-widest">Headquarters</div>
                                    <div class="font-black text-acef-dark text-sm">Nairobi, Kenya</div>
                                </div>
                                <div class="bg-white/90 backdrop-blur px-8 py-5 rounded-2xl flex items-center space-x-4 border border-white/20">
                                    <div class="text-acef-green font-bold text-xs uppercase tracking-widest">Email Us</div>
                                    <div class="font-black text-acef-dark text-sm">info@acef-ngo.org</div>
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
