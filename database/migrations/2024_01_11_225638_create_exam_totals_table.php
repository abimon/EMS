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
        Schema::create('exam_totals', function (Blueprint $table) {
            $table->id();
            $table->integer('unit_id');
            $table->integer('CAT1');
            $table->integer('CAT2');
            $table->integer('CAT3');
            $table->integer('CAT_total');
            $table->integer('ASN1');
            $table->integer('ASN2');
            $table->integer('ASN3');
            $table->integer('ASN_total');
            $table->integer('Q1');
            $table->integer('Q2');
            $table->integer('Q3');
            $table->integer('Q4');
            $table->integer('Q5');
            $table->integer('exam_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_totals');
    }
};
