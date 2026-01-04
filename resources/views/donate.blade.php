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

        <main class="py-24 bg-gray-50/30 dark:bg-[#0c0c0c] transition-colors -mt-12 relative z-20" x-data="{ 
            type: 'one-time', 
            amount: 50, 
            customAmount: '',
            method: 'paypal',
            projectId: '',
            programmeId: '',
            get activeAmount() { return this.customAmount ? this.customAmount : this.amount },
            impacts: {
                25: 'Provides educational materials for 5 students.',
                50: 'Supports the planting and care of 10 indigenous trees.',
                100: 'Funds a community water management workshop.',
                250: 'Provides clean energy kits for 2 rural households.'
            }
        }">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
                    
                    <!-- Left Column: Impact Content -->
                    <div class="lg:col-span-5 space-y-12">
                        <div class="space-y-6">
                            <span class="inline-block px-4 py-2 bg-acef-green/10 text-acef-green rounded-xl text-xs font-black uppercase tracking-widest">Impact Tiers</span>
                            <h2 class="text-4xl md:text-5xl font-black text-acef-dark dark:text-white tracking-tighter leading-tight">Your gift, <br><span class="text-acef-green">their future.</span></h2>
                            <p class="text-gray-500 dark:text-gray-400 text-lg font-light leading-relaxed">Choose an amount that resonates with your commitment to creating lasting change across Africa.</p>
                        </div>

                        <!-- Impact Cards -->
                        <div class="grid grid-cols-1 gap-4">
                            <template x-for="(desc, val) in impacts" :key="val">
                                <div @click="amount = parseInt(val); customAmount = ''" 
                                     :class="amount === parseInt(val) && !customAmount ? 'border-acef-green bg-white dark:bg-gray-800 shadow-xl scale-[1.02]' : 'border-gray-100 dark:border-gray-800 bg-white/50 dark:bg-gray-900/50 opacity-60 hover:opacity-100'"
                                     class="p-6 rounded-3xl border-2 transition-all cursor-pointer group flex items-start gap-4">
                                    <div :class="amount === parseInt(val) && !customAmount ? 'bg-acef-green text-white' : 'bg-gray-100 dark:bg-gray-800 text-gray-400 group-hover:bg-acef-green group-hover:text-white'"
                                         class="w-12 h-12 rounded-2xl flex items-center justify-center font-black text-lg transition-all" x-text="'$' + val"></div>
                                    <div class="flex-1">
                                        <p :class="amount === parseInt(val) && !customAmount ? 'text-acef-dark dark:text-white' : 'text-gray-400'" class="text-sm font-bold leading-snug" x-text="desc"></p>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <div class="pt-8 border-t border-gray-100 dark:border-gray-800 flex items-center gap-6">
                            <div class="flex -space-x-4">
                                @foreach(\App\Models\User::take(4)->get() as $user)
                                    <div class="w-12 h-12 rounded-full border-4 border-white dark:border-gray-900 overflow-hidden bg-gray-200">
                                        <img src="{{ $user->profile_image_url }}" class="w-full h-full object-cover">
                                    </div>
                                @endforeach
                            </div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-widest leading-tight">Joined by <span class="text-acef-dark dark:text-white">1,200+ donors</span> this month alone.</p>
                        </div>
                    </div>
                    
                    <!-- Right Column: Donation Form -->
                    <div class="lg:col-span-7">
                        <div class="bg-white dark:bg-gray-800 shadow-2xl shadow-emerald-500/10 rounded-[48px] p-10 md:p-14 border border-gray-100 dark:border-gray-700 relative overflow-hidden">
                            <!-- Background Decor -->
                            <div class="absolute -top-24 -right-24 w-64 h-64 bg-acef-green/5 rounded-full blur-3xl"></div>
                            
                            <div class="relative space-y-10">
                                <!-- Type Toggle -->
                                <div class="flex p-1.5 bg-gray-100 dark:bg-gray-900 rounded-2xl w-full max-w-sm mx-auto">
                                    <button @click="type = 'one-time'" :class="type === 'one-time' ? 'bg-white dark:bg-gray-800 text-acef-dark dark:text-white shadow-lg' : 'text-gray-400 hover:text-gray-600'" class="flex-1 py-3 text-xs font-black uppercase tracking-widest rounded-xl transition-all">One-Time</button>
                                    <button @click="type = 'monthly'" :class="type === 'monthly' ? 'bg-white dark:bg-gray-800 text-acef-dark dark:text-white shadow-lg' : 'text-gray-400 hover:text-gray-600'" class="flex-1 py-3 text-xs font-black uppercase tracking-widest rounded-xl transition-all flex items-center justify-center gap-2">
                                        Monthly <span class="text-[9px] bg-acef-green/20 text-acef-green px-1.5 py-0.5 rounded-md">Save Lives</span>
                                    </button>
                                </div>

                                <!-- Custom Amount Input -->
                                <div class="space-y-4">
                                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Custom Amount (USD)</label>
                                    <div class="relative group">
                                        <span class="absolute left-8 top-1/2 -translate-y-1/2 text-4xl font-black text-gray-300 group-focus-within:text-acef-green transition-colors">$</span>
                                        <input type="number" x-model="customAmount" placeholder="Enter amount..." class="w-full pl-16 pr-10 py-8 bg-gray-50 dark:bg-gray-900 border-none rounded-[32px] text-4xl font-black text-acef-dark dark:text-white focus:ring-4 focus:ring-acef-green/10 transition-all placeholder-gray-200">
                                    </div>
                                </div>

                                <!-- Allocation Selector -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-3">
                                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Donate to Project</label>
                                        <select x-model="projectId" class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl text-xs font-bold text-acef-dark dark:text-white focus:ring-2 focus:ring-acef-green">
                                            <option value="">General Support</option>
                                            @foreach($projects as $proj)
                                                <option value="{{ $proj->id }}">{{ $proj->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="space-y-3">
                                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Or by Programme</label>
                                        <select x-model="programmeId" class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl text-xs font-bold text-acef-dark dark:text-white focus:ring-2 focus:ring-acef-green">
                                            <option value="">All Regions</option>
                                            @foreach($programmes as $prog)
                                                <option value="{{ $prog->id }}">{{ $prog->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Payment Method Tabs -->
                                <div class="space-y-6">
                                    <div class="flex items-center gap-4">
                                        <button @click="method = 'paypal'" :class="method === 'paypal' ? 'bg-acef-green text-white ring-4 ring-acef-green/20' : 'bg-gray-100 dark:bg-gray-900 text-gray-400'" class="px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">PayPal / Card</button>
                                        @if($settings['mpesa_enabled'] ?? false)
                                            <button @click="method = 'mpesa'" :class="method === 'mpesa' ? 'bg-acef-green text-white ring-4 ring-acef-green/20' : 'bg-gray-100 dark:bg-gray-900 text-gray-400'" class="px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">M-Pesa</button>
                                        @endif
                                        <button @click="method = 'bank'" :class="method === 'bank' ? 'bg-acef-green text-white ring-4 ring-acef-green/20' : 'bg-gray-100 dark:bg-gray-900 text-gray-400'" class="px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">Bank</button>
                                    </div>

                                    <div class="pt-6 border-t border-gray-100 dark:border-gray-900">
                                        <!-- Actual Payment Logic Containers -->
                                        <div x-show="method === 'paypal'" x-transition class="space-y-6">
                                            <div id="paypal-button-container" class="relative z-10 min-h-[50px]"></div>
                                            <p class="text-[9px] text-gray-400 text-center font-bold uppercase tracking-widest flex items-center justify-center gap-2">
                                                <svg class="w-3 h-3 text-acef-green" fill="currentColor" viewBox="0 0 24 24"><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"/></svg>
                                                Secure 256-bit Encrypted Payment
                                            </p>
                                        </div>

                                        <div x-show="method === 'mpesa'" x-cloak x-transition class="space-y-6">
                                             <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <input type="text" id="mpesa-phone" placeholder="Phone: 2547..." class="px-6 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl text-sm font-bold focus:ring-2 focus:ring-acef-green">
                                                <button class="bg-acef-green text-white font-black rounded-2xl py-4 hover:shadow-lg transition-all">Push Prompt</button>
                                             </div>
                                        </div>

                                        <div x-show="method === 'bank'" x-cloak x-transition class="bg-gray-50 dark:bg-gray-900 rounded-3xl p-8 space-y-4 text-sm font-medium">
                                            <div class="flex justify-between items-center text-[10px] text-gray-400 uppercase font-black tracking-widest mb-2 px-1">
                                                <span>Bank Details</span>
                                                <button class="text-acef-green">Copy All</button>
                                            </div>
                                            <div class="grid grid-cols-1 gap-3">
                                                <div class="flex justify-between border-b border-gray-200 dark:border-gray-800 pb-2">
                                                    <span class="text-gray-400">Bank</span>
                                                    <span class="text-acef-dark dark:text-white">{{ $settings['bank_name'] ?? 'ACEF Global Bank' }}</span>
                                                </div>
                                                <div class="flex justify-between border-b border-gray-200 dark:border-gray-800 pb-2">
                                                    <span class="text-gray-400">Account</span>
                                                    <span class="text-acef-dark dark:text-white">{{ $settings['bank_account_number'] ?? '1234 5678 9012' }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-400">Swift</span>
                                                    <span class="text-acef-dark dark:text-white">{{ $settings['bank_swift_code'] ?? 'ACEFKENXXXX' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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