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
        Schema::create('doctors', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('clinic_name')->nullable();
            // multiple specialities
            $table->json('speciality')->nullable();
            $table->string('role')->default('doctor');
            // additional info
            $table->string('city')->nullable();
            $table->text('about')->nullable();
            $table->integer('years_of_exp')->nullable();
            $table->string('clinic_address')->nullable();
            $table->string('photo')->nullable();
            $table->decimal('consultation_price', 8, 2)->nullable();
            // Google / Social Login
            $table->string('provider_name')->nullable();

            $table->string('provider_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};