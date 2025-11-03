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
            // Electronics
            [
                'category_id' => 1,
                'name' => 'Smartphone X',
                'sku' => 'SMX001',
                'description' => 'Latest smartphone model',
                'price' => 599.99,
                'stock' => 50
            ],
            [
                'category_id' => 1,
                'name' => 'Wireless Earbuds',
                'sku' => 'WEB002',
                'description' => 'High-quality wireless earbuds',
                'price' => 79.99,
                'stock' => 100
            ],
            // Food & Beverages
            [
                'category_id' => 2,
                'name' => 'Coffee Premium',
                'sku' => 'COF001',
                'description' => 'Premium ground coffee',
                'price' => 12.99,
                'stock' => 200
            ],
            // Clothing
            [
                'category_id' => 3,
                'name' => 'T-Shirt Basic',
                'sku' => 'TSB001',
                'description' => 'Cotton basic t-shirt',
                'price' => 19.99,
                'stock' => 150
            ],
            // Stationery
            [
                'category_id' => 4,
                'name' => 'Notebook Set',
                'sku' => 'NBS001',
                'description' => 'Premium notebook set',
                'price' => 9.99,
                'stock' => 300
            ],
            // Home & Living
            [
                'category_id' => 5,
                'name' => 'LED Lamp',
                'sku' => 'LED001',
                'description' => 'Modern LED desk lamp',
                'price' => 29.99,
                'stock' => 75
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}