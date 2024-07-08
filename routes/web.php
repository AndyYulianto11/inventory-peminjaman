<?php

use App\Http\Controllers\{AdminpengajuController, AtasanController, BarangmasukController, DashboardpengajuController, DataasetunitController,
                          DatabarangController, DatapengadaanbarangController, DatapengajuController, HomeController, JenisbarangController,
                          KepalaController, UserController, UnitController, SupplierController, SatuanController, RektorController, KeuanganController, BarangKeluarController, LaporanBarangKeluarController,
                          PengajuanBarangLainController
                        };
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;

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
    Route::get('/edit-databarang/{slug}', [DatabarangController::class, 'edit'])->name('edit-databarang');
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
    Route::get('/cek-pengaju/{status}', [AdminpengajuController::class, 'getDataByStatus'])->name('cek-pengaju-admin');
    Route::get('/show-cek-pengaju/{id}', [AdminpengajuController::class, 'show'])->name('show-pengaju');
    Route::get('/edit-cek-pengaju/{id}', [AdminpengajuController::class, 'edit'])->name('edit-cek-pengaju');
    Route::put('/update-cek-pengaju/{id}', [AdminpengajuController::class, 'update'])->name('update-cek-pengaju');
    Route::get('/lihat-berkas/{id}', [DatapengajuController::class, 'dokumen'])->name('lihat-berkas');
    // Mengirim data ke Data Aset Item
    Route::post('/proses-insert/{id}', [AdminpengajuController::class, 'prosesInsert'])->name('proses.insert');

    // Laporan Barang Masuk
    Route::get('/laporan-barang-masuk', [BarangmasukController::class, 'laporan_barang_masuk'])->name('laporan-barang-masuk');
    Route::get('/cetak-laporan-barang-masuk/{tglawal}/{tglakhir}', [BarangmasukController::class, 'view_laporan_barang_masuk'])->name('cetak-laporan-barang-masuk');
    Route::resource('laporan-barang-keluar', LaporanBarangKeluarController::class);

    // Data Aset Unit
    Route::get('/cek-dataasetunit', [DataasetunitController::class, 'index'])->name('cek-dataasetunit');
    Route::get('/show-cek-dataasetunit/{id}', [DataasetunitController::class, 'show'])->name('show-dataasetunit');
    Route::get('/edit-cek-dataasetunit/{id}', [DataasetunitController::class, 'edit'])->name('edit-cek-dataasetunit');
    Route::put('/update-cek-dataasetunit/{id}', [DataasetunitController::class, 'update'])->name('update-cek-dataasetunit');
    Route::get('/cetak-dataasetunit/{id}', [DataasetunitController::class, 'cetak'])->name('cetak-dataasetunit');

    // Data Pengadaan Barang
    Route::get('/cek-datapengadaanbarang', [DatapengadaanbarangController::class, 'index'])->name('cek-datapengadaanbarang');
    Route::get('/cek-datapengadaanbarang/{status}', [DatapengadaanbarangController::class, 'getDataByStatus'])->name('cek-datapengadaanbarang-admin');
    Route::get('/create-datapengadaanbarang', [DatapengadaanbarangController::class, 'create'])->name('create-datapengadaanbarang');
    Route::post('/store-datapengadaanbarang', [DatapengadaanbarangController::class, 'store'])->name('store-datapengadaanbarang');
    Route::get('/show-cek-datapengadaanbarang/{id}', [DatapengadaanbarangController::class, 'show'])->name('show-datapengadaanbarang');
    Route::get('/edit-cek-datapengadaanbarang/{id}', [DatapengadaanbarangController::class, 'edit'])->name('edit-cek-datapengadaanbarang');
    Route::put('/update-cek-datapengadaanbarang/{id}', [DatapengadaanbarangController::class, 'update'])->name('update-cek-datapengadaanbarang');
    Route::put('/cek-datapengadaanbarang/update-status/{id}', [DatapengadaanbarangController::class, 'updateStatus'])->name('update.status');
    Route::put('/update-status-rektorat/{id}', [DatapengadaanbarangController::class, 'updateStatusRektorat'])->name('update-status-rektorat');
    Route::post('/delete-pengadaan-barang/{id}', [DatapengadaanbarangController::class, 'destroy']);

    Route::get('/cetak-datapengadaanbarang/{id}', [DatapengadaanbarangController::class, 'cetak'])->name('cetak-datapengadaanbarang');
    Route::get('/get-item-data', [DatapengadaanbarangController::class, 'dataitem'])->name('get-item-data');
    Route::get('/get-data-by-date', [DatapengadaanbarangController::class, 'getDataByDate']);
    Route::post('/delete-item/{id}', [DatapengadaanbarangController::class, 'deleteItem'])->name('delete-item');
    Route::post('/delete-pengadaan/{id}', [DatapengadaanbarangController::class, 'destroy'])->name('delete-pengadaan');

    Route::resource('barang-keluar', BarangKeluarController::class);

});

Route::middleware(['auth', 'checkrole:administrator'])->group(function () {
    // Data User
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::post('/user', [UserController::class, 'store']);
    Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/update-user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::post('/delete-user', [UserController::class, 'destroy'])->name('user.destroy');

    // Data Unit
    Route::get('/unit', [UnitController::class, 'index'])->name('unit');
    Route::post('/unit', [UnitController::class, 'store']);
    Route::get('/edit-unit/{id}', [UnitController::class, 'edit'])->name('unit.edit');
    Route::put('/update-unit/{id}', [UnitController::class, 'update'])->name('unit.update');
    Route::post('/delete-unit', [UnitController::class, 'destroy'])->name('unit.destroy');


});

