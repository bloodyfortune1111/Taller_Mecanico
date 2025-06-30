<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Ejecuta las migraciones (crea la tabla).
     */
    public function up(): void
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id(); // Columna ID autoincremental
            // Define la clave foránea para relacionar con la tabla 'clientes'
            $table->foreignId('cliente_id')->constrained()->onDelete('cascade');
            $table->string('marca'); // Marca del vehículo
            $table->string('modelo'); // Modelo del vehículo
            $table->integer('ano')->nullable(); // Año del vehículo (opcional)
            $table->string('matricula')->unique(); // Matrícula (única)
            $table->string('color')->nullable(); // Color (opcional)
            $table->timestamps(); // Columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     * Revierte las migraciones (elimina la tabla).
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};