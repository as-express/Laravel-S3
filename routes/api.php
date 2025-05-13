<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::prefix('product')->group(function () {
    Route::post('/', [ProductController::class, 'store']);
    Route::get('/', [ProductController::class, 'getAll']);
    Route::get('/{id}', [ProductController::class, 'getOne']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});
