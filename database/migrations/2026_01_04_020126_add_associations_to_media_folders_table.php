<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('media_folders', function (Blueprint $table) {
            if (!Schema::hasColumn('media_folders', 'project_id')) {
                $table->foreignId('project_id')->nullable()->constrained('projects')->nullOnDelete();
            }
            if (!Schema::hasColumn('media_folders', 'programme_id')) {
                $table->foreignId('programme_id')->nullable()->constrained('programs')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('media_folders', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropForeign(['programme_id']);
            $table->dropColumn(['project_id', 'programme_id']);
        });
    }
};
