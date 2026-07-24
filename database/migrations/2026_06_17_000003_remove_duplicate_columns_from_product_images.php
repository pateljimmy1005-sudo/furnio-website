<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run only after products:normalize-option-a and full verification.
     */
    public function up(): void
    {
        $columns = ['name', 'category', 'price', 'description', 'material', 'color', 'stock', 'discount'];

        Schema::table('product_images', function (Blueprint $table) use ($columns) {
            foreach ($columns as $column) {
                if (Schema::hasColumn('product_images', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('product_images', function (Blueprint $table) {
            $table->string('name')->after('product_id');
            $table->string('category', 100)->after('name');
            $table->decimal('price', 10, 2)->after('category');
            $table->text('description')->after('price');
            $table->string('material', 100)->after('image');
            $table->string('color', 100)->after('material');
            $table->integer('stock')->after('color');
            $table->integer('discount')->after('stock');
        });
    }
};
