<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->decimal('latitude', 10, 7)
                ->nullable()
                ->after('address');

            $table->decimal('longitude', 10, 7)
                ->nullable()
                ->after('latitude');

            $table->index([
                'latitude',
                'longitude',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropIndex([
                'addresses_latitude_longitude_index',
            ]);

            $table->dropColumn([
                'latitude',
                'longitude',
            ]);
        });
    }
};
