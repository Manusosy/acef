@php
    $currentRoute = Route::currentRouteName();
    
    $menuItems = [
        [
            'label' => 'Dashboard',
            'route' => 'admin.dashboard',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>',
        ],
        [
            'label' => 'Content',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>',
            'children' => [
                ['label' => 'Projects', 'route' => 'admin.projects.index'],
                ['label' => 'Programmes', 'route' => 'admin.programmes.index'],
                ['label' => 'Articles', 'route' => 'admin.articles.index'],
                ['label' => 'Site Structure', 'route' => 'admin.pages.index'],
                ['label' => 'Media Library', 'route' => 'admin.media.index'],
                ['label' => 'Gallery', 'route' => 'admin.gallery.index'],
            ]
        ],
        [
            'label' => 'Organization',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>',
            'children' => [
                ['label' => 'Team Members', 'route' => 'admin.team.index'],
                ['label' => 'Partners', 'route' => 'admin.partners.index'],
            ]
        ],
        [
            'label' => 'Users',
            'route' => 'admin.users.index',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>',
        ],
        [
            'label' => 'Settings',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>',
            'children' => [
                ['label' => 'General', 'route' => 'admin.settings.general'],
                ['label' => 'Payments', 'route' => 'admin.settings.payments'],
                ['label' => 'Admin Account', 'route' => 'profile.edit'],
            ]
        ],
        [
            'label' => 'Donations',
            'route' => 'admin.donations.index',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        ],
    ];
@endphp

<!-- Sidebar -->
<aside class="fixed inset-y-0 left-0 z-50 bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 sidebar-transition sidebar-scroll overflow-y-auto"
       :class="sidebarOpen ? 'w-64' : 'w-20'"
       x-show="sidebarOpen || window.innerWidth >= 1024"
       x-transition:enter="transition ease-out duration-300"
       x-transition:enter-start="-translate-x-full lg:translate-x-0"
       x-transition:enter-end="translate-x-0"
       x-transition:leave="transition ease-in duration-200 lg:transition-none"
       x-transition:leave-start="translate-x-0"
       x-transition:leave-end="-translate-x-full lg:translate-x-0">

    <!-- Logo -->
    <div class="flex items-center h-16 px-4 border-b border-gray-700/50">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center flex-shrink-0">
                <span class="text-white font-bold text-lg">A</span>
            </div>
            <span x-show="sidebarOpen" x-cloak class="text-white font-bold text-lg tracking-tight">
                ACEF <span class="text-emerald-400 font-normal">Admin</span>
            </span>
        </a>
    </div>

    <!-- Collapse Toggle (Desktop) -->
    <button @click="sidebarOpen = !sidebarOpen" 
            class="hidden lg:flex absolute -right-3 top-20 w-6 h-6 bg-gray-800 border border-gray-700 rounded-full items-center justify-center text-gray-400 hover:text-white hover:bg-gray-700 transition-colors">
        <svg class="w-3 h-3 transition-transform" :class="!sidebarOpen && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>

    <!-- Navigation -->
    <nav class="p-4 space-y-1">
        @foreach($menuItems as $item)
            @if(isset($item['children']))
                <!-- Dropdown Menu -->
                <div x-data="{ open: {{ collect($item['children'])->pluck('route')->contains($currentRoute) ? 'true' : 'false' }} }">
                    <button @click="open = !open" 
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-300 hover:bg-white/10 hover:text-white transition-all group"
                            :class="{ 'justify-center': !sidebarOpen }">
                        <svg class="w-5 h-5 flex-shrink-0 text-gray-400 group-hover:text-emerald-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            {!! $item['icon'] !!}
                        </svg>
                        <span x-show="sidebarOpen" x-cloak class="flex-1 text-left text-sm font-medium">{{ $item['label'] }}</span>
                        <svg x-show="sidebarOpen" x-cloak class="w-4 h-4 transition-transform" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    <div x-show="open && sidebarOpen" x-cloak
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="mt-1 ml-4 pl-4 border-l border-gray-700/50 space-y-1">
                        @foreach($item['children'] as $child)
                            <a href="{{ Route::has($child['route']) ? route($child['route']) : '#' }}" 
                               class="block px-3 py-2 rounded-lg text-sm transition-all
                                      {{ $currentRoute === $child['route'] 
                                         ? 'bg-emerald-500/20 text-emerald-400 font-medium' 
                                         : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                                {{ $child['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                <!-- Single Menu Item -->
                <a href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all group
                          {{ $currentRoute === $item['route'] 
                             ? 'bg-white/10 text-white' 
                             : 'text-gray-300 hover:bg-white/10 hover:text-white' }}"
                   :class="{ 'justify-center': !sidebarOpen }">
                    <svg class="w-5 h-5 flex-shrink-0 transition-colors {{ $currentRoute === $item['route'] ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $item['icon'] !!}
                    </svg>
                    <span x-show="sidebarOpen" x-cloak class="text-sm font-medium">{{ $item['label'] }}</span>
                </a>
            @endif
        @endforeach
    </nav>

    <!-- Bottom Section -->
    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-700/50">
        <div x-show="sidebarOpen" x-cloak class="mb-3 px-3 py-2 bg-gradient-to-r from-emerald-500/10 to-teal-500/10 rounded-lg border border-emerald-500/20">
            <p class="text-xs text-emerald-400 font-medium">Environment</p>
            <p class="text-sm text-white">{{ ucfirst(app()->environment()) }}</p>
        </div>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-400 hover:bg-red-500/10 hover:text-red-400 transition-all"
                    :class="{ 'justify-center': !sidebarOpen }">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span x-show="sidebarOpen" x-cloak class="text-sm font-medium">Sign Out</span>
            </button>
        </form>
    </div>
</aside>
