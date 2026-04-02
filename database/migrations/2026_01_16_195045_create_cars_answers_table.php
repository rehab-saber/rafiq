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
        Schema::create('cars_answers', function (Blueprint $table) {

            $table->integer('id')->primary(); // يدوي

            $table->unsignedBigInteger('child_id'); // 👈 children.id bigint
            $table->integer('question_id');         // 👈 integer
            $table->integer('option_id');           // 👈 integer

            $table->integer('score')->nullable();
            $table->string('severity_level')->nullable();

            $table->timestamps();

            $table->foreign('child_id')
                ->references('id')
                ->on('children')
                ->onDelete('cascade');

            $table->foreign('question_id')
                ->references('id')
                ->on('cars_questions')
                ->onDelete('cascade');

            $table->foreign('option_id')
                ->references('id')
                ->on('cars_question_options')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars_answers');
    }
};
