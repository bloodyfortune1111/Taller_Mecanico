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
    Schema::create('vehiculos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
        $table->string('marca');
        $table->string('modelo');
        $table->string('placas')->unique();
        $table->year('ano')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
