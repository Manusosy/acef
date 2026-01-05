<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('timeline_achievements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('timeline_year_id')->constrained('timeline_years')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->json('images')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('timeline_achievements');
    }
};
