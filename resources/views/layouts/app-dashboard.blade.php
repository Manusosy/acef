<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ACEF') }} - Dashboard</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-100 transform transition-transform duration-300 lg:static lg:translate-x-0 flex flex-col"
               :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">
            
            <!-- Logo -->
            <div class="px-6 py-8">
                <div class="flex items-center gap-3">
                    @php
                        $generalSettings = \App\Models\Setting::getGroup('general');
                        $siteLogo = $generalSettings['site_logo'] ?? null;
                        $siteName = $generalSettings['site_name'] ?? 'ACEF Admin';
                    @endphp

                    @if($siteLogo)
                        <img src="{{ Storage::url($siteLogo) }}" alt="{{ $siteName }}" class="h-10 w-auto object-contain">
                    @else
                        <div class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center text-white font-bold text-xl">
                            {{ substr($siteName, 0, 1) }}
                        </div>
                    @endif
                    
                    <div>
                        <h1 class="font-bold text-gray-900 leading-tight">{{ $siteName }}</h1>
                        <p class="text-xs text-gray-400 font-medium">Platform Manager</p>
                    </div>
                </div>
            </div>

            <!-- Nav -->
            <nav class="flex-1 px-4 space-y-1 overflow-y-auto" x-data="{ openMenu: '{{ request()->segment(2) }}' }">
                <!-- Dashboard -->
                <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('coordinator.dashboard') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors group {{ request()->routeIs('admin.dashboard') || request()->routeIs('coordinator.dashboard') ? 'bg-emerald-50 text-emerald-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') || request()->routeIs('coordinator.dashboard') ? 'text-emerald-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>

                @if(Auth::user()->isAdmin())
                    <!-- Programs -->
                    <div x-data="{ open: {{ request()->routeIs('admin.programmes.*') ? 'true' : 'false' }} }">
                        <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-colors group hover:bg-gray-50 {{ request()->routeIs('admin.programmes.*') ? 'bg-gray-50' : '' }}">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 {{ request()->routeIs('admin.programmes.*') ? 'text-emerald-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                                </svg>
                                <span class="font-medium text-gray-700">Programs</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open" x-collapse class="pl-11 pr-2 space-y-1 mt-1">
                            <a href="{{ route('admin.programmes.index') }}" class="block px-3 py-1.5 text-sm rounded-md transition-colors {{ request()->routeIs('admin.programmes.index') ? 'text-emerald-600 font-medium bg-emerald-50' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">All Programs</a>
                            <a href="{{ route('admin.programmes.create') }}" class="block px-3 py-1.5 text-sm rounded-md transition-colors {{ request()->routeIs('admin.programmes.create') ? 'text-emerald-600 font-medium bg-emerald-50' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">Add New</a>
                        </div>
                    </div>

                    <!-- Projects -->
                    <div x-data="{ open: {{ request()->routeIs('admin.projects.*') ? 'true' : 'false' }} }">
                        <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-colors group hover:bg-gray-50 {{ request()->routeIs('admin.projects.*') ? 'bg-gray-50' : '' }}">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 {{ request()->routeIs('admin.projects.*') ? 'text-emerald-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                </svg>
                                <span class="font-medium text-gray-700">Projects</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open" x-collapse class="pl-11 pr-2 space-y-1 mt-1">
                            <a href="{{ route('admin.projects.index') }}" class="block px-3 py-1.5 text-sm rounded-md transition-colors {{ request()->routeIs('admin.projects.index') ? 'text-emerald-600 font-medium bg-emerald-50' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">All Projects</a>
                            <a href="{{ route('admin.projects.create') }}" class="block px-3 py-1.5 text-sm rounded-md transition-colors {{ request()->routeIs('admin.projects.create') ? 'text-emerald-600 font-medium bg-emerald-50' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">Add New</a>
                        </div>
                    </div>

                    <!-- Partners -->
                    <a href="{{ route('admin.partners.index') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors group {{ request()->routeIs('admin.partners.*') ? 'bg-emerald-50 text-emerald-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                         <svg class="w-5 h-5 {{ request()->routeIs('admin.partners.*') ? 'text-emerald-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="font-medium">Partners</span>
                    </a>

                    <!-- Articles (Keeping this as extra but styled) -->
                    <a href="{{ route('admin.articles.index') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors group {{ request()->routeIs('admin.articles.*') ? 'bg-emerald-50 text-emerald-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.articles.*') ? 'text-emerald-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        <span class="font-medium">Articles</span>
                    </a>
                    
                    <!-- Media (Keeping this as extra) -->
                    <a href="{{ route('admin.media.index') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors group {{ request()->routeIs('admin.media.*') ? 'bg-emerald-50 text-emerald-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.media.*') ? 'text-emerald-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="font-medium">Media</span>
                    </a>

                @else
                    <!-- Coordinator Menu Items -->
                     <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors group hover:bg-gray-50">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        <span class="font-medium text-gray-500 group-hover:text-gray-900">My Articles</span>
                    </a>
                @endif
                
                <!-- Settings (All Roles) -->
                <a href="{{ route('admin.settings.general') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors group {{ request()->routeIs('admin.settings.*') ? 'bg-emerald-50 text-emerald-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                     <svg class="w-5 h-5 {{ request()->routeIs('admin.settings.*') ? 'text-emerald-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span class="font-medium">Settings</span>
                </a>
            </nav>
            
            <!-- User Profile (Bottom) -->
            <div class="p-4 border-t border-gray-100">
                <div class="flex items-center gap-3 w-full p-2 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center font-bold">
                         {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>



        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden">
            <!-- Topbar -->
            <!-- Topbar (Mobile Only mostly) -->
            <header class="flex items-center justify-between h-16 px-6 bg-white border-b border-gray-100 lg:hidden">
                <!-- Mobile Menu Button -->
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>

                <div class="font-bold text-lg">ACEF Admin</div>

                <!-- Mobile Profile -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </button>
                    <!-- Dropdown -->
                     <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-100 py-1 z-50">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Log Out</button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-8">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
