<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PostController;


// Home
Route::get('/', function () {
    return view('index');
});

// Productos
Route::get('/products', [ProductController::class, 'index'])
     ->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])
     ->name('products.show');

// Autenticación manual
Route::get('register', [RegisterController::class, 'showRegistrationForm'])
     ->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('login', [LoginController::class, 'showLoginForm'])
     ->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::post('logout', [LoginController::class, 'logout'])
     ->name('logout');

// Perfil de usuario (autenticado)
Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'edit'])
         ->name('profile.edit');
    Route::post('profile', [ProfileController::class, 'update'])
         ->name('profile.update');
});

// Carrito de compras
Route::get('/cart', [CartController::class, 'index'])
     ->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])
     ->name('cart.add');
Route::post('/cart/remove/{product}', [CartController::class, 'remove'])
     ->name('cart.remove');

// Checkout (solo usuarios logueados)
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])
         ->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])
         ->name('checkout.store');
    Route::get('/checkout/thankyou', [CheckoutController::class, 'thankyou'])
         ->name('checkout.thankyou');
});

// Blog (público)
Route::get('/blog', [PostController::class, 'index'])
     ->name('blog.index');

// Blog (solo usuarios autenticados: create & store)
Route::middleware('auth')->group(function () {
    Route::get('/blog/create', [PostController::class, 'create'])->name('blog.create');
    Route::post('/blog',       [PostController::class, 'store'])->name('blog.store');
});

Route::get('/blog/{post}', [PostController::class, 'show'])
     ->name('blog.show');
