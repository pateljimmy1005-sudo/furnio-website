<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();

            $table->unsignedBigInteger('product_id');

            $table->string('name')->nullable();

            $table->string('phone')->nullable();

            $table->text('address')->nullable();

            $table->integer('quantity')->default(1);

            $table->decimal('total_price', 10, 2);

            $table->string('payment_method')->default('Cash On Delivery');

            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};