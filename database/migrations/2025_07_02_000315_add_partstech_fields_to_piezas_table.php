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
        Schema::table('piezas', function (Blueprint $table) {
            // Campos para integración con PartsTech API
            $table->enum('disponibilidad', ['disponible', 'agotado', 'descontinuado'])->default('disponible')->after('categoria');
            $table->string('external_id')->nullable()->after('api_id')->comment('ID externo de PartsTech');
            $table->string('imagen_url')->nullable()->after('external_id')->comment('URL de imagen de la pieza');
            $table->json('especificaciones')->nullable()->after('imagen_url')->comment('Especificaciones técnicas');
            
            // Índices para mejorar rendimiento
            $table->index(['categoria', 'activo']);
            $table->index(['marca', 'activo']);
            $table->index('external_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('piezas', function (Blueprint $table) {
            // Eliminar índices primero
            $table->dropIndex(['categoria', 'activo']);
            $table->dropIndex(['marca', 'activo']);
            $table->dropIndex(['external_id']);
            
            // Eliminar columnas
            $table->dropColumn([
                'disponibilidad',
                'external_id',
                'imagen_url',
                'especificaciones'
            ]);
        });
    }
};
