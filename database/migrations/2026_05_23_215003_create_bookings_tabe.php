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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->constrained('parents')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
            $table->foreignId('child_id')->constrained('children')->onDelete('cascade');
            $table->foreignId('availability_id')->unique()->constrained('doctor_availabilities')->onDelete('cascade');
            // $table->time('time');
            // $table->date('date');
            $table->enum('type', ['online', 'in_person'])->default('in_person');
            $table->enum('status', ['pending', 'confirmed', 'rejected', 'completed'])->default('pending');
            $table->text('doctor_note')->nullable();
            $table->text('parent_note')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};