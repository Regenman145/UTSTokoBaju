<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Barang;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Kasir;
use App\Http\Controllers\Tentang;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
// Route::get('/barang', function () {
//     return view('barang');
// });
Route::get('/sementara', function () {
    return view('kosong');
});
Route::middleware('guest')->group(function () {
    //registrasi
    Route::get('/registrasi', [AuthController::class, 'tampilRegistrasi'])->name('registrasi.tampil');
    Route::post('/registrasi/submit', [AuthController::class, 'submitRegistrasi'])->name('registrasi.submit');
    //login
    Route::get('/login', [AuthController::class, 'tampilLogin'])->name('login.tampil');
    Route::post('/login/submit', [AuthController::class, 'submitLogin'])->name('login.submit');
});

Route::middleware('auth')->group(function () {
    //logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'tampilDashboard'])->name('tampil.dashboard');
    //input baju
    Route::get('/baju', [Barang::class, 'tampil'])->name('baju.barang');
    Route::get('/baju/tambah', [Barang::class, 'tambah'])->name('baju.tambah');
    Route::post('/baju/submit', [Barang::class, 'submit'])->name('baju.submit');
    //edit baju
    Route::get('/baju/edit/{id}', [Barang::class, 'edit'])->name('baju.edit');
    Route::put('/baju/update/{id}', [Barang::class, 'update'])->name('baju.update');
    //hapus
    Route::post('/baju/hapus/{id}', [Barang::class, 'hapus'])->name('baju.hapus');
    //kasir
    Route::get('/kasir', [Kasir::class, 'index'])->name('kasir.index');
    Route::post('/kasir/tambah', [Kasir::class, 'store'])->name('kasir.store');
    Route::get('/struk/{id}', [Kasir::class, 'struk'])->name('kasir.struk');
    Route::get('/history', [Kasir::class, 'history'])->name('kasir.history');
    //tentang
    Route::get('/tentang', [Tentang::class, 'tampil'])->name('tentang.tampil');
});
