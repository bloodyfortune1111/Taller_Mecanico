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
        Schema::create('piezas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre de la pieza
            $table->string('numero_parte')->nullable(); // Número de parte del fabricante
            $table->text('descripcion')->nullable();
            $table->string('marca')->nullable(); // Marca de la pieza
            $table->decimal('precio', 10, 2); // Precio actual
            $table->integer('stock')->default(0); // Stock disponible
            $table->string('categoria')->nullable(); // Motor, Frenos, etc.
            $table->string('vehiculo_compatible')->nullable(); // Compatibilidad
            $table->string('proveedor')->nullable(); // De dónde viene la pieza
            $table->string('api_id')->nullable(); // ID en la API externa
            $table->json('api_data')->nullable(); // Datos adicionales de la API
            $table->boolean('activo')->default(true);
            $table->timestamps();
            
            // Índices para búsqueda
            $table->index(['numero_parte', 'marca']);
            $table->index('categoria');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('piezas');
    }
};
