<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $servicios = [
            [
                'nombre' => 'Cambio de Aceite',
                'descripcion' => 'Cambio de aceite motor y filtro',
                'precio_base' => 45.00,
                'categoria' => 'Mantenimiento',
                'tiempo_estimado' => 30,
                'activo' => true
            ],
            [
                'nombre' => 'Rotación de Neumáticos',
                'descripcion' => 'Rotación y balanceado de neumáticos',
                'precio_base' => 25.00,
                'categoria' => 'Mantenimiento',
                'tiempo_estimado' => 45,
                'activo' => true
            ],
            [
                'nombre' => 'Cambio de Pastillas de Freno',
                'descripcion' => 'Reemplazo de pastillas de freno delanteras o traseras',
                'precio_base' => 120.00,
                'categoria' => 'Reparación',
                'tiempo_estimado' => 90,
                'activo' => true
            ],
            [
                'nombre' => 'Diagnóstico Computarizado',
                'descripcion' => 'Diagnóstico completo del sistema electrónico del vehículo',
                'precio_base' => 75.00,
                'categoria' => 'Diagnóstico',
                'tiempo_estimado' => 60,
                'activo' => true
            ],
            [
                'nombre' => 'Cambio de Bujías',
                'descripcion' => 'Reemplazo de bujías de encendido',
                'precio_base' => 65.00,
                'categoria' => 'Mantenimiento',
                'tiempo_estimado' => 45,
                'activo' => true
            ],
            [
                'nombre' => 'Alineación y Balanceo',
                'descripcion' => 'Alineación de ruedas y balanceo completo',
                'precio_base' => 85.00,
                'categoria' => 'Mantenimiento',
                'tiempo_estimado' => 120,
                'activo' => true
            ],
            [
                'nombre' => 'Cambio de Batería',
                'descripcion' => 'Reemplazo de batería y limpieza de terminales',
                'precio_base' => 35.00,
                'categoria' => 'Instalación',
                'tiempo_estimado' => 20,
                'activo' => true
            ],
            [
                'nombre' => 'Limpieza de Inyectores',
                'descripcion' => 'Limpieza y calibración de inyectores de combustible',
                'precio_base' => 95.00,
                'categoria' => 'Limpieza',
                'tiempo_estimado' => 90,
                'activo' => true
            ],
            [
                'nombre' => 'Cambio de Filtro de Aire',
                'descripcion' => 'Reemplazo del filtro de aire del motor',
                'precio_base' => 20.00,
                'categoria' => 'Mantenimiento',
                'tiempo_estimado' => 15,
                'activo' => true
            ],
            [
                'nombre' => 'Revisión de Frenos',
                'descripcion' => 'Inspección completa del sistema de frenos',
                'precio_base' => 40.00,
                'categoria' => 'Diagnóstico',
                'tiempo_estimado' => 30,
                'activo' => true
            ]
        ];

        foreach ($servicios as $servicio) {
            Servicio::create($servicio);
        }
    }
}
