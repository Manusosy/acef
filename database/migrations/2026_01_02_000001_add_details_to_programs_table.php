<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->decimal('funding_goal', 15, 2)->nullable();
            $table->decimal('funding_raised', 15, 2)->nullable();
            $table->string('duration')->nullable(); // e.g. "5 Years"
            $table->string('location')->nullable(); // e.g. "Rift Valley, Kenya"
            $table->string('factsheet')->nullable(); // PDF path
        });
    }

    public function down()
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn(['funding_goal', 'funding_raised', 'duration', 'location', 'factsheet']);
        });
    }
};
