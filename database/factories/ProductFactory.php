<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);

        $price = fake()->numberBetween(
            5000000,
            30000000
        );

        return [
            'category_id' => Category::factory(),

            'name' => $name,

            'slug' => Str::slug($name),

            'sku' => strtoupper(
                fake()->unique()->bothify('FAR-####-??')
            ),

            'brand' => 'FARZIN',

            'short_description' =>
                fake()->sentence(8),

            'description' =>
                fake()->paragraphs(2, true),

            'price' => $price,

            'old_price' => fake()->optional(
                0.35
            )->numberBetween(
                $price + 500000,
                $price + 5000000
            ),

            'discount' => fake()->optional(
                0.35
            )->numberBetween(5, 30),

            'stock' => fake()->numberBetween(
                0,
                50
            ),

            'rating' => fake()->randomFloat(
                1,
                3.5,
                5
            ),

            'review_count' => fake()->numberBetween(
                0,
                150
            ),

            'is_active' => true,

            'is_featured' => fake()->boolean(30),
        ];
    }
}
