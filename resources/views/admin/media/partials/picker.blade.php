<!-- Media Picker Modal - Include in forms that need media selection -->
<div id="mediaPickerModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-2xl w-full max-w-4xl max-h-[80vh] shadow-xl flex flex-col">
        <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Select Image from Media Library</h3>
            <button onclick="closeMediaPicker()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="p-4 flex-1 overflow-y-auto">
            <div id="mediaPickerGrid" class="grid grid-cols-4 sm:grid-cols-6 gap-3">
                <!-- Loaded via JS -->
            </div>
            <div id="mediaPickerLoading" class="text-center py-8 text-gray-500">Loading...</div>
            <div id="mediaPickerEmpty" class="hidden text-center py-8 text-gray-500">
                <p>No images in library.</p>
                <a href="{{ route('admin.media.index') }}" target="_blank" class="text-emerald-600 hover:underline">Upload images first</a>
            </div>
        </div>
        <div class="flex justify-between items-center gap-3 p-4 border-t border-gray-200 dark:border-gray-700">
            <div id="selectedMediaInfo" class="text-sm text-gray-500 dark:text-gray-400"></div>
            <div class="flex gap-3">
                <button onclick="closeMediaPicker()" class="px-4 py-2 text-gray-600 dark:text-gray-400">Cancel</button>
                <button onclick="confirmMediaSelection()" id="confirmMediaBtn" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg disabled:opacity-50" disabled>Select Image</button>
            </div>
        </div>
    </div>
</div>

<script>
let mediaPickerCallback = null;
let selectedMediaId = null;
let selectedMediaUrl = null;

function openMediaPicker(callback) {
    mediaPickerCallback = callback;
    selectedMediaId = null;
    selectedMediaUrl = null;
    document.getElementById('confirmMediaBtn').disabled = true;
    document.getElementById('selectedMediaInfo').textContent = '';
    document.getElementById('mediaPickerModal').classList.remove('hidden');
    loadMediaForPicker();
}

function closeMediaPicker() {
    document.getElementById('mediaPickerModal').classList.add('hidden');
    mediaPickerCallback = null;
}

async function loadMediaForPicker() {
    const grid = document.getElementById('mediaPickerGrid');
    const loading = document.getElementById('mediaPickerLoading');
    const empty = document.getElementById('mediaPickerEmpty');
    
    grid.innerHTML = '';
    loading.classList.remove('hidden');
    empty.classList.add('hidden');

    try {
        const response = await fetch('{{ route("admin.media.index") }}?ajax=1');
        const data = await response.json();
        loading.classList.add('hidden');

        if (!data.html || data.html.trim() === '') {
            empty.classList.remove('hidden');
            return;
        }

        // Parse and render items
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = data.html;
        
        // Re-fetch items
        const itemsResponse = await fetch('{{ route("admin.media.index") }}');
        const itemsPage = await itemsResponse.text();
        const parser = new DOMParser();
        const doc = parser.parseFromString(itemsPage, 'text/html');
        const mediaItems = doc.querySelectorAll('[data-media-id]');

        // Fallback: just load from API
        const apiResponse = await fetch('/admin/media?per_page=100', { headers: { 'Accept': 'application/json' }});
    } catch (error) {
        loading.textContent = 'Failed to load media.';
    }

    // Inline simple approach
    fetch('/admin/media/picker')
        .then(r => r.text())
        .then(html => {
            loading.classList.add('hidden');
            if (html.trim()) {
                grid.innerHTML = html;
            } else {
                empty.classList.remove('hidden');
            }
        });
}

function selectMediaItem(id, url, filename) {
    // Deselect previous
    document.querySelectorAll('.media-picker-item').forEach(el => el.classList.remove('ring-2', 'ring-emerald-500'));
    
    // Select new
    const item = document.querySelector(`[data-picker-id="${id}"]`);
    if (item) item.classList.add('ring-2', 'ring-emerald-500');
    
    selectedMediaId = id;
    selectedMediaUrl = url;
    document.getElementById('selectedMediaInfo').textContent = filename;
    document.getElementById('confirmMediaBtn').disabled = false;
}

function confirmMediaSelection() {
    if (mediaPickerCallback && selectedMediaId) {
        mediaPickerCallback(selectedMediaId, selectedMediaUrl);
    }
    closeMediaPicker();
}
</script>
