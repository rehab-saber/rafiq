<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parent_notification_settings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('parent_id')
                ->constrained('parents')
                ->cascadeOnDelete();

            $table->boolean('main_notifications')->default(true);

            $table->boolean('activity_reminders')->default(false);

            $table->boolean('appointment_reminders')->default(true);

            $table->boolean('doctor_messages')->default(true);

            $table->boolean('new_article_reminder')->default(false);

            $table->timestamps();

            $table->unique('parent_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parent_notification_settings');
    }
};