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
            $table->bigInteger('ktp')->nullable()->unique();
            $table->string('name');
            $table->string('gender')->default('Laki-laki');
            $table->date('birthdate');
            $table->string('birthplace');
            $table->enum('type', ['Pengajar', 'Musrif', 'Mudzir'])->default('Pengajar');
            $table->enum('secondary_type', ['Pengajar', 'Musrif', 'Mudzir'])->nullable();
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
