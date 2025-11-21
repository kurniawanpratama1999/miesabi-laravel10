<?php

use App\Http\Controllers\Guest\{LoginController, RegisterController};
use App\Http\Controllers\{CategoryController, DeliveryController, VariantController, ProductController};
use App\Http\Controllers\User\{MenuController, KeranjangController, CheckoutController};
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('pages.guest.index'));
// Route::get('/', [MenuController::class, 'index']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.process');

Route::resource('category', CategoryController::class);
Route::resource('delivery', DeliveryController::class);
Route::resource('variant', VariantController::class);
Route::resource('product', ProductController::class);

// ADMIN
Route::prefix('{admin}')->group(function () {
    Route::resource('menu', MenuController::class);
    Route::resource('keranjang', KeranjangController::class);
    Route::resource('checkout', CheckoutController::class);
});
