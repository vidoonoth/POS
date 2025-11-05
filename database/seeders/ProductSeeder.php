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
            // Additional products
            [
                'category_id' => 1,
                'name' => 'Latte',
                'sku' => 'COF005',
                'description' => 'Smooth and milky latte',
                'price' => 27.000,
                'image' => 'product/coffee/latte.png',
            ],
            [
                'category_id' => 1,
                'name' => 'Flat White',
                'sku' => 'COF006',
                'description' => 'Velvety flat white coffee',
                'price' => 26.000,
                'image' => 'product/coffee/flatwhite.png',
            ],
            [
                'category_id' => 1,
                'name' => 'Cold Brew',
                'sku' => 'COF007',
                'description' => 'Refreshing cold brew coffee',
                'price' => 32.000,
                'image' => 'product/coffee/coldbrew.png',
            ],
            [
                'category_id' => 1,
                'name' => 'Frappuccino',
                'sku' => 'COF008',
                'description' => 'Blended iced coffee drink',
                'price' => 35.000,
                'image' => 'product/coffee/frappuccino.png',
            ],
            [
                'category_id' => 1,
                'name' => 'Affogato',
                'sku' => 'COF009',
                'description' => 'Espresso with a scoop of ice cream',
                'price' => 29.000,
                'image' => 'product/coffee/affogato.png',
            ],
            [
                'category_id' => 1,
                'name' => 'Turkish Coffee',
                'sku' => 'COF010',
                'description' => 'Strong, unfiltered coffee',
                'price' => 23.000,
                'image' => 'product/coffee/turkish.png',
            ],
            [
                'category_id' => 1,
                'name' => 'Irish Coffee',
                'sku' => 'COF011',
                'description' => 'Coffee with Irish whiskey and cream',
                'price' => 40.000,
                'image' => 'product/coffee/irish.png',
            ],
            [
                'category_id' => 1,
                'name' => 'Mocha',
                'sku' => 'COF012',
                'description' => 'Chocolate-flavored latte',
                'price' => 30.000,
                'image' => 'product/coffee/mocha.png',
            ],
            [
                'category_id' => 1,
                'name' => 'Espresso Macchiato',
                'sku' => 'COF013',
                'description' => 'Espresso with a dash of foamed milk',
                'price' => 22.000,
                'image' => 'product/coffee/espressomacch.png',
            ],
            [
                'category_id' => 1,
                'name' => 'Ristretto',
                'sku' => 'COF014',
                'description' => 'Short, concentrated espresso shot',
                'price' => 20.000,
                'image' => 'product/coffee/ristretto.png',
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(['sku' => $product['sku']], $product);
        }
    }
}
