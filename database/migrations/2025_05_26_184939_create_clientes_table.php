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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id(); // Columna ID autoincremental
            $table->string('nombre'); // Nombre del cliente
            $table->string('apellido')->nullable(); // Apellido del cliente (opcional)
            $table->string('email')->unique(); // Correo electrónico (único)
            $table->string('telefono')->nullable(); // Teléfono (opcional)
            $table->string('direccion')->nullable(); // Dirección (opcional)
            $table->timestamps(); // Columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     * Revierte las migraciones (elimina la tabla).
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};