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
                'name' => 'هود',
                'slug' => 'hood',
                'description' => 'انواع هود مدرن فرزین',
                'image' => 'https://images.unsplash.com/photo-1556911220-e15b29be8c8f?auto=format&fit=crop&w=1400&q=85',
                'sort_order' => 1,
                'is_active' => true,
            ],

            [
                'name' => 'سینک',
                'slug' => 'sink',
                'description' => 'انواع سینک مدرن فرزین',
                'image' => 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?auto=format&fit=crop&w=1400&q=85',
                'sort_order' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                [
                    'slug' => $category['slug'],
                ],
                $category
            );
        }
    }
}
