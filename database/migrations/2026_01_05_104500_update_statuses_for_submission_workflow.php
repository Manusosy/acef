<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add pending to programs (currently: draft, published, archived)
        // Using string to avoid enum modification issues across different DBs if possible, 
        // but enum is fine if we match existing style.
        Schema::table('programs', function (Blueprint $table) {
            $table->string('status')->default('draft')->change();
        });

        // Add pending and draft to projects (currently: ongoing, completed, starting)
        Schema::table('projects', function (Blueprint $table) {
            $table->string('status')->default('draft')->change();
        });
    }

    public function down(): void
    {
        // Revert to original enums if necessary, but string is safer for now
    }
};
