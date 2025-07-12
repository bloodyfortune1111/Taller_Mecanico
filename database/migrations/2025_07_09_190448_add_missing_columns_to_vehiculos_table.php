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
        Schema::table('vehiculos', function (Blueprint $table) {
            // Renombrar 'placas' a 'matricula' para consistencia
            $table->renameColumn('placas', 'matricula');
            
            // Agregar columnas faltantes que el modelo espera
            $table->string('color')->nullable()->after('modelo');
            $table->string('combustible')->nullable()->after('color');
            $table->integer('kilometraje')->nullable()->after('combustible');
            
            // Renombrar 'ano' a 'año' para consistencia
            $table->renameColumn('ano', 'año');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehiculos', function (Blueprint $table) {
            // Revertir los cambios
            $table->renameColumn('matricula', 'placas');
            $table->dropColumn(['color', 'combustible', 'kilometraje']);
            $table->renameColumn('año', 'ano');
        });
    }
};
