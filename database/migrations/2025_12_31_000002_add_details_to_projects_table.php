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
            $table->string('location')->nullable()->after('country');
            $table->text('gallery')->nullable()->after('image'); // JSON
            $table->text('objectives')->nullable()->after('description'); // JSON
            $table->string('video_url')->nullable()->after('gallery');
            $table->foreignId('programme_id')->nullable()->constrained()->nullOnDelete()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['programme_id']);
            $table->dropColumn(['location', 'gallery', 'objectives', 'video_url', 'programme_id']);
        });
    }
};
