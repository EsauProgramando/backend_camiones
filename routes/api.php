<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CrudController;

Route::post('api/camiones/crud', [CrudController::class, 'execute']);
