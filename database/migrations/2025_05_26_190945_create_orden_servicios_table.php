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
        Schema::create('orden_servicios', function (Blueprint $table) {
            $table->id(); // Columna ID autoincremental
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('vehiculo_id')->constrained('vehiculos')->onDelete('cascade');
            $table->foreignId('mecanico_id')->nullable()->constrained('users')->onDelete('set null'); // Asignación de mecánico
            $table->text('diagnostico')->nullable();
            $table->text('servicios_realizar')->nullable(); // Esto podría ser una relación Many-to-Many con un Catálogo de Servicios
            $table->text('repuestos_necesarios')->nullable(); // Esto podría ser una relación Many-to-Many con un Catálogo de Piezas
            $table->decimal('costo_total', 10, 2)->default(0.00);
            $table->enum('estado', ['recibido', 'en_proceso', 'finalizado', 'entregado'])->default('recibido');
            $table->timestamps(); // Columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     * Revierte las migraciones (elimina la tabla).
     */
    public function down(): void
    {
        Schema::dropIfExists('orden_servicios');
    }
};