<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

Route::get('/fix-admin', function () {
    try {
        // Fix Role
        $role = Role::where('slug', 'admin')->first();
        if (!$role) {
            $role = Role::create([
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Administrator with full access',
            ]);
        }

        // Fix User
        $user = User::withTrashed()->where('email', 'admin@acef.org')->first();
        if ($user) {
            $user->restore();
            $user->password = Hash::make('password');
            $user->role_id = $role->id;
            $user->is_active = true;
            $user->save();
        } else {
            $user = User::create([
                'name' => 'Admin User',
                'email' => 'admin@acef.org',
                'password' => Hash::make('password'),
                'role_id' => $role->id,
                'country' => 'Kenya',
                'is_active' => true,
            ]);
        }
        
        return "Admin fixed! ID: {$user->id}, Email: {$user->email}, Role: {$role->name}, Password: password";
        
    } catch (\Throwable $e) {
        return "Error: " . $e->getMessage() . " | Trace: " . $e->getTraceAsString();
    }
});
