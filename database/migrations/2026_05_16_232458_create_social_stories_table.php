<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('social_stories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->nullable()->constrained('sections')->nullOnDelete();
            $table->string('title');
            $table->text('summary')->nullable();
            $table->longText('content')->nullable();
            $table->enum('user_progress', ['not_started', 'in_progress', 'completed'])->default('not_started');
            $table->enum('language', ['en', 'ar'])->default('en');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('social_stories');
    }
};