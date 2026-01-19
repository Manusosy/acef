<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('who_we_are_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('media_id')->constrained('media_items')->onDelete('cascade');
            $table->string('country')->nullable();
            $table->text('caption')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('who_we_are_images');
    }
};
