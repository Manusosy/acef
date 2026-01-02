<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesTableSeeder::class,
        ]);

        $adminRole = \App\Models\Role::where('slug', 'admin')->first();

        User::firstOrCreate(
            ['email' => 'admin@acef.org'],
            [
                'name' => 'Admin User',
                'password' => 'password',
                'role_id' => $adminRole?->id,
                'country' => 'Kenya',
                'is_active' => true,
            ]
        );

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => 'password',
            ]
        );
    }
}
