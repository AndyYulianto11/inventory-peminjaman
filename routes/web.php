<?php

use App\Http\Controllers\BarangmasukController;
use App\Http\Controllers\DatabarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisbarangController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

Route::middleware(['auth', 'checkrole:administrator,admingudang,kepalagudang'])->group(function () {
    // Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Data Barang
    Route::get('/databarang', [DatabarangController::class, 'index'])->name('databarang');
    Route::post('/store-databarang', [DatabarangController::class, 'store'])->name('store-databarang');
    Route::get('/edit-databarang/{id}', [DatabarangController::class, 'edit'])->name('edit-databarang');
    Route::put('/update-databarang/{id}', [DatabarangController::class, 'update'])->name('update-databarang');
    Route::post('/delete-databarang', [DatabarangController::class, 'destroy'])->name('databarang.destroy');

    // Jenis Barang
    Route::get('/jenisbarang', [JenisbarangController::class, 'index'])->name('jenisbarang');
    Route::get('fetch-jenisbarangs', [JenisbarangController::class, 'fetchjenisbarang']);
    Route::post('/jenisbarang', [JenisbarangController::class, 'store']);
    Route::post('/edit-jenisbarang/{id}', [JenisbarangController::class, 'edit']);
    Route::post('/update-jenisbarang', [JenisbarangController::class, 'update'])->name('jenisbarang.update');
    Route::post('/delete-jenisbarang', [JenisbarangController::class, 'destroy'])->name('jenisbarang.destroy');

    // Satuan
    Route::get('/satuan', [SatuanController::class, 'index'])->name('satuan');
    Route::post('/satuan', [SatuanController::class, 'store']);
    Route::get('fetch-satuans', [SatuanController::class, 'fetchsatuan']);
    Route::post('/edit-satuan/{id}', [SatuanController::class, 'edit']);
    Route::post('/update-satuan', [SatuanController::class, 'update'])->name('satuan.update');
    Route::post('/delete-satuan', [SatuanController::class, 'destroy'])->name('satuan.destroy');

    // Barang Masuk
    Route::get('/barangmasuk', [BarangmasukController::class, 'index'])->name('barangmasuk');
    Route::get('/create-barangmasuk', [BarangmasukController::class, 'create'])->name('create-barangmasuk');
    Route::post('/store-barangmasuk', [BarangmasukController::class, 'store'])->name('store-barangmasuk');

});

Route::middleware(['auth', 'checkrole:administrator'])->group(function () {
    // Data User
    Route::get('/user', [UserController::class, 'index'])->name('user');
});
