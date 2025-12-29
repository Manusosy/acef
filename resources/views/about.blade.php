<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>About Us - ACEF</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-white overflow-x-hidden">
        @include('components.header')

        <!-- About Hero Section -->
        <section class="relative h-[60vh] min-h-[500px] flex items-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img src="/mission_vision_africa_1766827653058.png" alt="About ACEF" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-acef-dark/90 via-acef-dark/60 to-transparent"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full pt-20">
                <div class="max-w-3xl text-white space-y-6">
                    <p class="text-acef-green font-bold tracking-widest uppercase text-sm">About ACEF</p>
                    <h1 class="text-5xl md:text-7xl font-black leading-tight tracking-tighter">
                        Empowering Africa for a <br>
                        <span class="text-acef-green italic">Sustainable</span> Future
                    </h1>
                    <p class="text-lg md:text-xl font-light text-white/80 leading-relaxed max-w-2xl italic">
                        An environmental platform advocating for environmental and marine conservation.
                    </p>
                </div>
            </div>
        </section>

        <main>
            <!-- Who We Are Section -->
            <section class="py-24 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col lg:flex-row gap-16 items-start">
                        <div class="lg:w-1/3">
                            <h2 class="text-5xl font-black text-acef-dark tracking-tighter sticky top-32">
                                Who <br> We Are
                                <div class="w-20 h-1.5 bg-acef-green mt-4 rounded-full"></div>
                            </h2>
                        </div>
                        <div class="lg:w-2/3 space-y-8">
                            <p class="text-2xl text-acef-dark font-medium leading-normal">
                                <span class="text-acef-green font-bold underline decoration-2 underline-offset-8">Africa Climate and Environment Foundation (ACEF)</span> serves as a leading youth-led collaborative platform for climate action and sustainable development across the African continent.
                            </p>
                            <p class="text-gray-600 leading-loose text-lg font-light">
                                Officially registered on March 31st, 2021, ACEF was born out of a deep conviction: that lasting environmental change only happens when the community, especially its youth, is the primary steward of its own future. We focus on bridging the gap between scientific knowledge, policy advocacy, and grassroots action.
                            </p>
                        </div>
                    </div>

                    <!-- MVV Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-24">
                        <div class="bg-acef-gray p-10 rounded-3xl border border-black/5 hover:shadow-xl transition-all h-full flex flex-col">
                            <div class="w-12 h-12 bg-acef-green/10 rounded-2xl flex items-center justify-center text-acef-green mb-6 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <h3 class="text-2xl font-bold text-acef-dark mb-4">Our Mission</h3>
                            <p class="text-gray-500 leading-relaxed font-light">To mobilize and empower African youth to actively participate in the Climate, Environment, and Sustainable Development agenda, bridging the hunger and poverty gap, mitigating climate change, protecting the environment, and conserving natural resources in Africa.</p>
                        </div>
                        <div class="bg-acef-gray p-10 rounded-3xl border border-black/5 hover:shadow-xl transition-all h-full flex flex-col">
                            <div class="w-12 h-12 bg-acef-dark/10 rounded-2xl flex items-center justify-center text-acef-dark mb-6 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </div>
                            <h3 class="text-2xl font-bold text-acef-dark mb-4">Our Vision</h3>
                            <p class="text-gray-500 leading-relaxed font-light">A resilient Africa where empowered youth lead innovative solutions for climate action, environmental protection, and sustainable development, ensuring a future free from hunger and poverty.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Core Values -->
            <section class="py-24 bg-acef-gray/50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center space-y-4 mb-20">
                        <p class="text-acef-green font-bold tracking-widest uppercase text-sm">Our Principles</p>
                        <h2 class="text-5xl font-black text-acef-dark tracking-tighter">Core Values</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @php
                            $values = [
                                ['title' => 'Youth Leadership', 'desc' => 'Centering young people as primary agents of systemic change.', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197'],
                                ['title' => 'Innovation', 'desc' => 'Fostering creative and context-specific solutions for Africa.', 'icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z'],
                                ['title' => 'Collaboration', 'desc' => 'Building strong partnerships with diverse continental stakeholders.', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                                ['title' => 'Impact', 'desc' => 'Driving measurable and sustainable positive environmental change.', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                                ['title' => 'Integrity', 'desc' => 'Operating with radical transparency and accountability.', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                                ['title' => 'Inclusivity', 'desc' => 'Ensuring equitable participation for all marginalized groups.', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197']
                            ];
                        @endphp
                        @foreach($values as $v)
                        <div class="bg-white p-8 rounded-[40px] border border-gray-100 shadow-sm hover:shadow-xl transition-all group flex flex-col items-center text-center space-y-6">
                            <div class="w-16 h-16 bg-acef-green/5 rounded-2xl flex items-center justify-center text-acef-green group-hover:bg-acef-green group-hover:text-white transition-all duration-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $v['icon'] }}"></path></svg>
                            </div>
                            <div class="space-y-2">
                                <h4 class="text-xl font-bold text-acef-dark tracking-tight">{{ $v['title'] }}</h4>
                                <p class="text-gray-500 text-sm font-light italic leading-relaxed">{{ $v['desc'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- Founder Section -->
            <section class="py-24 bg-acef-dark relative">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row items-center gap-16">
                        <div class="md:w-1/3 flex justify-center">
                            <div class="relative">
                                <div class="w-64 h-64 rounded-full overflow-hidden border-4 border-acef-green shadow-2xl">
                                    <img src="/mission_vision_africa_1766827653058.png" alt="Tambe Honourine Enow" class="w-full h-full object-cover">
                                </div>
                                <div class="absolute -bottom-2 -right-2 bg-acef-green w-10 h-10 rounded-full flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M13.293 6.293a1 1 0 011.414 0l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414-1.414L16.586 13H5a1 1 0 110-2h11.586l-3.293-3.293a1 1 0 010-1.414z"/></svg>
                                </div>
                            </div>
                        </div>
                        <div class="md:w-2/3 text-white space-y-6">
                            <p class="text-acef-green font-bold tracking-widest uppercase text-xs">A Founder's Message</p>
                            <h2 class="text-4xl font-bold leading-tight">
                                "The future of Africa lies in the hands of its <span class="text-acef-green italic">vibrant youth</span>, women, and grassroots communities."
                            </h2>
                            <div class="space-y-4 text-white/60 font-light leading-relaxed">
                                <p>
                                    Welcome to the digital home of the Africa Climate and Environment Foundation (ACEF)! Officially registered on March 31st, 2021, and with its roots firmly planted in Limbe, Cameroon, ACEF was born out of a deep conviction: that the future of Africa and indeed, our planet lies in the hands of its dedicated youth.
                                </p>
                                <p>
                                    In the short time since our founding, ACEF has grown into a vibrant network of over 2,000 members and volunteers across 14 nations. We invite you to explore our platform and discover how you can be part of this vital movement.
                                </p>
                            </div>
                            <div class="pt-4">
                                <p class="font-bold text-xl uppercase tracking-tighter">Tambe Honourine Enow</p>
                                <p class="text-acef-green text-sm italic">Founder, Africa Climate and Environment Foundation (ACEF)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Strategic Objectives -->
            <section class="py-24 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-16 space-y-4">
                        <p class="text-acef-green font-bold tracking-widest uppercase text-sm">Strategic Focus</p>
                        <h2 class="text-5xl font-black text-acef-dark tracking-tighter">Our Objectives</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @php
                            $objectives = [
                                ['title' => 'Economic Empowerment', 'desc' => 'Promoting economic participation and poverty reduction within African communities.'],
                                ['title' => 'Climate Education', 'desc' => 'Providing training in sustainable development through continental networking.'],
                                ['title' => 'Waste Management', 'desc' => 'Promoting effective solid waste management through proper sorting and dumping.'],
                                ['title' => 'WASH Excellence', 'desc' => 'Empowering individual and community action on water and sanitation issues.'],
                                ['title' => 'Eco-Innovation', 'desc' => 'Developing innovations to eliminate environmental hazards and adopt alternative energy.'],
                                ['title' => 'Cultural Advocacy', 'desc' => 'Campaigning against traditions that hinder sustainable development and climate action.'],
                                ['title' => 'Rights Protection', 'desc' => 'Safeguarding environmental protection rights across the African continent.']
                            ];
                        @endphp
                        @foreach($objectives as $obj)
                        <div class="p-8 rounded-3xl border border-gray-100 hover:border-acef-green/30 hover:shadow-xl transition-all group">
                            <div class="flex items-start space-x-4">
                                <div class="w-1.5 h-8 bg-acef-green rounded-full group-hover:scale-y-125 transition-transform"></div>
                                <div class="space-y-2">
                                    <h4 class="text-xl font-bold text-acef-dark group-hover:text-acef-green transition-colors">{{ $obj['title'] }}</h4>
                                    <p class="text-gray-500 text-sm font-light leading-relaxed">{{ $obj['desc'] }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- Journey Timeline -->
            <section class="py-24 bg-white overflow-hidden">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h2 class="text-center text-4xl font-black text-acef-dark mb-20 tracking-tighter">Our Journey</h2>
                    
                    <div class="relative">
                        <!-- Vertical line -->
                        <div class="absolute left-1/2 -translate-x-1/2 h-full w-0.5 bg-acef-gray"></div>
                        
                        <div class="space-y-24">
                            <!-- Step 1 -->
                            <div class="relative flex items-center justify-between">
                                <div class="w-5/12 text-right pr-12">
                                    <span class="text-acef-green font-black text-xl mb-2 block">2021</span>
                                    <h4 class="text-xl font-bold text-acef-dark mb-2">Foundation & Registration</h4>
                                    <p class="text-gray-500 text-sm">ACEF was officially registered in Limbe, Cameroon, starting our continental mission.</p>
                                </div>
                                <div class="absolute left-1/2 -translate-x-1/2 w-6 h-6 rounded-full bg-acef-green border-4 border-white shadow-lg z-10"></div>
                                <div class="w-5/12"></div>
                            </div>

                            <!-- Step 2 -->
                            <div class="relative flex items-center justify-between">
                                <div class="w-5/12"></div>
                                <div class="absolute left-1/2 -translate-x-1/2 w-6 h-6 rounded-full bg-acef-green border-4 border-white shadow-lg z-10"></div>
                                <div class="w-5/12 pl-12">
                                    <span class="text-acef-green font-black text-xl mb-2 block">2022</span>
                                    <h4 class="text-xl font-bold text-acef-dark mb-2">Coastal Expansion</h4>
                                    <p class="text-gray-500 text-sm">Launched our first multi-country marine protection initiative across the West African coast.</p>
                                </div>
                            </div>

                            <!-- Step 3 -->
                            <div class="relative flex items-center justify-between">
                                <div class="w-5/12 text-right pr-12">
                                    <span class="text-acef-green font-black text-xl mb-2 block">2023</span>
                                    <h4 class="text-xl font-bold text-acef-dark mb-2">Research Partnership</h4>
                                    <p class="text-gray-500 text-sm">Established collaborative research hubs with major African universities.</p>
                                </div>
                                <div class="absolute left-1/2 -translate-x-1/2 w-6 h-6 rounded-full bg-acef-green border-4 border-white shadow-lg z-10"></div>
                                <div class="w-5/12"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Team Section -->
            <section class="py-24 bg-acef-gray">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
                    <div class="flex justify-between items-end">
                        <div class="space-y-4">
                            <h2 class="text-5xl font-black text-acef-dark tracking-tighter">Meet Our Leadership</h2>
                            <p class="text-gray-500 font-light italic">The dedicated team driving continental conservation.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
                        <!-- Member 1 -->
                        <div class="group">
                            <div class="relative rounded-3xl overflow-hidden mb-6 aspect-square grayscale group-hover:grayscale-0 transition-all duration-500 shadow-xl">
                                <img src="/mission_vision_africa_1766827653058.png" alt="Team Member" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                            </div>
                            <h4 class="text-xl font-bold text-acef-dark">Sarah Mbali</h4>
                            <p class="text-acef-green font-medium text-sm">Executive Director</p>
                        </div>
                        <!-- Member 2 -->
                        <div class="group">
                            <div class="relative rounded-3xl overflow-hidden mb-6 aspect-square grayscale group-hover:grayscale-0 transition-all duration-500 shadow-xl">
                                <img src="/project_solar_panels_1766827705821.png" alt="Team Member" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                            </div>
                            <h4 class="text-xl font-bold text-acef-dark">David Chizi</h4>
                            <p class="text-acef-green font-medium text-sm">Conservation Lead</p>
                        </div>
                        <!-- Member 3 -->
                        <div class="group">
                            <div class="relative rounded-3xl overflow-hidden mb-6 aspect-square grayscale group-hover:grayscale-0 transition-all duration-500 shadow-xl">
                                <img src="/project_tree_planting_1766827726209.png" alt="Team Member" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                            </div>
                            <h4 class="text-xl font-bold text-acef-dark">Grace Tabi</h4>
                            <p class="text-acef-green font-medium text-sm">Programs Manager</p>
                        </div>
                        <!-- Member 4 -->
                        <div class="group">
                            <div class="relative rounded-3xl overflow-hidden mb-6 aspect-square grayscale group-hover:grayscale-0 transition-all duration-500 shadow-xl">
                                <img src="/project_mangroves_1766827746442.png" alt="Team Member" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                            </div>
                            <h4 class="text-xl font-bold text-acef-dark">Isaac Obi</h4>
                            <p class="text-acef-green font-medium text-sm">Financial Director</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        @include('components.footer')
    </body>
</html>
