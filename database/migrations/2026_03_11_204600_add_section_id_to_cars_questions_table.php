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
        Schema::table('cars_questions', function (Blueprint $table) {
            // ربط العمود section_id بالجدول sections
            $table->foreign('section_id')
                  ->references('id')
                  ->on('sections')
                  ->cascadeOnDelete();
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars_questions', function (Blueprint $table) {
            $table->dropForeign(['section_id']);
        });
    }
};
