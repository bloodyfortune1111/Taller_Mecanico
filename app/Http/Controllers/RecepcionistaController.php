<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdenServicio;
use App\Models\Cliente;
use App\Models\Vehiculo;
use App\Models\Servicio;
use App\Models\Pieza;

class RecepcionistaController extends Controller
{
    /**
     * Dashboard para recepcionistas
     */
    public function dashboard()
    {
        // Estadísticas básicas para recepcionistas
        $ordenes_pendientes = OrdenServicio::where('estado', 'pendiente')->count();
        $ordenes_hoy = OrdenServicio::whereDate('created_at', today())->count();
        $clientes_total = Cliente::count();
        $vehiculos_total = Vehiculo::count();
        
        // Órdenes recientes para mostrar en el dashboard
        $ordenes_recientes = OrdenServicio::with(['cliente', 'vehiculo'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('recepcionista.dashboard', compact(
            'ordenes_pendientes',
            'ordenes_hoy', 
            'clientes_total',
            'vehiculos_total',
            'ordenes_recientes'
        ));
    }

    /**
     * Mostrar una orden específica (solo lectura para recepcionistas)
     */
    public function verOrden($id)
    {
        $orden = OrdenServicio::with(['cliente', 'vehiculo'])->findOrFail($id);
        
        return view('recepcionista.orden-detalle', compact('orden'));
    }
}
