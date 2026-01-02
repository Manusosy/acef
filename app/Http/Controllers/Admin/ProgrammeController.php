<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProgrammeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $query = Program::query();

        // Scope to country if Coordinator
        if ($user->isCoordinator()) {
            $query->whereJsonContains('country', $user->country);
        }

        $programmes = $query->latest()->paginate(10);
        return view('admin.programmes.index', compact('programmes'));
    }

    public function create()
    {
        return view('admin.programmes.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $rules = [
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable',
            'hero_image' => 'nullable',
            'factsheet' => 'nullable',
            'impact_stories' => 'nullable|json',
            'focus_areas' => 'nullable|json',
            'funding_goal' => 'nullable|numeric|min:0',
            'funding_raised' => 'nullable|numeric|min:0',
            'duration' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'stats' => 'nullable|array',
            'category' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
        ];

        if ($user->isAdmin()) {
            $rules['status'] = 'required|in:draft,published,archived';
            $rules['country'] = 'nullable|array';
        }

        $validated = $request->validate($rules);

        $program = new Program();
        $program->fill($validated);

        // Handle Images
        if ($request->hasFile('image')) {
            $program->image = $request->file('image')->store('programs', 'public');
        } elseif ($request->filled('image')) {
            $program->image = $this->handleMediaPath($request->image);
        }

        if ($request->hasFile('hero_image')) {
            $program->hero_image = $request->file('hero_image')->store('programs/hero', 'public');
        } elseif ($request->filled('hero_image')) {
            $program->hero_image = $this->handleMediaPath($request->hero_image);
        }
        
        // Handle Factsheet (PDF)
        if ($request->hasFile('factsheet')) {
            $program->factsheet = $request->file('factsheet')->store('programs/docs', 'public');
        } elseif ($request->filled('factsheet')) {
             // Assuming media picker can pick docs too, handle path string
             $program->factsheet = $this->handleMediaPath($request->factsheet);
        }

        // Handle JSON fields
        if ($request->filled('impact_stories')) {
            $program->impact_stories = json_decode($request->impact_stories, true);
        }
        if ($request->filled('focus_areas')) {
            $program->focus_areas = json_decode($request->focus_areas, true);
        }

        // Enforce coordinator restrictions
        if ($user->isCoordinator()) {
            $program->status = 'draft';
            $program->country = [$user->country];
        }

        $program->save();

        return redirect()->route('admin.programmes.index')->with('success', 'Program created successfully.');
    }

    public function edit(Program $programme)
    {
        return view('admin.programmes.edit', ['programme' => $programme]);
    }

    public function update(Request $request, Program $programme)
    {
        $user = auth()->user();

        // Scope check for coordinator
        if ($user->isCoordinator() && !in_array($user->country, (array)$programme->country)) {
            abort(403);
        }

        $rules = [
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable',
            'hero_image' => 'nullable',
            'factsheet' => 'nullable',
            'impact_stories' => 'nullable|json',
            'focus_areas' => 'nullable|json',
            'funding_goal' => 'nullable|numeric|min:0',
            'funding_raised' => 'nullable|numeric|min:0',
            'duration' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'stats' => 'nullable|array',
            'category' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
        ];

        if ($user->isAdmin()) {
            $rules['status'] = 'required|in:draft,published,archived';
            $rules['country'] = 'nullable|array';
        }

        $validated = $request->validate($rules);

        $programme->fill($validated);

        if ($request->hasFile('image')) {
            $programme->image = $request->file('image')->store('programs', 'public');
        } elseif ($request->filled('image')) {
            $programme->image = $this->handleMediaPath($request->image);
        }

        if ($request->hasFile('hero_image')) {
            $programme->hero_image = $request->file('hero_image')->store('programs/hero', 'public');
        } elseif ($request->filled('hero_image')) {
            $programme->hero_image = $this->handleMediaPath($request->hero_image);
        }
        
        if ($request->hasFile('factsheet')) {
            $programme->factsheet = $request->file('factsheet')->store('programs/docs', 'public');
        } elseif ($request->filled('factsheet')) {
            $programme->factsheet = $this->handleMediaPath($request->factsheet);
        }

        if ($request->filled('impact_stories')) {
            $programme->impact_stories = json_decode($request->impact_stories, true);
        }
        if ($request->filled('focus_areas')) {
            $programme->focus_areas = json_decode($request->focus_areas, true);
        }

        $programme->save();

        return redirect()->route('admin.programmes.index')->with('success', 'Program updated successfully.');
    }

    public function destroy(Program $programme)
    {
        $user = auth()->user();
        if ($user->isCoordinator() && !in_array($user->country, (array)$programme->country)) {
            abort(403);
        }

        $programme->delete();
        return redirect()->route('admin.programmes.index')->with('success', 'Program deleted successfully.');
    }

    private function handleMediaPath($path)
    {
        if(str_starts_with($path, '/storage/')) {
            return substr($path, 9);
        }
        return $path;
    }
}
