@foreach($media as $item)
    <div data-picker-id="{{ $item->id }}" 
         class="media-picker-item aspect-square bg-gray-100 dark:bg-gray-700 rounded-lg overflow-hidden cursor-pointer hover:opacity-80 transition-opacity"
         onclick="selectMediaItem({{ $item->id }}, '{{ $item->url }}', '{{ $item->original_filename }}')">
        <img src="{{ $item->url }}" alt="{{ $item->alt_text }}" class="w-full h-full object-cover">
    </div>
@endforeach
