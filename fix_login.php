<?php
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

echo "Checking Admin User...\n";

$users = User::where('email', 'admin@acef.org')->get();

if ($users->count() > 1) {
    echo "Found " . $users->count() . " admin users! Cleaning up duplicates...\n";
    $first = $users->shift();
    foreach ($users as $duplicate) {
        $duplicate->delete();
    }
    $user = $first;
} else {
    $user = $users->first();
}

if (!$user) {
    echo "User not found. Creating...\n";
    $user = new User();
    $user->email = 'admin@acef.org';
    $user->name = 'Admin User';
}

$adminRole = Role::where('slug', 'admin')->first();
if (!$adminRole) {
    echo "Admin role not found. Creating...\n";
    $adminRole = Role::create(['name' => 'Admin', 'slug' => 'admin']);
}

$user->password = Hash::make('password');
$user->role_id = $adminRole->id;
$user->is_active = true;
$user->save();

echo "User 'admin@acef.org' fixed.\n";
echo "ID: " . $user->id . "\n";
echo "Role: " . $adminRole->name . "\n";
echo "Password: password\n";
