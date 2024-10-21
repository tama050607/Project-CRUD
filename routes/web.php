<?php

use Illuminate\Support\Facades\Route;
// use : untukimport file
// samakan route nya sesuai dengan namespace
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\UserController;
// mengelola obat
// memilin index karena ingin memunculkan data didalam MedicineController
Route::get('/', [LandingPageController::class, 'index'])->name('landing_page');
// prefix digunakan untuk menjadi nama awal
Route::prefix('/obat')->name('obat.')->group(function(){
    // Menampilkan Formulir
    Route::get('/tambah', [MedicineController::class, 'create'])
    ->name('tambah');
    // Menangani proses data Formulir
    Route::post('/tambah', [MedicineController::class, 'store'])
    ->name('tambah.formulir');
    Route::get('/data', [MedicineController::class, 'index'])->name('data');
    // / pertama untuk mengakses data yang ingin diubah, / kedua untuk menambahkan fitur di controller.
    // {} parameter diamis digunakan untuk mencari data yang spesifik
    // menggunakan "id" karena datanya spesifik
    Route::delete('/hapus/{id}', [MedicineController::class, 'destroy'])->name('hapus');
    Route::get('obat/edit/{id}', [MedicineController::class, 'edit'])->name('edit');
    Route::patch('obat/update/{id}', [MedicineController::class, 'update'])->name('edit.formulir');
    Route::patch('/edit/stock/{id}', [MedicineController::class, 'updateStock'])->name('edit.stock');
});

Route::prefix('/kelola')->name('kelola.')->group(function(){
Route::get('/halaman', [UserController::class, 'index'])->name('akun');
   // Munculin web
Route::get('/tambah', [UserController::class, 'create'])->name('akun.formulir');
   // Nambah akun
Route::post('/tambah-akun', [UserController::class, 'store'])->name('akun.tambah');
Route::get('kelola/edit/{id}', [UserController::class, 'edit'])->name('edit.form');
Route::patch('kelola/edits/{id}', [UserController::class, 'update'])->name('edit.selesai');
Route::delete('/hapus/{id}', [UserController::class, 'destroy'])->name('akun.hapus');
});
