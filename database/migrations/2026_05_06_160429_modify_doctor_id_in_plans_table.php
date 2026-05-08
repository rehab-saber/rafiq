<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('plans', function (Blueprint $table) {

            // 1️⃣ نخلي doctor_id يقبل null
            $table->unsignedBigInteger('doctor_id')->nullable()->change();

        });

        // 2️⃣ نعدل الـ foreign key
        Schema::table('plans', function (Blueprint $table) {
            $table->dropForeign(['doctor_id']);

            $table->foreign('doctor_id')
                ->references('id')
                ->on('doctors')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table) {

            $table->dropForeign(['doctor_id']);

            $table->unsignedBigInteger('doctor_id')->nullable(false)->change();

            $table->foreign('doctor_id')
                ->references('id')
                ->on('doctors')
                ->onDelete('cascade');
        });
    }
};
