<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OrdenServicio;
use App\Models\Cliente;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Log;

class TestDeleteOrden extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:delete-orden';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prueba la eliminación de una orden de servicio';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Iniciando prueba de eliminación de orden...');
        
        // Verificar si hay órdenes existentes
        $ordenesCount = OrdenServicio::count();
        $this->info("Total de órdenes en la base de datos: $ordenesCount");
        
        if ($ordenesCount == 0) {
            $this->info('No hay órdenes existentes. Creando una orden de prueba...');
            
            // Verificar si hay clientes y vehículos
            $cliente = Cliente::first();
            $vehiculo = Vehiculo::first();
            
            if (!$cliente || !$vehiculo) {
                $this->error('No hay clientes o vehículos en la base de datos. Necesarios para crear una orden de prueba.');
                return;
            }
            
            // Crear orden de prueba
            $orden = OrdenServicio::create([
                'cliente_id' => $cliente->id,
                'vehiculo_id' => $vehiculo->id,
                'diagnostico' => 'Orden para probar eliminación web',
                'servicios_realizar' => 'Prueba de eliminación web',
                'costo_total' => 150.00,
                'estado' => 'recibido',
                'pagado' => false
            ]);
            
            $this->info("Orden de prueba creada con ID: {$orden->id}");
            $this->info("NO SE ELIMINARÁ - Solo se creó para probar la interfaz web");
            return; // No eliminar, solo crear
        } else {
            $this->info('Ya hay órdenes en la base de datos. No se creará una nueva.');
            return;
        }
    }
}
