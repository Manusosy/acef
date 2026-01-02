<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Project::query();

        // Scope to country if Coordinator
        if ($user->isCoordinator()) {
            $query->whereJsonContains('country', $user->country);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $projects = $query->latest()->paginate(10);
        
        // Adjust categories pluck to respect scope
        if ($user->isAdmin()) {
            $categories = Project::distinct()->pluck('category')->filter();
        } else {
            $categories = Project::whereJsonContains('country', $user->country)->distinct()->pluck('category')->filter();
        }

        return view('admin.projects.index', compact('projects', 'categories'));
    }

    public function create()
    {
        $user = auth()->user();
        $programmes = $user->isAdmin() 
            ? \App\Models\Program::all() 
            : \App\Models\Program::whereJsonContains('country', $user->country)->get();

        return view('admin.projects.create', compact('programmes'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:100',
            'goal_amount' => 'nullable|numeric|min:0',
            'raised_amount' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];

        if ($user->isAdmin()) {
            $rules['country'] = 'required|array';
            $rules['status'] = 'required|in:ongoing,completed,starting';
        }

        $validated = $request->validate($rules);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active', true);

        // Enforce coordinator restrictions
        if ($user->isCoordinator()) {
            $validated['country'] = [$user->country];
            $validated['status'] = 'starting'; // Default status for coordinator-added projects? Or 'pending' if it existed.
            // Since there is no 'pending' in Project status ENUM/Validate, let's stick to 'starting'.
            // Actually, maybe projects should also have a 'published/draft' status?
            // Checking migrations/Project schema... wait, the controller suggests: ongoing,completed,starting.
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        Project::create($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        $user = auth()->user();
        $programmes = $user->isAdmin() 
            ? \App\Models\Program::all() 
            : \App\Models\Program::whereJsonContains('country', $user->country)->get();

        return view('admin.projects.edit', compact('project', 'programmes'));
    }

    public function update(Request $request, Project $project)
    {
        $user = auth()->user();

        // Scope check for coordinator
        if ($user->isCoordinator() && !in_array($user->country, (array)$project->country)) {
            abort(403);
        }

        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:100',
            'goal_amount' => 'nullable|numeric|min:0',
            'raised_amount' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];

        if ($user->isAdmin()) {
            $rules['country'] = 'required|array';
            $rules['status'] = 'required|in:ongoing,completed,starting';
        }

        $validated = $request->validate($rules);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $user = auth()->user();
        if ($user->isCoordinator() && !in_array($user->country, (array)$project->country)) {
            abort(403);
        }

        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}
