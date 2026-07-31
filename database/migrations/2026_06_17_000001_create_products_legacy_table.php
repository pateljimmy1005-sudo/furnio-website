<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('products_legacy')) {
            Schema::create('products_legacy', function (Blueprint $table) {
                $table->unsignedBigInteger('original_id');
                $table->string('name');
                $table->string('category');
                $table->decimal('price', 10, 2);
                $table->text('description');
                $table->string('image');
                $table->string('material')->nullable();
                $table->string('color')->nullable();
                $table->integer('stock')->default(0);
                $table->integer('discount')->default(0);
                $table->timestamp('archived_at')->useCurrent();
                $table->timestamps();

                $table->primary('original_id');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('products_legacy');
    }
};
