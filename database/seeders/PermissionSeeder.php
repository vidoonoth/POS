<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::firstOrCreate(['name' => 'dashboard']);
        Permission::firstOrCreate(['name' => 'pos']);
        Permission::firstOrCreate(['name' => 'order history']);
        Permission::firstOrCreate(['name' => 'manage admin']);
        Permission::firstOrCreate(['name' => 'manage profile']);

        // Assign permissions to roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $kasirRole = Role::firstOrCreate(['name' => 'kasir']);

        $adminRole->givePermissionTo([
            'dashboard',
            'manage admin',
            'manage profile',
        ]);

        $kasirRole->givePermissionTo([
            'pos',
            'order history',
            'manage profile',
        ]);
    }
}
