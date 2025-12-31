<x-admin-layout>
    <x-slot name="header">Media Library</x-slot>
    <x-slot name="title">Media Library</x-slot>

    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Media Library</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Manage all uploaded images</p>
            </div>
            <button onclick="document.getElementById('uploadModal').classList.remove('hidden')" 
                    class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                </svg>
                Upload Image
            </button>
        </div>
    </div>

    <!-- Search -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 mb-6">
        <form method="GET" class="flex gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search images..." 
                   class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
            <button type="submit" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600">Search</button>
        </form>
    </div>

    <!-- Media Grid -->
    <div id="mediaGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
        @forelse($media as $item)
            <div class="group relative bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-all cursor-pointer"
                 onclick="showMediaDetails({{ $item->id }})">
                <div class="aspect-square bg-gray-100 dark:bg-gray-700">
                    <img src="{{ $item->url }}" alt="{{ $item->alt_text }}" class="w-full h-full object-cover">
                </div>
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all flex items-center justify-center opacity-0 group-hover:opacity-100">
                    <div class="flex gap-2">
                        <button onclick="event.stopPropagation(); showMediaDetails({{ $item->id }})" class="p-2 bg-white rounded-lg text-gray-700 hover:bg-gray-100">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </button>
                        <button onclick="event.stopPropagation(); deleteMedia({{ $item->id }})" class="p-2 bg-white rounded-lg text-red-600 hover:bg-red-50">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </div>
                <div class="p-2">
                    <p class="text-xs text-gray-600 dark:text-gray-400 truncate">{{ $item->original_filename }}</p>
                    <p class="text-xs text-gray-400 dark:text-gray-500">{{ $item->size_formatted }}</p>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-gray-500 dark:text-gray-400">No images uploaded yet</p>
                <button onclick="document.getElementById('uploadModal').classList.remove('hidden')" class="mt-2 text-emerald-600 hover:underline">Upload your first image</button>
            </div>
        @endforelse
    </div>

    @if($media->hasPages())
        <div class="mt-6">{{ $media->links() }}</div>
    @endif

    <!-- Upload Modal -->
    <div id="uploadModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl w-full max-w-lg shadow-xl">
            <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Upload Image</h3>
                <button onclick="document.getElementById('uploadModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form id="uploadForm" class="p-6">
                <div id="dropZone" class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-8 text-center hover:border-emerald-500 transition-colors cursor-pointer">
                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                    <p class="text-gray-600 dark:text-gray-400 mb-2">Drag & drop an image here, or click to select</p>
                    <p class="text-xs text-gray-400">Max 10MB. JPEG, PNG, GIF, WebP</p>
                    <input type="file" id="fileInput" name="file" accept="image/*" class="hidden">
                </div>
                <div id="previewContainer" class="hidden mt-4">
                    <img id="previewImage" class="w-full rounded-lg">
                    <input type="text" name="alt_text" placeholder="Alt text (optional)" class="mt-4 w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                </div>
                <div id="uploadProgress" class="hidden mt-4">
                    <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div id="progressBar" class="h-full bg-emerald-500 transition-all" style="width: 0%"></div>
                    </div>
                </div>
                <div id="uploadError" class="hidden mt-4 p-3 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-lg text-red-600 dark:text-red-400 text-sm"></div>
            </form>
            <div class="flex justify-end gap-3 p-6 border-t border-gray-200 dark:border-gray-700">
                <button onclick="document.getElementById('uploadModal').classList.add('hidden')" class="px-4 py-2 text-gray-600 dark:text-gray-400">Cancel</button>
                <button onclick="uploadFile()" id="uploadBtn" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg disabled:opacity-50" disabled>Upload</button>
            </div>
        </div>
    </div>

    <!-- Details Modal -->
    <div id="detailsModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl w-full max-w-2xl shadow-xl">
            <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Image Details</h3>
                <button onclick="document.getElementById('detailsModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="p-6 grid grid-cols-2 gap-6">
                <div><img id="detailImage" class="w-full rounded-lg"></div>
                <div id="detailInfo" class="space-y-4"></div>
            </div>
        </div>
    </div>

    <script>
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('fileInput');
        let selectedFile = null;

        dropZone.onclick = () => fileInput.click();
        dropZone.ondragover = (e) => { e.preventDefault(); dropZone.classList.add('border-emerald-500'); };
        dropZone.ondragleave = () => dropZone.classList.remove('border-emerald-500');
        dropZone.ondrop = (e) => { e.preventDefault(); handleFile(e.dataTransfer.files[0]); };
        fileInput.onchange = (e) => handleFile(e.target.files[0]);

        function handleFile(file) {
            if (!file || !file.type.startsWith('image/')) return;
            selectedFile = file;
            const reader = new FileReader();
            reader.onload = (e) => {
                document.getElementById('previewImage').src = e.target.result;
                document.getElementById('previewContainer').classList.remove('hidden');
                document.getElementById('uploadBtn').disabled = false;
            };
            reader.readAsDataURL(file);
        }

        async function uploadFile() {
            if (!selectedFile) return;
            const formData = new FormData();
            formData.append('file', selectedFile);
            formData.append('alt_text', document.querySelector('[name="alt_text"]').value);
            formData.append('_token', '{{ csrf_token() }}');

            document.getElementById('uploadProgress').classList.remove('hidden');
            document.getElementById('uploadError').classList.add('hidden');

            try {
                const response = await fetch('{{ route("admin.media.store") }}', { method: 'POST', body: formData });
                const data = await response.json();
                if (data.success) {
                    location.reload();
                } else {
                    document.getElementById('uploadError').textContent = data.message;
                    document.getElementById('uploadError').classList.remove('hidden');
                }
            } catch (error) {
                document.getElementById('uploadError').textContent = 'Upload failed.';
                document.getElementById('uploadError').classList.remove('hidden');
            }
        }

        async function showMediaDetails(id) {
            const response = await fetch(`/admin/media/${id}`);
            const data = await response.json();
            document.getElementById('detailImage').src = data.media.url;
            document.getElementById('detailInfo').innerHTML = `
                <div><label class="text-sm text-gray-500">Filename</label><p class="text-gray-900 dark:text-white">${data.media.original_filename}</p></div>
                <div><label class="text-sm text-gray-500">Size</label><p class="text-gray-900 dark:text-white">${data.media.size_formatted}</p></div>
                <div><label class="text-sm text-gray-500">Uploaded</label><p class="text-gray-900 dark:text-white">${new Date(data.media.created_at).toLocaleDateString()}</p></div>
                <div><label class="text-sm text-gray-500">Usage</label><p class="text-gray-900 dark:text-white">${data.usage_count} place(s)</p></div>
            `;
            document.getElementById('detailsModal').classList.remove('hidden');
        }

        async function deleteMedia(id) {
            if (!confirm('Delete this image?')) return;
            const response = await fetch(`/admin/media/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }});
            const data = await response.json();
            if (data.success) location.reload();
            else alert(data.message);
        }
    </script>
</x-admin-layout>
