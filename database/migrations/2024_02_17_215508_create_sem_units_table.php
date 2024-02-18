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
        Schema::create('sem_units', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sem_id');
            $table->unsignedBigInteger('unit_id');
            $table->string('year');
            $table->timestamps();
            $table->foreign('sem_id')->references('id')->on('sems')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sem_units');
    }
};
