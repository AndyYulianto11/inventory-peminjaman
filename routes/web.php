<?php

use App\Http\Controllers\AdminpengajuController;
use App\Http\Controllers\AtasanController;
use App\Http\Controllers\BarangmasukController;
use App\Http\Controllers\DashboardpengajuController;
use App\Http\Controllers\DatabarangController;
use App\Http\Controllers\DatapengajuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisbarangController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\SupplierController;
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
    Route::get('/databarang_shows', [DatabarangController::class, 'shows'])->name('shows-databarang');
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
    Route::get('/detail-barangmasuk/{id}', [BarangmasukController::class, 'show'])->name('detail-barangmasuk');
    Route::get('/edit-barangmasuk/{id}', [BarangmasukController::class, 'edit'])->name('edit-barangmasuk');
    Route::put('/update-barangmasuk/{id}', [BarangmasukController::class, 'update'])->name('update-barangmasuk');
    Route::post('/delete-barangmasuk', [BarangmasukController::class, 'destroy'])->name('delete-barangmasuk');

    // Supplier
    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');
    Route::post('/supplier', [SupplierController::class, 'store']);
    Route::post('/edit-supplier/{id}', [SupplierController::class, 'edit']);
    Route::post('/update-supplier', [SupplierController::class, 'update'])->name('supplier.update');
    Route::post('/delete-supplier', [SupplierController::class, 'destroy'])->name('supplier.destroy');

    // Cek Pengaju
    Route::get('/cek-pengaju', [AdminpengajuController::class, 'index'])->name('cek-pengaju');
    Route::get('/show-cek-pengaju/{id}', [AdminpengajuController::class, 'show'])->name('show-pengaju');
    Route::get('/edit-cek-pengaju/{id}', [AdminpengajuController::class, 'edit'])->name('edit-cek-pengaju');
    Route::put('/update-cek-pengaju/{id}', [AdminpengajuController::class, 'update'])->name('update-cek-pengaju');

});

Route::middleware(['auth', 'checkrole:administrator'])->group(function () {
    // Data User
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::post('/user', [UserController::class, 'store']);
    Route::post('/delete-user', [UserController::class, 'destroy'])->name('user.destroy');


});

Route::middleware(['auth', 'checkrole:pengaju'])->group(function () {
    // Home User Pengaju
    Route::get('/pengaju', [DashboardpengajuController::class, 'index'])->name('pengaju');

    // Cek Data Barang
    Route::get('/cekdatabarang', [DashboardpengajuController::class, 'cekdata'])->name('cekdatabarang');

    // Data Pengaju
    Route::get('/datapengaju', [DatapengajuController::class, 'index'])->name('datapengaju');
    Route::get('/create-datapengaju', [DatapengajuController::class, 'create'])->name('create-datapengaju');
    Route::post('/store-datapengaju', [DatapengajuController::class, 'store'])->name('store-datapengaju');

    Route::get('/detail-cek-pengaju/{id}', [DatapengajuController::class, 'show'])->name('lihat-data-pengaju');
    Route::get('/cetak/{id}', [DatapengajuController::class, 'cetak'])->name('cetak');

});

Route::middleware(['auth', 'checkrole:atasan'])->group(function () {
    // Home User Atasan
    Route::get('/atasan', [AtasanController::class, 'index'])->name('atasan');
});
