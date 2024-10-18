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
        Schema::create('language_student', function (Blueprint $table) {
            $table->foreignId('language_id')->constrained('languages')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('level_id')->constrained('levels')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('language_student');
    }
};
