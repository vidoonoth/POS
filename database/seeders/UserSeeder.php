<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin', 'password' => Hash::make('password')]
        );

        $cashier = User::firstOrCreate(
            ['email' => 'cashier@example.com'],
            ['name' => 'Cashier', 'password' => Hash::make('password')]
        );

        // Assign roles if they exist
        if (class_exists(Role::class)) {
            if (Role::where('name', 'admin')->exists()) {
                $admin->assignRole('admin');
            }

            if (Role::where('name', 'kasir')->exists()) {
                $cashier->assignRole('kasir');
            }
        }
    }
}
