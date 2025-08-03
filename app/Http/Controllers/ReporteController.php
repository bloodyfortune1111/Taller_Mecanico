<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdenServicio;
use App\Models\Servicio;
use App\Models\Vehiculo;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    /**
     * Mostrar página principal de reportes
     */
    public function index()
    {
        // Calcular estadísticas generales
        $estadisticas = [
            'vehiculos_atendidos' => OrdenServicio::distinct('vehiculo_id')->count(),
            'servicios_realizados' => OrdenServicio::whereIn('estado', ['finalizado', 'entregado'])->count(),
            'ingresos_totales' => OrdenServicio::where('pagado', true)->sum('costo_total'),
            'ordenes_este_mes' => OrdenServicio::whereMonth('created_at', Carbon::now()->month)
                                              ->whereYear('created_at', Carbon::now()->year)
                                              ->count(),
            'ordenes_pendientes' => OrdenServicio::whereIn('estado', ['recibido', 'en_proceso'])->count(),
            'servicios_activos' => Servicio::where('activo', true)->count(),
            'clientes_activos' => DB::table('clientes')
                                    ->whereExists(function ($query) {
                                        $query->select(DB::raw(1))
                                              ->from('orden_servicios')
                                              ->whereRaw('orden_servicios.cliente_id = clientes.id');
                                    })->count(),
            'promedio_orden' => OrdenServicio::where('pagado', true)->avg('costo_total') ?? 0,
        ];

        return view('reportes.index', compact('estadisticas'));
    }

    /**
     * Reporte de vehículos atendidos por mes
     */
    public function vehiculosPorMes(Request $request)
    {
        $año = $request->get('year', Carbon::now()->year);
        $mesActual = Carbon::now()->month;
        
        $vehiculos = OrdenServicio::select(
            DB::raw('MONTH(created_at) as mes'),
            DB::raw('COUNT(DISTINCT vehiculo_id) as total_vehiculos'),
            DB::raw('COUNT(*) as total_ordenes')
        )
        ->whereYear('created_at', $año)
        // Solo mostrar meses hasta el mes actual si es el año actual
        ->when($año == Carbon::now()->year, function($query) use ($mesActual) {
            return $query->where(DB::raw('MONTH(created_at)'), '<=', $mesActual);
        })
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy('mes')
        ->get()
        ->map(function ($item) {
            $meses = [
                1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
                5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
            ];
            $item->nombre_mes = $meses[$item->mes];
            return $item;
        });

        if ($request->has('pdf')) {
            $vehiculosPorMes = $vehiculos;
            $pdf = PDF::loadView('reportes.vehiculos-mes-pdf', compact('vehiculosPorMes', 'año'));
            return $pdf->download('vehiculos-atendidos-' . $año . '.pdf');
        }

        $vehiculosPorMes = $vehiculos;
        return view('reportes.vehiculos-mes', compact('vehiculosPorMes', 'año'));
    }

    /**
     * Reporte de servicios más solicitados
     */
    public function serviciosSolicitados(Request $request)
    {
        $fechaInicio = $request->get('fecha_inicio', Carbon::now()->startOfYear()->format('Y-m-d'));
        $fechaFin = $request->get('fecha_fin', Carbon::now()->format('Y-m-d'));

        $serviciosSolicitados = DB::table('orden_servicio_servicios')
            ->join('servicios', 'servicios.id', '=', 'orden_servicio_servicios.servicio_id')
            ->join('orden_servicios', 'orden_servicios.id', '=', 'orden_servicio_servicios.orden_servicio_id')
            ->select(
                'servicios.nombre',
                'servicios.categoria',
                'servicios.precio_base',
                DB::raw('SUM(orden_servicio_servicios.cantidad) as total_solicitudes'),
                DB::raw('SUM(orden_servicio_servicios.subtotal) as ingresos_totales')
            )
            ->whereBetween('orden_servicios.created_at', [$fechaInicio, $fechaFin])
            ->groupBy('servicios.id', 'servicios.nombre', 'servicios.categoria', 'servicios.precio_base')
            ->orderBy('total_solicitudes', 'desc')
            ->get();

        if ($request->has('pdf')) {
            $pdf = PDF::loadView('reportes.servicios-solicitados-pdf', compact('serviciosSolicitados', 'fechaInicio', 'fechaFin'));
            return $pdf->download('servicios-solicitados.pdf');
        }

        return view('reportes.servicios-solicitados', compact('serviciosSolicitados', 'fechaInicio', 'fechaFin'));
    }

    /**
     * Reporte de ingresos mensuales
     */
    public function ingresosMensuales(Request $request)
    {
        $año = $request->get('year', Carbon::now()->year);
        $mesActual = Carbon::now()->month;
        
        $ingresos = OrdenServicio::select(
            DB::raw('MONTH(created_at) as mes'),
            DB::raw('SUM(costo_total) as total'),
            DB::raw('COUNT(*) as ordenes_completadas'),
            DB::raw('AVG(costo_total) as promedio_por_orden')
        )
        ->whereYear('created_at', $año)
        // Solo mostrar meses hasta el mes actual si es el año actual
        ->when($año == Carbon::now()->year, function($query) use ($mesActual) {
            return $query->where(DB::raw('MONTH(created_at)'), '<=', $mesActual);
        })
        ->where('pagado', true)
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy('mes')
        ->get()
        ->map(function ($item) {
            $meses = [
                1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
                5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
            ];
            $item->mes_nombre = $meses[$item->mes];
            return $item;
        });

        if ($request->has('pdf')) {
            $pdf = PDF::loadView('reportes.ingresos-mensuales-pdf', compact('ingresos'));
            return $pdf->download('ingresos-mensuales-' . $año . '.pdf');
        }

        return view('reportes.ingresos-mensuales', compact('ingresos'));
    }

    /**
     * Reporte de ingresos por servicio
     */
    public function ingresosPorServicio(Request $request)
    {
        $fechaInicio = $request->get('fecha_inicio', Carbon::now()->startOfYear()->format('Y-m-d'));
        $fechaFin = $request->get('fecha_fin', Carbon::now()->format('Y-m-d'));

        $ingresosPorServicio = DB::table('orden_servicio_servicios')
            ->join('servicios', 'servicios.id', '=', 'orden_servicio_servicios.servicio_id')
            ->join('orden_servicios', 'orden_servicios.id', '=', 'orden_servicio_servicios.orden_servicio_id')
            ->select(
                'servicios.nombre as tipo_servicio',
                'servicios.categoria',
                DB::raw('SUM(orden_servicio_servicios.cantidad) as cantidad'),
                DB::raw('SUM(orden_servicio_servicios.subtotal) as total_ingresos'),
                DB::raw('AVG(orden_servicio_servicios.precio_unitario) as precio_promedio')
            )
            ->whereBetween('orden_servicios.created_at', [$fechaInicio, $fechaFin])
            ->where('orden_servicios.pagado', true)
            ->groupBy('servicios.id', 'servicios.nombre', 'servicios.categoria')
            ->orderBy('total_ingresos', 'desc')
            ->get();

        $totalGeneral = $ingresosPorServicio->sum('total_ingresos');

        if ($request->has('pdf')) {
            // Para la vista PDF, usar el nombre de variable que espera la vista
            $ingresos = $ingresosPorServicio;
            $pdf = PDF::loadView('reportes.ingresos-servicio-pdf', compact('ingresos', 'fechaInicio', 'fechaFin', 'totalGeneral'));
            return $pdf->download('ingresos-por-servicio.pdf');
        }

        return view('reportes.ingresos-servicio', compact('ingresosPorServicio', 'fechaInicio', 'fechaFin', 'totalGeneral'));
    }
}
