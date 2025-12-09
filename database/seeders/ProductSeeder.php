<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Logitech MX Master 4',
            'price' => 119.99,
            'stock' => 50,
            'category' => 'Electronics',
        ]);

        Product::create([
            'name' => 'Apple AirPods Pro (2nd generation)',
            'price' => 249.99,
            'stock' => 30,
            'category' => 'Audio',
        ]);

        Product::create([
            'name' => 'Sony WH-1000XM5 Headphones',
            'price' => 398.00,
            'stock' => 20,
            'category' => 'Audio',
        ]);
    }
}
