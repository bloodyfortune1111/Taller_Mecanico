<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /**
     * Mostrar una lista de servicios del taller
     */
    public function index()
    {
        $servicios = Servicio::orderBy('categoria')->orderBy('nombre')->get();
        return view('servicios.index', compact('servicios'));
    }

    /**
     * Mostrar el formulario para crear un nuevo servicio
     */
    public function create()
    {
        return view('servicios.create');
    }

    /**
     * Almacenar un nuevo servicio en la base de datos
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio_base' => 'required|numeric|min:0',
            'categoria' => 'nullable|string|max:255',
            'tiempo_estimado' => 'nullable|integer|min:0',
            'activo' => 'boolean'
        ]);

        $data = $request->all();
        $data['activo'] = $request->has('activo');

        Servicio::create($data);
        
        return redirect()->route('servicios.index')
                        ->with('success', 'Servicio creado exitosamente.');
    }

    /**
     * Mostrar un servicio específico
     */
    public function show(Servicio $servicio)
    {
        return view('servicios.show', compact('servicio'));
    }

    /**
     * Mostrar el formulario para editar un servicio
     */
    public function edit(Servicio $servicio)
    {
        return view('servicios.edit', compact('servicio'));
    }

    /**
     * Actualizar un servicio en la base de datos
     */
    public function update(Request $request, Servicio $servicio)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio_base' => 'required|numeric|min:0',
            'categoria' => 'nullable|string|max:255',
            'tiempo_estimado' => 'nullable|integer|min:0',
            'activo' => 'boolean'
        ]);

        $data = $request->all();
        $data['activo'] = $request->has('activo');

        $servicio->update($data);
        
        return redirect()->route('servicios.index')
                        ->with('success', 'Servicio actualizado exitosamente.');
    }

    /**
     * Eliminar un servicio de la base de datos
     */
    public function destroy(string $id)
    {
        try {
            $servicio = Servicio::findOrFail($id);
            $servicio->delete();
            
            return redirect()->route('servicios.index')
                            ->with('success', 'Servicio eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('servicios.index')
                            ->with('error', 'Error al eliminar el servicio: ' . $e->getMessage());
        }
    }

    /**
     * Obtener servicios para solicitudes AJAX (para formularios de órdenes)
     */
    public function getServicios()
    {
        $servicios = Servicio::activos()->select('id', 'nombre', 'precio_base', 'categoria')->get();
        return response()->json($servicios);
    }
}
