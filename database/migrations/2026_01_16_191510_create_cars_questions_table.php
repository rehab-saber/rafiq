<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars_questions', function (Blueprint $table) {

            // Primary Key (id يدوي)
            $table->integer('id')->primary();

            // Attributes
            $table->string('title');
            $table->text('question_text');
            $table->string('skill_indicator');

    // section relation
            $table->unsignedBigInteger('section_id')->nullable();
            $table->foreign('section_id')
                ->references('id')
                ->on('sections')
                ->cascadeOnDelete();
                
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars_questions');
    }
};

