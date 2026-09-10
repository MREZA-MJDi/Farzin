<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                ->constrained()
                ->restrictOnDelete();

            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();

            $table->string('brand')->nullable();

            $table->string('short_description')->nullable();
            $table->text('description')->nullable();

            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('old_price')->nullable();

            $table->unsignedTinyInteger('discount')->nullable();

            $table->unsignedInteger('stock')->default(0);

            $table->decimal('rating', 2, 1)->default(0);
            $table->unsignedInteger('review_count')->default(0);

            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);

            $table->timestamps();

            $table->index([
                'category_id',
                'is_active',
            ]);

            $table->index([
                'is_active',
                'is_featured',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
