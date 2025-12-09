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
            'description' => 'Ergonomic Bluetooth Mouse with Advanced Performance Haptic Feedback',
            'price' => 119.99,
            'image' => 'https://m.media-amazon.com/images/I/61ni3t1ryQL._AC_SL1500_.jpg',
            'stock' => 50
        ]);

        Product::create([
            'name' => 'Apple AirPods Pro (2nd generation)',
            'description' => 'Wireless Earbuds, Up to 2X More Active Noise Cancelling',
            'price' => 249.99,
            'image' => 'https://m.media-amazon.com/images/I/61SUj2aKoEL._AC_SL1500_.jpg',
            'stock' => 30
        ]);

        Product::create([
            'name' => 'Sony WH-1000XM5 Headphones',
            'description' => 'Industry Leading Noise Canceling Bluetooth Headphones',
            'price' => 398.00,
            'image' => 'https://m.media-amazon.com/images/I/51QeS0jCGWL._AC_SL1500_.jpg',
            'stock' => 20
        ]);
    }
}
