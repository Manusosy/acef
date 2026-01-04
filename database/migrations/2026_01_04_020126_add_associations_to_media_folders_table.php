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
        // Columns added manually via Raw SQL due to SQLite driver issues in this environment
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('media_folders', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropForeign(['programme_id']);
            $table->dropColumn(['project_id', 'programme_id']);
        });
    }
};
