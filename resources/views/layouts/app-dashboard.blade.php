@php
    $generalSettings = \App\Models\Setting::getGroup('general');
    $siteName = $generalSettings['site_name'] ?? 'ACEF';
    $siteLogo = $generalSettings['site_logo'] ?? null;
    $dashboardLogo = $generalSettings['dashboard_logo'] ?? $siteLogo;
    $siteFavicon = $generalSettings['site_favicon'] ?? null;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ 
    darkMode: localStorage.getItem('theme') === 'dark',
    sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true',
    sidebarOpen: false
}" 
:class="{ 'dark': darkMode }" 
x-init="$watch('darkMode', val => localStorage.setItem('theme', val ? 'dark' : 'light')); 
        $watch('sidebarCollapsed', val => localStorage.setItem('sidebarCollapsed', val))">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @if($siteFavicon)
        <link rel="icon" type="image/x-icon" href="{{ Storage::url($siteFavicon) }}">
    @endif

    <title>{{ $siteName }} - Dashboard</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:ital,wght@0,200..900;1,200..900&family=Raleway:ital,wght@0,100..900;1,100..900&family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Media Picker Modal -->
    @include('admin.media.partials.picker')
    <style>
        [x-cloak] { display: none !important; }
        
        /* Theme Variables */
        :root {
            --color-bg-primary: #ffffff;
            --color-bg-secondary: #f9fafb;
            --color-text-primary: #111827;
            --color-text-secondary: #6b7280;
            --color-border: #e5e7eb;
        }
        
        .dark {
            --color-bg-primary: #1f2937;
            --color-bg-secondary: #111827;
            --color-text-primary: #f9fafb;
            --color-text-secondary: #9ca3af;
            --color-border: #374151;
        }
        
        /* Smooth transitions */
        .sidebar-transition {
            transition: width 300ms cubic-bezier(0.4, 0, 0.2, 1), 
                        margin 300ms cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Tooltip */
        .tooltip {
            opacity: 0;
            visibility: hidden;
            transition: opacity 200ms, visibility 200ms;
        }
        
        .group:hover .tooltip {
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-50 bg-gradient-to-b from-acef-dark via-acef-dark to-gray-900 border-r border-gray-800 transform transition-all duration-300 lg:static lg:translate-x-0 flex flex-col sidebar-transition"
               :class="{
                   'translate-x-0': sidebarOpen, 
                   '-translate-x-full': !sidebarOpen,
                   'w-64': !sidebarCollapsed,
                   'w-20': sidebarCollapsed
               }">
            
            <!-- Logo/Brand -->
            <div class="px-6 py-6 border-b border-gray-800">
                <div class="flex items-center gap-3" :class="sidebarCollapsed ? 'justify-center' : ''">
                    @if($dashboardLogo)
                        <img :src="'{{ Storage::url($dashboardLogo) }}'" alt="{{ $siteName }}" 
                             class="object-contain" 
                             :class="sidebarCollapsed ? 'h-8 w-8' : 'h-10 w-auto'">
                    @else
                        <div class="rounded-full bg-acef-green flex items-center justify-center text-white font-bold" 
                             :class="sidebarCollapsed ? 'w-8 h-8 text-sm' : 'w-10 h-10 text-xl'">
                            {{ substr($siteName, 0, 1) }}
                        </div>
                    @endif
                    
                    <div x-show="!sidebarCollapsed" x-transition class="min-w-0">
                        <h1 class="font-bold text-white leading-tight truncate">{{ $siteName }}</h1>
                        <p class="text-xs text-gray-400 font-medium">Platform Manager</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto" x-data="{ openMenu: '{{ request()->segment(2) }}' }">
                
                <!-- Dashboard -->
                <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('coordinator.dashboard') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all group relative {{ request()->routeIs('admin.dashboard') || request()->routeIs('coordinator.dashboard') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}"
                   :class="sidebarCollapsed ? 'justify-center' : ''">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span x-show="!sidebarCollapsed" x-transition class="font-medium">Dashboard</span>
                    <div x-show="sidebarCollapsed" class="tooltip absolute left-full ml-2 px-3 py-1.5 bg-gray-900 text-white text-sm rounded-lg whitespace-nowrap pointer-events-none z-50">Dashboard</div>
                </a>

                <!-- Posts (Articles) -->
                <div x-data="{ open: {{ request()->routeIs('admin.articles.*') ? 'true' : 'false' }} }">
                    <button @click="if (!sidebarCollapsed) open = !open" 
                            class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-all group hover:bg-white/5 {{ request()->routeIs('admin.articles.*') ? 'bg-white/5' : '' }}"
                            :class="sidebarCollapsed ? 'justify-center' : ''">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.articles.*') ? 'text-white' : 'text-gray-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2zM7 8h10M7 12h10M7 16h10"/>
                            </svg>
                            <span x-show="!sidebarCollapsed" x-transition class="font-medium text-gray-300 group-hover:text-white">Posts</span>
                        </div>
                        <svg x-show="!sidebarCollapsed" class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                        <div x-show="sidebarCollapsed" class="tooltip absolute left-full ml-2 px-3 py-1.5 bg-gray-900 text-white text-sm rounded-lg whitespace-nowrap pointer-events-none z-50">Posts</div>
                    </button>
                    <div x-show="open && !sidebarCollapsed" x-collapse class="pl-11 pr-2 space-y-1 mt-1">
                        <a href="{{ route('admin.articles.index') }}" class="block px-3 py-1.5 text-sm rounded-md transition-colors {{ request()->routeIs('admin.articles.index') ? 'text-white font-medium bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">All Articles</a>
                        <a href="{{ route('admin.articles.create') }}" class="block px-3 py-1.5 text-sm rounded-md transition-colors {{ request()->routeIs('admin.articles.create') ? 'text-white font-medium bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">Add New</a>
                        <a href="{{ route('admin.categories.index') }}" class="block px-3 py-1.5 text-sm rounded-md transition-colors {{ request()->routeIs('admin.categories.*') ? 'text-white font-medium bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">Categories</a>
                    </div>
                </div>


                <!-- Programs -->
                <div x-data="{ open: {{ request()->routeIs('admin.programmes.*') ? 'true' : 'false' }} }">
                    <button @click="if (!sidebarCollapsed) open = !open" 
                            class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-all group hover:bg-white/5 {{ request()->routeIs('admin.programmes.*') ? 'bg-white/5' : '' }}"
                            :class="sidebarCollapsed ? 'justify-center' : ''">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.programmes.*') ? 'text-white' : 'text-gray-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <span x-show="!sidebarCollapsed" x-transition class="font-medium text-gray-300 group-hover:text-white">Programmes</span>
                        </div>
                        <svg x-show="!sidebarCollapsed" class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                        <div x-show="sidebarCollapsed" class="tooltip absolute left-full ml-2 px-3 py-1.5 bg-gray-900 text-white text-sm rounded-lg whitespace-nowrap pointer-events-none z-50">Programmes</div>
                    </button>
                    <div x-show="open && !sidebarCollapsed" x-collapse class="pl-11 pr-2 space-y-1 mt-1">
                        <a href="{{ route('admin.programmes.index') }}" class="block px-3 py-1.5 text-sm rounded-md transition-colors {{ request()->routeIs('admin.programmes.index') ? 'text-white font-medium bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">All Programmes</a>
                        <a href="{{ route('admin.programmes.create') }}" class="block px-3 py-1.5 text-sm rounded-md transition-colors {{ request()->routeIs('admin.programmes.create') ? 'text-white font-medium bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">Add New</a>
                    </div>
                </div>

                <!-- Projects -->
                <div x-data="{ open: {{ request()->routeIs('admin.projects.*') ? 'true' : 'false' }} }">
                    <button @click="if (!sidebarCollapsed) open = !open" 
                            class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-all group hover:bg-white/5 {{ request()->routeIs('admin.projects.*') ? 'bg-white/5' : '' }}"
                            :class="sidebarCollapsed ? 'justify-center' : ''">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.projects.*') ? 'text-white' : 'text-gray-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span x-show="!sidebarCollapsed" x-transition class="font-medium text-gray-300 group-hover:text-white">Projects</span>
                        </div>
                        <svg x-show="!sidebarCollapsed" class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                        <div x-show="sidebarCollapsed" class="tooltip absolute left-full ml-2 px-3 py-1.5 bg-gray-900 text-white text-sm rounded-lg whitespace-nowrap pointer-events-none z-50">Projects</div>
                    </button>
                    <div x-show="open && !sidebarCollapsed" x-collapse class="pl-11 pr-2 space-y-1 mt-1">
                        <a href="{{ route('admin.projects.index') }}" class="block px-3 py-1.5 text-sm rounded-md transition-colors {{ request()->routeIs('admin.projects.index') ? 'text-white font-medium bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">All Projects</a>
                        <a href="{{ route('admin.projects.create') }}" class="block px-3 py-1.5 text-sm rounded-md transition-colors {{ request()->routeIs('admin.projects.create') ? 'text-white font-medium bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">Add New</a>
                    </div>
                </div>

                @if(Auth::user()->isAdmin())

                    <!-- Media Library -->
                    <a href="{{ route('admin.media.index') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all group relative {{ request()->routeIs('admin.media.*') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}"
                       :class="sidebarCollapsed ? 'justify-center' : ''">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span x-show="!sidebarCollapsed" x-transition class="font-medium">Media Library</span>
                        <div x-show="sidebarCollapsed" class="tooltip absolute left-full ml-2 px-3 py-1.5 bg-gray-900 text-white text-sm rounded-lg whitespace-nowrap pointer-events-none z-50">Media Library</div>
                    </a>

                    <!-- Pages -->
                    <div x-data="{ open: {{ request()->routeIs('admin.pages.*') ? 'true' : 'false' }} }">
                        <button @click="if (!sidebarCollapsed) open = !open" 
                                class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-all group hover:bg-white/5 {{ request()->routeIs('admin.pages.*') ? 'bg-white/5' : '' }}"
                                :class="sidebarCollapsed ? 'justify-center' : ''">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.pages.*') ? 'text-white' : 'text-gray-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                <span x-show="!sidebarCollapsed" x-transition class="font-medium text-gray-300 group-hover:text-white">Site Structure</span>
                            </div>
                            <svg x-show="!sidebarCollapsed" class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                            <div x-show="sidebarCollapsed" class="tooltip absolute left-full ml-2 px-3 py-1.5 bg-gray-900 text-white text-sm rounded-lg whitespace-nowrap pointer-events-none z-50">Site Structure</div>
                        </button>
                        <div x-show="open && !sidebarCollapsed" x-collapse class="pl-11 pr-2 space-y-1 mt-1">
                            <a href="{{ route('admin.pages.index') }}" class="block px-3 py-1.5 text-sm rounded-md transition-colors {{ request()->routeIs('admin.pages.index') ? 'text-white font-medium bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">All Pages</a>
                            <a href="{{ route('admin.pages.create') }}" class="block px-3 py-1.5 text-sm rounded-md transition-colors {{ request()->routeIs('admin.pages.create') ? 'text-white font-medium bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">Add New</a>
                        </div>
                    </div>



                    <!-- Resources -->
                    <a href="{{ route('admin.resources.index') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all group relative {{ request()->routeIs('admin.resources.*') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}"
                       :class="sidebarCollapsed ? 'justify-center' : ''">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        <span x-show="!sidebarCollapsed" x-transition class="font-medium">Resources</span>
                        <div x-show="sidebarCollapsed" class="tooltip absolute left-full ml-2 px-3 py-1.5 bg-gray-900 text-white text-sm rounded-lg whitespace-nowrap pointer-events-none z-50">Resources</div>
                    </a>

                    <!-- Organization -->
                    <div class="pt-4 pb-2 text-gray-500 uppercase text-xs font-bold tracking-wider" x-show="!sidebarCollapsed">Organization</div>
                    
                    <a href="{{ route('admin.team.index') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all group relative {{ request()->routeIs('admin.team.*') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}"
                       :class="sidebarCollapsed ? 'justify-center' : ''">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span x-show="!sidebarCollapsed" x-transition class="font-medium">Team Members</span>
                        <div x-show="sidebarCollapsed" class="tooltip absolute left-full ml-2 px-3 py-1.5 bg-gray-900 text-white text-sm rounded-lg whitespace-nowrap pointer-events-none z-50">Team Members</div>
                    </a>

                    <a href="{{ route('admin.partners.index') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all group relative {{ request()->routeIs('admin.partners.*') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}"
                       :class="sidebarCollapsed ? 'justify-center' : ''">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span x-show="!sidebarCollapsed" x-transition class="font-medium">Partners</span>
                        <div x-show="sidebarCollapsed" class="tooltip absolute left-full ml-2 px-3 py-1.5 bg-gray-900 text-white text-sm rounded-lg whitespace-nowrap pointer-events-none z-50">Partners</div>
                    </a>

                    <a href="{{ route('admin.accreditations.index') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all group relative {{ request()->routeIs('admin.accreditations.*') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}"
                       :class="sidebarCollapsed ? 'justify-center' : ''">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span x-show="!sidebarCollapsed" x-transition class="font-medium">Accreditations</span>
                        <div x-show="sidebarCollapsed" class="tooltip absolute left-full ml-2 px-3 py-1.5 bg-gray-900 text-white text-sm rounded-lg whitespace-nowrap pointer-events-none z-50">Accreditations</div>
                    </a>

                    <a href="{{ route('admin.users.index') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all group relative {{ request()->routeIs('admin.users.*') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}"
                       :class="sidebarCollapsed ? 'justify-center' : ''">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span x-show="!sidebarCollapsed" x-transition class="font-medium">Users & Roles</span>
                        <div x-show="sidebarCollapsed" class="tooltip absolute left-full ml-2 px-3 py-1.5 bg-gray-900 text-white text-sm rounded-lg whitespace-nowrap pointer-events-none z-50">Users & Roles</div>
                    </a>

                    <a href="{{ route('admin.donations.index') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all group relative {{ request()->routeIs('admin.donations.*') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}"
                       :class="sidebarCollapsed ? 'justify-center' : ''">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span x-show="!sidebarCollapsed" x-transition class="font-medium">Donations</span>
                        <div x-show="sidebarCollapsed" class="tooltip absolute left-full ml-2 px-3 py-1.5 bg-gray-900 text-white text-sm rounded-lg whitespace-nowrap pointer-events-none z-50">Donations</div>
                    </a>
                @endif

                <!-- Settings (System) -->
                <div x-data="{ open: {{ request()->routeIs('admin.settings.*') || request()->routeIs('profile.*') ? 'true' : 'false' }} }">
                    <button @click="if (!sidebarCollapsed) open = !open" 
                            class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-all group hover:bg-white/5 {{ request()->routeIs('admin.settings.*') || request()->routeIs('profile.*') ? 'bg-white/5' : '' }}"
                            :class="sidebarCollapsed ? 'justify-center' : ''">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.settings.*') || request()->routeIs('profile.*') ? 'text-white' : 'text-gray-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span x-show="!sidebarCollapsed" x-transition class="font-medium text-gray-300 group-hover:text-white">Settings</span>
                        </div>
                        <svg x-show="!sidebarCollapsed" class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                        <div x-show="sidebarCollapsed" class="tooltip absolute left-full ml-2 px-3 py-1.5 bg-gray-900 text-white text-sm rounded-lg whitespace-nowrap pointer-events-none z-50">Settings</div>
                    </button>
                    <div x-show="open && !sidebarCollapsed" x-collapse class="pl-11 pr-2 space-y-1 mt-1">
                        @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.settings.general') }}" class="block px-3 py-1.5 text-sm rounded-md transition-colors {{ request()->routeIs('admin.settings.general') ? 'text-white font-medium bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">Site Settings</a>
                        <a href="{{ route('admin.settings.apis') }}" class="block px-3 py-1.5 text-sm rounded-md transition-colors {{ request()->routeIs('admin.settings.apis') ? 'text-white font-medium bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">API & Gateways</a>
                        @endif
                        <a href="{{ route('profile.edit') }}" class="block px-3 py-1.5 text-sm rounded-md transition-colors {{ request()->routeIs('profile.edit') ? 'text-white font-medium bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">Admin Account</a>
                    </div>
                </div>
            </nav>
            
            <!-- Back to Home (Bottom) -->
            <div class="p-4 border-t border-gray-800">
                <a href="{{ route('home') }}" 
                   class="flex items-center gap-3 w-full p-2 rounded-lg text-gray-400 hover:bg-white/5 hover:text-white transition-all group"
                   :class="sidebarCollapsed ? 'justify-center' : ''">
                    <div class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center group-hover:bg-acef-green transition-colors flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <div x-show="!sidebarCollapsed" x-transition class="flex-1 min-w-0">
                        <p class="text-sm font-medium truncate">Go Back Home</p>
                        <p class="text-xs opacity-60 truncate">Exit Dashboard</p>
                    </div>
                </a>
            </div>
        </aside>



        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden">
            <!-- Enhanced Header -->
            <header class="h-16 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between px-6 gap-4 z-30 transition-all"
                    :class="sidebarCollapsed ? 'lg:ml-0' : 'lg:ml-0'">
                
                <!-- Left: Menu + Breadcrumbs -->
                <div class="flex items-center gap-4">
                    <!-- Hamburger Menu Button -->
                    <button @click="sidebarCollapsed = !sidebarCollapsed" 
                            class="hidden lg:block p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    
                    <!-- Mobile menu button -->
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    
                    <!-- Breadcrumbs -->
                    <nav class="hidden md:flex items-center gap-2 text-sm">
                        <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('coordinator.dashboard') }}" 
                           class="text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">Dashboard</a>
                        @if(request()->segment(2) && request()->segment(2) !== 'dashboard')
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            <span class="text-gray-900 dark:text-white font-medium capitalize">{{ str_replace('-', ' ', request()->segment(2)) }}</span>
                        @endif
                    </nav>
                </div>
                
                <!-- Center: Global Search -->
                <div class="flex-1 max-w-2xl hidden md:block">
                    <div class="relative">
                        <input type="search" 
                               placeholder="Search... (⌘K)"
                               class="w-full pl-10 pr-4 py-2 rounded-lg bg-gray-100 dark:bg-gray-700 border-none text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-acef-green transition-all">
                        <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
                
                <!-- Right: Actions -->
                <div class="flex items-center gap-2">
                    <!-- Notifications -->
                    <button class="relative p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </button>
                    
                    <!-- Theme Toggle -->
                    <button @click="darkMode = !darkMode" 
                            class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        <svg x-show="!darkMode" class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        <svg x-show="darkMode" class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </button>
                    
                    <!-- Profile Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" 
                                class="flex items-center gap-2 p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            <div class="w-8 h-8 rounded-full bg-acef-green flex items-center justify-center text-white font-bold text-sm">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="hidden lg:block text-sm font-medium text-gray-700 dark:text-gray-300">{{ explode(' ', Auth::user()->name)[0] }}</span>
                            <svg class="hidden lg:block w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="open" 
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-200 dark:border-gray-700 py-2 z-50">
                            
                            <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors {{ request()->routeIs('profile.edit') ? 'bg-gray-50 dark:bg-gray-700' : '' }}">
                                <svg class="w-4 h-4 {{ request()->routeIs('profile.edit') ? 'text-acef-green' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                My Profile
                            </a>
                            
                            <a href="{{ route('admin.settings.general') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Settings
                            </a>
                            
                            <div class="border-t border-gray-100 dark:border-gray-700 my-2"></div>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="dashboard-content flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 dark:bg-gray-900 p-8">
                <!-- Session Status -->
                <x-auth-session-status class="mb-6 px-4 py-3 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300" :status="session('status')" />
                
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
