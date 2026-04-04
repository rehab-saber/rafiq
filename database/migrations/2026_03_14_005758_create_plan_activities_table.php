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
        Schema::create('plan_activities', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('activity_id');
            $table->unsignedBigInteger('plan_id');

            $table->integer('target_repetitions');
            $table->text('doctor_notes')->nullable();
            $table->integer('order_number');

            $table->timestamps();

            $table->foreign('activity_id')
                ->references('id')
                ->on('activities')
                ->onDelete('cascade');

            $table->foreign('plan_id')
                ->references('id')
                ->on('plans')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_activities');
    }
};