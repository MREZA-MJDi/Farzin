<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::query()->delete();

        Product::create([
            'name' => 'هود مورب فرزین مدل آریا',
            'slug' => 'hood-arya',
            'sku' => 'FAR-HOOD-001',
            'brand' => 'FARZIN',
            'short_description' => 'هود مورب مدرن با طراحی مینیمال و عملکرد قدرتمند.',
            'description' => 'هود مورب فرزین مدل آریا با طراحی مدرن، موتور قدرتمند و ظاهر مینیمال، انتخابی مناسب برای آشپزخانه‌های امروزی.',
            'price' => 12800000,
            'old_price' => 14500000,
            'discount' => 12,
            'stock' => 18,
            'rating' => 4.8,
            'review_count' => 24,
            'category' => 'hood',
            'is_active' => true,
            'is_featured' => true,
        ]);

        Product::create([
            'name' => 'هود مخفی فرزین مدل نیکا',
            'slug' => 'hood-nika',
            'sku' => 'FAR-HOOD-002',
            'brand' => 'FARZIN',
            'short_description' => 'هود مخفی با طراحی یکپارچه و مناسب کابینت‌های مدرن.',
            'description' => 'هود مخفی فرزین مدل نیکا برای آشپزخانه‌هایی با طراحی مینیمال ساخته شده و ظاهر یکپارچه‌ای با کابینت ایجاد می‌کند.',
            'price' => 9800000,
            'old_price' => null,
            'discount' => null,
            'stock' => 12,
            'rating' => 4.6,
            'review_count' => 17,
            'category' => 'hood',
            'is_active' => true,
            'is_featured' => true,
        ]);

        Product::create([
            'name' => 'سینک توکار فرزین مدل کلاسیک',
            'slug' => 'sink-classic',
            'sku' => 'FAR-SINK-001',
            'brand' => 'FARZIN',
            'short_description' => 'سینک توکار استیل با طراحی ساده و مدرن.',
            'description' => 'سینک توکار فرزین مدل کلاسیک با ساختار مقاوم و طراحی ساده، برای آشپزخانه‌های مدرن انتخابی کاربردی است.',
            'price' => 7400000,
            'old_price' => 8200000,
            'discount' => 10,
            'stock' => 21,
            'rating' => 4.7,
            'review_count' => 31,
            'category' => 'sink',
            'is_active' => true,
            'is_featured' => true,
        ]);

        Product::create([
            'name' => 'سینک روکار فرزین مدل نوا',
            'slug' => 'sink-nova',
            'sku' => 'FAR-SINK-002',
            'brand' => 'FARZIN',
            'short_description' => 'سینک روکار مقاوم با طراحی کاربردی و مینیمال.',
            'description' => 'سینک روکار فرزین مدل نوا با طراحی کاربردی، گزینه‌ای مناسب برای آشپزخانه‌های مدرن و پروژه‌های بازسازی است.',
            'price' => 6900000,
            'old_price' => null,
            'discount' => null,
            'stock' => 15,
            'rating' => 4.5,
            'review_count' => 12,
            'category' => 'sink',
            'is_active' => true,
            'is_featured' => false,
        ]);

        Product::create([
            'name' => 'هود شومینه‌ای فرزین مدل آرا',
            'slug' => 'hood-ara',
            'sku' => 'FAR-HOOD-003',
            'brand' => 'FARZIN',
            'short_description' => 'هود شومینه‌ای قدرتمند برای آشپزخانه‌های بزرگ.',
            'description' => 'هود شومینه‌ای فرزین مدل آرا با طراحی کلاسیک و ظرفیت مکش مناسب برای آشپزخانه‌های بزرگ طراحی شده است.',
            'price' => 11500000,
            'old_price' => null,
            'discount' => null,
            'stock' => 9,
            'rating' => 4.4,
            'review_count' => 9,
            'category' => 'hood',
            'is_active' => true,
            'is_featured' => false,
        ]);
    }
}
