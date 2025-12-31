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
        Schema::table('projects', function (Blueprint $table) {
            // Drop column to avoid doctrine/dbal requirement
            $table->dropColumn('country');
        });
        
        Schema::table('projects', function (Blueprint $table) {
            // Re-add as text/json
            $table->text('country')->after('category')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('country');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->string('country')->after('category');
        });
    }
};
