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
                'image' => 'product/coffee/americano.png',
            ],
            [
                'category_id' => 1,
                'name' => 'Macchiato',
                'sku' => 'COF001',
                'description' => 'Macchiato coffee',
                'price' => 80.000,
                'image' => 'product/coffee/macchiato.png',
            ],
            // coffee
            [
                'category_id' => 1,
                'name' => 'Espresso',
                'sku' => 'COF002',
                'description' => 'Strong and bold espresso',
                'price' => 21.000,
                'image' => 'product/coffee/espresso.png',
            ],
            [
                'category_id' => 1,
                'name' => 'Cappuccino',
                'sku' => 'COF003',
                'description' => 'Creamy cappuccino with foam',
                'price' => 25.000,
                'image' => 'product/coffee/cappuccino.png',
            ],
            // mochaccino
            [
                'category_id' => 1,
                'name' => 'Mochaccino',
                'sku' => 'COF004',
                'description' => 'Delicious chocolate flavored coffee',
                'price' => 28.000,
                'image' => 'product/coffee/mochaccino.png',
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(['sku' => $product['sku']], $product);
        }
    }
}
