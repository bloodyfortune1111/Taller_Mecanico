<?php

namespace App\Http\Controllers;

use App\Models\Pieza;
use App\Models\Vehiculo;
use App\Services\PartsTechService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PiezaController extends Controller
{
    protected $partsTechService;

    public function __construct(PartsTechService $partsTechService)
    {
        $this->partsTechService = $partsTechService;
    }

    /**
     * Mostrar una lista del recurso.
     */
    public function index(Request $request)
    {
        // Obtener piezas locales
        $piezasLocales = Pieza::query();
        
        // Aplicar filtros de búsqueda
        if ($request->filled('search')) {
            $search = $request->search;
            $piezasLocales->where(function($query) use ($search) {
                $query->where('nombre', 'like', "%{$search}%")
                      ->orWhere('numero_parte', 'like', "%{$search}%")
                      ->orWhere('categoria', 'like', "%{$search}%")
                      ->orWhere('marca', 'like', "%{$search}%");
            });
        }

        if ($request->filled('categoria')) {
            $piezasLocales->where('categoria', $request->categoria);
        }

        $piezasLocales = $piezasLocales->activas()->paginate(15);

        // Obtener categorías disponibles para los filtros
        $categorias = $this->partsTechService->getAvailableCategories();

        // Buscar piezas en la API de PartsTech (solo si hay búsqueda específica)
        $piezasApi = [];
        if ($request->filled('search_api') && $request->filled('vehiculo_id')) {
            $vehiculo = Vehiculo::find($request->vehiculo_id);
            if ($vehiculo) {
                $piezasApi = $this->partsTechService->searchPartsByVehicle(
                    $vehiculo->año,
                    $vehiculo->marca,
                    $vehiculo->modelo,
                    $vehiculo->motor
                );
            }
        }

        return view('piezas.index', compact('piezasLocales', 'piezasApi', 'categorias'));
    }

    /**
     * Mostrar el formulario para crear un nuevo recurso.
     */
    public function create()
    {
        $categorias = $this->partsTechService->getAvailableCategories();
        return view('piezas.create', compact('categorias'));
    }

    /**
     * Almacenar un recurso recién creado en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero_parte' => 'required|string|max:255|unique:piezas',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria' => 'required|string|max:255',
            'marca' => 'nullable|string|max:255',
            'precio' => 'required|numeric|min:0',
            'disponibilidad' => 'required|in:disponible,agotado,descontinuado',
            'proveedor' => 'nullable|string|max:255',
            'activo' => 'boolean'
        ]);

        $data = $request->all();
        $data['activo'] = $request->has('activo');

        Pieza::create($data);
        
        return redirect()->route('piezas.index')
                        ->with('success', 'Pieza creada exitosamente.');
    }

    /**
     * Mostrar el recurso especificado.
     */
    public function show(Pieza $pieza)
    {
        return view('piezas.show', compact('pieza'));
    }

    /**
     * Mostrar el formulario para editar el recurso especificado.
     */
    public function edit(Pieza $pieza)
    {
        $categorias = $this->partsTechService->getAvailableCategories();
        return view('piezas.edit', compact('pieza', 'categorias'));
    }

    /**
     * Actualizar el recurso especificado en la base de datos.
     */
    public function update(Request $request, Pieza $pieza)
    {
        $request->validate([
            'numero_parte' => 'required|string|max:255|unique:piezas,numero_parte,' . $pieza->id,
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria' => 'required|string|max:255',
            'marca' => 'nullable|string|max:255',
            'precio' => 'required|numeric|min:0',
            'disponibilidad' => 'required|in:disponible,agotado,descontinuado',
            'proveedor' => 'nullable|string|max:255',
            'activo' => 'boolean'
        ]);

        $data = $request->all();
        $data['activo'] = $request->has('activo');

        $pieza->update($data);
        
        return redirect()->route('piezas.index')
                        ->with('success', 'Pieza actualizada exitosamente.');
    }

    /**
     * Eliminar el recurso especificado de la base de datos.
     */
    public function destroy(Pieza $pieza)
    {
        try {
            $pieza->delete();
            return redirect()->route('piezas.index')
                            ->with('success', 'Pieza eliminada exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar pieza: ' . $e->getMessage());
            return redirect()->route('piezas.index')
                            ->with('error', 'Error al eliminar la pieza.');
        }
    }

    /**
     * API: Obtener piezas para solicitudes AJAX
     */
    public function getPiezas(Request $request)
    {
        $query = Pieza::activas();

        // Aplicar filtro de búsqueda si existe
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('numero_parte', 'like', "%{$search}%");
            });
        }

        // Aplicar filtro de categoría si existe
        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        $piezas = $query->select('id', 'numero_parte', 'nombre', 'precio', 'categoria', 'marca')
                       ->limit(50)
                       ->get();

        return response()->json($piezas);
    }

    /**
     * Buscar piezas en la API de PartsTech
     */
    public function searchPartsTech(Request $request)
    {
        $request->validate([
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'categoria' => 'nullable|string'
        ]);

        $vehiculo = Vehiculo::findOrFail($request->vehiculo_id);
        
        try {
            // Buscar por categoría específica si se proporciona
            if ($request->filled('categoria')) {
                $piezas = $this->partsTechService->searchPartsByCategory(
                    $request->categoria,
                    $vehiculo->año,
                    $vehiculo->marca,
                    $vehiculo->modelo
                );
            } else {
                // Buscar todas las piezas compatibles con el vehículo
                $piezas = $this->partsTechService->searchPartsByVehicle(
                    $vehiculo->año,
                    $vehiculo->marca,
                    $vehiculo->modelo,
                    $vehiculo->motor
                );
            }

            return response()->json([
                'success' => true,
                'piezas' => $piezas
            ]);

        } catch (\Exception $e) {
            Log::error('Error en búsqueda PartsTech: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error al buscar piezas en PartsTech'
            ], 500);
        }
    }

    /**
     * Importar una pieza desde la API de PartsTech al catálogo local
     */
    public function importFromPartsTech(Request $request)
    {
        $request->validate([
            'part_number' => 'required|string',
            'external_id' => 'nullable|string'
        ]);

        try {
            // Obtener los detalles completos de la pieza desde PartsTech
            $partDetails = $this->partsTechService->getPartDetails($request->part_number);
            
            if (!$partDetails) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se pudo obtener información de la pieza'
                ], 404);
            }

            // Verificar si la pieza ya existe en el catálogo local
            $piezaExistente = Pieza::where('numero_parte', $partDetails['part_number'])->first();
            
            if ($piezaExistente) {
                return response()->json([
                    'success' => false,
                    'message' => 'La pieza ya existe en el catálogo local'
                ], 409);
            }

            // Crear la nueva pieza en el catálogo local
            $pieza = Pieza::create([
                'numero_parte' => $partDetails['part_number'],
                'nombre' => $partDetails['name'],
                'descripcion' => $partDetails['description'],
                'categoria' => $partDetails['category'],
                'marca' => $partDetails['brand'],
                'precio' => $partDetails['price'],
                'disponibilidad' => $partDetails['availability'] === 'in_stock' ? 'disponible' : 'agotado',
                'proveedor' => 'PartsTech',
                'external_id' => $partDetails['external_id'],
                'imagen_url' => $partDetails['image_url'],
                'especificaciones' => json_encode($partDetails['specifications']),
                'activo' => true
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pieza importada exitosamente',
                'pieza' => $pieza
            ]);

        } catch (\Exception $e) {
            Log::error('Error al importar pieza: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error al importar la pieza'
            ], 500);
        }
    }

    /**
     * Verificar la conectividad con la API de PartsTech
     */
    public function testPartsTechConnection()
    {
        $isConnected = $this->partsTechService->testConnection();
        
        return response()->json([
            'connected' => $isConnected,
            'message' => $isConnected ? 'Conexión exitosa' : 'Error de conexión'
        ]);
    }
}
