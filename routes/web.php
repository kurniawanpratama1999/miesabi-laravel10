<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('pages.index'));
Route::get('/login', fn() => view('pages.login'));
Route::get('/register', fn() => view('pages.register'));

Route::get('/{user}/dashboard', fn() => view('pages.user.02-menu'));
Route::get('/{user}/menu', fn() => view('pages.user.02-menu'));
Route::get('/{user}/keranjang', fn() => view('pages.user.03-keranjang'));
Route::get('/{user}/pesanan', fn() => view('pages.user.03A-pesanan'));
Route::get('/{user}/scanqr', fn() => view('pages.user.03B-scanqr'));
Route::get('/{user}/informasi-pembayaran', fn() => view('pages.user.03C-informasi-pembayaran'));
Route::get('/{user}/pesanan/diproses', fn() => view('pages.user.04A-pesanan-diterima'));
Route::get('/{user}/pesanan/diterima', fn() => view('pages.user.04B-pesanan-diproses'));
Route::get('/{user}/pesanan/riwayat', fn() => view('pages.user.04C-riwayat-pesanan'));
Route::get('/{user}/pesanan/penilaian', fn() => view('pages.user.04D-nilai-produk'));
Route::get('/{user}/ulasan', fn() => view('pages.user.05-ulasan'));

Route::get('/pesanan', fn() => view('pages.admin.pesanan'));
Route::get('/produk', fn() => view('pages.admin.pesanan'));
Route::get('/riwayat', fn() => view('pages.admin.pesanan'));
