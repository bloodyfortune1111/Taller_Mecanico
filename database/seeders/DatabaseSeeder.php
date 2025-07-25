<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuario administrador
        User::factory()->create([
            'name' => 'Admin Alex',
            'email' => 'AdminAlex@taller.com',
            'role' => 'admin'
        ]);

        // Crear usuario mecánico
        User::factory()->create([
            'name' => 'Juan Mecánico',
            'email' => 'mecanico@taller.com', 
            'role' => 'mecanico'
        ]);

        // Crear usuario recepcionista
        User::factory()->create([
            'name' => 'María Recepcionista',
            'email' => 'recepcionista@taller.com',
            'role' => 'recepcionista'
        ]);

        // Ejecutar seeders de datos
        $this->call([
            ServiciosSeeder::class,
            PiezasSeeder::class,
            ClientesSeeder::class,
            VehiculosSeeder::class,
            OrdenesServicioSeeder::class,
        ]);
    }
}
