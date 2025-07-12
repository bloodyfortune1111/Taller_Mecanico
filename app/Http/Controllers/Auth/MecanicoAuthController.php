<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class MecanicoAuthController extends Controller
{
    /**
     * Mostrar el formulario de login para mecánicos
     */
    public function showLoginForm()
    {
        return view('mecanico.auth.login');
    }

    /**
     * Manejar el login de mecánicos
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();
            
            // Verificar que sea un mecánico
            if ($user->role !== 'mecanico') {
                Auth::logout();
                throw ValidationException::withMessages([
                    'email' => 'Acceso denegado. Solo los mecánicos pueden acceder a este panel.',
                ]);
            }

            $request->session()->regenerate();
            return redirect()->intended(route('mecanico.dashboard'));
        }

        throw ValidationException::withMessages([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }

    /**
     * Cerrar sesión del mecánico
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('mecanico.login');
    }
}
