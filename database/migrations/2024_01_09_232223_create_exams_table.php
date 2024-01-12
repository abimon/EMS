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
            $table->unsignedBigInteger('unit_id');
            $table->string('reg_no');
            $table->string('name');
            $table->string('attempt')->nullable();
            $table->integer('CAT1')->nullable();
            $table->integer('CAT2')->nullable();
            $table->integer('CAT3')->nullable();
            $table->string('CAT_t');
            $table->integer('ASN1')->nullable();
            $table->integer('ASN2')->nullable();
            $table->integer('ASN3')->nullable();
            $table->string('ASN_t');
            $table->integer('Q1')->nullable();
            $table->integer('Q2')->nullable();
            $table->integer('Q3')->nullable();
            $table->integer('Q4')->nullable();
            $table->integer('Q5')->nullable();
            $table->string('Exam_t');
            $table->integer('marks')->nullable();
            $table->timestamps();
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
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
