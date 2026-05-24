<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->nullable()->constrained('sections')->onDelete('cascade');
            $table->string('title');
            $table->text('summary');
            $table->longText('content')->nullable();
            $table->integer('read_time_minutes')->nullable();
            $table->string('media_path')->nullable();
            $table->string('source_url')->nullable();
            $table->boolean('is_published')->default(true);
            $table->string('language')->default('en');
            $table->timestamps();
        });

        Schema::create('article_bookmarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->constrained('parents')->cascadeOnDelete();
            $table->foreignId('article_id')->constrained('articles')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['parent_id', 'article_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_bookmarks');
        Schema::dropIfExists('articles');
    }
};