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
        Schema::table('cars_question_options', function (Blueprint $table) {
            $table->decimal('score', 5, 2)->change();
            $table->string('description')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('cars_question_options', function (Blueprint $table) {
            $table->integer('score')->change();
            $table->string('description')->nullable(false)->change();
        });
    }
};
