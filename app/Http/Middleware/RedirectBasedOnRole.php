<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectBasedOnRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si el usuario está autenticado, verificar si está accediendo al dashboard
        if (auth()->check() && $request->is('dashboard')) {
            $user = auth()->user();
            
            // No redirigir si ya está en la ruta correcta basada en su rol
            return $next($request);
        }
        
        return $next($request);
    }
}
