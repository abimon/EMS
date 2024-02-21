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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('sem_id');
            $table->unsignedBigInteger('student_id');
            $table->string('attempt')->nullable();
            $table->string('CAT')->nullable();
            $table->string('Exam')->nullable();
            $table->timestamps();
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->foreign('sem_id')->references('id')->on('sems')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
