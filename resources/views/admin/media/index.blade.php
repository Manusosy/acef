<x-app-dashboard-layout>
    <div x-data="{ 
        selectedItem: null,
        view: 'grid',
        folders: @js($folders),
        activeFolder: null,
        showFolderModal: false,
        newFolderName: '',
        
        async init() {
            // Initial load if needed
        },

        async selectItem(item) {
            this.selectedItem = item;
        },

        async deleteItem() {
            if(!this.selectedItem || !confirm('Delete this file permanently?')) return;
            
            const response = await fetch(`/admin/media/${this.selectedItem.id}`, {
                method: 'DELETE',
                headers: { 
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            const data = await response.json();
            if(data.success) {
                this.selectedItem = null;
                location.reload(); // Simple refresh for now to update grid
            }
        },

        async createFolder() {
            if(!this.newFolderName) return;
            const response = await fetch('{{ route('admin.media.folders.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ name: this.newFolderName })
            });
            const data = await response.json();
            if(data.success) {
                this.folders.push(data.folder);
                this.newFolderName = '';
                this.showFolderModal = false;
            } else {
                alert(data.message);
            }
        },

        async deleteFolder(folderId) {
            if(!confirm('Delete folder? Files will be moved to Library.')) return;
            const response = await fetch(`/admin/media/folders/${folderId}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            const data = await response.json();
            if(data.success) {
                this.folders = this.folders.filter(f => f.id !== folderId);
                if(this.activeFolder === folderId) {
                    this.filterByFolder(null);
                }
            }
        },

        filterByFolder(id) {
            this.activeFolder = id;
            const url = new URL(window.location.href);
            if(id) url.searchParams.set('folder_id', id);
            else url.searchParams.delete('folder_id');
            window.location.href = url.toString();
        },

        async updateItem() {
            if(!this.selectedItem) return;
            const response = await fetch(`/admin/media/${this.selectedItem.id}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    alt_text: this.selectedItem.alt_text,
                    caption: this.selectedItem.caption
                })
            });
            const data = await response.json();
            // Optional: Show toast
        },

        copyUrl() {
            if(!this.selectedItem) return;
            navigator.clipboard.writeText(this.selectedItem.url);
            alert('URL copied to clipboard!');
        }
    }" class="h-full flex flex-col -m-8">
        
        <div class="flex flex-1 overflow-hidden">
            <!-- Left Navigation (Folders) -->
            <div class="w-64 bg-white dark:bg-gray-800 border-r border-gray-100 dark:border-gray-700 flex flex-col">
                <div class="p-6 border-b border-gray-50 dark:border-gray-700 flex items-center justify-between">
                    <h2 class="text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest">Gallery Folders</h2>
                    <button @click="showFolderModal = true" class="p-1.5 hover:bg-emerald-50 text-emerald-600 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </button>
                </div>
                
                <div class="flex-1 overflow-y-auto p-4 space-y-1">
                    <button @click="filterByFolder(null)" 
                       :class="activeFolder === null ? 'bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-acef-green' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white'"
                       class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-sm font-bold transition-all group">
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4" :class="activeFolder === null ? 'text-emerald-500' : 'text-gray-400 group-hover:text-gray-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/></svg>
                            <span>All Media</span>
                        </div>
                    </button>

                    <template x-for="folder in folders" :key="folder.id">
                        <div class="group relative">
                            <button @click="filterByFolder(folder.id)" 
                               :class="activeFolder === folder.id ? 'bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-acef-green' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white'"
                               class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-sm font-bold transition-all">
                                <div class="flex items-center gap-3">
                                    <svg class="w-4 h-4" :class="activeFolder === folder.id ? 'text-emerald-500' : 'text-gray-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                                    <span x-text="folder.name"></span>
                                </div>
                            </button>
                            <button @click.stop="deleteFolder(folder.id)" class="absolute right-2 top-1/2 -translate-y-1/2 p-1 text-gray-300 hover:text-red-500 opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col bg-white dark:bg-gray-900">
                <!-- Toolbar -->
                <div class="px-8 py-5 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-3">
                            @csrf
                            @if(request('folder_id'))
                                <input type="hidden" name="folder_id" value="{{ request('folder_id') }}">
                            @endif
                            <input type="file" name="file" id="mediaUpload" class="hidden" onchange="this.form.submit()">
                            <button type="button" onclick="document.getElementById('mediaUpload').click()" 
                                    class="px-5 py-2.5 bg-emerald-500 text-white font-black rounded-xl hover:bg-emerald-600 transition-all shadow-lg shadow-emerald-200 text-sm flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                                Add New
                            </button>
                        </form>
                        
                        <div class="h-6 w-px bg-gray-100 mx-2"></div>

                        <select class="bg-transparent border-none text-xs font-black text-gray-500 focus:ring-0 cursor-pointer uppercase tracking-widest">
                            <option>All Dates</option>
                            <option>December 2025</option>
                            <option>November 2025</option>
                        </select>

                        <select class="bg-transparent border-none text-xs font-black text-gray-500 focus:ring-0 cursor-pointer uppercase tracking-widest">
                            <option>All File Types</option>
                            <option>Images</option>
                            <option>Videos</option>
                            <option>Documents</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="relative group">
                            <input type="text" placeholder="Search files..." class="pl-9 pr-4 py-2 bg-gray-50 dark:bg-gray-800 border-none rounded-xl text-xs w-64 focus:ring-2 focus:ring-emerald-500/20 transition-all dark:text-white dark:placeholder-gray-500">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-300 group-hover:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <div class="flex bg-gray-50 p-1 rounded-xl">
                            <button @click="view = 'grid'" :class="view === 'grid' ? 'bg-white dark:bg-gray-700 text-emerald-600 shadow-sm' : 'text-gray-400 dark:text-gray-500'" class="p-1.5 rounded-lg transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                            </button>
                            <button @click="view = 'list'" :class="view === 'list' ? 'bg-white dark:bg-gray-700 text-emerald-600 shadow-sm' : 'text-gray-400 dark:text-gray-500'" class="p-1.5 rounded-lg transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Media Grid -->
                <div class="flex-1 overflow-y-auto p-10">
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8 gap-6">
                        @foreach($media as $item)
                        <div @click="selectItem(@js($item))" 
                             :class="selectedItem?.id === {{ $item->id }} ? 'ring-4 ring-emerald-500 ring-offset-4 scale-95 shadow-2xl' : 'hover:scale-105 hover:shadow-xl'"
                             class="aspect-square bg-gray-50 dark:bg-gray-800 rounded-2xl overflow-hidden cursor-pointer relative group transition-all duration-300 border border-gray-100 dark:border-gray-700 flex items-center justify-center">
                            
                            @if($item->isImage())
                                <img src="{{ $item->url }}" class="w-full h-full object-cover">
                            @elseif($item->isPdf())
                                <div class="flex flex-col items-center gap-2">
                                    <div class="w-12 h-12 bg-red-50 text-red-500 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9v-2h2v2zm0-4h-2V7h2v5zm4 4h-2v-5h2v5z"/></svg>
                                    </div>
                                    <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest px-2 text-center truncate w-full">{{ $item->original_filename }}</span>
                                </div>
                            @else
                                <div class="flex flex-col items-center gap-2">
                                    <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>
                                    </div>
                                    <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest px-2 text-center truncate w-full">{{ $item->original_filename }}</span>
                                </div>
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div x-show="selectedItem?.id === {{ $item->id }}" class="absolute top-2 right-2 bg-emerald-500 text-white rounded-full p-1 shadow-lg z-10">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"/></svg>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Detail Sidebar (WordPress Style) -->
            <div x-show="selectedItem" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                 class="w-96 bg-gray-50 dark:bg-gray-800 border-l border-gray-100 dark:border-gray-700 flex flex-col shadow-2xl z-20">
                <div class="p-8 pb-4 border-b border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest">Attachment Details</h3>
                        <button @click="selectedItem = null" class="text-gray-300 dark:text-gray-600 hover:text-gray-900 dark:hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <div class="aspect-video bg-white dark:bg-gray-900 rounded-2xl overflow-hidden shadow-inner border border-gray-100 dark:border-gray-700 mb-6 flex items-center justify-center">
                        <template x-if="selectedItem?.mime_type.startsWith('image/')">
                            <img :src="selectedItem.url" class="w-full h-full object-contain">
                        </template>
                        <template x-if="selectedItem?.mime_type === 'application/pdf'">
                            <svg class="w-16 h-16 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9v-2h2v2zm0-4h-2V7h2v5zm4 4h-2v-5h2v5z"/></svg>
                        </template>
                    </div>

                    <div class="space-y-1">
                        <h4 class="text-sm font-black text-gray-900 dark:text-white truncate" x-text="selectedItem?.original_filename"></h4>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest" x-text="selectedItem?.created_at_formatted"></p>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest" x-text="selectedItem?.size_formatted"></p>
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto p-8 space-y-8">
                    <div class="space-y-4">
                        <div class="bg-white dark:bg-gray-900 p-5 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">File URL</label>
                            <div class="flex items-center gap-2">
                                <input type="text" :value="selectedItem?.url" readonly class="flex-1 bg-gray-50 dark:bg-gray-800 border-none rounded-lg text-xs font-medium font-mono text-gray-500 dark:text-gray-400 focus:ring-0">
                                <button @click="copyUrl" class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m-7 4h7m-7 4h7M13 17h7"/></svg>
                                </button>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Alternative Text</label>
                                <input type="text" x-model="selectedItem.alt_text" 
                                       @blur="updateItem"
                                       class="w-full bg-white dark:bg-gray-900 border-gray-100 dark:border-gray-700 rounded-xl text-xs font-semibold focus:ring-emerald-500 focus:border-emerald-500 dark:text-white">
                                <p class="mt-1 text-[9px] text-gray-400 font-medium">Describe the purpose of the image. Leave empty if purely decorative.</p>
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Caption</label>
                                <textarea x-model="selectedItem.caption" 
                                          @blur="updateItem"
                                          rows="3" class="w-full bg-white dark:bg-gray-900 border-gray-100 dark:border-gray-700 rounded-xl text-xs font-semibold focus:ring-emerald-500 focus:border-emerald-500 dark:text-white"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100">
                        <button @click="deleteItem" class="w-full py-4 text-xs font-black text-red-500 uppercase tracking-widest hover:bg-red-50 rounded-2xl transition-all border border-dashed border-red-200">
                            Delete Permanently
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Folder Modal -->
        <div x-show="showFolderModal" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4">
            <div @click="showFolderModal = false" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
            <div class="bg-white dark:bg-gray-800 rounded-3xl w-full max-w-md p-8 shadow-2xl relative">
                <h3 class="text-xl font-black text-gray-900 dark:text-white mb-2">New Folder</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Create a folder to organize your media assets.</p>
                <input type="text" x-model="newFolderName" placeholder="Folder name..." 
                       class="w-full px-5 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl text-sm font-bold focus:ring-2 focus:ring-emerald-500/20 mb-6 dark:text-white dark:placeholder-gray-500">
                <div class="flex gap-4">
                    <button @click="showFolderModal = false" class="flex-1 py-4 text-sm font-black text-gray-400 uppercase tracking-widest hover:text-gray-900 transition-colors">Cancel</button>
                    <button @click="createFolder" class="flex-1 py-4 bg-emerald-500 text-white text-sm font-black uppercase tracking-widest rounded-2xl shadow-lg shadow-emerald-200 hover:bg-emerald-600 transition-all">Create</button>
                </div>
            </div>
        </div>
    </div>
</x-app-dashboard-layout>
