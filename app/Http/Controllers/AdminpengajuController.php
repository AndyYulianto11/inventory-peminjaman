<?php

namespace App\Http\Controllers;

use App\Models\{DataAsetUnit, Databarang, Datapengaju, HistoryStokBarang, ItemBarangMasuk,
                ItemDataAsetUnit, ItemDataPengadaanBarang, ItemDataPengaju};
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
        $judul = [
            'subjudul' => 'Data Pengaju',
            'submenu' => 'Data Pengaju',
        ];

        $pengaju = Datapengaju::where(['status_setujuadmin' => '0'])->get();
        $itemBarang = ItemBarangMasuk::latest()->take(5)->get();

        return view('admin.cek_pengaju.index', compact('judul', 'pengaju', 'itemBarang'));
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
        $judul = [
            'subjudul' => 'Pengajuan',
            'submenu' => 'pengajuan',
        ];

        $datapengaju = Datapengaju::find($id);
        $itemDatapengaju = ItemDataPengaju::where('datapengaju_id', $datapengaju->id)->get();

        return view('admin.cek_pengaju.show', compact('judul', 'datapengaju', 'itemDatapengaju'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $judul = [
            'subjudul' => 'Pengajuan',
            'submenu' => 'pengajuan',
        ];

        $datapengaju = Datapengaju::find($id);
        $itemDatapengaju = ItemDataPengaju::where('datapengaju_id', $datapengaju->id)->get();

        return view('admin.cek_pengaju.edit', compact('judul', 'datapengaju', 'itemDatapengaju'));
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
            $keterangan = "";

            foreach ($post as $key => $value) {
                if(abs($value->selisih) > 0 && abs($value->selisih) != $value->qty)
                {
                    $keterangan = "Sebagian Serah Terima";
                    ItemDataPengadaanBarang::create([
                        'barang_id' => $value->barang_id,
                        'qty' => abs($value->selisih),
                    ]);
                }else if(abs($value->selisih) == 0)
                {
                    $keterangan = "Serah terima";
                }else if(abs($value->selisih) == $value->qty)
                {
                    $keterangan = "Belum Serah Terima";
                    ItemDataPengadaanBarang::create([
                        'barang_id' => $value->barang_id,
                        'qty' => abs($value->selisih),
                    ]);
                }

                $value->status_persetujuanadmin = $request->status_persetujuanadmin[$key];
                $value->keterangan = $keterangan;
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

            $statusBelumSerahTerima = ItemDataPengaju::where(['datapengaju_id' => $getDataPengaju->id, 'status_persetujuanadmin' => '2'])->count('status_persetujuanadmin');
            $statusSerahTerima = ItemDataPengaju::where(['datapengaju_id' => $getDataPengaju->id, 'status_persetujuanadmin' => '3'])->count('status_persetujuanadmin');
            $statusSebagianSerahTerima = ItemDataPengaju::where(['datapengaju_id' => $getDataPengaju->id, 'status_persetujuanadmin' => '4'])->count('status_persetujuanadmin');

            if($statusBelumSerahTerima > 0 && $statusSerahTerima == 0 && $statusSebagianSerahTerima == 0){
                $status_setujuadmin = '2';

                $getDataPengaju->update([
                    'status_setujuadmin' => $status_setujuadmin,
                ]);

                return redirect('cek-pengaju')->with('success', 'Data berhasil diubah!');
            }else if($statusSerahTerima > 0 && $statusBelumSerahTerima == 0 && $statusSebagianSerahTerima == 0){
                $status_setujuadmin = '3';

                $getDataPengaju->update([
                    'status_setujuadmin' => $status_setujuadmin,
                ]);

                return redirect('cek-pengaju')->with('success', 'Data berhasil diubah!');
            }else{
                $status_setujuadmin = '4';

                $getDataPengaju->update([
                    'status_setujuadmin' => $status_setujuadmin,
                ]);

                return redirect('cek-pengaju')->with('success', 'Data berhasil diubah!');
            }
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

    public function getDataByStatus($status)
    {
        $judul = [
            'subjudul' => 'Data Pengaju',
            'submenu' => 'Data Pengaju',
        ];

        $isEdit = false;
        $isDetail = false;

        $pengaju = [];

        if($status == 'sebagian-serah-terima'){
            $data = Datapengaju::where('status_setujuadmin', '4')->get()->all();
            foreach($data as $row){
                $pengaju[] = $row;
            }
        }else if($status == 'serah-terima'){
            $data = Datapengaju::where('status_setujuadmin', '3')->get()->all();
            foreach($data as $row){
                $pengaju[] = $row;
            }
        }else if($status == 'belum-serah-terima'){
            $data = Datapengaju::where('status_setujuadmin', '2')->get()->all();
            foreach($data as $row){
                $pengaju[] = $row;
            }
        }else if($status == 'diajukan'){
            $data = Datapengaju::where('status_setujuadmin', '1')->get()->all();
            foreach($data as $row){
                $pengaju[] = $row;
            }
        }

        return view('admin.cek_pengaju.index', compact('pengaju', 'judul', 'isEdit', 'isDetail'));
    }
}
