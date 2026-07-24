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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2); // Unit price at the time of purchase
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            // Keep user_id, name, phone, address, payment_method, status, payment_status, razorpay_*
            $table->decimal('total_amount', 10, 2)->after('user_id')->nullable();
            $table->decimal('shipping_fee', 10, 2)->default(0)->after('total_amount');
            
            // Note: We are not dropping product_id, quantity, total_price yet 
            // to avoid SQLite dropColumn issues if not configured properly, 
            // but we'll make them nullable so we don't need to fill them.
            $table->unsignedBigInteger('product_id')->nullable()->change();
            $table->integer('quantity')->nullable()->change();
            $table->decimal('total_price', 10, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['total_amount', 'shipping_fee']);
        });
    }
};
