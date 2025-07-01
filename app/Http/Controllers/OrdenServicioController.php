<?php

namespace App\Http\Controllers;

use App\Models\OrdenServicio;
use App\Models\Cliente;
use App\Models\Vehiculo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrdenServicioController extends Controller
{
    public function __construct()
    {
        Log::info('OrdenServicioController constructor ejecutado');
    }

    /**
     * Muestra una lista de las órdenes de servicio.
     */
    public function index()
    {
        Log::info('Método index de OrdenServicioController ejecutado');
        $ordenesServicio = OrdenServicio::with(['cliente', 'vehiculo', 'mecanico'])->get();
        return view('ordenes-servicio.index', compact('ordenesServicio'));
    }

    /**
     * Muestra el formulario para crear una nueva orden de servicio.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $vehiculos = Vehiculo::all();
        $mecanicos = User::all(); // Ajusta según tu lógica de roles si es necesario
        
        return view('ordenes-servicio.create', compact('clientes', 'vehiculos', 'mecanicos'));
    }

    /**
     * Almacena una nueva orden de servicio en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'mecanico_id' => 'nullable|exists:users,id',
            'diagnostico' => 'nullable|string',
            'servicios_realizar' => 'nullable|string',
            'repuestos_necesarios' => 'nullable|string',
            'costo_total' => 'required|numeric|min:0',
            'estado' => 'required|in:recibido,en_proceso,finalizado,entregado',
        ]);
    
        $data = $request->only([
            'cliente_id',
            'vehiculo_id', 
            'mecanico_id',
            'diagnostico',
            'servicios_realizar',
            'repuestos_necesarios',
            'costo_total',
            'estado'
        ]);
        
        $data['pagado'] = $request->has('pagado');
        
        OrdenServicio::create($data);
        return redirect()->route('ordenes-servicio.index')->with('success', 'Orden de servicio creada exitosamente.');
    }

    /**
     * Muestra los detalles de una orden de servicio específica.
     */
    public function show(string $ordenServicio)
    {
        $ordenServicio = OrdenServicio::with(['cliente', 'vehiculo', 'mecanico'])->findOrFail((int) $ordenServicio);
        return view('ordenes-servicio.show', compact('ordenServicio'));
    }

    /**
     * Muestra el formulario para editar una orden de servicio existente.
     */
    public function edit(OrdenServicio $ordenServicio)
    {
        $clientes = Cliente::all();
        $vehiculos = Vehiculo::all();
        $mecanicos = User::all(); // Ajusta según tu lógica de roles si es necesario
        
        return view('ordenes-servicio.edit', compact('ordenServicio', 'clientes', 'vehiculos', 'mecanicos'));
    }

    /**
     * Actualiza una orden de servicio existente en la base de datos.
     */
    public function update(Request $request, OrdenServicio $ordenServicio)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'mecanico_id' => 'nullable|exists:users,id',
            'diagnostico' => 'nullable|string',
            'servicios_realizar' => 'nullable|string',
            'repuestos_necesarios' => 'nullable|string',
            'costo_total' => 'required|numeric|min:0',
            'estado' => 'required|in:recibido,en_proceso,finalizado,entregado',
        ]);

        $data = $request->only([
            'cliente_id',
            'vehiculo_id', 
            'mecanico_id',
            'diagnostico',
            'servicios_realizar',
            'repuestos_necesarios',
            'costo_total',
            'estado'
        ]);
        
        $data['pagado'] = $request->has('pagado');
        
        $ordenServicio->update($data);
        return redirect()->route('ordenes-servicio.index')->with('success', 'Orden de servicio actualizada exitosamente.');
    }

    /**
     * Elimina una orden de servicio específica de la base de datos.
     */
    public function destroy(string $id)
    {
        // Log muy específico para saber si el método se ejecuta
        Log::info('=== MÉTODO DESTROY EJECUTADO ===');
        Log::info('ID recibido como string: ' . $id);
        
        try {
            // Buscar la orden manualmente
            $ordenServicio = OrdenServicio::findOrFail($id);
            Log::info('Orden encontrada: ' . json_encode($ordenServicio->toArray()));
            Log::info('Intentando eliminar orden ID: ' . $ordenServicio->id);
            
            $ordenServicio->delete();
            Log::info('Orden eliminada exitosamente');
            return redirect()->route('ordenes-servicio.index')->with('success', 'Orden de servicio eliminada exitosamente.');
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Orden no encontrada con ID: ' . $id);
            return redirect()->route('ordenes-servicio.index')->with('error', 'Error: No se pudo encontrar la orden de servicio.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar orden: ' . $e->getMessage());
            Log::error('Trace: ' . $e->getTraceAsString());
            return redirect()->route('ordenes-servicio.index')->with('error', 'Error al eliminar la orden de servicio: ' . $e->getMessage());
        }
    }
}