Route::middleware(['auth', 'checkrole:pengaju'])->group(function () {
    // Home User Pengaju
    Route::get('/pengaju', [DashboardpengajuController::class, 'index'])->name('pengaju');

    // Cek Data Barang
    Route::get('/cekdatabarang', [DashboardpengajuController::class, 'cekdata'])->name('cekdatabarang');

    // Data Pengaju
    Route::get('/datapengaju/{role}', [DatapengajuController::class, 'index'])->name('datapengaju');
    Route::get('/datapengaju/atasan/{status}', [DatapengajuController::class, 'getDataByStatus'])->name('datapengaju-atasan');
    Route::get('/datapengaju/admin/{status}', [DatapengajuController::class, 'getDataByStatusAdmin'])->name('datapengaju-admin');
    Route::get('/create-datapengaju', [DatapengajuController::class, 'create'])->name('create-datapengaju');
    Route::post('/store-datapengaju', [DatapengajuController::class, 'store'])->name('store-datapengaju');
    Route::resource('pengajuan-lainnya', PengajuanBarangLainController::class);

    Route::get('/detail-datapengaju/{role}/{id}', [DatapengajuController::class, 'show'])->name('lihat-data-pengaju');
    Route::get('/cetak/{id}', [DatapengajuController::class, 'cetak'])->name('cetak');

    Route::get('/edit-datapengaju/{role}/{id}', [DatapengajuController::class, 'edit'])->name('edit-datapengaju');
    Route::put('/update-datapengaju/{id}', [DatapengajuController::class, 'update'])->name('update-datapengaju');

    Route::post('/delete-item-datapengaju', [DatapengajuController::class, 'destroy'])->name('delete-item-datapengaju');

    Route::get('/lihat-dokumen/{id}', [DatapengajuController::class, 'dokumen'])->name('lihat-dokumen');

    // upload file pdf
    Route::get('/upload/{id}', [DatapengajuController::class, 'upload'])->name('upload');
    Route::put('/upload-pdf/{id}', [DatapengajuController::class, 'updatePdf'])->name('upload-pdf');

    // ubah status submit pengaju
    Route::put('/update-status/{id}', [DatapengajuController::class, 'updateStatus'])->name('update.status');
    Route::put('/update-setuju-atasan/{id}', [DatapengajuController::class, 'updateSetujuatasan'])->name('update.setuju');

});

Route::middleware(['auth', 'checkrole:atasan'])->group(function () {
    // Home User Atasan
    Route::get('/atasan', [AtasanController::class, 'index'])->name('atasan');
    // Cek Data Pengaju
    Route::get('/cekdatapengaju', [AtasanController::class, 'cekdatapengaju'])->name('cekdatapengaju');
    Route::get('/cekdatapengaju/{status}', [AtasanController::class, 'getDataByStatus'])->name('cekdatapengaju-atasan');

    Route::get('/pengadaan-barang', [AtasanController::class, 'getPengadaanBarang'])->name('pengadaan-barang');
    Route::get('/pengadaan-barang/{status}', [AtasanController::class, 'getPengadaanBarangByStatus'])->name('pengadaan-barang-status');
    Route::get('/pengadaan-barang/detail/{id}', [AtasanController::class, 'getPengadaanBarangById'])->name('pengadaan-barang-cek');
    Route::post('/pengadaan-barang', [AtasanController::class, 'pengadaanBarangStore'])->name('pengadaan-barang-store');
    Route::post('/delete-pengadaan/{id}', [AtasanController::class, 'deletePengadaan']);

    Route::get('/detail-data-pengaju/{id}', [AtasanController::class, 'show'])->name('detail-data-pengaju');
    Route::put('/update-data-pengaju/{id}', [AtasanController::class, 'update'])->name('update-data-pengaju');

    Route::get('/lihat-file/{id}', [DatapengajuController::class, 'dokumen'])->name('lihat-file');
});

Route::middleware(['auth', 'checkrole:keuangan'])->group(function () {
    // Home User Keuangan
    Route::get('/keuangan', [KeuanganController::class, 'index'])->name('keuangan');

    // Data Pengadaan Barang
    Route::get('/cek-datatransaksipengadaan', [KeuanganController::class, 'datatransaksipengadaan'])->name('cek-datatransaksipengadaan');
    Route::get('/show-cek-datatransaksipengadaan/{id}', [KeuanganController::class, 'show'])->name('show-datatransaksipengadaan');
    Route::get('/cetak-datatransaksipengadaan/{id}', [KeuanganController::class, 'cetak'])->name('cetak-datatransaksipengadaan');

});

Route::middleware(['auth', 'checkrole:rektor'])->group(function () {
    // Home User Rektor
    Route::get('/rektor', [RektorController::class, 'index'])->name('rektor');
    Route::get('/detail-datapengadaanbarang', [RektorController::class, 'detailPengadaanbarang'])->name('detail-datapengadaanbarang');
    Route::get('/detail-datapengadaanbarang-rektorat/{status}', [RektorController::class, 'detailPengadaanbarangByStatus'])->name('detail-datapengadaanbarang-rektorat');
    Route::get('/show-datapengadaanbarang-rektorat/{id}', [RektorController::class, 'show'])->name('show-datapengadaanbarang-rektorat');
    Route::post('/pengadaan-barang-rektor-update', [RektorController::class, 'pengadaanBarangStore'])->name('pengadaan-barang-rektor-update');
});

Route::middleware(['auth', 'checkrole:kepalagudang'])->group(function () {
    // Data Pengadaan Barang
    Route::get('/cek-datapengadaan', [KepalaController::class, 'index'])->name('cek-datapengadaan');
    Route::get('/show-cek-datapengadaan/{id}', [KepalaController::class, 'show'])->name('show-datapengadaan');

});
