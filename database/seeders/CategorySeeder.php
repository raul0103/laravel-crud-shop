<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Категория 1',
                'parent_id' => null,
            ],
            [
                'name' => 'Категория 2',
                'parent_id' => 1,
            ],
            [
                'name' => 'Категория 3',
                'parent_id' => 2,
            ]
        ];

        foreach ($categories as $category) {
            Category::create(
                $category
            );
        }
    }
}
