<x-app-dashboard-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Site Settings</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Manage your site's visual identity and global configuration</p>
        </div>

        <form method="POST" action="{{ route('admin.settings.general.update') }}" class="space-y-8" enctype="multipart/form-data">
            @csrf
            {{-- Rest of the form --}}

            <!-- Branding -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm overflow-hidden">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 dark:text-white uppercase tracking-wider text-sm">Branding Assets</h3>
                        <p class="text-xs text-gray-500">Manage your site's visual identity</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach([
                        'site_logo' => 'Site Logo (Light Mode / Header)',
                        'site_logo_dark' => 'Site Logo (Dark Mode / Footer)',
                        'dashboard_logo' => 'Dashboard Sidebar Logo',
                        'site_favicon' => 'Site Favicon'
                    ] as $field => $label)
                    <div x-data="{ 
                        preview: '{{ isset($settings[$field]) ? Storage::url($settings[$field]) : '' }}',
                        path: '{{ $settings[$field] ?? '' }}',
                        selectImage() {
                            window.openMediaPicker((item) => {
                                this.preview = item.url;
                                this.path = item.url;
                                $refs.input.value = item.url;
                            });
                        }
                    }">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">{{ $label }}</label>
                        <div @click="selectImage()" class="relative group cursor-pointer">
                            <div class="aspect-video {{ $field === 'site_favicon' ? 'md:aspect-square md:w-32' : '' }} bg-gray-50 dark:bg-gray-900 rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-700 flex items-center justify-center overflow-hidden hover:border-emerald-500/50 transition-all">
                                <template x-if="preview">
                                    <div class="w-full h-full flex items-center justify-center {{ $field === 'site_logo_dark' || $field === 'dashboard_logo' ? 'bg-gray-900' : '' }}">
                                        <img :src="preview" class="max-w-full max-h-full object-contain p-4 group-hover:scale-105 transition-transform">
                                    </div>
                                </template>
                                <template x-if="!preview">
                                    <div class="flex flex-col items-center gap-2">
                                        <div class="w-12 h-12 rounded-2xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-300">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                        </div>
                                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Select Image</span>
                                    </div>
                                </template>
                                
                                <div class="absolute inset-0 bg-emerald-600/0 group-hover:bg-emerald-600/5 flex items-center justify-center transition-all">
                                    <div class="px-5 py-2.5 bg-white/90 dark:bg-gray-800/90 rounded-xl text-[10px] font-black uppercase tracking-widest opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 transition-all shadow-2xl border border-gray-100 dark:border-gray-700">
                                        Open Media Library
                                    </div>
                                </div>
                                <button type="button" x-show="preview" @click.stop="preview = ''; path = ''; $refs.input.value = ''" 
                                        class="absolute top-2 right-2 p-1.5 bg-red-500 text-white rounded-lg shadow-sm hover:bg-red-600 transition-colors z-20" title="Remove Image">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="{{ $field }}" x-ref="input" value="{{ $settings[$field] ?? '' }}">
                        <p class="mt-2 text-[10px] text-gray-400 font-bold uppercase tracking-widest flex items-center gap-1.5">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Recommended: PNG or SVG
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Basic Info -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Basic Information</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Site Name</label>
                        <input type="text" name="site_name" value="{{ $settings['site_name'] ?? 'ACEF' }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Site Tagline</label>
                        <input type="text" name="site_tagline" value="{{ $settings['site_tagline'] ?? '' }}" placeholder="Empowering communities through sustainable development" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Site Description</label>
                        <textarea name="site_description" rows="3" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">{{ $settings['site_description'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Contact Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                        <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone</label>
                        <input type="text" name="contact_phone" value="{{ $settings['contact_phone'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Address</label>
                        <textarea name="contact_address" rows="2" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">{{ $settings['contact_address'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Social Links -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Social Media</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Facebook</label>
                        <input type="url" name="social_facebook" value="{{ $settings['social_facebook'] ?? '' }}" placeholder="https://facebook.com/..." class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Twitter / X</label>
                        <input type="url" name="social_twitter" value="{{ $settings['social_twitter'] ?? '' }}" placeholder="https://twitter.com/..." class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Instagram</label>
                        <input type="url" name="social_instagram" value="{{ $settings['social_instagram'] ?? '' }}" placeholder="https://instagram.com/..." class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">LinkedIn</label>
                        <input type="url" name="social_linkedin" value="{{ $settings['social_linkedin'] ?? '' }}" placeholder="https://linkedin.com/..." class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">YouTube</label>
                        <input type="url" name="social_youtube" value="{{ $settings['social_youtube'] ?? '' }}" placeholder="https://youtube.com/..." class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>
                </div>
            </div>

            <!-- Legal & Compliance -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 overflow-hidden">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center text-blue-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 dark:text-white uppercase tracking-wider text-sm">Legal & Compliance</h3>
                        <p class="text-xs text-gray-500">Manage public documents and reports</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach([
                        'annual_report' => 'Latest Annual Report (PDF)',
                        'methodology_doc' => 'Implementation Methodology (PDF)'
                    ] as $field => $label)
                    <div x-data="{ 
                        preview: '{{ isset($settings[$field]) ? Storage::url($settings[$field]) : '' }}',
                        path: '{{ $settings[$field] ?? '' }}',
                        selectFile() {
                            window.openMediaPicker((item) => {
                                this.preview = item.url;
                                this.path = item.url;
                                $refs.input.value = item.url;
                            });
                        }
                    }">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">{{ $label }}</label>
                        <div @click="selectFile()" class="relative group cursor-pointer">
                            <div class="h-24 bg-gray-50 dark:bg-gray-900 rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-700 flex items-center justify-center overflow-hidden hover:border-blue-500/50 transition-all">
                                <template x-if="path">
                                    <div class="flex items-center gap-3 px-4">
                                        <div class="w-10 h-10 rounded-lg bg-red-50 dark:bg-red-900/30 flex items-center justify-center text-red-600">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9v-2h2v2zm0-4H9V7h2v5z"/></svg>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-[10px] font-black text-gray-900 dark:text-white truncate max-w-[150px]">Document Selected</span>
                                            <span class="text-[9px] text-gray-400 font-bold uppercase tracking-tight">Click to change</span>
                                        </div>
                                    </div>
                                </template>
                                <template x-if="!path">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-300">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                        </div>
                                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Select PDF</span>
                                    </div>
                                </template>
                                <button type="button" x-show="path" @click.stop="preview = ''; path = ''; $refs.input.value = ''" 
                                        class="absolute top-2 right-2 p-1.5 bg-red-500 text-white rounded-lg shadow-sm hover:bg-red-600 transition-colors z-20" title="Remove Document">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="{{ $field }}" x-ref="input" value="{{ $settings[$field] ?? '' }}">
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-colors">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</x-app-dashboard-layout>
