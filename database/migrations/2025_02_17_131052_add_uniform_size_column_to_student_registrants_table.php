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
        Schema::table('student_registrants', function (Blueprint $table) {
            $table->enum('uniform_size', ['S', 'M', 'L', 'XL', '2XL', '3XL'])->default('M');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_registrants', function (Blueprint $table) {
            $table->dropColumn('uniform_size');
        });
    }
};
