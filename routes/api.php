<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PlayerController;



// Rutas públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/question', [GameController::class, 'question']);
    Route::post('/check-answer', [GameController::class, 'checkAnswer']);
    Route::get('/search', [GameController::class, 'search']);
    Route::get('/stats', [GameController::class, 'stats']); // estadísticas del jugador
    Route::get('/categories', [CategoryController::class, 'index']);
});

