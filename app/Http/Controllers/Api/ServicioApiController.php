<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ServicioApiController extends Controller
{
    /**
     * Obtener todos los servicios disponibles
     */
    public function index(): JsonResponse
    {
        $servicios = Servicio::select('id', 'nombre', 'descripcion', 'precio_base as precio', 'tiempo_estimado as duracion_estimada', 'categoria')
            ->where('activo', true)
            ->orderBy('categoria')
            ->orderBy('nombre')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $servicios,
            'message' => 'Servicios obtenidos exitosamente'
        ], 200);
    }

    /**
     * Obtener servicios por categoría
     */
    public function porCategoria(Request $request): JsonResponse
    {
        $categoria = $request->query('categoria');
        
        $query = Servicio::select('id', 'nombre', 'descripcion', 'precio_base as precio', 'tiempo_estimado as duracion_estimada', 'categoria')
            ->where('activo', true)
            ->orderBy('nombre');

        if ($categoria) {
            $query->where('categoria', $categoria);
        }

        $servicios = $query->get();

        return response()->json([
            'success' => true,
            'data' => $servicios,
            'categoria' => $categoria,
            'message' => 'Servicios filtrados por categoría'
        ], 200);
    }

    /**
     * Buscar servicios por nombre o descripción
     */
    public function buscar(Request $request): JsonResponse
    {
        $termino = $request->query('q');
        
        if (!$termino) {
            return response()->json([
                'success' => false,
                'message' => 'El parámetro de búsqueda "q" es requerido'
            ], 400);
        }

        $servicios = Servicio::select('id', 'nombre', 'descripcion', 'precio_base as precio', 'tiempo_estimado as duracion_estimada', 'categoria')
            ->where('activo', true)
            ->where(function($query) use ($termino) {
                $query->where('nombre', 'like', "%{$termino}%")
                      ->orWhere('descripcion', 'like', "%{$termino}%");
            })
            ->orderBy('nombre')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $servicios,
            'termino_busqueda' => $termino,
            'resultados' => $servicios->count(),
            'message' => 'Búsqueda completada'
        ], 200);
    }

    /**
     * Obtener un servicio específico
     */
    public function show($id): JsonResponse
    {
        $servicio = Servicio::find($id);

        if (!$servicio) {
            return response()->json([
                'success' => false,
                'message' => 'Servicio no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $servicio,
            'message' => 'Servicio obtenido exitosamente'
        ], 200);
    }

    /**
     * Obtener servicios recomendados por tipo de vehículo
     */
    public function recomendados(Request $request): JsonResponse
    {
        $tipoVehiculo = $request->query('tipo_vehiculo');
        $kilometraje = $request->query('kilometraje');
        
        $query = Servicio::select('id', 'nombre', 'descripcion', 'precio_base as precio', 'tiempo_estimado as duracion_estimada', 'categoria')
            ->where('activo', true)
            ->orderBy('categoria')
            ->orderBy('nombre');

        // Lógica de recomendación basada en kilometraje
        if ($kilometraje) {
            $km = intval($kilometraje);
            if ($km > 100000) {
                $query->whereIn('categoria', ['Mantenimiento Mayor', 'Reparación']);
            } elseif ($km > 50000) {
                $query->whereIn('categoria', ['Mantenimiento Preventivo', 'Mantenimiento Mayor']);
            } else {
                $query->where('categoria', 'Mantenimiento Preventivo');
            }
        }

        $servicios = $query->get();

        return response()->json([
            'success' => true,
            'data' => $servicios,
            'criterios' => [
                'tipo_vehiculo' => $tipoVehiculo,
                'kilometraje' => $kilometraje
            ],
            'message' => 'Servicios recomendados obtenidos'
        ], 200);
    }

    /**
     * Obtener estadísticas de servicios
     */
    public function estadisticas(): JsonResponse
    {
        $stats = [
            'total_servicios' => Servicio::count(),
            'por_categoria' => Servicio::select('categoria')
                ->selectRaw('COUNT(*) as total')
                ->groupBy('categoria')
                ->get(),
            'precio_promedio' => Servicio::avg('precio'),
            'servicio_mas_caro' => Servicio::orderBy('precio', 'desc')->first(),
            'servicio_mas_barato' => Servicio::orderBy('precio', 'asc')->first(),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats,
            'message' => 'Estadísticas de servicios obtenidas'
        ], 200);
    }
}
