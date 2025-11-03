<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Get all categories
        $categories = Category::all();

        $products = [

            [
                'category_id' => 1,
                'name' => 'Americano',
                'sku' => 'SMX001',
                'description' => 'americano coffee best seller',
                'price' => 30.000,
            ],
            [
                'category_id' => 1,
                'name' => 'Coffee Premium',
                'sku' => 'COF001',
                'description' => 'Premium ground coffee',
                'price' => 80.000,
            ],
            // coffee
            [
                'category_id' => 1,
                'name' => 'Espresso',
                'sku' => 'COF002',
                'description' => 'Strong and bold espresso',
                'price' => 21.000,
            ],
            [
                'category_id' => 1,
                'name' => 'Cappuccino',
                'sku' => 'COF003',
                'description' => 'Creamy cappuccino with foam',
                'price' => 25.000,
            ],

        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
