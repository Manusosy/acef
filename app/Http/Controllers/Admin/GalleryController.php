<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = GalleryItem::with('project');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $items = $query->ordered()->paginate(12);
        $categories = GalleryItem::distinct()->pluck('category')->filter();
        $projects = Project::active()->get(['id', 'title']);

        return view('admin.gallery.index', compact('items', 'categories', 'projects'));
    }

    public function create()
    {
        $projects = Project::active()->get(['id', 'title']);
        return view('admin.gallery.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:100',
            'activity_type' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:100',
            'project_id' => 'nullable|exists:projects,id',
            'sort_order' => 'nullable|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('gallery', 'public');
        }

        GalleryItem::create($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery item added successfully.');
    }

    public function edit(GalleryItem $gallery)
    {
        $projects = Project::active()->get(['id', 'title']);
        return view('admin.gallery.edit', ['item' => $gallery, 'projects' => $projects]);
    }

    public function update(Request $request, GalleryItem $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:100',
            'activity_type' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:100',
            'project_id' => 'nullable|exists:projects,id',
            'sort_order' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }
            $validated['image'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery item updated successfully.');
    }

    public function destroy(GalleryItem $gallery)
    {
        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery item deleted successfully.');
    }
}
