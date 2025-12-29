<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = \App\Models\Role::where('slug', 'admin')->first();
        $coordinatorRole = \App\Models\Role::where('slug', 'country_coordinator')->first();

        // Create Admin User
        \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@acef.org',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role_id' => $adminRole->id,
        ]);

        // Create Country Coordinator User
        \App\Models\User::create([
            'name' => 'Coordinator User',
            'email' => 'coordinator@acef.org',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role_id' => $coordinatorRole->id,
            'country' => 'Kenya',
        ]);
    }
}
