<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Fetch roles available for registration
        $roles = \App\Models\Role::whereIn('slug', ['admin', 'country_coordinator'])->get();
        return view('auth.register', compact('roles'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => ['nullable', 'exists:roles,id'],
            'role' => ['required', 'string', 'in:admin,country_coordinator'],
        ]);

        // Security check for Country Coordinator role
        if ($request->role_id) {
            $role = \App\Models\Role::find($request->role_id);
            if ($role && $role->slug === 'country_coordinator') {
                if (!str_ends_with($request->email, '@acef-ngo.org')) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'email' => 'Country Coordinators must use an official @acef-ngo.org email address.',
                    ]);
                }
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
