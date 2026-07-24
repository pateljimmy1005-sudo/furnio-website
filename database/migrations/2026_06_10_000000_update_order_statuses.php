<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update existing orders to map to the new status strings
        DB::table('orders')->whereIn('status', ['pending', 'confirmed'])->update(['status' => 'Created']);
        DB::table('orders')->where('status', 'delivered')->update(['status' => 'Delivered']);
        DB::table('orders')->where('status', 'cancelled')->update(['status' => 'Cancelled']);

        // Set default value of status column in orders table to 'Created'
        Schema::table('orders', function (Blueprint $table) {
            $table->string('status')->default('Created')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('status')->default('pending')->change();
        });
    }
};
