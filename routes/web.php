<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ValidasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\PermohonanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', 'home');

Route::middleware('auth')->group(function(){
    // Home
    Route::get('home', [DashboardController::class, 'index'])->middleware('auth')->name('home');

    Route::group(['middleware' => 'can:isUser'], function(){
        // Kategori
        Route::get('kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::post('kategori', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

        // Barang
        Route::resource('barang', BarangController::class);

        // Permohonan
        Route::get('permohonan', [PermohonanController::class, 'index'])->name('permohonan.index');
        Route::post('permohonan/buat_permohonan', [PermohonanController::class, 'buat_permohonan'])->name('permohonan.buat');
        Route::get('permohonan/form_permohonan/{permohonan_id}', [PermohonanController::class, 'form_permohonan'])->name('permohonan.form');
        Route::post('permohonan/form_permohonan/{permohonan_id}', [PermohonanController::class, 'simpan_permohonan'])->name('permohonan.simpan');
        Route::get('permohonan/detail_permohonan/{permohonan_id}', [PermohonanController::class, 'detail_permohonan'])->name('permohonan.detail');
        Route::delete('permohonan/hapus_permohonan/{permohonan_id}', [PermohonanController::class, 'hapus_permohonan'])->name('permohonan.hapus');
        Route::get('permohonan/items/{permohonan_id}', [PermohonanController::class, 'items'])->name('permohonan.items');
        Route::post('permohonan/tambah_item/{permohonan_id}', [PermohonanController::class, 'tambah_item'])->name('permohonan.tambah.item');
        Route::post('permohonan/simpan_item/{permohonan_id}', [PermohonanController::class, 'simpan_item'])->name('permohonan.simpan.item');
        Route::delete('permohonan/hapus_item/{item_id}/{permohonan_id}', [PermohonanController::class, 'hapus_item'])->name('permohonan.hapus.item');

        // Pengadaan
        Route::get('pengadaan', [PengadaanController::class, 'index'])->name('pengadaan.index');
        Route::get('pengadaan/detail_permohonan/{permohonan_id}', [PengadaanController::class, 'detail_permohonan'])->name('pengadaan.detail');
        Route::post('pengadaan/selesai_permohonan/{permohonan_id}', [PengadaanController::class, 'selesai_permohonan'])->name('pengadaan.selesai');
    });


    Route::group(['middleware' => 'can:isTataUsaha'], function(){
        // Validasi
        Route::get('validasi', [ValidasiController::class, 'index'])->name('validasi.index');
        Route::post('validasi/approve/{permohonan_id}', [ValidasiController::class, 'approve'])->name('validasi.approve');
        Route::post('validasi/reject/{permohonan_id}', [ValidasiController::class, 'reject'])->name('validasi.reject');
        Route::get('validasi/detail_permohonan/{permohonan_id}', [ValidasiController::class, 'detail_permohonan'])->name('validasi.detail');
    });

});


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
