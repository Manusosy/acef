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

        $partners = \App\Models\Partner::where('is_active', true)->get();
        return view('admin.projects.create', compact('programmes', 'partners'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        // Convert Year to Date if needed
        if ($request->filled('start_date') && preg_match('/^\d{4}$/', $request->start_date)) {
            $request->merge(['start_date' => $request->start_date . '-01-01']);
        }
        
        $isDraft = $request->has('save_draft');

        $rules = [
            'title' => 'required|string|max:255',
            'description' => ($isDraft ? 'nullable' : 'required') . '|string',
            'category' => ($isDraft ? 'nullable' : 'required') . '|string|max:100',
            'goal_amount' => 'nullable|numeric|min:0',
            'raised_amount' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'programme_id' => 'nullable|exists:programs,id',
            'location' => 'nullable|string|max:255',
        ];

        if ($user->isAdmin()) {
            $rules['country'] = ($isDraft ? 'nullable' : 'required') . '|array';
            $rules['status'] = ($isDraft ? 'nullable' : 'required') . '|in:ongoing,completed,starting,draft';
        }

        $rules['objectives'] = 'nullable|array';
        $rules['voices'] = 'nullable|array';
        $rules['gallery'] = 'nullable|array';
        $rules['video_url'] = 'nullable|url|max:255';

        $validated = $request->validate($rules);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');
        
        // Handle Draft vs Publish
        if ($request->has('save_draft')) {
            $validated['status'] = 'draft';
            $validated['is_active'] = false;
        } else {
            // Default to starting/ongoing if publishing
            $validated['status'] = $validated['status'] ?? 'starting';
            $validated['is_active'] = true;
        }

        // Enforce coordinator restrictions
        if ($user->isCoordinator()) {
            $validated['country'] = [$user->country];
            $validated['status'] = $request->has('save_draft') ? 'draft' : 'pending';
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        } elseif ($request->filled('media_id')) {
            $mediaItem = \App\Models\MediaItem::find($request->media_id);
            if ($mediaItem) {
                $validated['image'] = $mediaItem->path;
            }
        }

        $project = Project::create($validated);

        // Sync Partners if provided
        if ($request->has('partners')) {
            $project->partners()->sync($request->partners);
        }

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        $user = auth()->user();
        $programmes = $user->isAdmin() 
            ? \App\Models\Program::all() 
            : \App\Models\Program::whereJsonContains('country', $user->country)->get();

        $partners = \App\Models\Partner::where('is_active', true)->get();
        return view('admin.projects.edit', compact('project', 'programmes', 'partners'));
    }

    public function update(Request $request, Project $project)
    {
        $user = auth()->user();

        // Convert Year to Date if needed
        if ($request->filled('start_date') && preg_match('/^\d{4}$/', $request->start_date)) {
            $request->merge(['start_date' => $request->start_date . '-01-01']);
        }

        // Scope check for coordinator
        if ($user->isCoordinator() && !in_array($user->country, (array)$project->country)) {
            abort(403);
        }

        $isDraft = $request->has('save_draft');

        $rules = [
            'title' => 'required|string|max:255',
            'description' => ($isDraft ? 'nullable' : 'required') . '|string',
            'category' => ($isDraft ? 'nullable' : 'required') . '|string|max:100',
            'goal_amount' => 'nullable|numeric|min:0',
            'raised_amount' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'programme_id' => 'nullable|exists:programs,id',
        ];

        if ($user->isAdmin()) {
            $rules['country'] = ($isDraft ? 'nullable' : 'required') . '|array';
            $rules['status'] = ($isDraft ? 'nullable' : 'required') . '|in:ongoing,completed,starting,draft';
        }

        $rules['objectives'] = 'nullable|array';
        $rules['voices'] = 'nullable|array';
        $rules['gallery'] = 'nullable|array';
        $rules['video_url'] = 'nullable|url|max:255';

        $validated = $request->validate($rules);

        // Handle Draft vs Publish from button clicks
        if ($request->has('save_draft')) {
            $validated['status'] = 'draft';
            $validated['is_active'] = false;
        } elseif ($request->has('publish')) {
            // If publishing, default to 'ongoing' if not set, or keep selected status
            if ($user->isAdmin()) {
                $validated['status'] = $validated['status'] === 'draft' ? 'ongoing' : $validated['status'];
                $validated['is_active'] = true;
            } else {
                $validated['status'] = 'pending';
                $validated['is_active'] = false;
            }
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        // fallback active check if not set by button logic
        if (!isset($validated['is_active'])) {
             $validated['is_active'] = $request->boolean('is_active');
        }

        if ($request->hasFile('image')) {
            if ($project->image && !Str::startsWith($project->image, 'media/')) {
                Storage::disk('public')->delete($project->image);
            }
            $validated['image'] = $request->file('image')->store('projects', 'public');
        } elseif ($request->filled('media_id')) {
            $mediaItem = \App\Models\MediaItem::find($request->media_id);
            if ($mediaItem) {
                $validated['image'] = $mediaItem->path;
            }
        }

        $project->update($validated);

        // Sync Partners if provided
        if ($request->has('partners')) {
            $project->partners()->sync($request->partners);
        } else {
             $project->partners()->detach();
        }

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
