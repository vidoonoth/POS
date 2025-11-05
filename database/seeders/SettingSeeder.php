<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::firstOrCreate(
            ['key' => 'site_name'],
            ['value' => 'POS System']
        );

        Setting::firstOrCreate(
            ['key' => 'site_description'],
            ['value' => 'Point of Sale System for your business']
        );
    }
}
