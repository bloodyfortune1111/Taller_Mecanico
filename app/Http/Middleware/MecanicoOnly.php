<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MecanicoOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Verificar si es un mecánico
        if ($user->role !== 'mecanico') {
            return redirect()->route('dashboard')->withErrors([
                'access' => 'Acceso denegado. Solo los mecánicos pueden acceder a esta sección.'
            ]);
        }

        return $next($request);
    }
}
