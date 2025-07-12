<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
// Importa tus controladores
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\OrdenServicioController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\PiezaController;

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

// Rutas para el panel de mecánicos (sistema separado)
Route::prefix('mecanico')->name('mecanico.')->group(function () {
    // Rutas para invitados (no autenticados)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [App\Http\Controllers\Auth\MecanicoAuthController::class, 'showLoginForm'])
            ->name('login');
        Route::post('/login', [App\Http\Controllers\Auth\MecanicoAuthController::class, 'login'])
            ->name('login.post');
    });
    
    // Rutas protegidas para mecánicos autenticados
    Route::middleware(['auth', 'mecanico.only'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\MecanicoController::class, 'dashboard'])
            ->name('dashboard');
        Route::get('/orden/{id}', [App\Http\Controllers\MecanicoController::class, 'verOrden'])
            ->name('orden');
        Route::post('/orden/{id}/estado', [App\Http\Controllers\MecanicoController::class, 'actualizarEstado'])
            ->name('orden.estado');
        Route::post('/logout', [App\Http\Controllers\Auth\MecanicoAuthController::class, 'logout'])
            ->name('logout');
    });
});

// Rutas para el dashboard, protegidas por autenticación y solo para administrador
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'admin.only'])->name('dashboard');

// Grupo ÚNICO de rutas protegidas por autenticación y solo para administrador
// Todas las rutas dentro de este grupo requerirán que el usuario sea el administrador autorizado.
Route::middleware(['auth', 'admin.only'])->group(function () {
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
    
    // Rutas de recursos para Servicios
    Route::resource('servicios', ServicioController::class);
    
    // Rutas de recursos para Piezas
    Route::resource('piezas', PiezaController::class);
    
    // Rutas AJAX para catálogos
    Route::get('/api/servicios', [ServicioController::class, 'getServicios'])->name('api.servicios');
    Route::get('/api/piezas', [PiezaController::class, 'getPiezas'])->name('api.piezas');
    
    // Rutas API para servicios propios del taller
    Route::prefix('api/servicios-taller')->name('api.servicios-taller.')->group(function () {
        Route::get('/', [App\Http\Controllers\Api\ServicioApiController::class, 'index'])->name('index');
        Route::get('/categoria', [App\Http\Controllers\Api\ServicioApiController::class, 'porCategoria'])->name('categoria');
        Route::get('/buscar', [App\Http\Controllers\Api\ServicioApiController::class, 'buscar'])->name('buscar');
        Route::get('/recomendados', [App\Http\Controllers\Api\ServicioApiController::class, 'recomendados'])->name('recomendados');
        Route::get('/estadisticas', [App\Http\Controllers\Api\ServicioApiController::class, 'estadisticas'])->name('estadisticas');
        Route::get('/{id}', [App\Http\Controllers\Api\ServicioApiController::class, 'show'])->name('show');
    });
    
    // Rutas API para piezas propias del taller
    Route::prefix('api/piezas-taller')->name('api.piezas-taller.')->group(function () {
        Route::get('/', [App\Http\Controllers\Api\PiezaApiController::class, 'index'])->name('index');
        Route::get('/categoria', [App\Http\Controllers\Api\PiezaApiController::class, 'porCategoria'])->name('categoria');
        Route::get('/buscar', [App\Http\Controllers\Api\PiezaApiController::class, 'buscar'])->name('buscar');
        Route::get('/marca', [App\Http\Controllers\Api\PiezaApiController::class, 'porMarca'])->name('marca');
        Route::get('/categorias', [App\Http\Controllers\Api\PiezaApiController::class, 'categorias'])->name('categorias');
        Route::get('/marcas', [App\Http\Controllers\Api\PiezaApiController::class, 'marcas'])->name('marcas');
        Route::get('/estadisticas', [App\Http\Controllers\Api\PiezaApiController::class, 'estadisticas'])->name('estadisticas');
        Route::get('/{id}', [App\Http\Controllers\Api\PiezaApiController::class, 'show'])->name('show');
    });
    
    // Rutas específicas para PartsTech API
    Route::post('/piezas/search-partstech', [PiezaController::class, 'searchPartsTech'])->name('piezas.search-partstech');
    Route::post('/piezas/import-partstech', [PiezaController::class, 'importFromPartsTech'])->name('piezas.import-partstech');
    Route::get('/piezas/test-connection', [PiezaController::class, 'testPartsTechConnection'])->name('piezas.test-connection');
    
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

// Rutas para administración, protegidas por autenticación y solo para administrador
Route::middleware(['auth', 'admin.only'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
});

require __DIR__.'/auth.php';
