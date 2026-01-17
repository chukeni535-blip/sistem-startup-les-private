<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PembayaranController;

/*
|--------------------------------------------------------------------------
| ROUTE DATA PEMBAYARAN
|--------------------------------------------------------------------------
| Menampilkan tabel data (data.blade.php)
*/

Route::get('/data', [PembayaranController::class, 'index'])
    ->name('data.index');

/*
|--------------------------------------------------------------------------
| ROUTE SIMPAN DATA FORM (POST)
|--------------------------------------------------------------------------
| Dari form daftar.blade.php
*/

Route::post('/daftar/proses', [PembayaranController::class, 'store'])
    ->name('data.store');

/*
|--------------------------------------------------------------------------
| ROUTE HALAMAN UTAMA
|--------------------------------------------------------------------------
*/

Route::get('/', [PageController::class, 'beranda'])->name('beranda');
Route::get('/produk', [PageController::class, 'produk'])->name('produk');
Route::get('/tentang', [PageController::class, 'tentang'])->name('tentang');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
Route::get('/pembayaran', [PageController::class, 'pembayaran'])->name('pembayaran');

/*
|--------------------------------------------------------------------------
| ROUTE DAFTAR PAKET
|--------------------------------------------------------------------------
*/

Route::get('/daftar/{paket}', [PageController::class, 'daftar'])
    ->name('daftar');

/*
|--------------------------------------------------------------------------
| ROUTE FALLBACK
|--------------------------------------------------------------------------
*/

Route::fallback(function () {
    return redirect()->route('beranda');
});
Route::delete('/pembayaran/{id}', [PembayaranController::class, 'destroy'])
    ->name('pembayaran.hapus');

Route::get('/pembayaran/bayar/{id}', [PembayaranController::class, 'bayar'])
    ->name('pembayaran.bayar');
Route::get('/pembayaran/{id}/instruksi', 
    [PembayaranController::class, 'instruksi'])
    ->name('pembayaran.instruksi');

Route::get('/pembayaran/upload/{id}', [PembayaranController::class, 'uploadForm'])
    ->name('pembayaran.upload');

Route::post('/pembayaran/upload/{id}', [PembayaranController::class, 'uploadStore'])
    ->name('pembayaran.upload.store');