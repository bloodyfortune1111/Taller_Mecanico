<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // La columna 'role' ya existe, solo necesitamos actualizar los valores permitidos
        // en el enum para incluir 'recepcionista'
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'mecanico', 'recepcionista') DEFAULT 'recepcionista'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir al enum original
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'mecanico') DEFAULT 'mecanico'");
    }
};
