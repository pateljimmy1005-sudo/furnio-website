<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $isSqlite = \Illuminate\Support\Facades\DB::getDriverName() === 'sqlite';

        Schema::table('products', function (Blueprint $table) use ($isSqlite) {
            $col = $isSqlite ? 'category' : [\Illuminate\Support\Facades\DB::raw('category(191)')];
            $table->index($col, 'products_category_index');
        });

        Schema::table('orders', function (Blueprint $table) use ($isSqlite) {
            $statusCol = $isSqlite ? 'status' : [\Illuminate\Support\Facades\DB::raw('status(191)')];
            $paymentStatusCol = $isSqlite ? 'payment_status' : [\Illuminate\Support\Facades\DB::raw('payment_status(191)')];
            $paymentMethodCol = $isSqlite ? 'payment_method' : [\Illuminate\Support\Facades\DB::raw('payment_method(191)')];

            $table->index($statusCol, 'orders_status_index');
            $table->index($paymentStatusCol, 'orders_payment_status_index');
            $table->index($paymentMethodCol, 'orders_payment_method_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('products_category_index');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex('orders_status_index');
            $table->dropIndex('orders_payment_status_index');
            $table->dropIndex('orders_payment_method_index');
        });
    }
};
