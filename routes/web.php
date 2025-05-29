<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('index'); // Usa la vista que acabamos de crear
});

// Este resource debe incluir show:
// Listado de productos
Route::get('/products', [ProductController::class, 'index'])
     ->name('products.index');

// Detalle de producto (Punto 2)
Route::get('/products/{product}', [ProductController::class, 'show'])
     ->name('products.show');

