<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServiciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $servicios = [
            // Mantenimiento Preventivo
            [
                'nombre' => 'Cambio de Aceite',
                'descripcion' => 'Cambio de aceite del motor con filtro incluido',
                'precio_base' => 45.00,
                'categoria' => 'Mantenimiento Preventivo',
                'tiempo_estimado' => 30,
                'activo' => true
            ],
            [
                'nombre' => 'Rotación de Llantas',
                'descripcion' => 'Rotación de llantas para desgaste uniforme',
                'precio_base' => 25.00,
                'categoria' => 'Mantenimiento Preventivo',
                'tiempo_estimado' => 45,
                'activo' => true
            ],
            [
                'nombre' => 'Revisión General',
                'descripcion' => 'Revisión completa del vehículo, fluidos y sistemas',
                'precio_base' => 65.00,
                'categoria' => 'Mantenimiento Preventivo',
                'tiempo_estimado' => 90,
                'activo' => true
            ],
            [
                'nombre' => 'Cambio de Filtro de Aire',
                'descripcion' => 'Reemplazo del filtro de aire del motor',
                'precio_base' => 20.00,
                'categoria' => 'Mantenimiento Preventivo',
                'tiempo_estimado' => 15,
                'activo' => true
            ],
            
            // Mantenimiento Mayor
            [
                'nombre' => 'Cambio de Timing Belt',
                'descripcion' => 'Reemplazo de la correa de distribución',
                'precio_base' => 450.00,
                'categoria' => 'Mantenimiento Mayor',
                'tiempo_estimado' => 240,
                'activo' => true
            ],
            [
                'nombre' => 'Cambio de Embrague',
                'descripcion' => 'Reemplazo completo del kit de embrague',
                'precio_base' => 650.00,
                'categoria' => 'Mantenimiento Mayor',
                'tiempo_estimado' => 360,
                'activo' => true
            ],
            [
                'nombre' => 'Overhaul de Motor',
                'descripcion' => 'Reconstrucción completa del motor',
                'precio_base' => 2500.00,
                'categoria' => 'Mantenimiento Mayor',
                'tiempo_estimado' => 720,
                'activo' => true
            ],
            
            // Reparaciones
            [
                'nombre' => 'Reparación de Frenos',
                'descripcion' => 'Cambio de pastillas y discos de freno',
                'precio_base' => 180.00,
                'categoria' => 'Reparación',
                'tiempo_estimado' => 120,
                'activo' => true
            ],
            [
                'nombre' => 'Reparación de Suspensión',
                'descripcion' => 'Reparación de amortiguadores y resortes',
                'precio_base' => 320.00,
                'categoria' => 'Reparación',
                'tiempo_estimado' => 180,
                'activo' => true
            ],
            [
                'nombre' => 'Reparación de Transmisión',
                'descripcion' => 'Reparación de transmisión automática o manual',
                'precio_base' => 850.00,
                'categoria' => 'Reparación',
                'tiempo_estimado' => 480,
                'activo' => true
            ],
            [
                'nombre' => 'Reparación de Aire Acondicionado',
                'descripcion' => 'Reparación y recarga del sistema de A/C',
                'precio_base' => 125.00,
                'categoria' => 'Reparación',
                'tiempo_estimado' => 90,
                'activo' => true
            ],
            
            // Diagnóstico
            [
                'nombre' => 'Diagnóstico Computarizado',
                'descripcion' => 'Diagnóstico con escáner automotriz',
                'precio_base' => 75.00,
                'categoria' => 'Diagnóstico',
                'tiempo_estimado' => 60,
                'activo' => true
            ],
            [
                'nombre' => 'Diagnóstico de Motor',
                'descripcion' => 'Diagnóstico completo del motor',
                'precio_base' => 95.00,
                'categoria' => 'Diagnóstico',
                'tiempo_estimado' => 90,
                'activo' => true
            ],
            [
                'nombre' => 'Diagnóstico Eléctrico',
                'descripcion' => 'Diagnóstico del sistema eléctrico',
                'precio_base' => 85.00,
                'categoria' => 'Diagnóstico',
                'tiempo_estimado' => 75,
                'activo' => true
            ],
            
            // Servicios Especializados
            [
                'nombre' => 'Alineación y Balanceo',
                'descripcion' => 'Alineación de ruedas y balanceo de llantas',
                'precio_base' => 55.00,
                'categoria' => 'Mantenimiento Preventivo',
                'tiempo_estimado' => 60,
                'activo' => true
            ],
            [
                'nombre' => 'Cambio de Bujías',
                'descripcion' => 'Reemplazo de bujías de encendido',
                'precio_base' => 35.00,
                'categoria' => 'Mantenimiento Preventivo',
                'tiempo_estimado' => 45,
                'activo' => true
            ]
        ];

        foreach ($servicios as $servicio) {
            Servicio::create($servicio);
        }
    }
}
