<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;

// Objetos de API
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/validar-token', function (\Illuminate\Http\Request $request) {
    try {
        return response()->json([
            'valido' => true,
            'usuario' => $request->user(),
        ]);
    } catch (\Exception $e) {
        return response()->json(['valido' => false, 'error' => $e->getMessage()], 401);
    }
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/usuarios', [UsuarioController::class, 'index']);
    Route::post('/usuarios', [UsuarioController::class, 'store']);
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update']);
    Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});