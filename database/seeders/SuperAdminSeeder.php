<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Safely create or update the user
        $user = User::updateOrCreate(
            ['email' => 'admin@admin.com'], // Unique constraint
            [
                'name' => 'admin',
                'password' => Hash::make('12345678'), // You can change this
            ]
        );

        // Create or find the super_admin role
        $role = Role::firstOrCreate(['name' => 'super_admin']);

        // Assign the role if not already assigned
        if (! $user->hasRole($role)) {
            $user->assignRole($role);
        }
    }
}
