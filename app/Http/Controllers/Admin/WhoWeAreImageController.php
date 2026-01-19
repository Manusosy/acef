<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhoWeAreImage;
use Illuminate\Http\Request;

class WhoWeAreImageController extends Controller
{
    public function index()
    {
        $images = WhoWeAreImage::with('media')->ordered()->get();
        return view('admin.who-we-are.index', compact('images'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'media_items' => 'required|array',
            'media_items.*' => 'exists:media_items,id',
        ]);

        $maxOrder = WhoWeAreImage::max('sort_order') ?? 0;
        
        foreach ($validated['media_items'] as $index => $mediaId) {
            WhoWeAreImage::create([
                'media_id' => $mediaId,
                'country' => null,
                'caption' => null,
                'sort_order' => $maxOrder + 1 + $index,
                'is_active' => true,
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function update(Request $request, WhoWeAreImage $image)
    {
        $validated = $request->validate([
            'country' => 'nullable|string|max:255',
            'caption' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);

        $image->update($validated);

        return response()->json(['success' => true]);
    }

    public function destroy(WhoWeAreImage $image)
    {
        $image->delete();
        return response()->json(['success' => true]);
    }

    public function reorder(Request $request)
    {
        $order = $request->input('order', []);
        
        foreach ($order as $index => $id) {
            WhoWeAreImage::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
