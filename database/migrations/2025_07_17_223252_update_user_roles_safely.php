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
        // Primero, verificar roles actuales y normalizarlos
        $invalidUsers = DB::table('users')
            ->whereNotIn('role', ['admin', 'mecanico'])
            ->get();
            
        // Corregir roles inválidos (establecer como 'mecanico' por defecto)
        foreach ($invalidUsers as $user) {
            DB::table('users')
                ->where('id', $user->id)
                ->update(['role' => 'mecanico']);
        }
        
        // Ahora actualizar el ENUM para incluir 'recepcionista'
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'mecanico', 'recepcionista') DEFAULT 'recepcionista'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cambiar cualquier recepcionista a mecanico antes de revertir
        DB::table('users')
            ->where('role', 'recepcionista')
            ->update(['role' => 'mecanico']);
            
        // Revertir al enum original
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'mecanico') DEFAULT 'mecanico'");
    }
};
