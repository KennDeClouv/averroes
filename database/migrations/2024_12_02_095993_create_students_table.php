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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('classes_id')->nullable()->constrained('classes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('room_id')->nullable()->constrained('rooms')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->string('full_name');
            $table->string('nisn')->unique();
            $table->enum('gender', ["male", "female"])->default('male');
            $table->date('birth_date');
            $table->string('birth_place');
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('education_sd')->nullable();
            $table->string('education_smp')->nullable();
            $table->string('sibling_info')->nullable();
            $table->integer('quran_memorization')->nullable();
            $table->string('achievements')->nullable();
            $table->string('school_motivation')->nullable();
            $table->enum('major', ['RPL', 'DKV'])->nullable();
            $table->string('medical_history')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_occupation')->nullable();
            $table->integer('father_income')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->integer('mother_income')->nullable();
            $table->string('parent_whatsapp')->nullable();
            $table->string('quran_record_link')->nullable();
            $table->enum('student_status', ['Yatim Piatu', 'Yatim', 'Piatu', 'Non Yatim Piatu']);
            $table->string('attachment_family_register')->nullable();
            $table->string('attachment_birth_certificate')->nullable();
            $table->string('attachment_diploma')->nullable();
            $table->boolean('is_graduate')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
