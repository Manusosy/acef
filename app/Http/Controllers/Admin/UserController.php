<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('role');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('role')) {
            $query->whereHas('role', function ($q) use ($request) {
                $q->where('slug', $request->role);
            });
        }

        if ($request->filled('status')) {
            $query->where('is_active', (bool) $request->status);
        }

        $users = $query->latest()->paginate(10);
        $roles = Role::all();

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        $countries = config('acef.countries');
        return view('admin.users.create', compact('roles', 'countries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::defaults()],
            'role_id' => 'required|exists:roles,id',
            'country' => 'nullable|string|max:100',
        ]);

        // If role is Country Coordinator (slug: country_coordinator), country is required
        $role = Role::find($validated['role_id']);
        if ($role && $role->slug === 'country_coordinator' && empty($validated['country'])) {
            return back()->withErrors(['country' => 'The country field is required for Country Coordinators.'])->withInput();
        }

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $countries = config('acef.countries');
        return view('admin.users.edit', compact('user', 'roles', 'countries'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'role_id' => 'required|exists:roles,id',
            'country' => 'nullable|string|max:100',
        ]);

        // If role is Country Coordinator (slug: country_coordinator), country is required
        $role = Role::find($validated['role_id']);
        if ($role && $role->slug === 'country_coordinator' && empty($validated['country'])) {
            return back()->withErrors(['country' => 'The country field is required for Country Coordinators.'])->withInput();
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        // Prevent self-deletion
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        // Reassign articles to the next available admin
        $nextAdmin = User::whereHas('role', function ($q) {
            $q->whereIn('slug', ['admin', 'administrator']);
        })->where('id', '!=', $user->id)->first();

        if ($nextAdmin) {
            \App\Models\Article::where('author_id', $user->id)->update(['author_id' => $nextAdmin->id]);
        } else {
            // If no other admin, author_id becomes null (Article model handles fallback to 'ACEF Editorial')
            \App\Models\Article::where('author_id', $user->id)->update(['author_id' => null]);
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully. Their articles have been reassigned.');
    }
}
