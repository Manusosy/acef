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
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-100 transform transition-transform duration-300 lg:static lg:translate-x-0"
               :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">
            
            <!-- Logo -->
            <div class="flex items-center justify-center h-20 border-b border-gray-50">
                <a href="/" class="flex items-center space-x-2">
                     <span class="text-acef-green font-bold text-2xl tracking-tighter">ACEF</span>
                     <span class="text-xs text-gray-400 font-medium uppercase tracking-widest ml-1">Admin</span>
                </a>
            </div>

            <!-- Nav -->
            <nav class="p-4 space-y-1 overflow-y-auto h-[calc(100vh-5rem)]">
                <!-- Dashboard -->
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-acef-green/10 text-acef-green' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard Overview
                    </a>
                @elseif(auth()->user()->isCoordinator())
                    <a href="{{ route('coordinator.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-colors {{ request()->routeIs('coordinator.dashboard') ? 'bg-acef-green/10 text-acef-green' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard
                    </a>
                @endif

                <div class="pt-4 pb-2">
                    <p class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Management</p>
                </div>

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.projects.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-colors {{ request()->routeIs('admin.projects.*') ? 'bg-acef-green/10 text-acef-green' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        Programs & Projects
                    </a>
                    
                    <a href="{{ route('admin.donations.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-colors {{ request()->routeIs('admin.donations.*') ? 'bg-acef-green/10 text-acef-green' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Donations
                    </a>

                    <a href="{{ route('admin.articles.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-colors {{ request()->routeIs('admin.articles.*') ? 'bg-acef-green/10 text-acef-green' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        Posts & Articles
                    </a>
                @endif
                
                @if(auth()->user()->isCoordinator())
                    <a href="#" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-colors text-gray-500 hover:bg-gray-50 hover:text-gray-900">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        My Articles
                    </a>
                @endif

                <a href="{{ auth()->user()->isAdmin() ? route('admin.media.index') : '#' }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-colors {{ request()->routeIs('*.media.*') ? 'bg-acef-green/10 text-acef-green' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Media Library
                </a>

                <div class="pt-4 pb-2">
                    <p class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider">System</p>
                </div>

                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-colors {{ request()->routeIs('profile.edit') ? 'bg-acef-green/10 text-acef-green' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                     <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Settings
                </a>
            </nav>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden">
            <!-- Topbar -->
            <header class="flex items-center justify-between h-20 px-8 bg-white border-b border-gray-100">
                <!-- Mobile Menu Button -->
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 lg:hidden focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>

                <!-- Breadcrumbs / Search -->
                <div class="flex items-center flex-1 lg:mr-8 max-w-2xl">
                    <div class="hidden md:flex items-center text-sm text-gray-500 mr-8">
                        <span class="hover:text-gray-900 cursor-pointer">Home</span>
                        <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <span class="font-medium text-gray-900">Dashboard</span>
                    </div>
                    
                    <div class="relative w-full max-w-lg hidden sm:block">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </span>
                        <input class="w-full bg-gray-50 text-gray-900 border-none rounded-xl pl-10 pr-4 py-2.5 focus:ring-2 focus:ring-acef-green/20 focus:bg-white transition-all text-sm placeholder-gray-400" type="text" placeholder="Search programs, donors, or files...">
                    </div>
                </div>

                <!-- Right Actions -->
                <div class="flex items-center space-x-6">
                    <!-- Notifications -->
                    <button class="relative text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        <span class="absolute top-0 right-0 block h-2.5 w-2.5 rounded-full bg-red-500 ring-2 ring-white"></span>
                    </button>

                    <!-- User Profile -->
                    <div class="flex items-center pl-6 border-l border-gray-100">
                        <div class="hidden md:block text-right mr-3">
                            <p class="text-sm font-bold text-gray-900 leading-none">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-400 mt-1">{{ Auth::user()->role ? Auth::user()->role->name : 'User' }}</p>
                        </div>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center focus:outline-none">
                                <div class="w-10 h-10 rounded-full bg-acef-green text-white flex items-center justify-center font-bold text-lg shadow-lg shadow-acef-green/20">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            </button>
                            
                            <!-- Dropdown -->
                            <div x-show="open" @click.away="open = false" 
                                 x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-100 py-1 z-50">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Your Profile</a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Log Out</button>
                                </form>
                            </div>
                        </div>
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
