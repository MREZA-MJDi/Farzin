<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'brand',
        'short_description',
        'description',
        'price',
        'old_price',
        'discount',
        'stock',
        'rating',
        'review_count',
        'category',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'price' => 'integer',
        'old_price' => 'integer',
        'discount' => 'integer',
        'stock' => 'integer',
        'rating' => 'decimal:1',
        'review_count' => 'integer',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)
            ->orderBy('sort_order');
    }

    public function primaryImage(): HasOne
    {
        return $this->hasOne(ProductImage::class)
            ->where('is_primary', true);
    }
}
