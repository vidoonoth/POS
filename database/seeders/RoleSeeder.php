<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create core roles
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'kasir']);
    }
}
