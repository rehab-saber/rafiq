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
        Schema::table('activity_attempts', function (Blueprint $table) {

            $table->enum('difficulty', [
                'easy',
                'medium',
                'hard'
            ])->nullable()->after('started_at');

            $table->enum('mood', [
                'happy',
                'calm',
                'frustrated'
            ])->nullable()->after('difficulty');

            $table->tinyInteger('rating')
                ->nullable()
                ->after('mood');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activity_attempts', function (Blueprint $table) {

            $table->dropColumn([
                'difficulty',
                'mood',
                'rating'
            ]);
        });
    }
};