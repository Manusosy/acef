<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accreditation;
use Illuminate\Http\Request;

class AccreditationController extends Controller
{
    public function index()
    {
        $accreditations = Accreditation::latest()->paginate(10);
        return view('admin.accreditations.index', compact('accreditations'));
    }

    public function create()
    {
        return view('admin.accreditations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'acronym' => 'required|string|max:10',
            'image' => 'nullable|string',
        ]);

        Accreditation::create($validated);

        return redirect()->route('admin.accreditations.index')->with('success', 'Accreditation added successfully.');
    }

    public function edit(Accreditation $accreditation)
    {
        return view('admin.accreditations.edit', compact('accreditation'));
    }

    public function update(Request $request, Accreditation $accreditation)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'acronym' => 'required|string|max:10',
            'image' => 'nullable|string',
        ]);

        $accreditation->update($validated);

        return redirect()->route('admin.accreditations.index')->with('success', 'Accreditation updated successfully.');
    }

    public function destroy(Accreditation $accreditation)
    {
        $accreditation->delete();
        return redirect()->route('admin.accreditations.index')->with('success', 'Accreditation deleted successfully.');
    }
}
