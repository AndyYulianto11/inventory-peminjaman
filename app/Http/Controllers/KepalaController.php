<?php

namespace App\Http\Controllers;

use App\Models\ItemTransaksiPengadaanBarang;
use App\Models\TransaksiPengadaanBarang;
use Illuminate\Http\Request;

class KepalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'subjudul' => 'Data Pengadaan Barang',
            'submenu' => 'data pengadaan barang',
        ];

        $datapengadaanbarang = TransaksiPengadaanBarang::all();

        return view('kepala_bau_it.data_pengadaan_barang.index', compact('data', 'datapengadaanbarang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            'subjudul' => 'Data Pengadaan Barang',
            'submenu' => 'data pengadaan barang',
        ];

        $datapengadaanbarang = TransaksiPengadaanBarang::find($id);
        $itemDatapengadaanbarang = ItemTransaksiPengadaanBarang::where('transaksipengadaanbarang_id', $datapengadaanbarang->id)->get();

        // dd($itemDatapengadaanbarang);
        return view('kepala_bau_it.data_pengadaan_barang.show', compact('data', 'datapengadaanbarang', 'itemDatapengadaanbarang'));
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
}
