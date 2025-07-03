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
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre del servicio (ej: "Cambio de aceite")
            $table->text('descripcion')->nullable(); // Descripción detallada
            $table->decimal('precio_base', 10, 2); // Precio base del servicio
            $table->string('categoria')->nullable(); // Categoría (ej: "Mantenimiento", "Reparación")
            $table->integer('tiempo_estimado')->nullable(); // Tiempo en minutos
            $table->boolean('activo')->default(true); // Si el servicio está disponible
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
