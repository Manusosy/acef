<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TimelineYear;

class TimelineYearController extends Controller
{
    public function index()
    {
        $years = TimelineYear::withCount('achievements')->orderBy('year', 'desc')->get();
        return view('admin.timeline-years.index', compact('years'));
    }

    public function create()
    {
        return view('admin.timeline-years.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|integer|unique:timeline_years,year',
            'order' => 'nullable|integer',
            'is_visible' => 'boolean'
        ]);

        $validated['is_visible'] = $request->has('is_visible');
        TimelineYear::create($validated);

        return redirect()->route('admin.timeline-years.index')->with('success', 'Year added successfully.');
    }

    public function edit(TimelineYear $timelineYear)
    {
        $timelineYear->load(['achievements' => function($q) {
            $q->orderBy('order', 'asc');
        }]);
        return view('admin.timeline-years.edit', compact('timelineYear'));
    }

    public function update(Request $request, TimelineYear $timelineYear)
    {
        $validated = $request->validate([
            'year' => 'required|integer|unique:timeline_years,year,'.$timelineYear->id,
            'order' => 'nullable|integer',
            'is_visible' => 'boolean'
        ]);

        $validated['is_visible'] = $request->has('is_visible');
        $timelineYear->update($validated);

        return redirect()->route('admin.timeline-years.index')->with('success', 'Year updated successfully.');
    }

    public function destroy(TimelineYear $timelineYear)
    {
        $timelineYear->delete();
        return back()->with('success', 'Year deleted successfully.');
    }
}
