<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // category_id already exists in create_articles_table migration
            // Only add the additional fields
            $table->json('tags')->nullable()->after('country');
            $table->integer('read_time')->nullable()->after('tags'); // in minutes
            $table->boolean('is_featured')->default(0)->nullable()->after('read_time');
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // Only drop columns we added in up()
            $table->dropColumn(['tags', 'read_time', 'is_featured']);
        });
    }
};
