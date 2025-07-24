<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RecepcionistaOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar que el usuario esté autenticado
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        
        // Verificar que el usuario sea recepcionista o admin
        if (!in_array($user->role, ['recepcionista', 'admin'])) {
            abort(403, 'Acceso denegado. Se requieren permisos de recepcionista o administrador.');
        }

        return $next($request);
    }
}
