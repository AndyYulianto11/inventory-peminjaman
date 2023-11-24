<?php

namespace App\Http\Controllers;

use App\Models\DataPengadaanBarang;
use App\Models\ItemDataPengadaanBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DatapengadaanbarangController extends Controller
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

        $datapengadaanbarang = DataPengadaanBarang::all();

        return view('admin.data_pengadaan_barang.index', compact('data', 'datapengadaanbarang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'subjudul' => 'Transaksi Pengadaan Barang',
            'submenu' => 'transaksi pengadaan barang',
        ];
        $currentDateTime = Carbon::now();

        return view('admin.data_pengadaan_barang.create', compact('data', 'currentDateTime'));
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

        $datapengadaanbarang = DataPengadaanBarang::find($id);
        $itemDatapengadaanbarang = ItemDataPengadaanBarang::where('datapengadaanbarang_id', $datapengadaanbarang->id)->get();

        // dd($itemDatapengadaanbarang);
        return view('admin.data_pengadaan_barang.show', compact('data', 'datapengadaanbarang', 'itemDatapengadaanbarang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'subjudul' => 'Data Pengadaan Barang',
            'submenu' => 'data pengadaan barang',
        ];

        $datapengadaanbarang = DataPengadaanBarang::find($id);
        $itemDatapengadaanbarang = ItemDataPengadaanBarang::where('datapengadaanbarang_id', $datapengadaanbarang->id)->get();

        return view('admin.data_pengadaan_barang.edit', compact('data', 'datapengadaanbarang', 'itemDatapengadaanbarang'));
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
        try {
            $this->validate($request, [
                'kondisi_barang' => 'required',
            ]);

            $getDataPengaju = DataPengadaanBarang::findOrFail($id);

            $post = ItemDataPengadaanBarang::where('datapengadaanbarang_id', $getDataPengaju->id)->get();

            foreach ($post as $key => $value) {
                $value->kondisi_barang = $request->kondisi_barang[$key];
                $value->save();
            }

            return response()->json(['status' => 'success', 'message' => 'Data berhasil diubah!']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
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

    public function getDataByDate(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // Query untuk mengambil data berdasarkan filter tanggal
        $filteredData = ItemDataPengadaanBarang::with('barang.satuan')
                                                ->where('status', '1')
                                                ->whereBetween('created_at', [$start_date, $end_date]) 
                                                ->get();

        return response()->json(['filteredData' => $filteredData]);
    }
}
