<?php

namespace App\Http\Controllers;

use App\Models\Databarang;
use App\Models\ItemTransaksiPengadaanBarang;
use App\Models\Jenisbarang;
use App\Models\Satuan;
use App\Models\TransaksiPengadaanBarang;
use App\Models\User;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $judul = [
            'subjudul' => 'Keuangan',
            'submenu' => 'keuangan',
        ];

        $jenis = Jenisbarang::count();
        $user = User::count();
        $barang = Databarang::count();
        $satuan = Satuan::count();
        return view('keuangan', compact('jenis', 'user', 'barang', 'satuan'));
    }

    public function datatransaksipengadaan()
    {
        $data = [
            'subjudul' => 'Transaksi Pengadaan Barang',
            'submenu' => 'transaksi pengadaan barang',
        ];

        $datapengadaanbarang = TransaksiPengadaanBarang::all();

        return view('keuangan.data_pengadaan_barang.index', compact('data', 'datapengadaanbarang'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'subjudul' => 'Transaksi Pengadaan Barang',
            'submenu' => 'transaksi pengadaan barang',
        ];

        $datapengadaanbarang = TransaksiPengadaanBarang::find($id);
        $itemDatapengadaanbarang = ItemTransaksiPengadaanBarang::where('transaksipengadaanbarang_id', $datapengadaanbarang->id)->get();

        // dd($itemDatapengadaanbarang);
        return view('keuangan.data_pengadaan_barang.show', compact('data', 'datapengadaanbarang', 'itemDatapengadaanbarang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cetak($id)
    {
        $data = [
            'subjudul' => 'Transaksi Pengadaan Barang',
            'submenu' => 'transaksi pengadaan barang',
        ];

        $datapengadaanbarang = TransaksiPengadaanBarang::find($id);
        $itemDatapengadaanbarang = ItemTransaksiPengadaanBarang::where('transaksipengadaanbarang_id', $datapengadaanbarang->id)->get();

        return view('keuangan.data_pengadaan_barang.cetak', compact('data', 'datapengadaanbarang', 'itemDatapengadaanbarang'));
    }
}
