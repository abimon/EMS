<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dep_id');
            $table->string('sem');
            $table->string('timelines');
            $table->string('year');
            $table->boolean('status');
            $table->timestamps();
            $table->foreign('dep_id')->references('id')->on('departments')->onDelete('cascade');

        });
    }
    public function down(): void
    {
        Schema::dropIfExists('sems');
    }
};
