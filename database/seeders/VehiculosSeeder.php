<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehiculo;
use App\Models\Cliente;

class VehiculosSeeder extends Seeder
{
    public function run(): void
    {
        $vehiculos = [
            [
                'cliente_id' => 1, // Carlos González
                'marca' => 'Nissan',
                'modelo' => 'Sentra',
                'año' => 2018,
                'color' => 'Blanco',
                'matricula' => 'ABC-123-A',
                'kilometraje' => 85000,
                'combustible' => 'Gasolina',
            ],
            [
                'cliente_id' => 1, // Carlos González (segundo auto)
                'marca' => 'Chevrolet',
                'modelo' => 'Aveo',
                'año' => 2015,
                'color' => 'Rojo',
                'matricula' => 'DEF-456-B',
                'kilometraje' => 120000,
                'combustible' => 'Gasolina',
            ],
            [
                'cliente_id' => 2, // María Rodríguez
                'marca' => 'Toyota',
                'modelo' => 'Corolla',
                'año' => 2019,
                'color' => 'Gris',
                'matricula' => 'GHI-789-C',
                'kilometraje' => 65000,
                'combustible' => 'Gasolina',
            ],
            [
                'cliente_id' => 3, // José Martínez
                'marca' => 'Volkswagen',
                'modelo' => 'Jetta',
                'año' => 2017,
                'color' => 'Negro',
                'matricula' => 'JKL-012-D',
                'kilometraje' => 95000,
                'combustible' => 'Gasolina',
            ],
            [
                'cliente_id' => 4, // Ana López
                'marca' => 'Honda',
                'modelo' => 'Civic',
                'año' => 2020,
                'color' => 'Azul',
                'matricula' => 'MNO-345-E',
                'kilometraje' => 45000,
                'combustible' => 'Gasolina',
            ],
            [
                'cliente_id' => 5, // Roberto Hernández
                'marca' => 'Ford',
                'modelo' => 'Focus',
                'año' => 2016,
                'color' => 'Plata',
                'matricula' => 'PQR-678-F',
                'kilometraje' => 110000,
                'combustible' => 'Gasolina',
            ],
            [
                'cliente_id' => 6, // Patricia García
                'marca' => 'Nissan',
                'modelo' => 'March',
                'año' => 2021,
                'color' => 'Verde',
                'matricula' => 'STU-901-G',
                'kilometraje' => 25000,
                'combustible' => 'Gasolina',
            ],
            [
                'cliente_id' => 7, // Francisco Pérez
                'marca' => 'Chevrolet',
                'modelo' => 'Sonic',
                'año' => 2014,
                'color' => 'Amarillo',
                'matricula' => 'VWX-234-H',
                'kilometraje' => 140000,
                'combustible' => 'Gasolina',
            ],
            [
                'cliente_id' => 8, // Laura Sánchez
                'marca' => 'Hyundai',
                'modelo' => 'Accent',
                'año' => 2019,
                'color' => 'Blanco',
                'matricula' => 'YZA-567-I',
                'kilometraje' => 55000,
                'combustible' => 'Gasolina',
            ],
            [
                'cliente_id' => 9, // Miguel Torres
                'marca' => 'Mazda',
                'modelo' => 'Mazda3',
                'año' => 2022,
                'color' => 'Rojo',
                'matricula' => 'BCD-890-J',
                'kilometraje' => 15000,
                'combustible' => 'Gasolina',
            ],
            [
                'cliente_id' => 10, // Carmen Ramírez
                'marca' => 'Kia',
                'modelo' => 'Rio',
                'año' => 2018,
                'color' => 'Gris',
                'matricula' => 'EFG-123-K',
                'kilometraje' => 75000,
                'combustible' => 'Gasolina',
            ]
        ];

        foreach ($vehiculos as $vehiculo) {
            Vehiculo::create($vehiculo);
        }
    }
}
