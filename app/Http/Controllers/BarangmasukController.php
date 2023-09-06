<?php

namespace App\Http\Controllers;

use App\Models\Barangmasuk;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangmasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'subjudul' => 'Barang Masuk',
            'submenu' => 'barang masuk',
        ];
        return view('admin.barang_masuk.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'subjudul' => 'Barang Masuk',
            'submenu' => 'barang masuk',
        ];
        $barangmasuk = Barangmasuk::all();
        return view('admin.barang_masuk.create', compact('data', 'barangmasuk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $kode_nota = $request->kode_nota;
            $tanggal_pembelian = $request->tanggal_pembelian;
            $supplier_id = $request->supplier_id;
            $user_id = $request->user_id;
            $barang_id = $request->barang_id;
            $qty = $request->qty;
            $harga = $request->harga;

            $header = Barangmasuk::insertGetId([
                'kode_nota' => $request->kode_nota,
                'tanggal_pembelian' => $request->tanggal_pembelian,
                'supplier_id' => $request->supplier_id,
                'user_id' => $request->user_id,
                'barang_id' => $request->barang_id,
                'qty' => $request->qty,
                'harga' => $request->harga,
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
