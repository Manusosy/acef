<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::withCount('sections', 'heroSlides')->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug',
            'template' => 'nullable|string|max:100',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'is_published' => 'boolean',
            'has_hero' => 'boolean',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['is_published'] = $request->boolean('is_published', true);
        $validated['has_hero'] = $request->boolean('has_hero');

        $page = Page::create($validated);

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', 'Page created successfully.');
    }

    public function edit(Page $page)
    {
        $page->load(['sections' => fn($q) => $q->ordered(), 'heroSlides' => fn($q) => $q->ordered()]);
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'is_published' => 'boolean',
            'has_hero' => 'boolean',
            'hero_slider_enabled' => 'boolean',
            'hero_slider_delay' => 'nullable|integer|min:1000|max:30000',
        ]);

        $validated['is_published'] = $request->boolean('is_published');
        $validated['has_hero'] = $request->boolean('has_hero');
        $validated['hero_slider_enabled'] = $request->boolean('hero_slider_enabled');

        $page->update($validated);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page)
    {
        // Prevent deleting core pages
        $coreSlugs = [
            'home', 'about', 'contact', 'programmes', 'projects', 
            'impact', 'news', 'gallery', 'get-involved', 'team', 'partners'
        ];
        if (in_array($page->slug, $coreSlugs)) {
            return redirect()->route('admin.pages.index')
                ->with('error', 'Cannot delete mission-critical core pages.');
        }

        $page->delete();
        return redirect()->route('admin.pages.index')
            ->with('success', 'Page deleted successfully.');
    }
}
