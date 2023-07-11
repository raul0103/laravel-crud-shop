<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Телефон Samsung A51',
                'image' => '',
                'description' => 'Новинка в нашем магазине',
                'price' => 120000,
                'stocked' => true
            ],
            [
                'name' => 'Телевизор LG',
                'image' => 'images/tele-lg.jpeg',
                'price' => 375000,
                'stocked' => false
            ],
            [
                'name' => 'Стиральная машина Indesit',
                'image' => 'images/indesit.jpeg',
                'price' => 85000,
                'stocked' => true,
            ]
        ];

        foreach ($products as $product) {
            $product['slug'] = Str::slug($product['name']);

            Product::create(
                $product
            );
        }
    }
}
