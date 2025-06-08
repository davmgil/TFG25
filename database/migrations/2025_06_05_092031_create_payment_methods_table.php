<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->string('cardholder_name');
            $table->string('card_number_last4', 4)
                  ->comment('Sólo los últimos 4 dígitos, para mostrar al usuario');
            $table->tinyInteger('expiry_month')->comment('Mes en número (1-12)');
            $table->smallInteger('expiry_year')->comment('Año (e.g. 2025)');
            $table->boolean('is_default')->default(false)
                  ->comment('Marca la tarjeta principal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
