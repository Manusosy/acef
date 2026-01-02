@props(['name', 'value' => '', 'placeholder' => '', 'id' => null])

<div x-data="setupEditor(`{!! addslashes($value) !!}`, { placeholder: '{{ $placeholder }}' })"
     class="border border-gray-200 rounded-xl overflow-hidden bg-white w-full"
     wire:ignore>
    
    <!-- Toolbar -->
    <div class="flex flex-wrap items-center gap-1 p-2 border-b border-gray-200 bg-gray-50 text-gray-600">
        <!-- History -->
        <div class="flex items-center gap-1 border-r border-gray-300 pr-2 mr-2">
            <button type="button" @click="undo()" :disabled="!canUndo" 
                    :class="{ 'opacity-50 cursor-not-allowed': !canUndo }"
                    class="p-1.5 rounded hover:bg-gray-200 transition-colors" title="Undo">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>
            </button>
            <button type="button" @click="redo()" :disabled="!canRedo"
                    :class="{ 'opacity-50 cursor-not-allowed': !canRedo }"
                    class="p-1.5 rounded hover:bg-gray-200 transition-colors" title="Redo">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 10h-10a8 8 0 00-8 8v2M21 10l-6 6m6-6l-6-6"/></svg>
            </button>
        </div>

        <!-- Formatting -->
        <div class="flex items-center gap-1 border-r border-gray-300 pr-2 mr-2 font-serif font-bold">
            <button type="button" @click="toggleBold()" :class="{ 'bg-gray-200 text-gray-900': isActive('bold') }"
                    class="p-1.5 rounded hover:bg-gray-200 transition-colors w-8 text-center" title="Bold">B</button>
            <button type="button" @click="toggleItalic()" :class="{ 'bg-gray-200 text-gray-900': isActive('italic') }"
                    class="p-1.5 rounded hover:bg-gray-200 transition-colors italic w-8 text-center" title="Italic">I</button>
            <button type="button" @click="toggleUnderline()" :class="{ 'bg-gray-200 text-gray-900': isActive('underline') }"
                    class="p-1.5 rounded hover:bg-gray-200 transition-colors underline w-8 text-center" title="Underline">U</button>
        </div>

        <!-- Headings -->
        <div class="flex items-center gap-1 border-r border-gray-300 pr-2 mr-2 text-xs font-bold">
            <button type="button" @click="toggleHeading(1)" :class="{ 'bg-gray-200 text-gray-900': isActive('heading', { level: 1 }) }"
                    class="p-1.5 rounded hover:bg-gray-200 transition-colors" title="H1">H1</button>
            <button type="button" @click="toggleHeading(2)" :class="{ 'bg-gray-200 text-gray-900': isActive('heading', { level: 2 }) }"
                    class="p-1.5 rounded hover:bg-gray-200 transition-colors" title="H2">H2</button>
        </div>

        <!-- Lists -->
        <div class="flex items-center gap-1 border-r border-gray-300 pr-2 mr-2">
            <button type="button" @click="toggleBulletList()" :class="{ 'bg-gray-200 text-gray-900': isActive('bulletList') }"
                    class="p-1.5 rounded hover:bg-gray-200 transition-colors" title="Bullet List">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16M4 6h.01M4 12h.01M4 18h.01"/></svg>
            </button>
            <button type="button" @click="toggleOrderedList()" :class="{ 'bg-gray-200 text-gray-900': isActive('orderedList') }"
                    class="p-1.5 rounded hover:bg-gray-200 transition-colors" title="Ordered List">
                 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h12M7 12h12M7 17h12M3 7h.01M3 12h.01M3 17h.01"/></svg>
            </button>
        </div>

        <!-- Media -->
        <div class="flex items-center gap-1">
            <button type="button" @click="setLink()" :class="{ 'bg-gray-200 text-gray-900': isActive('link') }"
                    class="p-1.5 rounded hover:bg-gray-200 transition-colors" title="Link">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
            </button>
            <button type="button" @click="addImage()" :class="{ 'bg-gray-200 text-gray-900': isActive('image') }"
                    class="p-1.5 rounded hover:bg-gray-200 transition-colors" title="Image">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </button>
        </div>
    </div>

    <!-- Edit Area -->
    <div x-ref="editorElement" class="min-h-[250px] outline-none text-gray-800 prose prose-sm max-w-none p-4"></div>

    <!-- Hidden Input -->
    <input type="hidden" name="{{ $name }}" value="{{ $value }}" x-ref="input">
</div>
