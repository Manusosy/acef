<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $query = Partner::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $partners = $query->ordered()->paginate(10);

        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'category' => 'required|in:strategic,institutional,implementation',
            'sort_order' => 'nullable|integer|min:0',
            'logo' => 'nullable|string|max:1000',
            'is_active' => 'boolean',
            'show_on_homepage' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['show_on_homepage'] = $request->boolean('show_on_homepage', false);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->filled('logo')) {
            $path = $request->input('logo');
            if (str_contains($path, '/storage/')) {
                $path = Str::after($path, '/storage/');
            }
            $validated['logo'] = $path;
        }

        Partner::create($validated);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner added successfully.');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'category' => 'required|in:strategic,institutional,implementation',
            'sort_order' => 'nullable|integer|min:0',
            'logo' => 'nullable|string|max:1000',
            'is_active' => 'boolean',
            'show_on_homepage' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['show_on_homepage'] = $request->boolean('show_on_homepage');

        if ($request->filled('logo')) {
            $path = $request->input('logo');
            if (str_contains($path, '/storage/')) {
                $path = Str::after($path, '/storage/');
            }
            $validated['logo'] = $path;
        }

        $partner->update($validated);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner updated successfully.');
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner removed successfully.');
    }
}
