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
        Schema::create('doctor_settings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('doctor_id')
                ->unique()
                ->constrained('doctors')
                ->cascadeOnDelete();

            $table->boolean('main_notifications')->default(true);
            $table->boolean('appointment_reminders')->default(true);
            $table->boolean('progress_alerts')->default(true);
            $table->boolean('massage_alerts')->default(true);

            $table->boolean('online_consultations')->default(true);
            $table->boolean('clinic_visits')->default(true);

            $table->boolean('chat_status')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_settings');
    }
};
