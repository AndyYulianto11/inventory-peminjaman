<?php

namespace App\Http\Controllers;

use App\Models\DataAsetUnit;
use App\Models\Databarang;
use App\Models\Datapengaju;
use App\Models\HistoryStokBarang;
use App\Models\ItemDataAsetUnit;
use App\Models\ItemDataPengadaanBarang;
use App\Models\ItemDataPengaju;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminpengajuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'subjudul' => 'Pengajuan',
            'submenu' => 'pengajuan',
        ];

        $pengaju = Datapengaju::where('status_submit', 1)->get();
        // $pengaju = Datapengaju::get();

        return view('admin.cek_pengaju.index', compact('data', 'pengaju'));
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
            'subjudul' => 'Pengajuan',
            'submenu' => 'pengajuan',
        ];

        $datapengaju = Datapengaju::find($id);
        $itemDatapengaju = ItemDataPengaju::where('datapengaju_id', $datapengaju->id)->get();

        return view('admin.cek_pengaju.show', compact('data', 'datapengaju', 'itemDatapengaju'));
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
            'subjudul' => 'Pengajuan',
            'submenu' => 'pengajuan',
        ];

        $datapengaju = Datapengaju::find($id);
        $itemDatapengaju = ItemDataPengaju::where('datapengaju_id', $datapengaju->id)->get();

        return view('admin.cek_pengaju.edit', compact('data', 'datapengaju', 'itemDatapengaju'));
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
                'status_persetujuanadmin' => 'required',
            ]);

            $getDataPengaju = Datapengaju::findOrFail($id);
            $barang_id = $request->barang_id;
            $qty = $request->qty;

            $post = ItemDataPengaju::where('datapengaju_id', $getDataPengaju->id)->get();

            $barangs = Databarang::whereIn('id', $barang_id)->get();

            foreach ($post as $key => $value) {
                $value->status_persetujuanadmin = $request->status_persetujuanadmin[$key];
                $value->keterangan = $request->keterangan[$key];
                $value->save();

                // Update otomatis stok data barang
                $barang = $barangs->where('id', $value->barang_id)->first();
                $qtyToReduce = $qty[$key];
                if ($barang->stok >= $qtyToReduce) {
                    $barang->stok -= $qtyToReduce;
                } else {
                    $barang->stok = 0;
                }
                $barang->save();

                // Hitung dan simpan selisih
                // $selisih = max(0, $barang->stok - $qty[$key]);
                // $value->selisih = $selisih;
                // $value->save();

                // Record history stok data barang
                HistoryStokBarang::create([
                    'databarang_id' => $value->barang_id,
                    'itemdatapengaju_id' => $value->id,
                    'qty' => $qty[$key],
                    'keterangan' => 'Barang Dipinjam',
                ]);
            }

            $getDataPengaju->update([
                'status_setujuadmin' => $request->status_setujuadmin,
            ]);

            return redirect('cek-pengaju')->with('success', 'Data berhasil diubah!');
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
    public function destroy($id)
    {
        //
    }

    public function prosesInsert($id)
    {
        $dataA = Datapengaju::find($id);

        if (!$dataA) {
            return response()->json(['error' => 'Data not found'], 404);
        }

        $user = Auth::user();

        // Memproses ItemDataPengaju yang terkait dengan $id yang sedang diproses

        $datapengajuIds = ItemDataPengaju::where('datapengaju_id', $dataA->id)->pluck('id')->toArray();
        $dataB = ItemDataPengaju::whereIn('id', $datapengajuIds)->get();

        foreach ($dataB as $value) {
            $selisihStok = $value->selisih;

            if ($selisihStok === 0) {
                // Jika selisih adalah 0, masukkan data ke DataAsetUnit dan ItemDataAsetUnit

                $header = DataAsetUnit::firstOrCreate([
                    'kode_transaksi' => $dataA->code_pengajuan,
                    'tgl_transaksi' => $dataA->tgl_pengajuan,
                    'user_id' => $dataA->user_id,
                    'yang_menyerahkan' => $user->name,
                ]);

                ItemDataAsetUnit::create([
                    'dataasetunit_id' => $header->id,
                    'barang_id' => $value->barang_id,
                    'qty' => $value->qty,
                ]);
            } else {
                // Jika selisih bukan 0, masukkan data ke DataPengadaanBarang dan ItemDataPengadaanBarang

                // $headerPengadaan = DataPengadaanBarang::firstOrCreate([
                //     'kode_transaksi' => $dataA->code_pengajuan,
                //     'tgl_transaksi' => $dataA->tgl_pengajuan,
                //     'user_id' => $dataA->user_id,
                //     'yang_menyerahkan' => $user->name,
                // ]);

                ItemDataPengadaanBarang::create([
                    'barang_id' => $value->barang_id,
                    'qty' => $value->qty,
                    'status' => 1,
                ]);
            }
        }

        return response()->json([
            'status' => 200,
            'message' => 'Proses Data berhasil dikirim',
        ]);
    }
}
