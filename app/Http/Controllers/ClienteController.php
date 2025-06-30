<?php

namespace App\Http\Controllers;

use App\Models\Cliente; // Importa el modelo Cliente
use Illuminate\Http\Request; // Para manejar las solicitudes HTTP
use Illuminate\Support\Facades\Validator; // Para validación de datos

class ClienteController extends Controller
{
    /**
     * Muestra una lista de todos los clientes.
     */
    public function index()
    {
        // Obtiene todos los clientes de la base de datos
        $clientes = Cliente::all();
        // Retorna la vista 'clientes.index' y le pasa la variable $clientes
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Muestra el formulario para crear un nuevo cliente.
     */
    public function create()
    {
        // Retorna la vista 'clientes.create'
        return view('clientes.create');
    }

    /**
     * Almacena un nuevo cliente en la base de datos.
     */
    public function store(Request $request)
    {
        // Reglas de validación para los datos del formulario
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:clientes', // Email debe ser único en la tabla 'clientes'
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ]);

        // Si la validación falla, redirige de vuelta con los errores
        if ($validator->fails()) {
            return redirect()->route('clientes.create')
                             ->withErrors($validator)
                             ->withInput();
        }

        // Crea un nuevo cliente con los datos validados
        $cliente = Cliente::create($request->all());

        // Redirige a la lista de clientes con un mensaje de éxito
        return redirect()
            ->route('vehiculos.create', ['cliente_id' => $cliente->id])
            ->with('success', 'Cliente registrado correctamente. Ahora registra un vehículo.');
    }

    /**
     * Muestra los detalles de un cliente específico.
     */
    public function show(Cliente $cliente)
    {
        // Retorna la vista 'clientes.show' y le pasa el cliente y sus vehículos
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Muestra el formulario para editar un cliente existente.
     */
    public function edit(Cliente $cliente)
    {
        // Retorna la vista 'clientes.edit' y le pasa el cliente a editar
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Actualiza un cliente existente en la base de datos.
     */
    public function update(Request $request, Cliente $cliente)
    {
        // Reglas de validación para los datos del formulario de actualización
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:clientes,email,' . $cliente->id, // Email único, excepto para el cliente actual
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ]);

        // Si la validación falla, redirige de vuelta con los errores
        if ($validator->fails()) {
            return redirect()->route('clientes.edit', $cliente->id)
                             ->withErrors($validator)
                             ->withInput();
        }

        // Actualiza el cliente con los datos validados
        $cliente->update($request->all());

        // Redirige a la lista de clientes con un mensaje de éxito
    }

    /**
     * Elimina un cliente de la base de datos.
     */
    public function destroy(Cliente $cliente)
    {
        // Elimina el cliente
        $cliente->delete();

        // Redirige a la lista de clientes con un mensaje de éxito
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado exitosamente.');
    }
}
