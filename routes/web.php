<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PostController;


// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Productos
Route::get('/products', [ProductController::class, 'index'])
     ->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])
     ->name('products.show');

// Footer
Route::view('/politica-cookies', 'legal.cookies')
     ->name('cookies.policy');
Route::view('/terminos-condiciones', 'legal.terms')
     ->name('terms.conditions');
Route::view('/politica-privacidad', 'legal.privacy')
     ->name('privacy.policy');


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
    // Mostrar la página “Mi Cuenta” (profile.index → método index)
    Route::get('profile', [ProfileController::class, 'index'])
         ->name('profile.index');

    // Actualizar nombre y correo (profile.updateProfile → método updateProfile)
    Route::post('profile/update-profile', [ProfileController::class, 'updateProfile'])
         ->name('profile.updateProfile');

    // CRUD de Direcciones:
    Route::post('profile/addresses', [ProfileController::class, 'storeAddress'])
         ->name('profile.addresses.store');
    Route::put('profile/addresses/{address}', [ProfileController::class, 'updateAddress'])
         ->name('profile.addresses.update');
    Route::delete('profile/addresses/{address}', [ProfileController::class, 'destroyAddress'])
         ->name('profile.addresses.destroy');

    // CRUD de Métodos de Pago:
    Route::post('profile/payments', [ProfileController::class, 'storePayment'])
         ->name('profile.payments.store');
    Route::put('profile/payments/{payment}', [ProfileController::class, 'updatePayment'])
         ->name('profile.payments.update');
    Route::delete('profile/payments/{payment}', [ProfileController::class, 'destroyPayment'])
         ->name('profile.payments.destroy');
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
    Route::get('/blog/{post}/edit', [PostController::class, 'edit'])->name('blog.edit');
    Route::put('/blog/{post}', [PostController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{post}', [PostController::class, 'destroy'])->name('blog.destroy');

});

// Blog (solo usuarios autenticados, modificar)
Route::get('/blog/{post}', [PostController::class, 'show'])
     ->name('blog.show');
         Route::get('/blog/{post}/edit',   [PostController::class, 'edit'])->name('blog.edit');
    Route::put('/blog/{post}',        [PostController::class, 'update'])->name('blog.update');
