<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $hood = Category::query()
            ->where('slug', 'hood')
            ->firstOrFail();

        $sink = Category::query()
            ->where('slug', 'sink')
            ->firstOrFail();

        $products = [
            [
                'category_id' => $hood->id,
                'name' => 'هود مورب فرزین مدل آریا',
                'slug' => 'hood-arya',
                'sku' => 'FAR-HOOD-001',
                'brand' => 'FARZIN',
                'short_description' => 'هود مورب مدرن با طراحی مینیمال و عملکرد قدرتمند.',
                'description' => 'هود مورب فرزین مدل آریا با طراحی مدرن و عملکرد قدرتمند.',
                'price' => 12800000,
                'old_price' => 14500000,
                'discount' => 12,
                'stock' => 18,
                'rating' => 4.8,
                'review_count' => 24,
                'is_active' => true,
                'is_featured' => true,
            ],

            [
                'category_id' => $hood->id,
                'name' => 'هود مخفی فرزین مدل نیکا',
                'slug' => 'hood-nika',
                'sku' => 'FAR-HOOD-002',
                'brand' => 'FARZIN',
                'short_description' => 'هود مخفی مناسب آشپزخانه‌های مدرن.',
                'description' => 'هود مخفی فرزین مدل نیکا با طراحی یکپارچه.',
                'price' => 9800000,
                'old_price' => null,
                'discount' => null,
                'stock' => 12,
                'rating' => 4.6,
                'review_count' => 17,
                'is_active' => true,
                'is_featured' => true,
            ],

            [
                'category_id' => $sink->id,
                'name' => 'سینک توکار فرزین مدل کلاسیک',
                'slug' => 'sink-classic',
                'sku' => 'FAR-SINK-001',
                'brand' => 'FARZIN',
                'short_description' => 'سینک توکار استیل با طراحی ساده و مدرن.',
                'description' => 'سینک توکار فرزین مدل کلاسیک با ساختار مقاوم.',
                'price' => 7400000,
                'old_price' => 8200000,
                'discount' => 10,
                'stock' => 21,
                'rating' => 4.7,
                'review_count' => 31,
                'is_active' => true,
                'is_featured' => true,
            ],

            [
                'category_id' => $sink->id,
                'name' => 'سینک روکار فرزین مدل نوا',
                'slug' => 'sink-nova',
                'sku' => 'FAR-SINK-002',
                'brand' => 'FARZIN',
                'short_description' => 'سینک روکار مقاوم با طراحی مینیمال.',
                'description' => 'سینک روکار فرزین مدل نوا با طراحی کاربردی.',
                'price' => 6900000,
                'old_price' => null,
                'discount' => null,
                'stock' => 15,
                'rating' => 4.5,
                'review_count' => 12,
                'is_active' => true,
                'is_featured' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['sku' => $product['sku']],
                $product
            );
        }
    }
}
