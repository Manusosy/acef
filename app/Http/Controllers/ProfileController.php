<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($request->filled('profile_image')) {
            $path = $request->input('profile_image');
            if (str_contains($path, '/storage/')) {
                $path = \Illuminate\Support\Str::after($path, '/storage/');
            }
            $user->profile_image = $path;
        }

        if ($request->filled('business_card')) {
            $path = $request->input('business_card');
            if (str_contains($path, '/storage/')) {
                $path = \Illuminate\Support\Str::after($path, '/storage/');
            }
            $user->business_card = $path;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Reassign articles to the next available admin
        $nextAdmin = \App\Models\User::whereHas('role', function ($q) {
            $q->whereIn('slug', ['admin', 'administrator']);
        })->where('id', '!=', $user->id)->first();

        if ($nextAdmin) {
            \App\Models\Article::where('author_id', $user->id)->update(['author_id' => $nextAdmin->id]);
        } else {
            \App\Models\Article::where('author_id', $user->id)->update(['author_id' => null]);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
