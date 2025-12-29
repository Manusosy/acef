<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Donate - ACEF</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-white overflow-x-hidden">
        @include('components.header')

        <main class="pt-40 pb-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row gap-16 items-start">
                    <!-- Left: Copy & Stats -->
                    <div class="lg:w-1/2 space-y-12">
                        <div class="space-y-6">
                            <h1 class="text-6xl md:text-7xl font-black text-acef-dark tracking-tighter leading-none">
                                Fueling Africa's <br>
                                <span class="text-acef-green">Green Future</span>
                            </h1>
                            <p class="text-gray-500 text-lg md:text-xl font-light italic leading-relaxed max-w-xl">
                                Empower Change Across the Continent. Select your country to find the most direct way to support our initiatives. Every contribution helps us plant trees, support local farmers, and build sustainable energy infrastructure.
                            </p>
                        </div>

                        <!-- Mini Stats -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-gray-50 p-6 rounded-3xl border border-gray-100 space-y-2">
                                <span class="text-acef-green text-3xl font-black">1.2M</span>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Trees Planted</p>
                            </div>
                            <div class="bg-gray-50 p-6 rounded-3xl border border-gray-100 space-y-2">
                                <span class="text-acef-green text-3xl font-black">450+</span>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Communities</p>
                            </div>
                            <div class="bg-gray-50 p-6 rounded-3xl border border-gray-100 space-y-2">
                                <span class="text-acef-green text-3xl font-black">85%</span>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Program Funding</p>
                            </div>
                        </div>

                        <!-- Where money goes -->
                        <div class="bg-acef-green/5 border border-acef-green/20 rounded-[40px] p-8 space-y-4">
                            <div class="flex items-center space-x-3 text-acef-green">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                <span class="font-black text-acef-dark tracking-tight">Where your money goes</span>
                            </div>
                            <p class="text-gray-400 text-sm leading-relaxed italic">
                                100% of public donations go directly to project execution. Administrative costs are covered by private benefactors. We are committed to absolute transparency in our financial reporting.
                            </p>
                            <a href="{{ route('impact') }}" class="text-acef-green text-xs font-bold flex items-center hover:underline">
                                View Financial Reports <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Right: Donation Form -->
                    <div class="lg:w-1/2 w-full lg:sticky lg:top-32" x-data="{ 
                        country: '', 
                        amount: 50,
                        customAmount: '',
                        get isReady() { return this.country !== '' && (this.amount > 0 || this.customAmount > 0) }
                    }">
                        <div class="bg-white rounded-[50px] shadow-2xl border border-gray-50 p-8 md:p-12 space-y-8">
                            <div class="flex items-center space-x-3 text-acef-green">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <h2 class="text-2xl font-black text-acef-dark tracking-tighter">Make a Contribution</h2>
                            </div>

                            <div class="space-y-6">
                                <div class="space-y-3">
                                    <label class="text-xs font-black uppercase tracking-widest text-acef-dark">I am donating from...</label>
                                    <select x-model="country" class="w-full px-8 py-5 bg-gray-50 border-none rounded-2xl text-gray-500 focus:ring-2 focus:ring-acef-green transition-all outline-none">
                                        <option value="">Select your country</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Tanzania">Tanzania</option>
                                        <option value="Ghana">Ghana</option>
                                    </select>
                                    <p class="text-[10px] text-gray-300 font-bold uppercase pl-2">Select a region to see specific projects.</p>
                                </div>

                                <div class="space-y-3">
                                    <label class="text-xs font-black uppercase tracking-widest text-acef-dark">Select Amount</label>
                                    <div class="grid grid-cols-4 gap-3">
                                        <button @click="amount = 25; customAmount = ''" :class="amount === 25 ? 'bg-acef-green text-acef-dark shadow-lg shadow-acef-green/20' : 'bg-gray-50 text-gray-400 hover:bg-acef-green/10'" class="py-4 rounded-xl font-black transition-all">$25</button>
                                        <button @click="amount = 50; customAmount = ''" :class="amount === 50 ? 'bg-acef-green text-acef-dark shadow-lg shadow-acef-green/20' : 'bg-gray-50 text-gray-400 hover:bg-acef-green/10'" class="py-4 rounded-xl font-black transition-all">$50</button>
                                        <button @click="amount = 100; customAmount = ''" :class="amount === 100 ? 'bg-acef-green text-acef-dark shadow-lg shadow-acef-green/20' : 'bg-gray-50 text-gray-400 hover:bg-acef-green/10'" class="py-4 rounded-xl font-black transition-all">$100</button>
                                        <button @click="amount = 0" :class="amount === 0 ? 'bg-acef-green text-acef-dark shadow-lg shadow-acef-green/20' : 'bg-gray-50 text-gray-400 hover:bg-acef-green/10'" class="py-4 rounded-xl font-black transition-all">Other</button>
                                    </div>
                                    <template x-if="amount === 0">
                                        <div class="mt-4 pt-2">
                                            <input type="number" x-model="customAmount" placeholder="Enter custom amount ($)" class="w-full px-8 py-4 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-acef-green transition-all outline-none text-sm">
                                        </div>
                                    </template>
                                </div>

                                <button :disabled="!isReady" :class="isReady ? 'bg-acef-green text-acef-dark shadow-xl shadow-acef-green/20' : 'bg-gray-100 text-gray-300 cursor-not-allowed'" class="w-full py-5 font-black rounded-2xl flex items-center justify-center space-x-3 transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    <span x-text="isReady ? 'Proceed to Secure Donation' : 'Select Country to Donate'"></span>
                                </button>

                                <div class="flex items-center justify-center space-x-6 pt-2">
                                    <div class="flex items-center space-x-1 text-[10px] font-bold text-gray-300 uppercase tracking-widest">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.9L10 9.503l7.834-4.603a1.166 1.166 0 00-1.134-2.1l-6.7 3.937L3.3 2.8a1.166 1.166 0 00-1.134 2.1z" clip-rule="evenodd"></path></svg>
                                        <span>Secure SSL</span>
                                    </div>
                                    <div class="flex items-center space-x-1 text-[10px] font-bold text-gray-300 uppercase tracking-widest">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l5-5z" clip-rule="evenodd"></path></svg>
                                        <span>Verified NGO</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Social Proof -->
                            <div class="pt-8 border-t border-gray-50 flex items-center space-x-4">
                                <div class="w-10 h-10 bg-acef-green/10 rounded-full flex items-center justify-center text-acef-green">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                </div>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest leading-loose">
                                    Someone from <span class="text-acef-dark font-black">Kenya</span> just donated <span class="text-acef-green font-black">$25</span> <span class="text-gray-200 ml-2">2m ago</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Funds in Action -->
                <div class="mt-32 space-y-12">
                    <h2 class="text-5xl font-black text-acef-dark tracking-tighter">Funds in Action</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center">
                        <div class="space-y-6 group">
                            <div class="aspect-video rounded-[30px] overflow-hidden">
                                <img src="/project_tree_planting_1766827726209.png" alt="Reforestation" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            </div>
                            <div class="space-y-2">
                                <p class="text-acef-green font-bold text-[10px] uppercase tracking-widest">Reforestation</p>
                                <h3 class="text-2xl font-black text-acef-dark tracking-tight">The Great Green Wall</h3>
                                <p class="text-gray-400 text-sm font-light italic leading-relaxed">Restoring Africa's degraded landscapes and transforming millions of lives in the Sahel.</p>
                            </div>
                        </div>
                        <div class="space-y-6 group">
                            <div class="aspect-video rounded-[30px] overflow-hidden">
                                <img src="/project_solar_panels_1766827705821.png" alt="Solar" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            </div>
                            <div class="space-y-2">
                                <p class="text-acef-green font-bold text-[10px] uppercase tracking-widest">Clean Energy</p>
                                <h3 class="text-2xl font-black text-acef-dark tracking-tight">Solar for Schools</h3>
                                <p class="text-gray-400 text-sm font-light italic leading-relaxed">Bringing sustainable electricity to rural schools to power digital learning.</p>
                            </div>
                        </div>
                        <div class="space-y-6 group">
                            <div class="aspect-video rounded-[30px] overflow-hidden">
                                <img src="/uploaded_image_1766828557603.png" alt="Farming" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            </div>
                            <div class="space-y-2">
                                <p class="text-acef-green font-bold text-[10px] uppercase tracking-widest">Community</p>
                                <h3 class="text-2xl font-black text-acef-dark tracking-tight">Sustainable Farming</h3>
                                <p class="text-gray-400 text-sm font-light italic leading-relaxed">Empowering local farmers with tools and knowledge for climate-resilient crops.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        @include('components.footer')
    </body>
</html>
