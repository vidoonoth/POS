<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Electronic devices and accessories'
            ],
            [
                'name' => 'Food & Beverages',
                'description' => 'Food and drink items'
            ],
            [
                'name' => 'Clothing',
                'description' => 'Apparel and accessories'
            ],
            [
                'name' => 'Stationery',
                'description' => 'Office and school supplies'
            ],
            [
                'name' => 'Home & Living',
                'description' => 'Household items and decorations'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
