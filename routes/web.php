<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
// Importa tus controladores
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\OrdenServicioController; // <--- Asegúrate de que esta importación esté aquí

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('carrusel'); // Tu ruta de inicio personalizada
});

// Rutas para el dashboard, protegidas por autenticación y verificación de email
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grupo ÚNICO de rutas protegidas por autenticación
// Todas las rutas dentro de este grupo requerirán que el usuario esté autenticado.
Route::middleware('auth')->group(function () {
    // Rutas de perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas de recursos para Clientes
    // Esto crea automáticamente rutas para index, create, store, show, edit, update, destroy
    Route::resource('clientes', ClienteController::class);

    // Rutas de recursos para Vehiculos
    // Estas rutas también están protegidas por el mismo middleware 'auth'.
    Route::resource('vehiculos', VehiculoController::class);

    // Rutas de recursos para Ordenes de Servicio
    Route::resource('ordenes-servicio', OrdenServicioController::class);
    
    // Ruta de prueba para depurar eliminación
    Route::get('/debug-delete/{id}', function($id) {
        Log::info('=== RUTA DE PRUEBA DEBUG DELETE ===');
        Log::info('ID recibido: ' . $id);
        
        $orden = \App\Models\OrdenServicio::find($id);
        if (!$orden) {
            Log::error('Orden no encontrada con ID: ' . $id);
            return 'Orden no encontrada';
        }
        
        try {
            Log::info('Intentando eliminar orden desde ruta debug...');
            $orden->delete();
            Log::info('Orden eliminada exitosamente desde ruta debug');
            return 'Orden eliminada exitosamente';
        } catch (\Exception $e) {
            Log::error('Error en ruta debug: ' . $e->getMessage());
            return 'Error: ' . $e->getMessage();
        }
    })->name('debug.delete');
});

// Rutas para administración, protegidas por autenticación y rol de admin
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
});

require __DIR__.'/auth.php';
