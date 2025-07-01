<?php

namespace App\Http\Controllers;

use App\Models\OrdenServicio;
use App\Models\Cliente;
use App\Models\Vehiculo;
use App\Models\User;
use Illuminate\Http\Request;

class OrdenServicioController extends Controller
{
    /**
     * Muestra una lista de las órdenes de servicio.
     */
    public function index()
    {
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
            'pagado' => 'boolean',
        ]);
    
        $data = $request->all();
        $data['pagado'] = $request->has('pagado') ? true : false;
        
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
    public function edit(string $ordenServicioId)
    {
        
        $ordenServicio = OrdenServicio::findOrFail((int) $ordenServicioId);
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
            'pagado' => 'boolean',
        ]);

        $data = $request->all();
        $data['pagado'] = $request->has('pagado') ? true : false;
        
        $ordenServicio->update($data);
        return redirect()->route('ordenes-servicio.index')->with('success', 'Orden de servicio actualizada exitosamente.');
    }

    /**
     * Elimina una orden de servicio específica de la base de datos.
     */
    public function destroy(OrdenServicio $ordenServicio)
    {
        $ordenServicio->delete();
        return redirect()->route('ordenes-servicio.index')->with('success', 'Orden de servicio eliminada exitosamente.');
    }
}
