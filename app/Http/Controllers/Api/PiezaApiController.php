<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pieza;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PiezaApiController extends Controller
{
    /**
     * Obtener todas las piezas activas y en stock
     */
    public function index(): JsonResponse
    {
        $piezas = Pieza::select('id', 'nombre', 'numero_parte', 'descripcion', 'marca', 'precio', 'stock', 'categoria', 'vehiculo_compatible', 'proveedor', 'imagen_url')
            ->where('activo', true)
            ->where('stock', '>', 0)
            ->orderBy('nombre')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $piezas,
            'message' => 'Piezas disponibles obtenidas exitosamente'
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
     * Buscar piezas por nombre, número de parte o descripción
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
        $piezas = Pieza::where('activo', true)
            ->where(function($query) use ($termino) {
                $query->where('nombre', 'like', "%{$termino}%")
                      ->orWhere('numero_parte', 'like', "%{$termino}%")
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
     * Obtener piezas por categoría
     */
    public function porCategoria($categoria): JsonResponse
    {
        $piezas = Pieza::where('activo', true)
            ->where('categoria', $categoria)
            ->orderBy('nombre')
            ->get();
        return response()->json([
            'success' => true,
            'data' => $piezas,
            'categoria' => $categoria,
            'message' => 'Piezas filtradas por categoría'
        ], 200);
    }
}
