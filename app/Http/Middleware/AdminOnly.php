<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
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
        
        // Verificar si es un administrador (cualquier usuario con rol admin)
        if ($user->role !== 'admin') {
            return redirect()->route('login')->withErrors([
                'email' => 'Acceso denegado. Solo los administradores pueden acceder a esta sección.'
            ]);
        }

        return $next($request);
    }
}
