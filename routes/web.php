<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MenuController;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckKasir;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

Route::middleware([CheckKasir::class])->group(function () {
    Route::get('/kasir', [KasirController::class, 'index']);
    Route::get('/kasir/menu-all', [KasirController::class, 'allMenu']);
    Route::get('/kasir/daftar-menu/cari', [KasirController::class, 'search']);
    Route::get('kasir/menu-perkategori/{kategori_id}', [KasirController::class, 'menuPerkategori']);
    Route::get('select/{id}/addCart', [KasirController::class, 'store']);
    Route::get('data-new/solds', [KasirController::class, 'getSolds']);
    Route::get('select/{id}/delete-pesanan', [KasirController::class, 'destroy']);
    Route::get('select/reset-pesanan', [KasirController::class, 'reset']);
    Route::get('select/{id}/update-qty/{qty}', [KasirController::class, 'updateQty']);
});

Route::middleware([CheckAdmin::class])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index']);
    Route::get('daftar-menu', [MenuController::class, 'index']);
    Route::get('kategori/create', [KategoriController::class, 'create']);
    Route::post('kategori/store', [KategoriController::class, 'store']);
    Route::get('kategori/edit/{id}', [KategoriController::class, 'edit']);
    Route::post('kategori/{id}/update', [KategoriController::class, 'update']);
    Route::get('kategori/{id}/delete', [KategoriController::class, 'destroy']);

    Route::get('menu-baru/create', [MenuController::class, 'create']);
    Route::post('menu-baru/store', [MenuController::class, 'store']);
    Route::get('daftar-menu/edit/{id}', [MenuController::class, 'edit']);
    Route::post('daftar-menu/{id}/update', [MenuController::class, 'update']);
    Route::get('daftar-menu/{id}/delete', [MenuController::class, 'destroy']);
    Route::get('daftar-menu/new-data', [MenuController::class, 'getNewData']);
    Route::get('daftar-menu/new-data/cari', [MenuController::class, 'search']);
    Route::get('daftar-menu/new-data/{kategori_id}', [MenuController::class, 'getPerkategori']);

    Route::get('laporan', [LaporanController::class, 'index']);
    Route::get('laporan/select/{date}', [LaporanController::class, 'getPerdate']);
    // Route::get('laporan/getData', [LaporanController::class, 'getData']);
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');
require __DIR__ . '/auth.php';
