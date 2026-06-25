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
        Schema::create('sensor_data', function (Blueprint $table) {
            $table->id();
            $table->float('temperature'); // Untuk DHT22 (Suhu)
            $table->float('humidity');    // Untuk DHT22 (Kelembaban)
            $table->integer('lux');       // Untuk LDR (Kecerahan)
            $table->timestamps();         // Otomatis mencatat waktu (created_at)
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_data');
    }
};
