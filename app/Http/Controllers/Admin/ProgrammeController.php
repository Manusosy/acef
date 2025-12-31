<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Programme;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProgrammeController extends Controller
{
    public function index(Request $request)
    {
        $query = Programme::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $programmes = $query->ordered()->paginate(10);

        return view('admin.programmes.index', compact('programmes'));
    }

    public function create()
    {
        return view('admin.programmes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:100',
            'icon' => 'nullable|string|max:50',
            'stats_label' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Programme::create($validated);

        return redirect()->route('admin.programmes.index')
            ->with('success', 'Programme created successfully.');
    }

    public function edit(Programme $programme)
    {
        return view('admin.programmes.edit', compact('programme'));
    }

    public function update(Request $request, Programme $programme)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:100',
            'icon' => 'nullable|string|max:50',
            'stats_label' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $programme->update($validated);

        return redirect()->route('admin.programmes.index')
            ->with('success', 'Programme updated successfully.');
    }

    public function destroy(Programme $programme)
    {
        $programme->delete();

        return redirect()->route('admin.programmes.index')
            ->with('success', 'Programme deleted successfully.');
    }
}
