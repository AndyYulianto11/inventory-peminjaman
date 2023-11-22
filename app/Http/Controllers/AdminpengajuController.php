<?php

namespace App\Http\Controllers;

use App\Models\DataAsetUnit;
use App\Models\Databarang;
use App\Models\DataPengadaanBarang;
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
                $barang->stok -= $qty[$key];
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
        $dataA = Datapengaju::find($id); // Ambil data dari tabel A berdasarkan ID

        if (!$dataA) {
            return response()->json(['error' => 'Data not found'], 404);
        }
        // Mendapatkan data user yang sudah login
        $user = Auth::user();

        $datapengajuIds = ItemDataPengaju::where('datapengaju_id', $dataA->id)->pluck('id')->toArray();

        // $dataB = ItemDataPengaju::whereIn('datapengaju_id', $dataA->id)->get();
        $dataB = ItemDataPengaju::whereIn('id', $datapengajuIds)->get();

        foreach ($dataB as $value) {
            // Ambil nilai selisih dari tabel item_data_pengaju
            $selisihStok = $value->selisih;

            if ($selisihStok === 0) {
                $header = DataAsetUnit::create([
                    'kode_transaksi' => $dataA->code_pengajuan,
                    'tgl_transaksi' => $dataA->tgl_pengajuan,
                    'user_id' => $dataA->user_id,
                    'yang_menyerahkan' => $user->name,
                    // Tambahkan kolom lain yang sesuai
                ]);

                ItemDataAsetUnit::create([
                    'dataasetunit_id' => $header->id,
                    'barang_id' => $value->barang_id,
                    'qty' => $value->qty,
                ]);
            } else {

                $headerPengadaan = DataPengadaanBarang::create([
                    'kode_transaksi' => $dataA->code_pengajuan,
                    'tgl_transaksi' => $dataA->tgl_pengajuan,
                    'user_id' => $dataA->user_id,
                    'yang_menyerahkan' => $user->name,
                    // Tambahkan kolom lain yang sesuai
                ]);

                ItemDataPengadaanBarang::create([
                    'datapengadaanbarang_id' => $headerPengadaan->id,
                    'barang_id' => $value->barang_id,
                    'qty' => $value->qty,
                ]);
            }
        }

        return response()->json([
            'status' => 200,
            'message' => 'Proses Data berhasil dikirim',
        ]);
    }
}
