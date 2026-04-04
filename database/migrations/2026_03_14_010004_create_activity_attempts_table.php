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
        Schema::create('activity_attempts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('child_id');
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('activity_id');

            $table->integer('score');
            $table->string('status');
            $table->integer('attempt_number');

            $table->timestamp('completed_at')->nullable();

            $table->timestamps();

            $table->foreign('child_id')
                ->references('id')
                ->on('children')
                ->onDelete('cascade');

            $table->foreign('plan_id')
                ->references('id')
                ->on('plans')
                ->onDelete('cascade');

            $table->foreign('activity_id')
                ->references('id')
                ->on('activities')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_attempts');
    }
};