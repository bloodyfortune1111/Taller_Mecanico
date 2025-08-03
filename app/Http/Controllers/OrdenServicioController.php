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
use Illuminate\Support\Facades\Auth;

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
        Log::info('Store method called with data:', $request->all());
        
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'mecanico_id' => 'nullable|exists:users,id',
            'diagnostico' => 'nullable|string',
            'costo_total' => 'required|numeric|min:0',
            'estado' => 'required|in:recibido,en_proceso,finalizado,entregado',
            'servicios' => 'nullable|array',
            'servicios.*' => 'exists:servicios,id',
            'piezas' => 'nullable|array',
            'piezas.*.id' => 'exists:piezas,id',
            'piezas.*.cantidad' => 'integer|min:1',
        ]);
        
        Log::info('Validation passed successfully');

        DB::beginTransaction();
        
        try {
            // Crear la orden de servicio
            $data = $request->only([
                'cliente_id',
                'vehiculo_id', 
                'mecanico_id',
                'diagnostico',
                'costo_total',
                'estado'
            ]);
            
            $data['pagado'] = $request->has('pagado');
            
            $ordenServicio = OrdenServicio::create($data);

            // Asociar servicios si se proporcionaron
            if ($request->has('servicios') && is_array($request->servicios)) {
                $serviciosIds = array_filter($request->servicios); // Remover valores vacíos
                if (!empty($serviciosIds)) {
                    $serviciosData = [];
                    foreach ($serviciosIds as $servicioId) {
                        $servicio = Servicio::find($servicioId);
                        if ($servicio) {
                            $serviciosData[$servicioId] = [
                                'cantidad' => 1,
                                'precio_unitario' => $servicio->precio_base,
                                'subtotal' => $servicio->precio_base * 1,
                            ];
                        }
                    }
                    if (!empty($serviciosData)) {
                        $ordenServicio->servicios()->attach($serviciosData);
                    }
                }
            }

            // Validar stock de piezas antes de procesar
            if ($request->has('piezas') && is_array($request->piezas)) {
                $erroresStock = [];
                foreach ($request->piezas as $pieza) {
                    if (isset($pieza['id']) && isset($pieza['cantidad'])) {
                        $piezaModel = Pieza::find($pieza['id']);
                        if ($piezaModel) {
                            $cantidad = (int)$pieza['cantidad'];
                            if ($piezaModel->stock <= 0) {
                                $erroresStock[] = "La pieza '{$piezaModel->nombre}' está agotada (stock: 0)";
                            } elseif ($piezaModel->stock < $cantidad) {
                                $erroresStock[] = "Stock insuficiente para '{$piezaModel->nombre}'. Disponible: {$piezaModel->stock}, Requerido: {$cantidad}";
                            }
                        }
                    }
                }
                
                // Si hay errores de stock, cancelar la operación
                if (!empty($erroresStock)) {
                    DB::rollback();
                    return back()->withInput()
                        ->with('error', 'No se puede crear la orden debido a problemas de stock:<br>' . implode('<br>', $erroresStock));
                }
            }

            // Asociar piezas con cantidades si se proporcionaron
            if ($request->has('piezas') && is_array($request->piezas)) {
                $piezasData = [];
                foreach ($request->piezas as $pieza) {
                    if (isset($pieza['id']) && isset($pieza['cantidad'])) {
                        $piezaModel = Pieza::find($pieza['id']);
                        if ($piezaModel) {
                            $cantidad = (int)$pieza['cantidad'];
                            $piezasData[$pieza['id']] = [
                                'cantidad' => $cantidad,
                                'precio_unitario' => $piezaModel->precio,
                                'subtotal' => $piezaModel->precio * $cantidad,
                            ];
                        }
                    }
                }
                if (!empty($piezasData)) {
                    $ordenServicio->piezas()->attach($piezasData);
                    // Descontar el stock de cada pieza (ya validado previamente)
                    foreach ($request->piezas as $pieza) {
                        if (isset($pieza['id']) && isset($pieza['cantidad'])) {
                            $piezaModel = Pieza::find($pieza['id']);
                            if ($piezaModel) {
                                $cantidad = (int)$pieza['cantidad'];
                                $piezaModel->stock -= $cantidad;
                                $piezaModel->save();
                                Log::info("Stock actualizado para pieza ID {$piezaModel->id}: {$piezaModel->stock} restante");
                            }
                        }
                    }
                }
            }

            // Recalcular el costo total basado en servicios y piezas seleccionados
            $costoServicios = 0;
            foreach ($ordenServicio->servicios as $servicio) {
                $costoServicios += $servicio->precio_base;
            }
            
            $costoPiezas = 0;
            foreach ($ordenServicio->piezas as $pieza) {
                $costoPiezas += $pieza->precio * $pieza->pivot->cantidad;
            }
            
            $costoCalculado = $costoServicios + $costoPiezas;
            $ordenServicio->update(['costo_total' => $costoCalculado]);

            DB::commit();
            
            Log::info('Order created successfully with ID: ' . $ordenServicio->id);
            Log::info('User role: ' . Auth::user()->role);
            
            // Determinar la ruta correcta basada en el rol del usuario
            $redirectRoute = Auth::user()->role === 'admin' 
                ? 'ordenes-servicio.index' 
                : 'recepcionista.ordenes-servicio.index';
            
            Log::info('Redirecting to route: ' . $redirectRoute);
            
            return redirect()->route($redirectRoute)
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
                $serviciosIds = array_filter($request->servicios); // Remover valores vacíos
                $serviciosData = [];
                foreach ($serviciosIds as $servicioId) {
                    $servicio = Servicio::find($servicioId);
                    if ($servicio) {
                        $serviciosData[$servicioId] = [
                            'cantidad' => 1,
                            'precio_unitario' => $servicio->precio_base,
                            'subtotal' => $servicio->precio_base * 1,
                        ];
                    }
                }
                $orden_servicio->servicios()->sync($serviciosData);
            } else {
                $orden_servicio->servicios()->sync([]);
            }

            // Sincronizar piezas con cantidades
            if ($request->has('piezas') && is_array($request->piezas)) {
                $piezasData = [];
                foreach ($request->piezas as $pieza) {
                    if (isset($pieza['id']) && isset($pieza['cantidad'])) {
                        $piezaModel = Pieza::find($pieza['id']);
                        if ($piezaModel) {
                            $cantidad = (int)$pieza['cantidad'];
                            $piezasData[$pieza['id']] = [
                                'cantidad' => $cantidad,
                                'precio_unitario' => $piezaModel->precio,
                                'subtotal' => $piezaModel->precio * $cantidad,
                            ];
                        }
                    }
                }
                $orden_servicio->piezas()->sync($piezasData);
            } else {
                $orden_servicio->piezas()->sync([]);
            }

            // Recalcular el costo total basado en servicios y piezas seleccionados
            $costoCalculado = 0;
            
            // Sumar servicios
            $serviciosSeleccionados = $orden_servicio->servicios()->get();
            foreach ($serviciosSeleccionados as $servicio) {
                $costoCalculado += $servicio->precio_base;
            }
            
            // Sumar piezas
            $piezasSeleccionadas = $orden_servicio->piezas()->get();
            foreach ($piezasSeleccionadas as $pieza) {
                $cantidad = $pieza->pivot->cantidad ?? 1;
                $costoCalculado += $pieza->precio * $cantidad;
            }
            
            // Actualizar el costo total calculado
            $orden_servicio->update(['costo_total' => $costoCalculado]);

            DB::commit();
            
            // Determinar la ruta correcta basada en el rol del usuario
            $redirectRoute = Auth::user()->role === 'admin' 
                ? 'ordenes-servicio.index' 
                : 'recepcionista.ordenes-servicio.index';
            
            return redirect()->route($redirectRoute)
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

    /**
     * Generar recibo PDF para órdenes pagadas
     */
    public function generarRecibo(OrdenServicio $orden_servicio)
    {
        // Verificar que la orden esté pagada
        if (!$orden_servicio->pagado) {
            return redirect()->back()->with('error', 'Solo se pueden generar recibos para órdenes pagadas.');
        }

        // Cargar relaciones necesarias
        $orden_servicio->load(['cliente', 'vehiculo', 'mecanico', 'servicios', 'piezas']);

        // Calcular totales
        $totalServicios = $orden_servicio->servicios->sum('precio_base');
        $totalPiezas = $orden_servicio->piezas->sum(function($pieza) {
            return $pieza->precio * $pieza->pivot->cantidad;
        });

        // Configurar DomPDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('ordenes-servicio.recibo', compact(
            'orden_servicio', 
            'totalServicios', 
            'totalPiezas'
        ));

        // Configuraciones del PDF
        $pdf->setPaper('a4', 'portrait');
        
        // Nombre del archivo
        $nombreArchivo = 'recibo_orden_' . $orden_servicio->id . '_' . date('Y-m-d') . '.pdf';
        
        return $pdf->download($nombreArchivo);
    }
}
