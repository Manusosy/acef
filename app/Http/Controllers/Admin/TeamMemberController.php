<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::orderBy('order')->orderBy('name')->paginate(20);
        return view('admin.team.index', compact('members'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'image' => 'nullable',
            'group' => 'required|in:leadership,staff',
            'order' => 'integer|min:0',
        ]);

        if ($request->hasFile('image_file')) {
             $validated['image'] = $request->file('image_file')->store('team', 'public');
        } elseif ($request->filled('image')) {
             $validated['image'] = $this->handleMediaPath($request->image);
        }

        TeamMember::create($validated);

        return redirect()->route('admin.team.index')->with('success', 'Team member added successfully.');
    }

    public function edit(TeamMember $teamMember)
    {
        return view('admin.team.edit', compact('teamMember'));
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'image' => 'nullable',
            'group' => 'required|in:leadership,staff',
            'order' => 'integer|min:0',
        ]);

        if ($request->hasFile('image_file')) {
             $validated['image'] = $request->file('image_file')->store('team', 'public');
        } elseif ($request->filled('image')) {
             $validated['image'] = $this->handleMediaPath($request->image);
        }

        $teamMember->update($validated);

        return redirect()->route('admin.team.index')->with('success', 'Team member updated successfully.');
    }

    public function destroy(TeamMember $teamMember)
    {
        $teamMember->delete();
        return redirect()->route('admin.team.index')->with('success', 'Team member deleted successfully.');
    }

    private function handleMediaPath($path)
    {
        if(str_starts_with($path, '/storage/')) {
            return substr($path, 9);
        }
        return $path;
    }
}
