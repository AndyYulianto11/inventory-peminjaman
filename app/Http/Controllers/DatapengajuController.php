<?php

namespace App\Http\Controllers;

use App\Models\Databarang;
use App\Models\Datapengaju;
use App\Models\ItemDataPengaju;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DatapengajuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $judul = [
            'subjudul' => 'Data Pengaju',
            'submenu' => 'data pengaju',
        ];

        $databarang = Databarang::all();
        $datapengaju = Datapengaju::select("*")->orderBy('created_at', 'DESC')->get(); // ini untuk apa

        return view('pengaju.data_pengaju.index', compact('judul', 'databarang', 'datapengaju'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $judul = [
            'subjudul' => 'Data Pengaju',
            'submenu' => 'data pengaju',
        ];

        $datapengaju = Datapengaju::all(); // ini untuk apa

        $databarang = Databarang::all();

        return view('pengaju.data_pengaju.create', compact('judul', 'datapengaju', 'databarang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code_pengajuan' => 'required',
            'tgl_pengajuan' => 'required',
        ], [
            'code_pengajuan.required' => 'code_pengajuan harus diisi',
            'tgl_pengajuan.required' => 'tgl_pengajuan harus diisi',
        ]);

        // DB::beginTransaction();

        $barang_id = $request->barang_id;
        $qty = $request->qty;
        $status = $request->status;

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $header = Datapengaju::insertGetId([
                'code_pengajuan' => $request->code_pengajuan,
                'tgl_pengajuan' => $request->tgl_pengajuan,
                'user_id' => Auth::user()->id,
            ]);

            $barangs = Databarang::whereIn('id', $barang_id)->get();

            foreach ($barang_id as $key => $value) {
                $data = ItemDataPengaju::insert([
                    'datapengaju_id' => $header,
                    'barang_id' => $value,
                    'qty' => $qty[$key],
                    'status' => $status[$key],
                    'created_at' => Carbon::now(),
                ]);

                // Update otomatis stok data barang
                $barang = $barangs->where('id', $value)->first();
                $barang->stok -= $qty[$key];
                $barang->save();
            }

            return response()->json([
                'status' => 200,
                'message' => 'Barang masuk berhasil ditambahkan',
                'data' => $data
            ]);
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
        $data = [
            'subjudul' => 'Pengajuan',
            'submenu' => 'pengajuan',
        ];

        $datapengaju = Datapengaju::find($id);
        $itemDatapengaju = ItemDataPengaju::where('datapengaju_id', $datapengaju->id)->get();

        return view('pengaju.data_pengaju.show', compact('data', 'datapengaju', 'itemDatapengaju'));
    }

    public function cetak($id)
    {
        $data = [
            'subjudul' => 'Pengajuan',
            'submenu' => 'pengajuan',
        ];

        $datapengaju = Datapengaju::find($id);
        $itemDatapengaju = ItemDataPengaju::where('datapengaju_id', $datapengaju->id)->get();

        return view('pengaju.pdf.cetak', compact('data', 'datapengaju', 'itemDatapengaju'));
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
