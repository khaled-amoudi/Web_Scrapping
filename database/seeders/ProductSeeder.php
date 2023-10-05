<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'iphone13 pro max',
                'description' => 'iphone 13 pro max 2023, full options',
                'price' => 1000,
                'quantity' => 3,
            ],
            [
                'name' => 'samsung s20 Altra',
                'description' => 'samsung s20 Altra, full options',
                'price' => 800,
                'quantity' => 2,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
