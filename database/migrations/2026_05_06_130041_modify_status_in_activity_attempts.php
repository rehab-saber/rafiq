<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('activity_attempts', function (Blueprint $table) {
            $table->enum('status', ['pending', 'in_progress', 'completed'])
                ->default('pending')
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('activity_attempts', function (Blueprint $table) {
            $table->string('status')->change();
        });
    }
};