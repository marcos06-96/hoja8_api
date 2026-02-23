<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AnimalController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FavoritoController;
use App\Http\Controllers\Api\ProtectoraController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




// Publicas
Route::get('/animales', [AnimalController::class, 'index']);
Route::get('/animales/{animal}', [AnimalController::class, 'show']);
Route::get('/animales-all', [AnimalController::class, 'indexAll']);

// Adoptante
Route::middleware(['auth:sanctum', 'ability:adoptante'])->group(function () {
    Route::get('/favoritos', [FavoritoController::class, 'index']);
    Route::post('/animales/{animal}/favoritos', [FavoritoController::class, 'store']);
    Route::delete('/animales/{animal}/favoritos', [FavoritoController::class, 'destroy']);
    Route::get('/protectoras', [ProtectoraController::class, 'index']);
    Route::get('/protectoras/{protectora}', [ProtectoraController::class, 'show']);
    Route::get('/protectoras/{protectora}/animales', [AnimalController::class, 'animales']);
});

// Protectora
Route::middleware(['auth:sanctum', 'ability:protectora'])->group(function () {
    // CRUD animales
    Route::post('/animales', [AnimalController::class, 'store']);
    Route::put('/animales/{animal}', [AnimalController::class, 'update']);
    Route::patch('/animales/{animal}', [AnimalController::class, 'update']);
    Route::delete('/animales/{animal}', [AnimalController::class, 'destroy']);

    // Gestión de sus animales 
    Route::get('/mis-animales', [ProtectoraController::class, 'misAnimales']);
    Route::get('/mis-animales/urgentes', [ProtectoraController::class, 'misAnimalesUrgentes']);
    Route::get('/mis-animales/mas-antiguos', [ProtectoraController::class, 'misAnimalesMasAntiguos']);
    Route::get('/mis-animales/{animal}', [ProtectoraController::class, 'miAnimal']);
    Route::patch('/animales/{animal}/estado', [ProtectoraController::class, 'cambiarEstado']);

    // Estadísticas protectora
    Route::get('/mis-estadisticas', [ProtectoraController::class, 'misEstadisticas']); //generales
    Route::get('/mis-estadisticas/especie', [ProtectoraController::class, 'misEstadisticasPorEspecie']); //agrupadas por especies

    // Ranking
    Route::get('/ranking-favoritos', [ProtectoraController::class, 'rankingFavoritos']);
});
//admin
Route::middleware(['auth:sanctum', 'ability:admin'])->prefix('admin')->group(function () {

    Route::get('/usuarios', [AdminController::class, 'usuarios']);
    
    Route::patch('/usuarios/{usuario}/rol', [AdminController::class, 'cambiarRol']);
    
    Route::patch('/protectoras/{protectora}/estado', [AdminController::class, 'cambiarEstadoProtectora']);
    
    Route::delete('/animales/{animal}', [AdminController::class, 'destroyAnimal']);
    
    Route::get('/estadisticas', [AdminController::class, 'estadisticas']);
    
    Route::get('/estadisticas/protectoras', [AdminController::class, 'estadisticasProtectoras']);

Route::get('/adopciones/ultimo-mes', [AdminController::class, 'adopcionesUltimoMes']);


}
);

