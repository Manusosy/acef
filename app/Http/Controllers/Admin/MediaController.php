<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaFolder;
use App\Models\MediaItem;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $query = MediaItem::with('uploader');

        if ($request->filled('folder_id')) {
            $query->where('folder_id', $request->folder_id);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('original_filename', 'like', '%' . $request->search . '%')
                  ->orWhere('alt_text', 'like', '%' . $request->search . '%');
            });
        }

        $media = $query->recent()->paginate(24);
        $folders = MediaFolder::orderBy('name')->get();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'items' => $media->items(),
                'folders' => $folders,
                'html' => view('admin.media.partials.grid', compact('media'))->render(),
                'hasMore' => $media->hasMorePages(),
            ]);
        }

        return view('admin.media.index', compact('media', 'folders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,webp,pdf,doc,docx,xls,xlsx|max:20480',
            'alt_text' => 'nullable|string|max:255',
            'folder_id' => 'nullable|exists:media_folders,id',
        ]);


        $file = $request->file('file');
        $hash = MediaItem::hashFile($file);

        // Check for duplicate
        $existing = MediaItem::findByHash($hash);
        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'This image already exists in the Media Library.',
                'existing' => $existing,
            ], 409);
        }

        // Store the file
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('media', $filename, 'public');

        $media = MediaItem::create([
            'filename' => $filename,
            'original_filename' => $file->getClientOriginalName(),
            'path' => $path,
            'disk' => 'public',
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'hash' => $hash,
            'alt_text' => $request->alt_text,
            'uploaded_by' => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'media' => $media,
            'message' => 'Image uploaded successfully.',
        ]);
    }

    public function show(MediaItem $medium)
    {
        return response()->json([
            'media' => $medium->load('uploader'),
            'usage_count' => $medium->getUsageCount(),
        ]);
    }

    public function update(Request $request, MediaItem $medium)
    {
        $validated = $request->validate([
            'alt_text' => 'nullable|string|max:255',
            'caption' => 'nullable|string|max:1000',
        ]);

        $medium->update($validated);

        return response()->json([
            'success' => true,
            'media' => $medium,
            'message' => 'Media updated successfully.',
        ]);
    }

    public function destroy(MediaItem $medium)
    {
        // Check if in use
        if ($medium->getUsageCount() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete: this image is currently in use.',
            ], 400);
        }

        // Delete file
        Storage::disk($medium->disk)->delete($medium->path);
        $medium->delete();

        return response()->json([
            'success' => true,
            'message' => 'Image deleted successfully.',
        ]);
    }

    // Folder Management
    public function storeFolder(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:media_folders,name',
        ]);

        $folder = MediaFolder::create($validated);

        return response()->json([
            'success' => true,
            'folder' => $folder,
            'message' => 'Folder created successfully.',
        ]);
    }

    public function destroyFolder(MediaFolder $folder)
    {
        // Move items to root
        MediaItem::where('folder_id', $folder->id)->update(['folder_id' => null]);
        
        $folder->delete();

        return response()->json([
            'success' => true,
            'message' => 'Folder deleted successfully.',
        ]);
    }
}
