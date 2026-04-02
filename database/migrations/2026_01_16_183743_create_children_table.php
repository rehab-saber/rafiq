<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('children', function (Blueprint $table) {
            $table->id(); // auto increment

            $table->string('name');
            $table->enum('gender', ['male', 'female']);
            $table->integer('age');
            $table->integer('autism_level')->nullable();

            $table->unsignedBigInteger('parent_id');

            $table->timestamps();

            $table->foreign('parent_id')
                ->references('id')
                ->on('parents')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};
