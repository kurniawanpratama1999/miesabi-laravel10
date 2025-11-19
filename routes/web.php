<?php

use App\Http\Controllers\Guest\{LoginController, RegisterController};
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('pages.guest.index'));

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.process');

Route::get('/{user}/dashboard', fn() => view('pages.user.menu'));
Route::get('/{user}/menu', fn() => view('pages.user.menu'));
Route::get('/{user}/keranjang', fn() => view('pages.user.keranjang'));
Route::get('/{user}/pesanan', fn() => view('pages.user.pesanan'));
Route::get('/{user}/scanqr', fn() => view('pages.user.scanqr'));
Route::get('/{user}/informasi-pembayaran', fn() => view('pages.user.informasi-pembayaran'));
Route::get('/{user}/pesanan/diproses', fn() => view('pages.user.pesanan-diterima'));
Route::get('/{user}/pesanan/diterima', fn() => view('pages.user.pesanan-diproses'));
Route::get('/{user}/pesanan/riwayat', fn() => view('pages.user.riwayat-pesanan'));
Route::get('/{user}/pesanan/penilaian', fn() => view('pages.user.nilai-produk'));
Route::get('/{user}/ulasan', fn() => view('pages.user.ulasan'));

Route::get('/pesanan', fn() => view('pages.admin.pesanan'));
Route::get('/produk', fn() => view('pages.admin.produk'));
Route::get('/riwayat', fn() => view('pages.admin.riwayat'));
