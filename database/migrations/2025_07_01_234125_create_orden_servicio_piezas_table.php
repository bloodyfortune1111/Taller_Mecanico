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
        Schema::create('orden_servicio_piezas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orden_servicio_id')->constrained('orden_servicios')->onDelete('cascade');
            $table->foreignId('pieza_id')->constrained('piezas')->onDelete('cascade');
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2); // Precio al momento de la orden
            $table->decimal('subtotal', 10, 2); // cantidad * precio_unitario
            $table->timestamps();
            
            // Evitar duplicados en la misma orden
            $table->unique(['orden_servicio_id', 'pieza_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orden_servicio_piezas');
    }
};
