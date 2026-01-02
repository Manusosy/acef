<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['name' => 'Administrator', 'slug' => 'admin'],
            ['name' => 'Country Coordinator', 'slug' => 'country_coordinator'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['slug' => $role['slug']], ['name' => $role['name']]);
        }
    }
}
