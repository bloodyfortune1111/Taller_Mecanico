<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo; // Importa el modelo Vehiculo
use App\Models\Cliente; // Importa el modelo Cliente para las relaciones
use Illuminate\Http\Request; // Para manejar las solicitudes HTTP
use Illuminate\Support\Facades\Validator; // Para validación de datos

class VehiculoController extends Controller
{
    /**
     * Muestra una lista de todos los vehículos.
     * Opcionalmente, filtra por cliente si se pasa un cliente_id.
     */
    public function index(Request $request)
    {
        $vehiculos = Vehiculo::query();

        // Si se pasa un cliente_id en la URL, filtra los vehículos por ese cliente
        if ($request->has('cliente_id')) {
            $vehiculos->where('cliente_id', $request->cliente_id);
        }

        $vehiculos = $vehiculos->get();
        // Obtiene todos los clientes para el select de creación/edición si es necesario
        $clientes = Cliente::all();

        return view('vehiculos.index', compact('vehiculos', 'clientes'));
    }

    /**
     * Muestra el formulario para crear un nuevo vehículo.
     */
    public function create()
    {
        // Necesitamos la lista de clientes para asignar el vehículo a un cliente
        $clientes = Cliente::all();
        return view('vehiculos.create', compact('clientes'));
    }

    /**
     * Almacena un nuevo vehículo en la base de datos.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cliente_id' => 'required|exists:clientes,id', // Debe existir un cliente con ese ID
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'ano' => 'nullable|integer|min:1900|max:' . (date('Y') + 1), // Año válido
            'matricula' => 'required|string|max:20|unique:vehiculos', // Matrícula única
            'color' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->route('vehiculos.create')
                             ->withErrors($validator)
                             ->withInput();
        }

        Vehiculo::create($request->all());

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo creado exitosamente.');
    }

    /**
     * Muestra los detalles de un vehículo específico.
     */
    public function show(Vehiculo $vehiculo)
    {
        return view('vehiculos.show', compact('vehiculo'));
    }

    /**
     * Muestra el formulario para editar un vehículo existente.
     */
    public function edit(Vehiculo $vehiculo)
    {
        $clientes = Cliente::all(); // Necesitamos los clientes para el select
        return view('vehiculos.edit', compact('vehiculo', 'clientes'));
    }

    /**
     * Actualiza un vehículo existente en la base de datos.
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        $validator = Validator::make($request->all(), [
            'cliente_id' => 'required|exists:clientes,id',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'ano' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'matricula' => 'required|string|max:20|unique:vehiculos,matricula,' . $vehiculo->id, // Matrícula única, excepto para el vehículo actual
            'color' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->route('vehiculos.edit', $vehiculo->id)
                             ->withErrors($validator)
                             ->withInput();
        }

        $vehiculo->update($request->all());

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo actualizado exitosamente.');
    }

    /**
     * Elimina un vehículo de la base de datos.
     */
    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo eliminado exitosamente.');
    }
}
