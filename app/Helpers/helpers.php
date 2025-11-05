<?php

use App\Models\Setting;

if (!function_exists('getSiteName')) {
    function getSiteName()
    {
        return Setting::where('key', 'site_name')->first()->value ?? config('app.name', 'POS');
    }
}
