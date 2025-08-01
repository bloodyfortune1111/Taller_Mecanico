<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrdenServicio;
use App\Models\Cliente;
use App\Models\Vehiculo;
use App\Models\User;
use App\Models\Servicio;
use App\Models\Pieza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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
        $servicios = Servicio::orderBy('nombre')->get();
        $piezas = Pieza::orderBy('nombre')->get();
        
        return view('ordenes-servicio.create', compact('clientes', 'vehiculos', 'mecanicos', 'servicios', 'piezas'));
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
            'servicios' => 'nullable|array',
            'servicios.*' => 'exists:servicios,id',
            'piezas' => 'nullable|array',
            'piezas.*.id' => 'exists:piezas,id',
            'piezas.*.cantidad' => 'integer|min:1',
        ]);

        DB::beginTransaction();
        
        try {
            // Crear la orden de servicio
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
            
            $ordenServicio = OrdenServicio::create($data);

            // Asociar servicios si se proporcionaron
            if ($request->has('servicios') && is_array($request->servicios)) {
                $ordenServicio->servicios()->attach($request->servicios);
            }

            // Asociar piezas con cantidades si se proporcionaron
            if ($request->has('piezas') && is_array($request->piezas)) {
                $piezasData = [];
                foreach ($request->piezas as $pieza) {
                    if (isset($pieza['id']) && isset($pieza['cantidad'])) {
                        $piezasData[$pieza['id']] = ['cantidad' => $pieza['cantidad']];
                    }
                }
                if (!empty($piezasData)) {
                    $ordenServicio->piezas()->attach($piezasData);
                }
            }

            // Recalcular el costo total basado en servicios y piezas seleccionados
            $costoCalculado = $ordenServicio->calcularCostoTotal();
            $ordenServicio->update(['costo_total' => $costoCalculado]);

            DB::commit();
            
            return redirect()->route('ordenes-servicio.index')
                ->with('success', 'Orden de servicio creada exitosamente.');
                
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error al crear orden de servicio: ' . $e->getMessage());
            
            return back()->withInput()
                ->with('error', 'Hubo un error al crear la orden de servicio: ' . $e->getMessage());
        }
    }

    /**
     * Muestra los detalles de una orden de servicio específica.
     */
    public function show(OrdenServicio $orden_servicio)
    {
        $orden_servicio->load(['cliente', 'vehiculo', 'mecanico', 'servicios', 'piezas']);
        return view('ordenes-servicio.show', ['ordenServicio' => $orden_servicio]);
    }

        /**
     * Muestra el formulario para editar una orden de servicio existente.
     */
    public function edit(OrdenServicio $orden_servicio)
    {
        $orden_servicio->load(['servicios', 'piezas']);
        $clientes = Cliente::all();
        $vehiculos = Vehiculo::all();
        $mecanicos = User::all(); // Ajusta según tu lógica de roles si es necesario
        $servicios = Servicio::orderBy('nombre')->get();
        $piezas = Pieza::orderBy('nombre')->get();
        
        return view('ordenes-servicio.edit', [
            'ordenServicio' => $orden_servicio,
            'clientes' => $clientes,
            'vehiculos' => $vehiculos,
            'mecanicos' => $mecanicos,
            'servicios' => $servicios,
            'piezas' => $piezas
        ]);
    }

    /**
     * Actualiza una orden de servicio existente en la base de datos.
     */
    public function update(Request $request, OrdenServicio $orden_servicio)
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
            'servicios' => 'nullable|array',
            'servicios.*' => 'exists:servicios,id',
            'piezas' => 'nullable|array',
            'piezas.*.id' => 'exists:piezas,id',
            'piezas.*.cantidad' => 'integer|min:1',
        ]);

        DB::beginTransaction();
        
        try {
            // Actualizar los datos básicos de la orden
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
            
            $orden_servicio->update($data);

            // Sincronizar servicios
            if ($request->has('servicios') && is_array($request->servicios)) {
                $orden_servicio->servicios()->sync($request->servicios);
            } else {
                $orden_servicio->servicios()->sync([]);
            }

            // Sincronizar piezas con cantidades
            if ($request->has('piezas') && is_array($request->piezas)) {
                $piezasData = [];
                foreach ($request->piezas as $pieza) {
                    if (isset($pieza['id']) && isset($pieza['cantidad'])) {
                        $piezasData[$pieza['id']] = ['cantidad' => $pieza['cantidad']];
                    }
                }
                $orden_servicio->piezas()->sync($piezasData);
            } else {
                $orden_servicio->piezas()->sync([]);
            }

            // Recalcular el costo total basado en servicios y piezas seleccionados
            $costoCalculado = $orden_servicio->calcularCostoTotal();
            $orden_servicio->update(['costo_total' => $costoCalculado]);

            DB::commit();
            
            return redirect()->route('ordenes-servicio.show', ['orden_servicio' => $orden_servicio->id])
                ->with('success', 'Orden de servicio actualizada exitosamente.');
                
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error al actualizar orden de servicio: ' . $e->getMessage());
            
            return back()->withInput()
                ->with('error', 'Hubo un error al actualizar la orden de servicio: ' . $e->getMessage());
        }
    }

    /**
     * Elimina una orden de servicio específica de la base de datos.
     */
    public function destroy(OrdenServicio $orden_servicio)
    {
        Log::info('=== MÉTODO DESTROY EJECUTADO ===');
        Log::info('ID recibido: ' . $orden_servicio->id);
        try {
            $orden_servicio->delete();
            Log::info('Orden eliminada exitosamente');
            return redirect()->route('ordenes-servicio.index')->with('success', 'Orden de servicio eliminada exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar orden: ' . $e->getMessage());
            Log::error('Trace: ' . $e->getTraceAsString());
            return redirect()->route('ordenes-servicio.index')->with('error', 'Error al eliminar la orden de servicio: ' . $e->getMessage());
        }
    }
}