<?php

namespace App\Http\Controllers;

use App\Models\Databarang;
use App\Models\Jenisbarang;
use App\Models\Satuan;
use Exception;
use Illuminate\Http\Request;

class DatabarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis = Jenisbarang::all();
        $satuans = Satuan::all();
        $databarang = Databarang::select("*")->orderBy('created_at', 'DESC')->get();
        return view('admin.data_barang.index', compact('databarang', 'jenis', 'satuans'));
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
        try {
            $request->validate([
                'nama_barang' => 'required',
                'jenis_id' => 'required',
                'stok' => 'required',
                'satuan_id' => 'required',
            ]);

            $post = Databarang::create([
                'nama_barang' => $request->nama_barang,
                'jenis_id' => $request->jenis_id,
                'stok' => $request->stok,
                'satuan_id' => $request->satuan_id,
            ]);

            return redirect('databarang')->with('success', 'Data berhasil ditambahkan!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
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
    public function edit()
    {
        return view('admin.data_barang.edit');
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
