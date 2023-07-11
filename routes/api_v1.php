<?php

use App\Http\Controllers\Api\V1\ProductApiController;
use App\Http\Controllers\Api\V1\CartApiController;
use Illuminate\Support\Facades\Route;

Route::get('products', [ProductApiController::class, 'index']);
Route::get('products/search', [ProductApiController::class, 'search']);

Route::middleware('auth:sanctum')->group(function () {
    // Действия доступные только админу
    Route::middleware('admin')->group(function () {
        Route::post('products', [ProductApiController::class, 'store']);
        Route::put('products/{product}', [ProductApiController::class, 'update']);
        Route::delete('products/{product}', [ProductApiController::class, 'destroy']);
    });

    Route::prefix('cart')->group(function () {
        Route::post('{product}', [CartApiController::class, 'add']);
        Route::delete('{product}', [CartApiController::class, 'delete']);
    });
});
