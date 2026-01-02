<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_gateway_settings', function (Blueprint $table) {
            $table->id();
            $table->string('gateway'); // stripe, mpesa, paypal, gofundme
            $table->boolean('enabled')->default(false);
            $table->json('config')->nullable(); // API keys, secrets, etc.
            $table->timestamps();
            
            $table->unique('gateway');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_gateway_settings');
    }
};
