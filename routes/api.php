<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServicioApiController;
use App\Http\Controllers\Api\PiezaApiController;

Route::prefix('servicios')->group(function () {
    Route::get('/', [ServicioApiController::class, 'index']);
    Route::get('/categoria', [ServicioApiController::class, 'porCategoria']);
    Route::get('/buscar', [ServicioApiController::class, 'buscar']);
    Route::get('/{id}', [ServicioApiController::class, 'show']);
    Route::get('/recomendados', [ServicioApiController::class, 'recomendados']);
    Route::get('/estadisticas', [ServicioApiController::class, 'estadisticas']);
});

Route::prefix('piezas')->group(function () {
    Route::get('/', [PiezaApiController::class, 'index']);
    Route::get('/{id}', [PiezaApiController::class, 'show']);
    Route::get('/buscar', [PiezaApiController::class, 'buscar']);
    Route::get('/categoria/{categoria}', [PiezaApiController::class, 'porCategoria']);
});
