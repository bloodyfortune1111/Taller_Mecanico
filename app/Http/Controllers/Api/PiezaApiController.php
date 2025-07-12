<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pieza;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PiezaApiController extends Controller
{
    /**
     * Obtener todas las piezas disponibles
     */
    public function index(): JsonResponse
    {
        $piezas = Pieza::select('id', 'numero_parte', 'nombre', 'precio', 'categoria', 'marca', 'descripcion')
            ->where('activo', true)
            ->orderBy('categoria')
            ->orderBy('nombre')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $piezas,
            'message' => 'Piezas obtenidas exitosamente'
        ], 200);
    }

    /**
     * Obtener piezas por categoría
     */
    public function porCategoria(Request $request): JsonResponse
    {
        $categoria = $request->query('categoria');
        
        $query = Pieza::select('id', 'numero_parte', 'nombre', 'precio', 'categoria', 'marca', 'descripcion')
            ->where('activo', true)
            ->orderBy('nombre');

        if ($categoria) {
            $query->where('categoria', $categoria);
        }

        $piezas = $query->get();

        return response()->json([
            'success' => true,
            'data' => $piezas,
            'categoria' => $categoria,
            'message' => 'Piezas filtradas por categoría'
        ], 200);
    }

    /**
     * Buscar piezas por nombre, número de parte o marca
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

        $piezas = Pieza::select('id', 'numero_parte', 'nombre', 'precio', 'categoria', 'marca', 'descripcion')
            ->where('activo', true)
            ->where(function($query) use ($termino) {
                $query->where('nombre', 'like', "%{$termino}%")
                      ->orWhere('numero_parte', 'like', "%{$termino}%")
                      ->orWhere('marca', 'like', "%{$termino}%")
                      ->orWhere('descripcion', 'like', "%{$termino}%");
            })
            ->orderBy('nombre')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $piezas,
            'termino_busqueda' => $termino,
            'resultados' => $piezas->count(),
            'message' => 'Búsqueda completada'
        ], 200);
    }

    /**
     * Obtener una pieza específica
     */
    public function show($id): JsonResponse
    {
        $pieza = Pieza::find($id);

        if (!$pieza) {
            return response()->json([
                'success' => false,
                'message' => 'Pieza no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $pieza,
            'message' => 'Pieza obtenida exitosamente'
        ], 200);
    }

    /**
     * Obtener piezas por marca
     */
    public function porMarca(Request $request): JsonResponse
    {
        $marca = $request->query('marca');
        
        $query = Pieza::select('id', 'numero_parte', 'nombre', 'precio', 'categoria', 'marca', 'descripcion')
            ->where('activo', true)
            ->orderBy('nombre');

        if ($marca) {
            $query->where('marca', $marca);
        }

        $piezas = $query->get();

        return response()->json([
            'success' => true,
            'data' => $piezas,
            'marca' => $marca,
            'message' => 'Piezas filtradas por marca'
        ], 200);
    }

    /**
     * Obtener estadísticas de piezas
     */
    public function estadisticas(): JsonResponse
    {
        $stats = [
            'total_piezas' => Pieza::where('activo', true)->count(),
            'por_categoria' => Pieza::select('categoria')
                ->selectRaw('COUNT(*) as total')
                ->where('activo', true)
                ->groupBy('categoria')
                ->get(),
            'por_marca' => Pieza::select('marca')
                ->selectRaw('COUNT(*) as total')
                ->where('activo', true)
                ->groupBy('marca')
                ->get(),
            'precio_promedio' => Pieza::where('activo', true)->avg('precio'),
            'pieza_mas_cara' => Pieza::where('activo', true)->orderBy('precio', 'desc')->first(),
            'pieza_mas_barata' => Pieza::where('activo', true)->orderBy('precio', 'asc')->first(),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats,
            'message' => 'Estadísticas de piezas obtenidas'
        ], 200);
    }

    /**
     * Obtener categorías disponibles
     */
    public function categorias(): JsonResponse
    {
        $categorias = Pieza::select('categoria')
            ->where('activo', true)
            ->distinct()
            ->orderBy('categoria')
            ->pluck('categoria');

        return response()->json([
            'success' => true,
            'data' => $categorias,
            'message' => 'Categorías de piezas obtenidas'
        ], 200);
    }

    /**
     * Obtener marcas disponibles
     */
    public function marcas(): JsonResponse
    {
        $marcas = Pieza::select('marca')
            ->where('activo', true)
            ->distinct()
            ->orderBy('marca')
            ->pluck('marca');

        return response()->json([
            'success' => true,
            'data' => $marcas,
            'message' => 'Marcas de piezas obtenidas'
        ], 200);
    }
}
