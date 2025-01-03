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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('room_id')->nullable()->constrained('rooms')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('classes_id')->nullable()->constrained('classes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('ktp')->nullable()->unique();
            $table->string('name');
            $table->string('full_name');
            $table->string('gender')->default('male');
            $table->date('birth_date');
            $table->string('birth_place');
            $table->enum('type', ['teacher', 'companion', 'headmaster'])->default('teacher');
            $table->enum('secondary_type', ['teacher', 'companion', 'headmaster'])->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
