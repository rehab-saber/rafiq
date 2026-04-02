<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars_question_options', function (Blueprint $table) {

            $table->integer('id')->primary(); // id يدوي

            $table->string('label');          // A, B, C ...
            $table->string('description');    // نص الاختيار
            $table->integer('score');         

            $table->integer('question_id');   // FK

            $table->timestamps();

            // Foreign Key
            $table->foreign('question_id')
                  ->references('id')
                  ->on('cars_questions')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars_question_options');
    }
};
