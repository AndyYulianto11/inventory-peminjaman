<?php

namespace App\Http\Controllers;

use App\Models\Databarang;
use App\Models\HistoryStokBarang;
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
        $judul = [
            'subjudul' => 'Data Barang',
            'submenu' => 'data barang',
        ];
        $jenis = Jenisbarang::all();
        $satuans = Satuan::all();
        $databarang = Databarang::select("*")->orderBy('created_at', 'DESC')->get();
        return view('admin.data_barang.index', compact('judul', 'databarang', 'jenis', 'satuans'));
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
        $number = mt_rand(1000000000000, 9999999999999);

        if ($this->codeBarangExists($number)) {
            $number = mt_rand(1000000000000, 9999999999999);
        }

        $request['code_barang'] = $number;

        try {
            $request->validate([
                'nama_barang' => 'required',
                'jenis_id' => 'required',
                'stok' => 'required',
                'satuan_id' => 'required',
                'harga' => 'required',
            ]);

            $post = Databarang::create([
                'code_barang' => $number,
                'nama_barang' => $request->nama_barang,
                'jenis_id' => $request->jenis_id,
                'stok' => $request->stok,
                'satuan_id' => $request->satuan_id,
                'harga' => $request->harga,
            ]);

            HistoryStokBarang::create([
                'databarang_id' => $post->id,
                'qty' => $post->stok,
                'keterangan' => 'Insert Data Barang',
            ]);

            return redirect('databarang')->with('success', 'Data berhasil ditambahkan!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function codeBarangExists($number) {
        return Databarang::whereCodeBarang($number)->exists();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function shows(Request $request)
    {
        $showdatabarang = Databarang::leftJoin('jenisbarang','jenisbarang.id','databarangs.jenis_id')
                                    ->leftJoin('satuans','satuans.id','databarangs.satuan_id')
                                    ->where('databarangs.id',$request->id)
                                    ->select('databarangs.*','satuans.satuan','jenisbarang.jenisbarang')->first();
        // dd($showdatabarang);
        return response()->json([
            'status'=>200,
            'data' => $showdatabarang,
        ]);

        // return view('admin.data_barang.index', compact('databarang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jenis = Jenisbarang::all();
        $satuans = Satuan::all();
        $databarang = Databarang::findOrFail($id);
        return view('admin.data_barang.edit', compact('databarang', 'jenis', 'satuans'));
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
        $number = mt_rand(1000000000000, 9999999999999);

        if ($this->codeBarangExists($number)) {
            $number = mt_rand(1000000000000, 9999999999999);
        }

        $request['code_barang'] = $number;

        try {
            $this->validate($request, [
                'nama_barang' => 'required',
                'jenis_id' => 'required',
                'stok' => 'required',
                'satuan_id' => 'required',
                'harga' => 'required',
            ]);

            $post = Databarang::findOrFail($id);

            $post->update([
                'code_barang' => $number,
                'nama_barang' => $request->nama_barang,
                'jenis_id' => $request->jenis_id,
                'stok' => $request->stok,
                'satuan_id' => $request->satuan_id,
                'harga' => $request->harga,
            ]);

            return redirect('databarang')->with('success', 'Data berhasil diupdate!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = explode('data',$request->ids);
        $data = Databarang::find($id[1]);
        $data->delete();

        return response()->json([
            'status'=>200,
            'data' => $id[1],
        ]);
    }
}
