<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();

            // polymorphic relation
            $table->string('sender_type');
            $table->unsignedBigInteger('sender_id');

            $table->string('full_name');

            $table->string('email');

            $table->string('subject');

            $table->text('message');

            $table->string('screenshot_path')->nullable();

            $table->enum('status', [
                'pending',
                'resolved',
                'rejected'
            ])->default('pending');

            $table->text('admin_notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};