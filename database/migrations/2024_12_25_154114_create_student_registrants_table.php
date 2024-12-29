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
        Schema::create('student_registrants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->string('full_name');
            $table->date('birth_date');
            $table->string('birth_place');
            $table->text('address');
            $table->string('education_sd');
            $table->string('education_smp');
            $table->string('nisn')->unique();
            $table->string('sibling_info');
            $table->integer('quran_memorization');
            $table->text('achievements');
            $table->text('school_motivation');
            $table->enum('major', ['RPL', 'DKV']);
            $table->string('medical_history')->nullable();
            $table->string('father_name');
            $table->string('father_occupation');
            $table->integer('father_income');
            $table->string('mother_name');
            $table->string('mother_occupation');
            $table->integer('mother_income');
            $table->string('parent_whatsapp');
            $table->enum('student_status', ['Yatim Piatu', 'Yatim', 'Piatu', 'Non Yatim Piatu']);
            $table->string('quran_record_link')->nullable();
            $table->enum('status', ['pending', 'approve', 'rejected'])->default('pending');
            $table->string('attachment_family_register')->nullable();
            $table->string('attachment_birth_certificate')->nullable();
            $table->string('attachment_diploma')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_registrants');
    }
};
