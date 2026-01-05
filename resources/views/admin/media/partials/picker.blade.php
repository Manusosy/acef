<div x-data="{ 
    open: false,
    tab: 'library',
    items: [],
    folders: [],
    activeFolder: null,
    loading: false,
    selectedItems: [],
    multiple: false,
    search: '',
    callback: null,
    
    init() {
        window.openMediaPicker = (cb, options = {}) => {
            this.callback = cb;
            this.multiple = options.multiple || false;
            this.selectedItems = []; // Reset selection
            this.open = true;
            this.fetchItems();
        };
    },
    
    async fetchItems() {
        this.loading = true;
        try {
            let url = `/admin/media?ajax=1&search=${this.search}`;
            if(this.activeFolder) url += `&folder_id=${this.activeFolder}`;
            
            const response = await fetch(url, {
                headers: { 'Accept': 'application/json' }
            });
            const data = await response.json();
            this.items = data.items || [];
            this.folders = data.folders || [];
        } catch (e) {
            console.error('Failed to fetch media', e);
        }
        this.loading = false;
    },
    
    filterByFolder(id) {
        this.activeFolder = id;
        this.fetchItems();
    },

    selectItem(item) {
        if (this.multiple) {
            const index = this.selectedItems.findIndex(i => i.id === item.id);
            if (index > -1) {
                this.selectedItems.splice(index, 1);
            } else {
                this.selectedItems.push(item);
            }
        } else {
            this.selectedItems = [item];
        }
    },
    
    async updateMedia() {
        // Only update the first selected item to avoid complexity in multi-edit
        const item = this.selectedItems[0];
        if (!item) return;
        
        try {
            await fetch(`/admin/media/${item.id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    alt_text: item.alt_text,
                    caption: item.caption
                })
            });
        } catch (e) {
            console.error('Failed to update media', e);
        }
    },

    confirm() {
        if (this.selectedItems.length > 0 && this.callback) {
            if (this.multiple) {
                this.callback(this.selectedItems);
            } else {
                this.callback(this.selectedItems[0]); // Return single object for backward compatibility
            }
            this.close();
        }
    },
    
    close() {
        this.open = false;
        this.selectedItems = [];
    },
    
    async deleteItem() {
        const item = this.selectedItems[0];
        if (!item) return;
        if (!confirm('Are you sure you want to delete this image?')) return;
        
        try {
            const response = await fetch(`/admin/media/${item.id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            const data = await response.json();
            if (data.success) {
                this.selectedItems = [];
                this.fetchItems();
            } else {
                alert(data.message);
            }
        } catch (e) {
            console.error('Failed to delete media', e);
        }
    }
}" x-show="open" x-cloak 
    @keydown.escape.window="close()"
    class="fixed inset-0 z-[100] flex items-center justify-center p-4">
    <!-- Backdrop split -->
    <div @click="close()" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
    
    <!-- Modal -->
    <div class="bg-white dark:bg-gray-900 rounded-2xl w-full max-w-5xl h-[85vh] shadow-2xl relative overflow-hidden flex flex-col border border-gray-100 dark:border-gray-800 transition-colors">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between bg-white/95 dark:bg-gray-900/95 backdrop-blur-md sticky top-0 z-30 transition-colors">
            <div class="flex items-center gap-6">
                <h3 class="text-lg font-black text-gray-900 dark:text-white tracking-tight">Media Browser</h3>
                <nav class="flex gap-1 bg-gray-100 dark:bg-gray-800 p-1 rounded-xl transition-colors">
                    <button @click="tab = 'upload'" :class="tab === 'upload' ? 'bg-white dark:bg-gray-700 text-acef-dark dark:text-white shadow-sm' : 'text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200'" class="px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-widest transition-all">
                        Upload
                    </button>
                    <button @click="tab = 'library'" :class="tab === 'library' ? 'bg-white dark:bg-gray-700 text-acef-dark dark:text-white shadow-sm' : 'text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200'" class="px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-widest transition-all">
                        Library
                    </button>
                </nav>
            </div>
            <button @click="close()" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-all group">
                <svg class="w-6 h-6 text-gray-400 dark:text-gray-500 group-hover:text-gray-900 dark:group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        
        <div class="flex-1 flex overflow-hidden bg-gray-50 dark:bg-gray-950 transition-colors">
            <!-- Sidebar Navigation (Folders) -->
            <div x-show="tab === 'library'" class="hidden md:flex flex-none w-64 bg-white dark:bg-gray-900 border-r border-gray-100 dark:border-gray-800 flex-col p-6 space-y-6 transition-colors overflow-y-auto">
                <div>
                    <h4 class="text-[10px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-4">Folders</h4>
                    <div class="space-y-1">
                        <button @click="filterByFolder(null)" 
                                :class="activeFolder === null ? 'bg-emerald-50 text-emerald-600 dark:bg-emerald-900/20 dark:text-emerald-400 shadow-sm' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800'"
                                class="w-full text-left px-4 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all flex items-center gap-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/></svg>
                            All Files
                        </button>
                        <template x-for="folder in folders" :key="folder.id">
                            <button @click="filterByFolder(folder.id)" 
                                    :class="activeFolder === folder.id ? 'bg-emerald-50 text-emerald-600 dark:bg-emerald-900/20 dark:text-emerald-400 shadow-sm' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800'"
                                    class="w-full text-left px-4 py-2.5 rounded-xl text-xs font-black transition-all flex items-center gap-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                                <span x-text="folder.name" class="truncate"></span>
                            </button>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="flex-1 overflow-y-auto p-6 md:p-10">
                <!-- Upload Tab -->
                <div x-show="tab === 'upload'" class="h-full flex flex-col items-center justify-center border-4 border-dashed border-gray-200 dark:border-gray-800 rounded-3xl p-12 text-center bg-white dark:bg-gray-900 transition-all hover:border-emerald-500/30">
                    <div class="w-24 h-24 bg-emerald-50 dark:bg-emerald-900/20 rounded-2xl flex items-center justify-center text-emerald-500 mb-6 shadow-sm">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                    </div>
                    <h4 class="text-2xl font-black text-gray-900 dark:text-white mb-2 tracking-tight">Upload new assets</h4>
                    <p class="text-gray-500 dark:text-gray-400 mb-8 max-w-xs font-medium">Drag and drop files here or click to browse from your computer.</p>
                    
                    <input type="file" id="mediaPickerUpload" class="hidden" @change="
                        let file = $event.target.files[0];
                        if (file) {
                            let formData = new FormData();
                            formData.append('file', file);
                            formData.append('_token', '{{ csrf_token() }}');
                            if(activeFolder) formData.append('folder_id', activeFolder);
                            
                            fetch('{{ route('admin.media.store') }}', {
                                method: 'POST',
                                body: formData,
                                headers: { 'Accept': 'application/json' }
                            })
                            .then(r => r.json())
                            .then(data => {
                                if (data.success) {
                                    tab = 'library';
                                    fetchItems().then(() => {
                                        let uploaded = items.find(i => i.id === data.media.id);
                                        if(uploaded) selectItem(uploaded);
                                    });
                                } else {
                                    alert(data.message);
                                }
                            });
                        }
                    ">
                    <button @click="document.getElementById('mediaPickerUpload').click()" class="px-10 py-4 bg-emerald-500 text-white font-black rounded-2xl hover:bg-emerald-600 transition-all shadow-xl shadow-emerald-200 uppercase tracking-widest text-sm">
                        Select Files
                    </button>
                </div>

                <!-- Library Tab -->
                <div x-show="tab === 'library'" class="space-y-8">
                    <div class="flex items-center justify-between sticky top-0 py-2 z-10 w-full">
                        <div class="relative w-full md:max-w-md">
                            <input type="text" x-model="search" @input.debounce.500ms="fetchItems()" placeholder="Search library..." 
                                   class="w-full pl-12 pr-6 py-3.5 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl text-sm font-semibold text-gray-900 dark:text-white placeholder-gray-400 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 shadow-sm transition-all">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                    </div>
                    
                    <div x-show="loading" class="flex items-center justify-center py-24">
                        <div class="animate-spin rounded-full h-12 w-12 border-4 border-emerald-500 border-t-transparent shadow-emerald-100"></div>
                    </div>

                    <div x-show="!loading && items.length > 0" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 pb-20">
                        <template x-for="item in items" :key="item.id">
                            <div @click="selectItem(item)" 
                                 :class="selectedItems.some(i => i.id === item.id) ? 'ring-4 ring-emerald-500 ring-offset-4 ring-offset-gray-50 dark:ring-offset-gray-950 scale-95 shadow-2xl z-10' : 'hover:scale-105 hover:shadow-lg'"
                                 class="aspect-square bg-white dark:bg-gray-900 rounded-xl overflow-hidden cursor-pointer relative group transition-all duration-300 border border-gray-200 dark:border-gray-800 flex items-center justify-center p-1 shadow-sm">
                                <template x-if="item.mime_type.startsWith('image/')">
                                    <img :src="item.url" class="w-full h-full object-cover rounded-lg">
                                </template>
                                <template x-if="item.mime_type === 'application/pdf'">
                                    <div class="flex flex-col items-center gap-2">
                                        <div class="w-12 h-12 bg-red-50 dark:bg-red-900/20 text-red-500 rounded-xl flex items-center justify-center">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9v-2h2v2zm0-4h-2V7h2v5zm4 4h-2v-5h2v5z"/></svg>
                                        </div>
                                        <span class="text-[8px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest text-center truncate w-24" x-text="item.original_filename"></span>
                                    </div>
                                </template>
                                <template x-if="!item.mime_type.startsWith('image/') && item.mime_type !== 'application/pdf'">
                                    <div class="flex flex-col items-center gap-2">
                                        <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/20 text-blue-500 rounded-xl flex items-center justify-center">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>
                                        </div>
                                        <span class="text-[8px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest text-center truncate w-24" x-text="item.original_filename"></span>
                                    </div>
                                </template>

                                <div x-show="selectedItems.some(i => i.id === item.id)" class="absolute top-2 right-2 bg-emerald-500 text-white rounded-full p-1 shadow-lg z-10 transition-transform">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"/></svg>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div x-show="!loading && items.length === 0" class="flex flex-col items-center justify-center py-20 text-center">
                        <div class="w-20 h-20 bg-gray-50 dark:bg-gray-800 rounded-2xl flex items-center justify-center mb-4 text-gray-400">
                             <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <h4 class="text-sm font-black text-gray-900 dark:text-white mb-1">No items found</h4>
                        <p class="text-xs text-gray-500">Upload some images to get started.</p>
                    </div>
                </div>
            </div>

            <!-- Detail Sidebar (WordPress Style) -->
            <div x-show="selectedItems.length === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                 class="w-80 bg-white dark:bg-gray-900 border-l border-gray-100 dark:border-gray-800 flex flex-col shadow-xl z-20 h-full transition-colors">
                <div class="p-6 border-b border-gray-100 dark:border-gray-800 flex flex-col items-center text-center">
                    <div class="w-full h-40 bg-gray-50 dark:bg-gray-800 rounded-2xl overflow-hidden mb-4 flex items-center justify-center border border-gray-100 dark:border-gray-700 shadow-inner p-2 relative group">
                        <template x-if="selectedItems[0]?.mime_type.startsWith('image/')">
                            <img :src="selectedItems[0]?.url" class="w-full h-full object-contain">
                        </template>
                        <template x-if="selectedItems[0]?.mime_type === 'application/pdf'">
                            <svg class="w-16 h-16 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9v-2h2v2zm0-4h-2V7h2v5zm4 4h-2v-5h2v5z"/></svg>
                        </template>
                        
                        <!-- Delete Button Overlay -->
                        <button @click="deleteItem()" class="absolute top-2 right-2 p-1.5 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow-sm opacity-0 group-hover:opacity-100 transition-all font-bold text-xs" title="Delete permanently">
                             <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                    
                    <h4 class="text-xs font-black text-gray-900 dark:text-white truncate w-full px-2 mb-1" x-text="selectedItems[0]?.original_filename"></h4>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest" x-text="selectedItems[0]?.size_formatted"></p>
                </div>

                <div class="flex-1 overflow-y-auto p-6 space-y-5">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2">Alternative Text</label>
                        <input type="text" x-model="selectedItems[0].alt_text" @input.debounce.500ms="updateMedia()" 
                               class="w-full bg-gray-50 dark:bg-gray-800 border-none rounded-lg text-xs font-semibold text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500/20 py-2.5">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2">Caption</label>
                        <textarea x-model="selectedItems[0].caption" @input.debounce.500ms="updateMedia()" rows="3" 
                                  class="w-full bg-gray-50 dark:bg-gray-800 border-none rounded-lg text-xs font-semibold text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500/20 py-2.5 resize-none"></textarea>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2">File URL</label>
                        <div class="flex gap-2">
                             <input type="text" :value="selectedItems[0]?.url" readonly 
                                    class="w-full bg-gray-50 dark:bg-gray-800 border-none rounded-lg text-[10px] font-mono text-gray-500 dark:text-gray-400 focus:ring-2 focus:ring-emerald-500/20 truncate py-2.5">
                             <button @click="navigator.clipboard.writeText(selectedItems[0]?.url)" class="p-2.5 bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg text-emerald-600 transition-colors">
                                 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                             </button>
                        </div>
                    </div>
                    
                    <button @click="deleteItem()" class="w-full py-3 mt-4 text-red-500 hover:text-red-700 text-xs font-black uppercase tracking-widest flex items-center justify-center gap-2 hover:bg-red-50 dark:hover:bg-red-900/10 rounded-xl transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Delete Permanently
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between bg-white dark:bg-gray-900 z-30 transition-colors">
            <div class="text-[10px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest">
                <span x-show="selectedItems.length > 0" x-text="selectedItems.length + ' item(s) selected'" class="text-emerald-600 dark:text-emerald-400"></span>
            </div>
            <div class="flex gap-4">
                <button @click="close()" class="px-6 py-3 text-xs font-black text-gray-400 hover:text-gray-900 dark:text-gray-500 dark:hover:text-gray-300 uppercase tracking-widest transition-colors">Cancel</button>
                <button @click="confirm()" :disabled="selectedItems.length === 0" class="px-8 py-3 bg-gray-900 dark:bg-white text-white dark:text-gray-900 hover:bg-black dark:hover:bg-gray-200 rounded-xl text-xs font-black uppercase tracking-widest shadow-lg shadow-gray-200 dark:shadow-none disabled:opacity-20 disabled:cursor-not-allowed transition-all">
                    Insert Selected
                </button>
            </div>
        </div>
    </div>
</div>
