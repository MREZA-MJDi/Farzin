<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_status_histories', function (Blueprint $table) {
            if (
                Schema::hasColumn('order_status_histories', 'status')
                && ! Schema::hasColumn('order_status_histories', 'to_status')
            ) {
                $table->renameColumn('status', 'to_status');
            }

            if (! Schema::hasColumn('order_status_histories', 'from_status')) {
                $table->string('from_status')
                    ->nullable()
                    ->after('changed_by');
            }
        });
    }

    public function down(): void
    {
        Schema::table('order_status_histories', function (Blueprint $table) {
            if (
                Schema::hasColumn('order_status_histories', 'to_status')
                && ! Schema::hasColumn('order_status_histories', 'status')
            ) {
                $table->renameColumn('to_status', 'status');
            }

            if (Schema::hasColumn('order_status_histories', 'from_status')) {
                $table->dropColumn('from_status');
            }
        });
    }
};
