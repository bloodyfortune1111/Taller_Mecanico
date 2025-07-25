<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrdenServicio;
use App\Models\Vehiculo;
use App\Models\User;
use Carbon\Carbon;

class OrdenesServicioSeeder extends Seeder
{
    public function run(): void
    {
        $mecanico = User::where('role', 'mecanico')->first();
        
        $ordenes = [
            [
                'cliente_id' => 1,
                'vehiculo_id' => 1, // Nissan Sentra
                'mecanico_id' => $mecanico->id,
                'diagnostico' => 'Aceite sucio y filtro obstruido. Motor en buenas condiciones generales.',
                'servicios_realizar' => 'Cambio de aceite y filtro. Revisión general del motor.',
                'repuestos_necesarios' => 'Aceite 5W-30, Filtro de aceite',
                'costo_total' => 650.00,
                'estado' => 'entregado',
                'pagado' => true,
            ],
            [
                'cliente_id' => 1,
                'vehiculo_id' => 2, // Chevrolet Aveo
                'mecanico_id' => $mecanico->id,
                'diagnostico' => 'Pastillas de freno desgastadas y discos rayados. Requiere cambio.',
                'servicios_realizar' => 'Cambio de pastillas y discos de freno delanteros.',
                'repuestos_necesarios' => 'Pastillas de freno, Discos de freno',
                'costo_total' => 2300.00,
                'estado' => 'entregado',
                'pagado' => true,
            ],
            [
                'cliente_id' => 2,
                'vehiculo_id' => 3, // Toyota Corolla
                'mecanico_id' => $mecanico->id,
                'diagnostico' => 'Sistema de A/C requiere recarga de refrigerante y limpieza.',
                'servicios_realizar' => 'Reparación del sistema de aire acondicionado.',
                'repuestos_necesarios' => 'Refrigerante R134a, Filtro de cabina',
                'costo_total' => 1250.00,
                'estado' => 'en_proceso',
                'pagado' => false,
            ],
            [
                'cliente_id' => 3,
                'vehiculo_id' => 4, // Volkswagen Jetta
                'mecanico_id' => $mecanico->id,
                'diagnostico' => 'Correa de distribución desgastada. Bomba de agua con fugas menores.',
                'servicios_realizar' => 'Cambio de correa de distribución y bomba de agua.',
                'repuestos_necesarios' => 'Kit de distribución, Bomba de agua',
                'costo_total' => 5200.00,
                'estado' => 'entregado',
                'pagado' => true,
            ],
            [
                'cliente_id' => 4,
                'vehiculo_id' => 5, // Honda Civic
                'mecanico_id' => $mecanico->id,
                'diagnostico' => 'Bujías desgastadas y bobinas de encendido con fallas.',
                'servicios_realizar' => 'Reparación del sistema de encendido.',
                'repuestos_necesarios' => 'Bujías, Bobinas de encendido',
                'costo_total' => 1800.00,
                'estado' => 'en_proceso',
                'pagado' => false,
            ],
            [
                'cliente_id' => 5,
                'vehiculo_id' => 6, // Ford Focus
                'mecanico_id' => $mecanico->id,
                'diagnostico' => 'Desalineación por desgaste normal. Llantas en buen estado.',
                'servicios_realizar' => 'Alineación y balanceo de llantas.',
                'repuestos_necesarios' => 'Ninguno',
                'costo_total' => 550.00,
                'estado' => 'entregado',
                'pagado' => true,
            ],
            [
                'cliente_id' => 6,
                'vehiculo_id' => 7, // Nissan March
                'mecanico_id' => $mecanico->id,
                'diagnostico' => 'Pendiente revisión completa.',
                'servicios_realizar' => 'Revisión general de mantenimiento preventivo.',
                'repuestos_necesarios' => 'Por determinar',
                'costo_total' => 0.00,
                'estado' => 'recibido',
                'pagado' => false,
            ],
            [
                'cliente_id' => 7,
                'vehiculo_id' => 8, // Chevrolet Sonic
                'mecanico_id' => $mecanico->id,
                'diagnostico' => 'Clutch desgastado y sincronizadores dañados.',
                'servicios_realizar' => 'Reparación de transmisión manual.',
                'repuestos_necesarios' => 'Kit de clutch, Sincronizadores',
                'costo_total' => 6800.00,
                'estado' => 'entregado',
                'pagado' => true,
            ],
            [
                'cliente_id' => 8,
                'vehiculo_id' => 9, // Hyundai Accent
                'mecanico_id' => $mecanico->id,
                'diagnostico' => 'Amortiguadores delanteros desgastados.',
                'servicios_realizar' => 'Reparación de suspensión delantera.',
                'repuestos_necesarios' => 'Amortiguadores delanteros',
                'costo_total' => 2500.00,
                'estado' => 'en_proceso',
                'pagado' => false,
            ],
            [
                'cliente_id' => 9,
                'vehiculo_id' => 10, // Mazda3
                'mecanico_id' => $mecanico->id,
                'diagnostico' => 'Mantenimiento preventivo rutinario.',
                'servicios_realizar' => 'Cambio de aceite de mantenimiento programado.',
                'repuestos_necesarios' => 'Aceite sintético, Filtro',
                'costo_total' => 750.00,
                'estado' => 'recibido',
                'pagado' => false,
            ]
        ];

        foreach ($ordenes as $orden) {
            OrdenServicio::create($orden);
        }
    }
}
