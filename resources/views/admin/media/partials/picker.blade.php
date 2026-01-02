<div x-data="{ 
    open: false,
    tab: 'library',
    items: [],
    folders: [],
    activeFolder: null,
    loading: false,
    selectedItem: null,
    search: '',
    callback: null,
    
    init() {
        window.openMediaPicker = (cb) => {
            this.callback = cb;
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
        this.selectedItem = item;
    },
    
    confirm() {
        if (this.selectedItem && this.callback) {
            this.callback(this.selectedItem);
            this.close();
        }
    },
    
    close() {
        this.open = false;
        this.selectedItem = null;
    }
}" x-show="open" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4">
    <!-- Backdrop split -->
    <div @click="close()" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
    
    <!-- Modal -->
    <div class="bg-white rounded-[2rem] w-full max-w-6xl h-[90vh] shadow-2xl relative overflow-hidden flex flex-col border border-white/20">
        <!-- Header -->
        <div class="px-10 py-6 border-b border-gray-100 flex items-center justify-between bg-white/80 backdrop-blur-md sticky top-0 z-30">
            <div class="flex items-center gap-10">
                <h3 class="text-xl font-black text-gray-900 tracking-tight">Media Browser</h3>
                <nav class="flex gap-1 bg-gray-100 p-1.5 rounded-2xl">
                    <button @click="tab = 'upload'" :class="tab === 'upload' ? 'bg-white text-emerald-600 shadow-sm' : 'text-gray-500 hover:text-gray-900'" class="px-6 py-2 rounded-xl text-xs font-black uppercase tracking-widest transition-all">
                        Upload
                    </button>
                    <button @click="tab = 'library'" :class="tab === 'library' ? 'bg-white text-emerald-600 shadow-sm' : 'text-gray-500 hover:text-gray-900'" class="px-6 py-2 rounded-xl text-xs font-black uppercase tracking-widest transition-all">
                        Library
                    </button>
                </nav>
            </div>
            <button @click="close()" class="p-3 hover:bg-gray-100 rounded-2xl transition-all group">
                <svg class="w-6 h-6 text-gray-300 group-hover:text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        
        <div class="flex-1 flex overflow-hidden bg-gray-50/30">
            <!-- Sidebar Navigation (Folders) -->
            <div x-show="tab === 'library'" class="w-64 bg-white border-r border-gray-100 flex flex-col p-6 space-y-6">
                <div>
                    <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4">Folders</h4>
                    <div class="space-y-1">
                        <button @click="filterByFolder(null)" 
                                :class="activeFolder === null ? 'bg-emerald-50 text-emerald-600 shadow-sm' : 'text-gray-500 hover:bg-gray-50'"
                                class="w-full text-left px-4 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all flex items-center gap-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/></svg>
                            All Files
                        </button>
                        <template x-for="folder in folders" :key="folder.id">
                            <button @click="filterByFolder(folder.id)" 
                                    :class="activeFolder === folder.id ? 'bg-emerald-50 text-emerald-600 shadow-sm' : 'text-gray-500 hover:bg-gray-50'"
                                    class="w-full text-left px-4 py-2.5 rounded-xl text-xs font-black transition-all flex items-center gap-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                                <span x-text="folder.name" class="truncate"></span>
                            </button>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="flex-1 overflow-y-auto p-10">
                <!-- Upload Tab -->
                <div x-show="tab === 'upload'" class="h-full flex flex-col items-center justify-center border-4 border-dashed border-gray-100 rounded-[2.5rem] p-12 text-center bg-white transition-all hover:border-emerald-200">
                    <div class="w-24 h-24 bg-emerald-50 rounded-3xl flex items-center justify-center text-emerald-500 mb-6 shadow-sm">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                    </div>
                    <h4 class="text-2xl font-black text-gray-900 mb-2 tracking-tight">Upload new assets</h4>
                    <p class="text-gray-500 mb-8 max-w-xs font-medium">Drag and drop files here or click to browse from your computer.</p>
                    
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
                    <div class="flex items-center justify-between sticky top-0 py-2 z-10">
                        <div class="relative w-80">
                            <input type="text" x-model="search" @input.debounce.500ms="fetchItems()" placeholder="Search library..." 
                                   class="w-full pl-12 pr-6 py-3.5 bg-white border border-gray-100 rounded-2xl text-sm font-semibold focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500/20 shadow-sm transition-all">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                    </div>
                    
                    <div x-show="loading" class="flex items-center justify-center py-24">
                        <div class="animate-spin rounded-full h-12 w-12 border-4 border-emerald-500 border-t-transparent shadow-emerald-100"></div>
                    </div>

                    <div x-show="!loading" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
                        <template x-for="item in items" :key="item.id">
                            <div @click="selectItem(item)" 
                                 :class="selectedItem?.id === item.id ? 'ring-4 ring-emerald-500 ring-offset-4 scale-95 shadow-2xl' : 'hover:scale-105 hover:shadow-lg'"
                                 class="aspect-square bg-white rounded-2xl overflow-hidden cursor-pointer relative group transition-all duration-300 border border-gray-100 flex items-center justify-center p-1 shadow-sm">
                                <template x-if="item.mime_type.startsWith('image/')">
                                    <img :src="item.url" class="w-full h-full object-cover rounded-xl">
                                </template>
                                <template x-if="item.mime_type === 'application/pdf'">
                                    <div class="flex flex-col items-center gap-2">
                                        <div class="w-12 h-12 bg-red-50 text-red-500 rounded-xl flex items-center justify-center">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9v-2h2v2zm0-4h-2V7h2v5zm4 4h-2v-5h2v5z"/></svg>
                                        </div>
                                        <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest text-center truncate w-24" x-text="item.original_filename"></span>
                                    </div>
                                </template>
                                <template x-if="!item.mime_type.startsWith('image/') && item.mime_type !== 'application/pdf'">
                                    <div class="flex flex-col items-center gap-2">
                                        <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>
                                        </div>
                                        <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest text-center truncate w-24" x-text="item.original_filename"></span>
                                    </div>
                                </template>

                                <div x-show="selectedItem?.id === item.id" class="absolute top-2 right-2 bg-emerald-500 text-white rounded-full p-1 shadow-lg z-10 transition-transform">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"/></svg>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Detail Sidebar (WordPress Style) -->
            <div x-show="selectedItem" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                 class="w-80 bg-white border-l border-gray-100 flex flex-col shadow-xl z-20">
                <div class="p-8 pb-4 border-b border-gray-50 flex flex-col items-center text-center">
                    <div class="w-full aspect-square bg-gray-50 rounded-3xl overflow-hidden mb-6 flex items-center justify-center border border-gray-100 shadow-inner">
                        <template x-if="selectedItem?.mime_type.startsWith('image/')">
                            <img :src="selectedItem.url" class="w-full h-full object-contain">
                        </template>
                        <template x-if="selectedItem?.mime_type === 'application/pdf'">
                            <svg class="w-16 h-16 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9v-2h2v2zm0-4h-2V7h2v5zm4 4h-2v-5h2v5z"/></svg>
                        </template>
                    </div>
                    
                    <h4 class="text-sm font-black text-gray-900 truncate w-full px-4 mb-1" x-text="selectedItem?.original_filename"></h4>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-4" x-text="selectedItem?.size_formatted"></p>
                </div>

                <div class="flex-1 overflow-y-auto p-8 space-y-6">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Alternative Text</label>
                        <input type="text" x-model="selectedItem.alt_text" class="w-full bg-gray-50 border-none rounded-xl text-xs font-semibold focus:ring-2 focus:ring-emerald-500/20">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Caption</label>
                        <textarea x-model="selectedItem.caption" rows="3" class="w-full bg-gray-50 border-none rounded-xl text-xs font-semibold focus:ring-2 focus:ring-emerald-500/20"></textarea>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="px-10 py-6 border-t border-gray-100 flex items-center justify-between bg-white z-30">
            <div class="text-xs font-black text-gray-400 uppercase tracking-widest">
                <span x-show="selectedItem" x-text="'Selected: ' + selectedItem?.original_filename" class="text-emerald-600"></span>
            </div>
            <div class="flex gap-4">
                <button @click="close()" class="px-6 py-3 text-xs font-black text-gray-400 uppercase tracking-widest hover:text-gray-900 transition-colors">Cancel</button>
                <button @click="confirm()" :disabled="!selectedItem" class="px-10 py-3 bg-gray-900 text-white hover:bg-black rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-gray-200 disabled:opacity-20 disabled:cursor-not-allowed transition-all">
                    Insert File
                </button>
            </div>
        </div>
    </div>
</div>
