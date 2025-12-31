<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $query = MediaItem::images()->with('uploader');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('original_filename', 'like', '%' . $request->search . '%')
                  ->orWhere('alt_text', 'like', '%' . $request->search . '%');
            });
        }

        $media = $query->recent()->paginate(24);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.media.partials.grid', compact('media'))->render(),
                'hasMore' => $media->hasMorePages(),
            ]);
        }

        return view('admin.media.index', compact('media'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'alt_text' => 'nullable|string|max:255',
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

    // API endpoint for media picker
    public function picker(Request $request)
    {
        $media = MediaItem::images()
            ->recent()
            ->take(50)
            ->get();

        return view('admin.media.partials.picker', compact('media'));
    }
}
