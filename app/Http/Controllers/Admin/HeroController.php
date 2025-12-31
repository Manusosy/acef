<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\HeroSlide;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function edit(Page $page)
    {
        $page->load(['heroSlides' => fn($q) => $q->ordered()->with('media')]);
        return view('admin.heroes.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'has_hero' => 'boolean',
            'hero_slider_enabled' => 'boolean',
            'hero_slider_delay' => 'nullable|integer|min:1000|max:30000',
        ]);

        $page->update([
            'has_hero' => $request->boolean('has_hero'),
            'hero_slider_enabled' => $request->boolean('hero_slider_enabled'),
            'hero_slider_delay' => $validated['hero_slider_delay'] ?? 5000,
        ]);

        return redirect()->back()->with('success', 'Hero settings updated.');
    }

    public function storeSlide(Request $request, Page $page)
    {
        $validated = $request->validate([
            'media_id' => 'required|exists:media_items,id',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
        ]);

        $maxOrder = $page->heroSlides()->max('sort_order') ?? 0;
        
        $slide = $page->heroSlides()->create([
            ...$validated,
            'sort_order' => $maxOrder + 1,
            'is_active' => true,
        ]);

        return response()->json([
            'success' => true,
            'slide' => $slide->load('media'),
        ]);
    }

    public function updateSlide(Request $request, HeroSlide $slide)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        $slide->update($validated);

        return response()->json(['success' => true, 'slide' => $slide]);
    }

    public function destroySlide(HeroSlide $slide)
    {
        $slide->delete();
        return response()->json(['success' => true]);
    }

    public function reorderSlides(Request $request, Page $page)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'exists:hero_slides,id',
        ]);

        foreach ($request->order as $index => $slideId) {
            HeroSlide::where('id', $slideId)->update(['sort_order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
