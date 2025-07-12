<?php

namespace App\Http\Controllers;

use App\Models\OrdenServicio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MecanicoController extends Controller
{
    /**
     * Dashboard del mecánico - muestra sus órdenes asignadas
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Verificar que el usuario sea un mecánico
        if ($user->role !== 'mecanico') {
            return redirect()->route('login')->withErrors([
                'email' => 'Acceso denegado. Solo los mecánicos pueden acceder a este panel.'
            ]);
        }

        // Obtener órdenes asignadas a este mecánico
        $ordenesAsignadas = OrdenServicio::with(['cliente', 'vehiculo'])
            ->where('mecanico_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Estadísticas del mecánico
        $estadisticas = [
            'total_asignadas' => $ordenesAsignadas->count(),
            'pendientes' => $ordenesAsignadas->where('estado', 'recibido')->count(),
            'en_proceso' => $ordenesAsignadas->where('estado', 'en_proceso')->count(),
            'finalizadas' => $ordenesAsignadas->where('estado', 'finalizado')->count(),
        ];

        return view('mecanico.dashboard', compact('ordenesAsignadas', 'estadisticas'));
    }

    /**
     * Ver detalles de una orden específica del mecánico
     */
    public function verOrden($id)
    {
        $user = Auth::user();
        
        // Verificar que el usuario sea un mecánico
        if ($user->role !== 'mecanico') {
            return redirect()->route('login')->withErrors([
                'email' => 'Acceso denegado.'
            ]);
        }

        // Obtener la orden solo si está asignada a este mecánico
        $orden = OrdenServicio::with(['cliente', 'vehiculo', 'servicios', 'piezas'])
            ->where('id', $id)
            ->where('mecanico_id', $user->id)
            ->firstOrFail();

        return view('mecanico.orden-detalle', compact('orden'));
    }

    /**
     * Actualizar el estado de una orden
     */
    public function actualizarEstado(Request $request, $id)
    {
        $user = Auth::user();
        
        // Verificar que el usuario sea un mecánico
        if ($user->role !== 'mecanico') {
            return response()->json(['error' => 'Acceso denegado'], 403);
        }

        $request->validate([
            'estado' => 'required|in:recibido,en_proceso,finalizado'
        ]);

        // Obtener la orden solo si está asignada a este mecánico
        $orden = OrdenServicio::where('id', $id)
            ->where('mecanico_id', $user->id)
            ->firstOrFail();

        $orden->estado = $request->estado;
        $orden->save();

        return response()->json([
            'success' => true,
            'message' => 'Estado actualizado correctamente'
        ]);
    }
}
