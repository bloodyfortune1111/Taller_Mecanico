<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClientesSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = [
            [
                'nombre' => 'Carlos',
                'apellido' => 'González López',
                'telefono' => '5551234567',
                'email' => 'carlos.gonzalez@email.com',
                'direccion' => 'Av. Revolución 123, Col. Centro, CDMX',
            ],
            [
                'nombre' => 'María',
                'apellido' => 'Rodríguez Hernández',
                'telefono' => '5552345678',
                'email' => 'maria.rodriguez@gmail.com',
                'direccion' => 'Calle Morelos 456, Col. Roma Norte, CDMX',
            ],
            [
                'nombre' => 'José',
                'apellido' => 'Martínez García',
                'telefono' => '5553456789',
                'email' => 'jose.martinez@hotmail.com',
                'direccion' => 'Insurgentes Sur 789, Col. Del Valle, CDMX',
            ],
            [
                'nombre' => 'Ana',
                'apellido' => 'López Sánchez',
                'telefono' => '5554567890',
                'email' => 'ana.lopez@yahoo.com',
                'direccion' => 'Reforma 321, Col. Juárez, CDMX',
            ],
            [
                'nombre' => 'Roberto',
                'apellido' => 'Hernández Morales',
                'telefono' => '5555678901',
                'email' => 'roberto.hernandez@empresa.com',
                'direccion' => 'Av. Universidad 654, Col. Narvarte, CDMX',
            ],
            [
                'nombre' => 'Patricia',
                'apellido' => 'García Jiménez',
                'telefono' => '5556789012',
                'email' => 'patricia.garcia@outlook.com',
                'direccion' => 'Eje Central 987, Col. Doctores, CDMX',
            ],
            [
                'nombre' => 'Francisco',
                'apellido' => 'Pérez Ruiz',
                'telefono' => '5557890123',
                'email' => 'francisco.perez@gmail.com',
                'direccion' => 'Calzada de Tlalpan 147, Col. Álamos, CDMX',
            ],
            [
                'nombre' => 'Laura',
                'apellido' => 'Sánchez Vargas',
                'telefono' => '5558901234',
                'email' => 'laura.sanchez@empresa.mx',
                'direccion' => 'Viaducto 258, Col. Piedad Narvarte, CDMX',
            ],
            [
                'nombre' => 'Miguel',
                'apellido' => 'Torres Mendoza',
                'telefono' => '5559012345',
                'email' => 'miguel.torres@correo.com',
                'direccion' => 'Periférico Sur 369, Col. Jardines del Pedregal, CDMX',
            ],
            [
                'nombre' => 'Carmen',
                'apellido' => 'Ramírez Castro',
                'telefono' => '5550123456',
                'email' => 'carmen.ramirez@email.mx',
                'direccion' => 'Av. Patriotismo 741, Col. San Pedro de los Pinos, CDMX',
            ]
        ];

        foreach ($clientes as $cliente) {
            Cliente::create($cliente);
        }
    }
}
