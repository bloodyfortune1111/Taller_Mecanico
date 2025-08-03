<?php

namespace App\Http\Controllers;

use App\Models\OrdenServicio;
use App\Models\Cliente;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FacturaController extends Controller
{
    // En Laravel 11, el middleware se aplica directamente en las rutas
    // No necesitamos aplicarlo en el constructor
    
    private function verificarPermisos()
    {
        $user = Auth::user();
        if (!$user || !in_array($user->role, ['recepcionista', 'admin'])) {
            abort(403, 'No tienes permisos para acceder a esta funcionalidad');
        }
    }

    /**
     * Mostrar órdenes terminadas y finalizadas para generar facturas
     */
    public function index()
    {
        $this->verificarPermisos();
        
        $ordenesTerminadas = OrdenServicio::with(['cliente', 'vehiculo'])
            ->whereIn('estado', ['finalizado', 'entregado'])
            ->where('pagado', true)
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('facturas.index', compact('ordenesTerminadas'));
    }

    /**
     * Generar factura en PDF
     */
    public function generarFactura($id)
    {
        $this->verificarPermisos();
        $orden = OrdenServicio::with(['cliente', 'vehiculo', 'servicios', 'piezas'])
            ->where('id', $id)
            ->whereIn('estado', ['finalizado', 'entregado'])
            ->where('pagado', true)
            ->firstOrFail();

        // Calcular totales
        $subtotalServicios = $orden->servicios->sum(function ($servicio) {
            return $servicio->pivot->precio_unitario * $servicio->pivot->cantidad;
        });

        $subtotalPiezas = $orden->piezas->sum(function ($pieza) {
            return $pieza->pivot->precio_unitario * $pieza->pivot->cantidad;
        });

        // Usar el total almacenado en la base de datos
        $total = $orden->costo_total;
        $subtotal = $total / 1.16; // Quitar IVA del 16%
        $iva = $total - $subtotal;

        // Datos para la factura
        $datosFactura = [
            'orden' => $orden,
            'subtotalServicios' => $subtotalServicios,
            'subtotalPiezas' => $subtotalPiezas,
            'subtotal' => $subtotal,
            'iva' => $iva,
            'total' => $total,
            'fechaGeneracion' => \Carbon\Carbon::now(),
            'numeroFactura' => 'FACT-' . str_pad($orden->id, 6, '0', STR_PAD_LEFT)
        ];

        $pdf = Pdf::loadView('facturas.factura', $datosFactura);
        
        return $pdf->download('factura-' . $datosFactura['numeroFactura'] . '.pdf');
    }

    /**
     * Vista previa de la factura
     */
    public function preview($id)
    {
        $this->verificarPermisos();
        $orden = OrdenServicio::with(['cliente', 'vehiculo', 'servicios', 'piezas'])
            ->where('id', $id)
            ->whereIn('estado', ['finalizado', 'entregado'])
            ->where('pagado', true)
            ->firstOrFail();

        // Calcular totales
        $subtotalServicios = $orden->servicios->sum(function ($servicio) {
            return $servicio->pivot->precio_unitario * $servicio->pivot->cantidad;
        });

        $subtotalPiezas = $orden->piezas->sum(function ($pieza) {
            return $pieza->pivot->precio_unitario * $pieza->pivot->cantidad;
        });

        // Usar el total almacenado en la base de datos
        $total = $orden->costo_total;
        $subtotal = $total / 1.16; // Quitar IVA del 16%
        $iva = $total - $subtotal;

        // Datos para la factura
        $datosFactura = [
            'orden' => $orden,
            'subtotalServicios' => $subtotalServicios,
            'subtotalPiezas' => $subtotalPiezas,
            'subtotal' => $subtotal,
            'iva' => $iva,
            'total' => $total,
            'fechaGeneracion' => \Carbon\Carbon::now(),
            'numeroFactura' => 'FACT-' . str_pad($orden->id, 6, '0', STR_PAD_LEFT)
        ];

        return view('facturas.factura', $datosFactura);
    }
}
