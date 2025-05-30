<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('index'); // Usa la vista que acabamos de crear
});

// Este resource debe incluir show:
// Listado de productos
Route::get('/products', [ProductController::class, 'index'])
     ->name('products.index');

// Detalle de producto
Route::get('/products/{product}', [ProductController::class, 'show'])
     ->name('products.show');

// Registro
Route::get('register', [RegisterController::class, 'showRegistrationForm'])
     ->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Login
Route::get('login', [LoginController::class, 'showLoginForm'])
     ->name('login');
Route::post('login', [LoginController::class, 'login']);

// Logout
Route::post('logout', [LoginController::class, 'logout'])
     ->name('logout');

// Perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'edit'])
         ->name('profile.edit');
    Route::post('profile', [ProfileController::class, 'update'])
         ->name('profile.update');
});