<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('index'); // Usa la vista que acabamos de crear
});

// Este resource debe incluir show:
Route::resource('products', ProductController::class)
     ->only(['index', 'show']);
