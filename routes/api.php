<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CrudController;
use App\Http\Controllers\Api\GaleriaController;
use App\Http\Controllers\Api\MaterialesController;
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::post('camiones/crud', [CrudController::class, 'execute']);

// routes/api.php
Route::post('galerias', [GaleriaController::class, 'store']);
Route::put('galerias', [GaleriaController::class, 'update']);
Route::get('galerias', [GaleriaController::class, 'index']);

//Materiales

Route::post('materiales', [MaterialesController::class, 'store']);
Route::put('materiales', [MaterialesController::class, 'update']);
Route::get('materiales', [MaterialesController::class, 'index']);
