<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google" content="notranslate">
        <title>Donate - Support Our Cause - ACEF</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-white dark:bg-gray-900 overflow-x-hidden transition-colors">
        @include('components.header')

        <!-- Donate Hero -->
        <section class="relative h-[50vh] min-h-[400px] flex items-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img src="/images/hero-donate.jpg" alt="Donate Background" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-acef-dark via-acef-dark/60 to-acef-dark/30"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full pt-10">
                <div class="max-w-4xl mx-auto text-center space-y-6">
                    <h1 class="text-5xl md:text-7xl font-black text-white tracking-tighter leading-none">
                        Make a Difference Today
                    </h1>
                    <p class="text-xl text-white/80 max-w-2xl mx-auto font-light leading-relaxed italic">
                        Your contribution empowers communities and changes lives across Africa.
                    </p>
                </div>
            </div>
        </section>

        <main class="py-24 bg-gray-50/30 dark:bg-[#0c0c0c] transition-colors -mt-12 relative z-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
                    
                    <!-- Donation Form Column -->
                    <div class="lg:col-span-2">
                        <div class="bg-white dark:bg-gray-800 rounded-[40px] shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden" x-data="{ method: 'paypal' }">
                            
                            <!-- Custom Tab Header -->
                            <div class="flex border-b border-gray-100 dark:border-gray-700 overflow-x-auto">
                                @if($settings['paypal_enabled'] ?? false)
                                <button @click="method = 'paypal'" 
                                    :class="method === 'paypal' ? 'border-acef-green text-acef-dark dark:text-white bg-gray-50 dark:bg-gray-700/50' : 'border-transparent text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700'"
                                    class="flex-1 py-6 px-6 flex items-center justify-center space-x-3 font-black tracking-tight border-b-4 transition-all min-w-[140px]">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                    <span>Card / PayPal</span>
                                </button>
                                @endif

                                @if($settings['mpesa_enabled'] ?? false)
                                <button @click="method = 'mpesa'" 
                                    :class="method === 'mpesa' ? 'border-acef-green text-acef-dark dark:text-white bg-gray-50 dark:bg-gray-700/50' : 'border-transparent text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700'"
                                    class="flex-1 py-6 px-6 flex items-center justify-center space-x-3 font-black tracking-tight border-b-4 transition-all min-w-[140px]">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                    <span>M-Pesa</span>
                                </button>
                                @endif

                                @if($settings['bank_enabled'] ?? false)
                                <button @click="method = 'bank'" 
                                    :class="method === 'bank' ? 'border-acef-green text-acef-dark dark:text-white bg-gray-50 dark:bg-gray-700/50' : 'border-transparent text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700'"
                                    class="flex-1 py-6 px-6 flex items-center justify-center space-x-3 font-black tracking-tight border-b-4 transition-all min-w-[140px]">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/></svg>
                                    <span>Bank Transfer</span>
                                </button>
                                @endif
                            </div>

                            <div class="p-8 md:p-12 space-y-8">
                                
                                <!-- PayPal Section -->
                                <div x-show="method === 'paypal'" class="space-y-8" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                                    <div class="space-y-2">
                                        <h2 class="text-3xl font-black text-acef-dark dark:text-white tracking-tighter">Secure Donation</h2>
                                        <p class="text-gray-400 text-sm font-light italic">Process your donation securely via PayPal or Credit/Debit Card.</p>
                                    </div>
                                    
                                    <div class="space-y-4">
                                        <label class="text-xs font-black uppercase text-acef-dark dark:text-gray-300 tracking-widest pl-2">Amount (USD)</label>
                                        <div class="relative">
                                            <span class="absolute left-6 top-1/2 -translate-y-1/2 font-bold text-gray-400">$</span>
                                            <input type="number" id="paypal-amount" value="50" class="w-full pl-12 pr-8 py-5 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green text-xl font-bold text-acef-dark dark:text-white transition-all placeholder-gray-300" placeholder="50">
                                        </div>
                                    </div>

                                    <div class="space-y-4">
                                        <label class="text-xs font-black uppercase text-acef-dark dark:text-gray-300 tracking-widest pl-2">Optional Message</label>
                                        <textarea id="paypal-message" rows="3" class="w-full px-8 py-5 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green text-acef-dark dark:text-white transition-all placeholder-gray-400" placeholder="Leave a message of support..."></textarea>
                                    </div>

                                    <div id="paypal-button-container" class="pt-4"></div>
                                </div>

                                <!-- M-Pesa Section -->
                                <div x-show="method === 'mpesa'" class="space-y-8" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                                    <div class="space-y-2">
                                        <h2 class="text-3xl font-black text-acef-dark dark:text-white tracking-tighter">M-Pesa Express</h2>
                                        <p class="text-gray-400 text-sm font-light italic">Receive an STK Push directly to your phone.</p>
                                    </div>

                                    <form id="mpesa-form" class="space-y-6">
                                        @csrf
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div class="space-y-4">
                                                <label class="text-xs font-black uppercase text-acef-dark dark:text-gray-300 tracking-widest pl-2">Phone Number</label>
                                                <input type="text" name="phone" placeholder="2547XXXXXXXX" class="w-full px-8 py-5 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green text-acef-dark dark:text-white transition-all font-bold">
                                            </div>
                                            <div class="space-y-4">
                                                <label class="text-xs font-black uppercase text-acef-dark dark:text-gray-300 tracking-widest pl-2">Amount (KES)</label>
                                                <input type="number" name="amount" value="1000" class="w-full px-8 py-5 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl outline-none focus:ring-2 focus:ring-acef-green text-acef-dark dark:text-white transition-all font-bold">
                                            </div>
                                        </div>

                                        <button type="submit" class="w-full py-5 bg-acef-green text-acef-dark font-black rounded-2xl flex items-center justify-center space-x-3 hover:bg-acef-dark hover:text-white transition-all shadow-xl shadow-acef-green/20">
                                            <span>Send Prompt</span>
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                        </button>
                                    </form>
                                    <div id="mpesa-status" class="hidden p-6 rounded-2xl text-center font-bold"></div>
                                </div>

                                <!-- Bank Section -->
                                <div x-show="method === 'bank'" class="space-y-8" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                                    <div class="space-y-2">
                                        <h2 class="text-3xl font-black text-acef-dark dark:text-white tracking-tighter">Bank Transfer</h2>
                                        <p class="text-gray-400 text-sm font-light italic">Direct transfer details for larger contributions.</p>
                                    </div>

                                    <div class="bg-gray-50 dark:bg-gray-900 rounded-3xl p-8 space-y-6 border border-gray-100 dark:border-gray-700">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-12">
                                            <div class="space-y-1">
                                                <p class="text-xs font-black uppercase text-gray-400 tracking-widest">Bank Name</p>
                                                <p class="text-lg font-bold text-acef-dark dark:text-white">{{ $settings['bank_name'] ?? 'N/A' }}</p>
                                            </div>
                                            <div class="space-y-1">
                                                <p class="text-xs font-black uppercase text-gray-400 tracking-widest">Account Name</p>
                                                <p class="text-lg font-bold text-acef-dark dark:text-white">{{ $settings['bank_account_name'] ?? 'N/A' }}</p>
                                            </div>
                                            <div class="space-y-1">
                                                <p class="text-xs font-black uppercase text-gray-400 tracking-widest">Account Number</p>
                                                <p class="text-lg font-bold text-acef-dark dark:text-white font-mono tracking-wider">{{ $settings['bank_account_number'] ?? 'N/A' }}</p>
                                            </div>
                                            <div class="space-y-1">
                                                <p class="text-xs font-black uppercase text-gray-400 tracking-widest">Swift Code</p>
                                                <p class="text-lg font-bold text-acef-dark dark:text-white font-mono">{{ $settings['bank_swift_code'] ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                        @if(!empty($settings['bank_instructions']))
                                        <div class="pt-6 border-t border-gray-200 dark:border-gray-800">
                                            <p class="text-sm text-gray-500 italic">{{ $settings['bank_instructions'] }}</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-8 lg:sticky lg:top-8">
                        
                        <!-- GoFundMe -->
                        @if($settings['gofundme_enabled'] ?? false)
                        <div class="bg-gradient-to-br from-[#fc4c02] to-[#e04000] rounded-[40px] p-10 shadow-xl text-center relative overflow-hidden group">
                            <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <h3 class="font-black text-2xl text-white mb-4 relative z-10">Donate via GoFundMe</h3>
                            <p class="text-white/80 mb-8 max-w-xs mx-auto text-sm font-medium relative z-10">Use our official GoFundMe campaign for secure international donations.</p>
                            <a href="{{ $settings['gofundme_campaign_url'] ?? '#' }}" target="_blank" class="inline-block w-full bg-white text-[#fc4c02] font-black py-4 rounded-2xl hover:bg-[#ffebe0] transition-colors shadow-lg relative z-10">
                                Visit Campaign
                            </a>
                        </div>
                        @endif

                        <!-- Value Props -->
                        <div class="bg-acef-dark rounded-[40px] p-10 space-y-8 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-64 h-64 bg-acef-green rounded-full blur-[80px] opacity-20 translate-x-1/2 -translate-y-1/2"></div>
                            
                            <h3 class="font-black text-xl text-white tracking-tight relative z-10">Why Support ACEF?</h3>
                            
                            <ul class="space-y-6 relative z-10">
                                <li class="flex items-start space-x-4">
                                    <div class="w-8 h-8 rounded-full bg-acef-green/20 flex items-center justify-center shrink-0 text-acef-green">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <span class="text-gray-300 text-sm font-light leading-relaxed"><strong class="text-white font-bold block mb-0.5">Community First</strong> Direct impact on local grassroots initiatives.</span>
                                </li>
                                <li class="flex items-start space-x-4">
                                    <div class="w-8 h-8 rounded-full bg-acef-green/20 flex items-center justify-center shrink-0 text-acef-green">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <span class="text-gray-300 text-sm font-light leading-relaxed"><strong class="text-white font-bold block mb-0.5">Transparency</strong>Full visibility on how funds are utilized.</span>
                                </li>
                                <li class="flex items-start space-x-4">
                                    <div class="w-8 h-8 rounded-full bg-acef-green/20 flex items-center justify-center shrink-0 text-acef-green">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <span class="text-gray-300 text-sm font-light leading-relaxed"><strong class="text-white font-bold block mb-0.5">Sustainable</strong>Focus on long-term ecological solutions.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </main>

        @include('components.footer')

        <!-- Scripts -->
        @if($settings['paypal_enabled'] ?? false)
            <script src="https://www.paypal.com/sdk/js?client-id={{ $settings['paypal_client_id'] ?? '' }}&currency=USD"></script>
            <script>
                if(document.getElementById('paypal-button-container')) {
                    paypal.Buttons({
                        createOrder: function(data, actions) {
                            const amount = document.getElementById('paypal-amount').value;
                            return actions.order.create({
                                purchase_units: [{ amount: { value: amount } }]
                            });
                        },
                        onApprove: function(data, actions) {
                            return actions.order.capture().then(function(details) {
                                fetch('{{ route("donate.paypal") }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        order_id: data.orderID,
                                        amount: details.purchase_units[0].amount.value,
                                        details: details,
                                        message: document.getElementById('paypal-message').value
                                    })
                                }).then(() => {
                                    alert('Thank you for your generous donation!');
                                    window.location.reload();
                                });
                            });
                        }
                    }).render('#paypal-button-container');
                }
            </script>
        @endif

        @if($settings['mpesa_enabled'] ?? false)
            <script>
                document.getElementById('mpesa-form')?.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const btn = this.querySelector('button');
                    const status = document.getElementById('mpesa-status');
                    
                    btn.disabled = true;
                    const originalText = btn.innerHTML;
                    btn.innerHTML = 'Processing...';
                    status.classList.add('hidden');

                    const formData = new FormData(this);

                    fetch('{{ route("donate.mpesa") }}', {
                        method: 'POST',
                        body: formData,
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                    })
                    .then(res => res.json())
                    .then(data => {
                        status.classList.remove('hidden');
                        if(data.success) {
                            status.className = 'p-6 rounded-2xl bg-green-100 text-green-800 border border-green-200 mt-6';
                            status.innerText = data.message;
                        } else {
                            status.className = 'p-6 rounded-2xl bg-red-100 text-red-800 border border-red-200 mt-6';
                            status.innerText = data.message || 'Payment initiation failed.';
                        }
                        btn.disabled = false;
                        btn.innerHTML = originalText;
                    })
                    .catch(err => {
                        console.error(err);
                        btn.disabled = false;
                        btn.innerHTML = originalText;
                    });
                });
            </script>
        @endif
    </body>
</html>