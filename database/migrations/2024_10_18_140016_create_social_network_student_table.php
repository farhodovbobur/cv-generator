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
        Schema::create('social_network_student', function (Blueprint $table) {
            $table->foreignId('social_network_id')->constrained('social_networks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('username')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_network_students');
    }
};
