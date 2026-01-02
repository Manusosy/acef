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
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('file_path')->nullable();
            $table->string('type')->default('Report');
            $table->string('category')->nullable();
            $table->string('size')->nullable();
            $table->string('year')->nullable();
            $table->boolean('is_locked')->default(false);
            $table->timestamps();
        });

        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role');
            $table->string('image')->nullable();
            $table->string('group')->default('staff'); // leadership, staff
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('accreditations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('acronym')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accreditations');
        Schema::dropIfExists('team_members');
        Schema::dropIfExists('resources');
    }
};
