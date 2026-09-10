<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),

            'image' => null,

            'alt' => fake()->sentence(5),

            'sort_order' => 1,

            'is_primary' => true,
        ];
    }
}
