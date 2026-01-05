<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TimelineAchievement;
use App\Models\TimelineYear;

class TimelineAchievementController extends Controller
{
    public function create(Request $request)
    {
        $year_id = $request->query('year_id');
        $years = TimelineYear::orderBy('year', 'desc')->get();
        return view('admin.timeline-achievements.create', compact('years', 'year_id'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'timeline_year_id' => 'required|exists:timeline_years,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'order' => 'nullable|integer',
            'images' => 'nullable|array',
            'images.*' => 'string'
        ]);
        
        $validated['images'] = $request->input('images', []);
        $validated['is_visible'] = $request->has('is_visible');
        
        TimelineAchievement::create($validated);
        
        return redirect()->route('admin.timeline-years.edit', $validated['timeline_year_id'])
                         ->with('success', 'Achievement added successfully.');
    }

    public function edit(TimelineAchievement $timelineAchievement)
    {
        $years = TimelineYear::orderBy('year', 'desc')->get();
        return view('admin.timeline-achievements.edit', compact('timelineAchievement', 'years'));
    }

    public function update(Request $request, TimelineAchievement $timelineAchievement)
    {
        $validated = $request->validate([
            'timeline_year_id' => 'required|exists:timeline_years,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'order' => 'nullable|integer',
            'images' => 'nullable|array',
            'images.*' => 'string'
        ]);

        $data = $request->only(['timeline_year_id', 'title', 'description', 'location', 'order']);
        $data['images'] = $request->input('images', []);
        $data['is_visible'] = $request->has('is_visible');

        $timelineAchievement->update($data);

        return redirect()->route('admin.timeline-years.edit', $data['timeline_year_id'])
                         ->with('success', 'Achievement updated successfully.');
    }

    public function destroy(TimelineAchievement $timelineAchievement)
    {
        $yearId = $timelineAchievement->timeline_year_id;
        $timelineAchievement->delete();
        return redirect()->route('admin.timeline-years.edit', $yearId)
                         ->with('success', 'Achievement deleted successfully.');
    }
}
