<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
// Importa tus controladores
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\OrdenServicioController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\PiezaController;
use App\Http\Controllers\FacturaController;

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

// Ruta temporal para prueba de CSS
Route::get('/test-css', function () {
    return view('test-css');
});

// Rutas de autenticación para mecánicos
Route::prefix('mecanico')->name('mecanico.')->group(function () {
    // Rutas para invitados (no autenticados)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [App\Http\Controllers\Auth\MecanicoAuthController::class, 'showLoginForm'])
            ->name('login');
        Route::post('/login', [App\Http\Controllers\Auth\MecanicoAuthController::class, 'login'])
            ->name('login.post');
    });
});

// Rutas específicas para mecánicos (accesibles después del login unificado)
Route::prefix('mecanico')->name('mecanico.')->middleware(['auth', 'mecanico.only'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\MecanicoController::class, 'dashboard'])
        ->name('dashboard');
    Route::get('/orden/{id}', [App\Http\Controllers\MecanicoController::class, 'verOrden'])
        ->name('orden');
    Route::post('/orden/{id}/estado', [App\Http\Controllers\MecanicoController::class, 'actualizarEstado'])
        ->name('orden.estado');
    
    // Mecánicos pueden ver las órdenes asignadas y actualizar estados
    Route::get('/ordenes-servicio', [OrdenServicioController::class, 'index'])->name('ordenes.index');
    Route::get('/ordenes-servicio/{ordenes_servicio}', [OrdenServicioController::class, 'show'])->name('ordenes.show');
    
    // Ruta de logout para mecánicos
    Route::post('/logout', [App\Http\Controllers\Auth\MecanicoAuthController::class, 'logout'])
        ->name('logout');
});

// Rutas específicas para recepcionistas (accesibles después del login unificado)
Route::prefix('recepcionista')->name('recepcionista.')->middleware(['auth', 'recepcionista.only'])->group(function () {
    Route::get('/orden/{id}', [App\Http\Controllers\RecepcionistaController::class, 'verOrden'])
        ->name('orden');
    
    // Rutas de recursos para Vehiculos (crear y ver para recepcionista solamente)
    Route::get('/vehiculos', [VehiculoController::class, 'index'])->name('vehiculos.index');
    Route::get('/vehiculos/create', [VehiculoController::class, 'create'])->name('vehiculos.create');
    Route::post('/vehiculos', [VehiculoController::class, 'store'])->name('vehiculos.store');
    Route::get('/vehiculos/{vehiculo}', [VehiculoController::class, 'show'])->name('vehiculos.show');

    // Rutas de recursos para Ordenes de Servicio (crear y ver para recepcionista solamente)
    Route::get('/ordenes-servicio', [OrdenServicioController::class, 'index'])->name('ordenes.index');
    Route::get('/ordenes-servicio/create', [OrdenServicioController::class, 'create'])->name('ordenes.create');
    Route::post('/ordenes-servicio', [OrdenServicioController::class, 'store'])->name('ordenes.store');
    Route::get('/ordenes-servicio/{ordenes_servicio}', [OrdenServicioController::class, 'show'])->name('ordenes.show');
    
    // Rutas de recursos para Servicios (solo ver para recepcionista)
    Route::get('/servicios', [ServicioController::class, 'index'])->name('servicios.index');
    Route::get('/servicios/{servicio}', [ServicioController::class, 'show'])->name('servicios.show');
    
    // Rutas de recursos para Piezas (solo ver para recepcionista)
    Route::get('/piezas', [PiezaController::class, 'index'])->name('piezas.index');
    Route::get('/piezas/{pieza}', [PiezaController::class, 'show'])->name('piezas.show');
    
    // Rutas AJAX para catálogos
    Route::get('/api/servicios', [ServicioController::class, 'getServicios'])->name('api.servicios');
    Route::get('/api/piezas', [PiezaController::class, 'getPiezas'])->name('api.piezas');
    
    // Rutas para generar facturas (solo recepcionista y admin)
    Route::get('/facturas', [FacturaController::class, 'index'])->name('facturas.index');
    Route::get('/facturas/{id}/preview', [FacturaController::class, 'preview'])->name('facturas.preview');
    Route::get('/facturas/{id}/generar', [FacturaController::class, 'generarFactura'])->name('facturas.generar');
});

// Rutas para el dashboard unificado - sin lógica compleja para evitar errores
Route::get('/dashboard', function () {
    $user = Auth::user();
    
    // Solo redirigir a la vista correcta sin lógica compleja
    if ($user->role === 'mecanico') {
        // Para mecánicos, calcular estadísticas y obtener órdenes asignadas
        $estadisticas = [
            'total_asignadas' => \App\Models\OrdenServicio::where('mecanico_id', $user->id)->count(),
            'pendientes' => \App\Models\OrdenServicio::where('mecanico_id', $user->id)->where('estado', 'recibido')->count(),
            'en_proceso' => \App\Models\OrdenServicio::where('mecanico_id', $user->id)->where('estado', 'en_proceso')->count(),
            'finalizadas' => \App\Models\OrdenServicio::where('mecanico_id', $user->id)->whereIn('estado', ['finalizado', 'entregado'])->count(),
        ];
        
        // Obtener las órdenes asignadas al mecánico con relaciones
        $ordenesAsignadas = \App\Models\OrdenServicio::where('mecanico_id', $user->id)
            ->with(['cliente', 'vehiculo'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        return view('mecanico.dashboard', compact('estadisticas', 'ordenesAsignadas'));
    }
    
    // Para admin y recepcionista, usar el dashboard principal
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grupo ÚNICO de rutas protegidas por autenticación y solo para administrador
// Todas las rutas dentro de este grupo requerirán que el usuario sea el administrador autorizado.
Route::middleware(['auth', 'admin.only'])->group(function () {
    // Rutas de perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas completas de recursos para admin (acceso completo CRUD)
    Route::resource('clientes', ClienteController::class);
    Route::resource('ordenes-servicio', OrdenServicioController::class);
    Route::resource('vehiculos', VehiculoController::class);
    Route::resource('servicios', ServicioController::class);
    Route::resource('piezas', PiezaController::class);

    // Rutas específicas para PartsTech API (solo admin)
    Route::post('/piezas/search-partstech', [PiezaController::class, 'searchPartsTech'])->name('piezas.search-partstech');
    Route::post('/piezas/import-partstech', [PiezaController::class, 'importFromPartsTech'])->name('piezas.import-partstech');
    Route::get('/piezas/test-connection', [PiezaController::class, 'testPartsTechConnection'])->name('piezas.test-connection');
    
    // Ruta de prueba para depurar eliminación (solo admin)
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
    
    // Las rutas de facturas ya están definidas en el grupo de recepcionista
    // y son accesibles para ambos roles (admin y recepcionista)
});

// Rutas para administración, protegidas por autenticación y solo para administrador
Route::middleware(['auth', 'admin.only'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
});

require __DIR__.'/auth.php';
