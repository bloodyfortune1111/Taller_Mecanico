<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogDeleteRequests
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('DELETE') && strpos($request->path(), 'ordenes-servicio') !== false) {
            Log::info('=== PETICIÓN DELETE RECIBIDA ===');
            Log::info('URL: ' . $request->fullUrl());
            Log::info('Método: ' . $request->method());
            Log::info('Parámetros: ' . json_encode($request->all()));
            Log::info('Ruta: ' . $request->path());
            Log::info('Headers: ' . json_encode($request->headers->all()));
        }

        return $next($request);
    }
}
