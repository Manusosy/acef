<x-app-dashboard-layout>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Partners</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Manage strategic, institutional, and implementation partners</p>
        </div>
        <a href="{{ route('admin.partners.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-acef-dark dark:bg-emerald-600 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:scale-105 active:scale-95 transition-all shadow-xl shadow-emerald-500/10">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            Add New Partner
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-4 mb-8 flex flex-wrap gap-4 shadow-sm">
        <form method="GET" class="flex flex-wrap gap-4 w-full">
            <div class="flex-1 min-w-[200px]">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search partners..." 
                       class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl text-xs font-semibold focus:ring-2 focus:ring-emerald-500/20 dark:text-gray-300">
            </div>
            <div class="w-48">
                <select name="category" onchange="this.form.submit()" class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl text-xs font-semibold focus:ring-2 focus:ring-emerald-500/20 dark:text-gray-300">
                    <option value="">All Categories</option>
                    <option value="strategic" {{ request('category') === 'strategic' ? 'selected' : '' }}>Strategic</option>
                    <option value="institutional" {{ request('category') === 'institutional' ? 'selected' : '' }}>Institutional</option>
                    <option value="implementation" {{ request('category') === 'implementation' ? 'selected' : '' }}>Implementation</option>
                </select>
            </div>
            <button type="submit" class="px-6 py-2 bg-gray-900 dark:bg-gray-700 text-white text-[10px] font-black uppercase tracking-widest rounded-xl">Filter</button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($partners as $partner)
            <div class="group bg-white dark:bg-gray-800 rounded-[32px] border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-2xl hover:shadow-emerald-500/5 transition-all duration-500">
                <div class="relative h-48 bg-gray-50 dark:bg-gray-900/50 flex items-center justify-center p-8 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-teal-500/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    
                    @if($partner->logo)
                        <img src="{{ Storage::url($partner->logo) }}" alt="{{ $partner->name }}" class="max-w-full max-h-full object-contain relative z-10 filter grayscale group-hover:grayscale-0 transition-all duration-500 group-hover:scale-110">
                    @else
                        <div class="w-20 h-20 rounded-3xl bg-white dark:bg-gray-800 shadow-xl flex items-center justify-center relative z-10 transition-transform group-hover:rotate-12">
                            <span class="text-3xl font-black text-emerald-500">{{ substr($partner->name, 0, 1) }}</span>
                        </div>
                    @endif

                    <div class="absolute top-4 right-4 flex flex-col gap-2">
                        <form x-data method="POST" action="{{ route('admin.partners.update', $partner) }}" class="inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="name" value="{{ $partner->name }}">
                            <input type="hidden" name="category" value="{{ $partner->category }}">
                            <input type="hidden" name="show_on_homepage" value="{{ $partner->show_on_homepage ? 0 : 1 }}">
                            <button type="submit" class="px-3 py-1 {{ $partner->show_on_homepage ? 'bg-emerald-500 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-400' }} text-[8px] font-black uppercase tracking-widest rounded-full shadow-lg transition-all hover:scale-110">
                                {{ $partner->show_on_homepage ? 'Featured' : 'Feature' }}
                            </button>
                        </form>
                        <span class="px-3 py-1 {{ $partner->is_active ? 'bg-white/90 text-emerald-600' : 'bg-red-50 text-red-600' }} text-[8px] font-black uppercase tracking-widest rounded-full shadow-sm">{{ $partner->is_active ? 'Active' : 'Inactive' }}</span>
                    </div>
                </div>

                <div class="p-8 space-y-4">
                    <div>
                        <p class="text-[10px] font-black text-emerald-500 uppercase tracking-widest mb-1">{{ $partner->category }}</p>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white leading-tight group-hover:text-emerald-600 transition-colors">{{ $partner->name }}</h3>
                    </div>
                    
                    <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2 italic font-medium leading-relaxed">
                        {{ $partner->description ?: 'No description provided.' }}
                    </p>

                    <div class="pt-6 border-t border-gray-50 dark:border-gray-700 flex items-center justify-between">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.partners.edit', $partner) }}" class="w-10 h-10 rounded-xl bg-gray-50 dark:bg-gray-900 flex items-center justify-center text-gray-400 hover:bg-emerald-50 hover:text-emerald-600 dark:hover:bg-emerald-900/30 transition-all border border-transparent hover:border-emerald-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            @if($partner->website)
                                <a href="{{ $partner->website }}" target="_blank" class="w-10 h-10 rounded-xl bg-gray-50 dark:bg-gray-900 flex items-center justify-center text-gray-400 hover:bg-emerald-50 hover:text-emerald-600 dark:hover:bg-emerald-900/30 transition-all border border-transparent hover:border-emerald-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                </a>
                            @endif
                        </div>
                        <form method="POST" action="{{ route('admin.partners.destroy', $partner) }}" onsubmit="return confirm('Delete this partner?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-10 h-10 rounded-xl bg-gray-50 dark:bg-gray-900 flex items-center justify-center text-gray-400 hover:bg-red-50 hover:text-red-600 dark:hover:bg-red-900/30 transition-all border border-transparent hover:border-red-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 bg-white dark:bg-gray-800 rounded-3xl border-2 border-dashed border-gray-100 dark:border-gray-700 flex flex-col items-center justify-center text-center space-y-4">
                <div class="w-20 h-20 rounded-3xl bg-emerald-50 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <div>
                    <h4 class="text-lg font-bold text-gray-900 dark:text-white">No Partners Found</h4>
                    <p class="text-sm text-gray-500">Add your first partner to get started.</p>
                </div>
                <a href="{{ route('admin.partners.create') }}" class="px-8 py-3 bg-acef-dark text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:scale-105 transition-all">Add Partner</a>
            </div>
        @endforelse
    </div>

    @if($partners->hasPages())
        <div class="mt-12">
            {{ $partners->links() }}
        </div>
    @endif
</x-app-dashboard-layout>
