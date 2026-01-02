<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    public function index()
    {
        $resources = Resource::latest()->paginate(10);
        return view('admin.resources.index', compact('resources'));
    }

    public function create()
    {
        return view('admin.resources.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'required|string',
            'type' => 'required|string',
            'category' => 'nullable|string',
            'year' => 'nullable|string',
            'is_locked' => 'boolean',
        ]);

        if (Storage::disk('public')->exists($validated['file_path'])) {
            $size = Storage::disk('public')->size($validated['file_path']);
            $validated['size'] = $this->formatBytes($size);
        } else {
             $validated['size'] = '0 B'; // Should ideally fail validation if file missing but 0 B is fallback
        }

        $validated['is_locked'] = $request->has('is_locked');

        Resource::create($validated);

        return redirect()->route('admin.resources.index')->with('success', 'Resource created successfully.');
    }

    public function edit(Resource $resource)
    {
        return view('admin.resources.edit', compact('resource'));
    }

    public function update(Request $request, Resource $resource)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'nullable|string',
            'type' => 'required|string',
            'category' => 'nullable|string',
            'year' => 'nullable|string',
            'is_locked' => 'boolean',
        ]);

        if ($request->filled('file_path') && $request->file_path !== $resource->file_path) {
             if (Storage::disk('public')->exists($request->file_path)) {
                $size = Storage::disk('public')->size($request->file_path);
                $validated['size'] = $this->formatBytes($size);
            }
        } else {
            unset($validated['file_path']); // Don't overwrite if not changed or empty
        }

        $validated['is_locked'] = $request->has('is_locked');

        $resource->update($validated);

        return redirect()->route('admin.resources.index')->with('success', 'Resource updated successfully.');
    }

    public function destroy(Resource $resource)
    {
        if ($resource->file_path && Storage::disk('public')->exists($resource->file_path)) {
            Storage::disk('public')->delete($resource->file_path);
        }
        
        $resource->delete();

        return redirect()->route('admin.resources.index')->with('success', 'Resource deleted successfully.');
    }

    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
