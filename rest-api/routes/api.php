<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return 'Hola MUndo';
});



Route::apiResource('products', ProductController::class);
Route::patch('products/{product}/updateAvailability', [ProductController::class, 'updateAvailability']);

