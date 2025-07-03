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
        Schema::table('brands', function (Blueprint $table) {
            $table->index(['country_code', 'rating', 'deleted_at'], 'idx_country_rating_deleted');
            $table->index(['rating', 'deleted_at'], 'idx_rating_deleted');
        });
    }

    public function down(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->dropIndex('idx_country_rating_deleted');
            $table->dropIndex('idx_rating_deleted');
        });
    }
};
