@foreach($media as $item)
    <div data-picker-id="{{ $item->id }}" 
         class="media-picker-item aspect-square bg-white dark:bg-gray-800 rounded-xl overflow-hidden cursor-pointer hover:shadow-md transition-all border border-gray-100 dark:border-gray-700 relative group"
         onclick="selectMediaItem({{ json_encode($item) }})">
        
        @if(str_starts_with($item->mime_type, 'image/'))
            <img src="{{ $item->url }}" alt="{{ $item->alt_text }}" class="w-full h-full object-cover">
        @elseif($item->mime_type === 'application/pdf')
            <div class="w-full h-full flex flex-col items-center justify-center bg-gray-50 dark:bg-gray-900 p-4">
                <svg class="w-12 h-12 text-red-500 mb-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9v-2h2v2zm0-4h-2V7h2v5zm4 4h-2v-5h2v5z"/></svg>
                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest text-center truncate w-full px-2">{{ $item->original_filename }}</span>
            </div>
        @else
            <div class="w-full h-full flex flex-col items-center justify-center bg-gray-50 dark:bg-gray-900 p-4">
                <svg class="w-12 h-12 text-blue-500 mb-2" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>
                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest text-center truncate w-full px-2">{{ $item->original_filename }}</span>
            </div>
        @endif

        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors"></div>
    </div>
@endforeach
