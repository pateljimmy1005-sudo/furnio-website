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
        if (Schema::hasTable('reviews') && !Schema::hasColumn('reviews', 'title')) {
            Schema::table('reviews', function (Blueprint $table) {
                $table->string('title', 150)->nullable()->after('rating');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('reviews') && Schema::hasColumn('reviews', 'title')) {
            Schema::table('reviews', function (Blueprint $table) {
                $table->dropColumn('title');
            });
        }
    }
};
