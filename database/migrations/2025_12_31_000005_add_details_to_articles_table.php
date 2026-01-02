<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // Drop old column if exists, assuming we can lose data or it's dev
            if (Schema::hasColumn('articles', 'category')) {
                $table->dropColumn('category');
            }
            
            $table->unsignedBigInteger('category_id')->nullable()->after('content');
            $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();
            $table->json('tags')->nullable()->after('category_id');
            $table->integer('read_time')->nullable()->after('tags'); // in minutes
            $table->boolean('is_featured')->default(0)->nullable()->after('read_time');
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id', 'tags', 'read_time', 'is_featured']);
            $table->string('category')->nullable();
        });
    }
};
