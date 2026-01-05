<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google" content="notranslate">
        <title>{{ $page->title ?? 'Donate' }} - ACEF</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Domine:wght@400;500;600;700&family=Outfit:wght@100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .font-serif { font-family: 'Domine', serif; }
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="antialiased font-sans bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors">
        @include('components.header')

        <!-- Dynamic Hero Section -->
        <x-hero :page="$page" height="h-[400px] sm:h-[500px]" />

        <main class="min-h-screen relative" x-data="donationForm()">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 relative -mt-32 z-10 pb-24">
                <!-- Main Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-8 sm:p-12 mb-12">
                    
                    <!-- Intro Text / Header -->
                    <div class="mb-12 border-b border-gray-100 dark:border-gray-700 pb-10 text-center max-w-4xl mx-auto">
                        <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl text-gray-900 dark:text-white leading-tight mb-6">
                            Invest in Africa's Future Leaders
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed text-lg mb-4">
                            Your donation directly supports ACEF's mission to mobilize and empower African youth. We are bridging the gap on hunger and poverty by driving innovative, youth-led solutions in climate action, environmental protection, and sustainable resource conservation.
                        </p>
                        <p class="text-acef-green dark:text-acef-light-green font-bold text-lg italic">
                            Together, we can build a resilient Africa—where empowered youth lead the way to a sustainable future.
                        </p>
                    </div>

                    <!-- Step 1: Gift Amount -->
                    <section class="mb-12 max-w-4xl mx-auto">
                        <h2 class="font-serif text-2xl text-gray-900 dark:text-white mb-6 border-b border-gray-200 dark:border-gray-700 pb-2 inline-block">Select your gift amount</h2>
                        
                        <!-- Frequency Selector -->
                        <div class="flex items-center gap-0 w-full max-w-xs mb-8 border border-gray-300 dark:border-gray-600 rounded-md overflow-hidden bg-white dark:bg-gray-700">
                            <button @click="frequency = 'one-time'" 
                                    class="flex-1 py-3 text-sm font-bold uppercase text-center transition-colors"
                                    :class="frequency === 'one-time' ? 'bg-acef-green text-white' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600'">
                                Give Once
                            </button>
                            <div class="w-px h-full bg-gray-300 dark:bg-gray-600"></div>
                            <button @click="frequency = 'monthly'" 
                                    class="flex-1 py-3 text-sm font-bold uppercase text-center transition-colors relative"
                                    :class="frequency === 'monthly' ? 'bg-acef-green text-white' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600'">
                                <span class="absolute -top-1 -right-1 flex h-3 w-3" x-show="frequency !== 'monthly'">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                                </span>
                                Monthly
                            </button>
                        </div>

                        <!-- Amount Grid -->
                        <div class="grid grid-cols-3 sm:grid-cols-6 gap-3 mb-6">
                            <template x-for="amt in [25, 50, 100, 250, 500]" :key="amt">
                                <button @click="setAmount(amt)"
                                        :class="(amount === amt && !customAmount) ? 'bg-acef-green text-white border-acef-green shadow-md ring-2 ring-acef-green/50' : 'bg-white dark:bg-gray-700 text-gray-600 dark:text-gray-300 border-gray-300 dark:border-gray-600 hover:border-acef-green hover:text-acef-green'"
                                        class="py-3 px-2 border rounded font-bold transition-all text-center">
                                    $<span x-text="amt"></span>
                                </button>
                            </template>
                            
                            <!-- Custom Amount Field -->
                            <div class="relative col-span-1 sm:col-span-1">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 font-bold">$</span>
                                <input type="number" x-model="customAmount" placeholder="Other" 
                                       @input="amount = null"
                                       class="w-full pl-6 pr-2 py-3 border border-gray-300 dark:border-gray-600 rounded text-sm font-bold focus:ring-2 focus:ring-acef-green bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 h-full">
                            </div>
                        </div>

                        <!-- Matching & Tribute -->
                        <div class="space-y-3">
                             <div class="flex items-center gap-3">
                                <input type="checkbox" id="employer-match" class="rounded border-gray-300 dark:border-gray-600 text-acef-green focus:ring-acef-green w-4 h-4 bg-white dark:bg-gray-700">
                                <label for="employer-match" class="text-sm text-gray-600 dark:text-gray-400 font-medium cursor-pointer">Does your employer match donations?</label>
                            </div>
                             <div class="flex items-center gap-3">
                                <input type="checkbox" id="tribute" class="rounded border-gray-300 dark:border-gray-600 text-acef-green focus:ring-acef-green w-4 h-4 bg-white dark:bg-gray-700">
                                <label for="tribute" class="text-sm text-gray-600 dark:text-gray-400 font-medium cursor-pointer">Is this a gift in honor of someone special?</label>
                            </div>
                        </div>
                    </section>
                    
                    <!-- Step 2: Information -->
                    <section class="mb-12 max-w-4xl mx-auto">
                        <h2 class="font-serif text-2xl text-gray-900 dark:text-white mb-6 border-b border-gray-200 dark:border-gray-700 pb-2 inline-block">Your Information</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-500 dark:text-gray-400 mb-1">First Name</label>
                                <input type="text" x-model="form.firstName" class="w-full border-gray-300 dark:border-gray-600 rounded focus:ring-acef-green bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-500 dark:text-gray-400 mb-1">Last Name</label>
                                <input type="text" x-model="form.lastName" class="w-full border-gray-300 dark:border-gray-600 rounded focus:ring-acef-green bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-xs font-bold uppercase text-gray-500 dark:text-gray-400 mb-1">Email</label>
                            <input type="email" x-model="form.email" class="w-full border-gray-300 dark:border-gray-600 rounded focus:ring-acef-green bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                        </div>
                        
                        <div class="flex gap-2 items-start">
                            <input type="radio" name="optin" value="yes" class="mt-1 border-gray-300 dark:border-gray-600 text-acef-green focus:ring-acef-green bg-white dark:bg-gray-700">
                            <label class="text-sm text-gray-600 dark:text-gray-400">Yes, I would like to be kept up to date with ACEF's projects and fundraising activities by email.</label>
                        </div>
                         <div class="flex gap-2 items-start mt-2">
                            <input type="radio" name="optin" value="no" class="mt-1 border-gray-300 dark:border-gray-600 text-acef-green focus:ring-acef-green bg-white dark:bg-gray-700">
                            <label class="text-sm text-gray-600 dark:text-gray-400">No, thanks.</label>
                        </div>
                    </section>

                    <!-- Step 3: Billing Info -->
                    <section class="mb-12 max-w-4xl mx-auto">
                        <h2 class="font-serif text-2xl text-gray-900 dark:text-white mb-6 border-b border-gray-200 dark:border-gray-700 pb-2 inline-block">Your Billing Information</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-500 dark:text-gray-400 mb-1">Country</label>
                                <select x-model="form.country" class="w-full border-gray-300 dark:border-gray-600 rounded focus:ring-acef-green bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                    <option value="Afghanistan">Afghanistan</option>
                                    <option value="Albania">Albania</option>
                                    <option value="Algeria">Algeria</option>
                                    <option value="Andorra">Andorra</option>
                                    <option value="Angola">Angola</option>
                                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Armenia">Armenia</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Austria">Austria</option>
                                    <option value="Azerbaijan">Azerbaijan</option>
                                    <option value="Bahamas">Bahamas</option>
                                    <option value="Bahrain">Bahrain</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Barbados">Barbados</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Belgium">Belgium</option>
                                    <option value="Belize">Belize</option>
                                    <option value="Benin">Benin</option>
                                    <option value="Bhutan">Bhutan</option>
                                    <option value="Bolivia">Bolivia</option>
                                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                    <option value="Botswana">Botswana</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Brunei">Brunei</option>
                                    <option value="Bulgaria">Bulgaria</option>
                                    <option value="Burkina Faso">Burkina Faso</option>
                                    <option value="Burundi">Burundi</option>
                                    <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                                    <option value="Cabo Verde">Cabo Verde</option>
                                    <option value="Cambodia">Cambodia</option>
                                    <option value="Cameroon">Cameroon</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Central African Republic">Central African Republic</option>
                                    <option value="Chad">Chad</option>
                                    <option value="Chile">Chile</option>
                                    <option value="China">China</option>
                                    <option value="Colombia">Colombia</option>
                                    <option value="Comoros">Comoros</option>
                                    <option value="Congo (Congo-Brazzaville)">Congo (Congo-Brazzaville)</option>
                                    <option value="Costa Rica">Costa Rica</option>
                                    <option value="Croatia">Croatia</option>
                                    <option value="Cuba">Cuba</option>
                                    <option value="Cyprus">Cyprus</option>
                                    <option value="Czechia (Czech Republic)">Czechia (Czech Republic)</option>
                                    <option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
                                    <option value="Denmark">Denmark</option>
                                    <option value="Djibouti">Djibouti</option>
                                    <option value="Dominica">Dominica</option>
                                    <option value="Dominican Republic">Dominican Republic</option>
                                    <option value="Ecuador">Ecuador</option>
                                    <option value="Egypt">Egypt</option>
                                    <option value="El Salvador">El Salvador</option>
                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                    <option value="Eritrea">Eritrea</option>
                                    <option value="Estonia">Estonia</option>
                                    <option value="Eswatini (fmr. 'Swaziland')">Eswatini (fmr. 'Swaziland')</option>
                                    <option value="Ethiopia">Ethiopia</option>
                                    <option value="Fiji">Fiji</option>
                                    <option value="Finland">Finland</option>
                                    <option value="France">France</option>
                                    <option value="Gabon">Gabon</option>
                                    <option value="Gambia">Gambia</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Germany">Germany</option>
                                    <option value="Ghana">Ghana</option>
                                    <option value="Greece">Greece</option>
                                    <option value="Grenada">Grenada</option>
                                    <option value="Guatemala">Guatemala</option>
                                    <option value="Guinea">Guinea</option>
                                    <option value="Guinea-Bissau">Guinea-Bissau</option>
                                    <option value="Guyana">Guyana</option>
                                    <option value="Haiti">Haiti</option>
                                    <option value="Holy See">Holy See</option>
                                    <option value="Honduras">Honduras</option>
                                    <option value="Hungary">Hungary</option>
                                    <option value="Iceland">Iceland</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Iran">Iran</option>
                                    <option value="Iraq">Iraq</option>
                                    <option value="Ireland">Ireland</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Jamaica">Jamaica</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Jordan">Jordan</option>
                                    <option value="Kazakhstan">Kazakhstan</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Kiribati">Kiribati</option>
                                    <option value="Kuwait">Kuwait</option>
                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                    <option value="Laos">Laos</option>
                                    <option value="Latvia">Latvia</option>
                                    <option value="Lebanon">Lebanon</option>
                                    <option value="Lesotho">Lesotho</option>
                                    <option value="Liberia">Liberia</option>
                                    <option value="Libya">Libya</option>
                                    <option value="Liechtenstein">Liechtenstein</option>
                                    <option value="Lithuania">Lithuania</option>
                                    <option value="Luxembourg">Luxembourg</option>
                                    <option value="Madagascar">Madagascar</option>
                                    <option value="Malawi">Malawi</option>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Maldives">Maldives</option>
                                    <option value="Mali">Mali</option>
                                    <option value="Malta">Malta</option>
                                    <option value="Marshall Islands">Marshall Islands</option>
                                    <option value="Mauritania">Mauritania</option>
                                    <option value="Mauritius">Mauritius</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Micronesia">Micronesia</option>
                                    <option value="Moldova">Moldova</option>
                                    <option value="Monaco">Monaco</option>
                                    <option value="Mongolia">Mongolia</option>
                                    <option value="Montenegro">Montenegro</option>
                                    <option value="Morocco">Morocco</option>
                                    <option value="Mozambique">Mozambique</option>
                                    <option value="Myanmar (formerly Burma)">Myanmar (formerly Burma)</option>
                                    <option value="Namibia">Namibia</option>
                                    <option value="Nauru">Nauru</option>
                                    <option value="Nepal">Nepal</option>
                                    <option value="Netherlands">Netherlands</option>
                                    <option value="New Zealand">New Zealand</option>
                                    <option value="Nicaragua">Nicaragua</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Nigeria">Nigeria</option>
                                    <option value="North Korea">North Korea</option>
                                    <option value="North Macedonia">North Macedonia</option>
                                    <option value="Norway">Norway</option>
                                    <option value="Oman">Oman</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Palau">Palau</option>
                                    <option value="Palestine State">Palestine State</option>
                                    <option value="Panama">Panama</option>
                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                    <option value="Paraguay">Paraguay</option>
                                    <option value="Peru">Peru</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Poland">Poland</option>
                                    <option value="Portugal">Portugal</option>
                                    <option value="Qatar">Qatar</option>
                                    <option value="Romania">Romania</option>
                                    <option value="Russia">Russia</option>
                                    <option value="Rwanda">Rwanda</option>
                                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                    <option value="Saint Lucia">Saint Lucia</option>
                                    <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                    <option value="Samoa">Samoa</option>
                                    <option value="San Marino">San Marino</option>
                                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                    <option value="Senegal">Senegal</option>
                                    <option value="Serbia">Serbia</option>
                                    <option value="Seychelles">Seychelles</option>
                                    <option value="Sierra Leone">Sierra Leone</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="Slovakia">Slovakia</option>
                                    <option value="Slovenia">Slovenia</option>
                                    <option value="Solomon Islands">Solomon Islands</option>
                                    <option value="Somalia">Somalia</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="South Korea">South Korea</option>
                                    <option value="South Sudan">South Sudan</option>
                                    <option value="Spain">Spain</option>
                                    <option value="Sri Lanka">Sri Lanka</option>
                                    <option value="Sudan">Sudan</option>
                                    <option value="Suriname">Suriname</option>
                                    <option value="Sweden">Sweden</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="Syria">Syria</option>
                                    <option value="Tajikistan">Tajikistan</option>
                                    <option value="Tanzania">Tanzania</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Timor-Leste">Timor-Leste</option>
                                    <option value="Togo">Togo</option>
                                    <option value="Tonga">Tonga</option>
                                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                    <option value="Tunisia">Tunisia</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Turkmenistan">Turkmenistan</option>
                                    <option value="Tuvalu">Tuvalu</option>
                                    <option value="Uganda">Uganda</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                    <option value="Uruguay">Uruguay</option>
                                    <option value="Uzbekistan">Uzbekistan</option>
                                    <option value="Vanuatu">Vanuatu</option>
                                    <option value="Venezuela">Venezuela</option>
                                    <option value="Vietnam">Vietnam</option>
                                    <option value="Yemen">Yemen</option>
                                    <option value="Zambia">Zambia</option>
                                    <option value="Zimbabwe">Zimbabwe</option>
                                </select>
                            </div>
                             <div>
                                <label class="block text-xs font-bold uppercase text-gray-500 dark:text-gray-400 mb-1">Address</label>
                                <input type="text" x-model="form.address" class="w-full border-gray-300 dark:border-gray-600 rounded focus:ring-acef-green bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            </div>
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-bold uppercase text-gray-500 dark:text-gray-400 mb-1">City</label>
                                    <input type="text" x-model="form.city" class="w-full border-gray-300 dark:border-gray-600 rounded focus:ring-acef-green bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-gray-500 dark:text-gray-400 mb-1">Postcode</label>
                                    <input type="text" x-model="form.zip" class="w-full border-gray-300 dark:border-gray-600 rounded focus:ring-acef-green bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                </div>
                            </div>
                        </div>
                    </section>
                    
                    <!-- Step 4: Payment -->
                    <section class="max-w-4xl mx-auto">
                         <h2 class="font-serif text-2xl text-gray-900 dark:text-white mb-6 border-b border-gray-200 dark:border-gray-700 pb-2 inline-block">Payment</h2>
                         
                         <!-- Payment Tabs -->
                         <div class="flex border-b border-gray-200 dark:border-gray-700 mb-8 overflow-x-auto scrollbar-hide">
                             <template x-for="m in methods" :key="m.id">
                                 <button @click="method = m.id"
                                         :class="method === m.id ? 'bg-acef-green text-white font-bold' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-acef-green dark:hover:text-acef-green'"
                                         class="px-6 py-4 border-b-2 text-xs font-bold uppercase tracking-widest whitespace-nowrap transition-all flex-1"
                                         x-text="m.label"></button>
                             </template>
                         </div>
                         
                         <!-- Credit Card / PayPal -->
                         <div x-show="method === 'paypal' || method === 'card'" class="bg-gray-50 dark:bg-gray-700/50 p-6 rounded-lg border border-gray-200 dark:border-gray-700">
                             @if($settings['paypal_enabled'] ?? false)
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 font-medium" x-show="method === 'card'">Secure Credit Card Payment processed by PayPal.</p>
                                <div id="paypal-button-container" class="relative z-10 w-full min-h-[150px]"></div>
                             @else
                                <div class="text-center py-8">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Temporarily Disabled</h3>
                                    <p class="text-gray-500 dark:text-gray-400 mt-2">This method is temporarily disabled, please check back.</p>
                                </div>
                             @endif
                         </div>
                         
                         <!-- M-Pesa -->
                         <div x-show="method === 'mpesa'" class="space-y-4">
                             @if($settings['mpesa_enabled'] ?? false)
                                 <div class="bg-green-50 dark:bg-green-900/10 border border-green-200 dark:border-green-800 p-6 rounded-lg">
                                     <h3 class="flex items-center gap-2 text-green-800 dark:text-green-400 font-bold mb-4">
                                         <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                         M-Pesa Mobile Money
                                     </h3>
                                     
                                     <!-- Currency Conversion Preview -->
                                     <div class="mb-6 p-4 bg-white dark:bg-gray-800 rounded border border-green-100 dark:border-green-900/30">
                                         <div class="flex justify-between items-center text-sm">
                                             <span class="text-gray-500 dark:text-gray-400">Donation Amount (USD):</span>
                                             <span class="font-bold text-gray-900 dark:text-white" x-text="formatCurrency(finalAmount)"></span>
                                         </div>
                                         <div class="flex justify-between items-center text-sm mt-2 pt-2 border-t border-gray-100 dark:border-gray-700">
                                             <span class="text-gray-500 dark:text-gray-400">Approx. in KES:</span>
                                             <span class="font-bold text-acef-gold text-lg" x-text="'KES ' + (Math.ceil(finalAmount * 129)).toLocaleString()"></span>
                                         </div>
                                         <p class="text-[10px] text-gray-400 mt-2 italic">*Exchange rate estimated at 129 KES/USD. Actual charges may vary.</p>
                                     </div>

                                     <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-xs font-bold uppercase text-green-800 dark:text-green-400 mb-1">M-Pesa Phone Number</label>
                                            <input type="tel" x-model="form.phone" placeholder="2547XXXXXXXX" class="w-full border-green-300 dark:border-green-800 rounded focus:ring-green-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                                        </div>
                                        <div class="flex items-end">
                                            <button @click="processMpesa" :disabled="loading" class="bg-acef-green text-white font-bold py-2.5 px-6 rounded hover:bg-white hover:text-acef-dark transition w-full disabled:opacity-50 h-[42px] flex items-center justify-center uppercase tracking-widest text-xs">
                                                <span x-text="loading ? 'Processing...' : 'Donate Now'"></span>
                                            </button>
                                        </div>
                                     </div>
                                     <div id="mpesa-status" class="mt-4 hidden p-4 rounded text-sm font-medium"></div>
                                 </div>
                             @else
                                <div class="bg-gray-50 dark:bg-gray-700/50 p-6 rounded-lg border border-gray-200 dark:border-gray-700 text-center">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Temporarily Disabled</h3>
                                    <p class="text-gray-500 dark:text-gray-400 mt-2">This method is temporarily disabled, please check back.</p>
                                </div>
                             @endif
                         </div>
                         
                         <!-- GoFundMe -->
                         <div x-show="method === 'gofundme'" class="bg-gray-50 dark:bg-gray-700/50 p-8 rounded-lg border border-gray-200 dark:border-gray-700 text-center">
                             <h3 class="font-bold text-gray-900 dark:text-white text-lg mb-2">Support us on GoFundMe</h3>
                             <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">You will be redirected to our secure GoFundMe campaign page to complete your donation.</p>
                             <a href="https://gofund.me/acef-placeholder" target="_blank" class="inline-flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded shadow-lg transition-colors">
                                 <span>Go to GoFundMe</span>
                                 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                             </a>
                         </div>

                         <!-- Bank Transfer -->
                         <div x-show="method === 'bank'" class="bg-gray-50 dark:bg-gray-700/50 p-6 rounded-lg border border-gray-200 dark:border-gray-700 text-sm">
                             <h4 class="font-bold text-gray-900 dark:text-white mb-4">Bank Transfer Details</h4>
                             <dl class="space-y-4">
                                 @if($settings['bank_instructions'] ?? false)
                                     <div class="text-gray-600 dark:text-gray-300 text-sm italic mb-4">
                                         {{ $settings['bank_instructions'] }}
                                     </div>
                                 @endif
                                 
                                 <div class="flex justify-between border-b border-gray-200 dark:border-gray-600 pb-2">
                                     <dt class="text-gray-500 dark:text-gray-400">Bank Name</dt>
                                     <dd class="font-bold text-gray-900 dark:text-white">{{ $settings['bank_name'] ?? 'Not Configured' }}</dd>
                                 </div>
                                 <div class="flex justify-between border-b border-gray-200 dark:border-gray-600 pb-2">
                                     <dt class="text-gray-500 dark:text-gray-400">Account Name</dt>
                                     <dd class="font-bold text-gray-900 dark:text-white">{{ $settings['bank_account_name'] ?? 'Not Configured' }}</dd>
                                 </div>
                                 <div class="flex justify-between border-b border-gray-200 dark:border-gray-600 pb-2">
                                     <dt class="text-gray-500 dark:text-gray-400">Account Number</dt>
                                     <dd class="font-bold text-gray-900 dark:text-white">{{ $settings['bank_account_number'] ?? 'Not Configured' }}</dd>
                                 </div>
                                 <div class="flex justify-between border-b border-gray-200 dark:border-gray-600 pb-2">
                                     <dt class="text-gray-500 dark:text-gray-400">Branch</dt>
                                     <dd class="font-bold text-gray-900 dark:text-white">{{ $settings['bank_branch'] ?? 'Not Configured' }}</dd>
                                 </div>
                                 <div class="flex justify-between">
                                     <dt class="text-gray-500 dark:text-gray-400">Swift Code</dt>
                                     <dd class="font-bold text-gray-900 dark:text-white">{{ $settings['bank_swift_code'] ?? 'Not Configured' }}</dd>
                                 </div>
                             </dl>
                         </div>
                     </section>
                     
                     <div class="mt-8 pt-8 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between">
                         <div class="flex gap-4 opacity-50 grayscale transition hover:grayscale-0 hover:opacity-100 items-center">
                             <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/M-PESA_LOGO-01.svg/320px-M-PESA_LOGO-01.svg.png" class="h-5 object-contain" title="M-Pesa">
                             <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" class="h-5 object-contain" title="PayPal">
                             <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png" class="h-5 object-contain" title="Visa">
                             <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" class="h-5 object-contain" title="Mastercard">
                         </div>
                         <div class="text-right">
                             <p class="text-xs text-gray-400 font-bold">Secure SSL Encryption</p>
                         </div>
                     </div>

                </div>
            </div>
        </main>

        @include('components.footer')

        <!-- PayPal SDK (Dynamically Loaded if Enabled) -->
        @if(($settings['paypal_enabled'] ?? false) && ($settings['paypal_client_id'] ?? false))
            <script src="https://www.paypal.com/sdk/js?client-id={{ $settings['paypal_client_id'] }}&currency=USD"></script>
        @endif

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('donationForm', () => ({
                    frequency: 'one-time',
                    amount: 50,
                    customAmount: '',
                    method: 'card', 
                    loading: false,
                    form: {
                        firstName: '',
                        lastName: '',
                        email: '',
                        phone: '', 
                        country: 'Kenya',
                        address: '',
                        address2: '',
                        city: '',
                        zip: ''
                    },
                    methods: [
                        { id: 'card', label: 'Credit Card' },
                        { id: 'paypal', label: 'PayPal' },
                        { id: 'mpesa', label: 'M-Pesa' },
                        { id: 'gofundme', label: 'GoFundMe' },
                        { id: 'bank', label: 'Bank (ACH)' }
                    ],

                    get finalAmount() {
                        return this.customAmount ? parseFloat(this.customAmount) : this.amount;
                    },

                    formatCurrency(val) {
                        return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(val || 0);
                    },

                    setAmount(val) {
                        this.amount = val;
                        this.customAmount = '';
                    },
                    
                    init() {
                         this.$watch('method', (value) => {
                             if(value === 'paypal' || value === 'card') {
                                 this.renderPayPal();
                             }
                        });
                        // Initial render check
                        if(this.method === 'paypal' || this.method === 'card') {
                             this.renderPayPal();
                        }
                    },

                    renderPayPal() {
                        const container = document.getElementById('paypal-button-container');
                        if (!container) return;
                        
                        container.innerHTML = '';

                        if (typeof paypal !== 'undefined') {
                            paypal.Buttons({
                                style: {
                                    layout: 'vertical',
                                    color:  'gold',
                                    shape:  'rect',
                                    label:  'donate'
                                },
                                createOrder: (data, actions) => {
                                    // Prepare address for PayPal
                                    const shipping = {
                                        name: {
                                            full_name: `${this.form.firstName} ${this.form.lastName}`
                                        },
                                        address: {
                                            address_line_1: this.form.address,
                                            admin_area_2: this.form.city,
                                            postal_code: this.form.zip,
                                            country_code: 'KE' // Ideally map this from selection
                                        }
                                    };

                                    return actions.order.create({
                                        purchase_units: [{ 
                                            amount: { value: this.finalAmount },
                                            description: 'Donation to ACEF',
                                            shipping: shipping
                                        }],
                                        payer: {
                                            name: {
                                                given_name: this.form.firstName,
                                                surname: this.form.lastName
                                            },
                                            email_address: this.form.email
                                        }
                                    });
                                },
                                onApprove: (data, actions) => {
                                    return actions.order.capture().then((details) => {
                                        this.recordDonation(data.orderID, details);
                                    });
                                }
                            }).render('#paypal-button-container');
                        }
                    },

                    async recordDonation(orderId, details) {
                        try {
                            const response = await fetch('{{ route("donate.paypal") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    order_id: orderId,
                                    amount: this.finalAmount,
                                    details: details,
                                    donor_name: `${this.form.firstName} ${this.form.lastName}`.trim(),
                                    donor_email: this.form.email
                                })
                            });
                            
                            if (response.ok) {
                                alert('Thank you! Donation recorded.');
                                window.location.reload();
                            }
                        } catch (e) { console.error(e); }
                    },

                    async processMpesa() {
                        if (!this.form.phone) return alert('Enter phone number');
                        this.loading = true;
                        const statusEl = document.getElementById('mpesa-status');
                        
                        try {
                             const formData = new FormData();
                             formData.append('phone', this.form.phone);
                             formData.append('amount', Math.ceil(this.finalAmount * 129)); // Show consistent with UI
                             formData.append('donor_name', `${this.form.firstName} ${this.form.lastName}`.trim());
                             formData.append('donor_email', this.form.email);

                             const response = await fetch('{{ route("donate.mpesa") }}', {
                                method: 'POST',
                                body: formData,
                                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                             });
                             
                             const data = await response.json();
                             statusEl.classList.remove('hidden');
                             
                             if (data.success) {
                                 statusEl.className = 'mt-4 p-4 rounded text-sm font-bold bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300';
                                 statusEl.textContent = data.message;
                             } else {
                                 statusEl.className = 'mt-4 p-4 rounded text-sm font-bold bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-300';
                                 statusEl.textContent = data.message;
                             }
                        } catch (e) {
                             statusEl.textContent = 'Connection failed';
                        } finally {
                            this.loading = false;
                        }
                    }
                }));
            });
        </script>
    </body>
</html>
