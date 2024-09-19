<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarModelController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RentalController;

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

Route::post('refresh', [App\Http\Controllers\AuthController::class, 'refresh']);

Route::middleware('auth:sanctum')->group(function()
{
    Route::apiResource('brand', BrandController::class);

    Route::apiResource('car', CarController::class);

    Route::apiResource('car-model', CarModelController::class);

    Route::apiResource('client', ClientController::class);

    Route::apiResource('rental', RentalController::class);

    Route::get('me', [App\Http\Controllers\AuthController::class, 'me']);

    Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout']);

});
