<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MecanicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear mecánicos de prueba
        $mecanicos = [
            [
                'name' => 'Michael García',
                'email' => 'michael@mecanico.com',
                'password' => Hash::make('123456'),
                'role' => 'mecanico',
            ],
            [
                'name' => 'Gus Rodríguez',
                'email' => 'gus@mecanico.com',
                'password' => Hash::make('123456'),
                'role' => 'mecanico',
            ],
            [
                'name' => 'Carlos Méndez',
                'email' => 'carlos@mecanico.com',
                'password' => Hash::make('123456'),
                'role' => 'mecanico',
            ],
        ];

        foreach ($mecanicos as $mecanicoData) {
            User::updateOrCreate(
                ['email' => $mecanicoData['email']],
                $mecanicoData
            );
        }

        echo "Mecánicos creados:\n";
        echo "- Michael García (michael@mecanico.com) - Contraseña: 123456\n";
        echo "- Gus Rodríguez (gus@mecanico.com) - Contraseña: 123456\n";
        echo "- Carlos Méndez (carlos@mecanico.com) - Contraseña: 123456\n\n";
        echo "Ahora debes asignar órdenes de servicio a estos mecánicos desde el panel de administración.\n";
    }
}
