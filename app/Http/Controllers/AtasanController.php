<?php

namespace App\Http\Controllers;

use App\Models\Databarang;
use App\Models\Datapengaju;
use App\Models\ItemDataPengaju;
use App\Models\Jenisbarang;
use App\Models\Satuan;
use App\Models\Unit;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AtasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $judul = [
            'subjudul' => 'Atasan',
            'submenu' => 'atasan',
        ];

        $jenis = Jenisbarang::count();
        $user = User::count();
        $barang = Databarang::count();
        $satuan = Satuan::count();
        return view('atasan', compact('jenis', 'user', 'barang', 'satuan'));
    }

    public function cekdatapengaju()
    {
        $judul = [
            'subjudul' => 'Data Pengaju',
            'submenu' => 'data pengaju',
        ];

        $unit = Unit::all();
        $user = auth()->user();

        $isEdit = false;
        $isDetail = false;

        $datapengaju = Datapengaju::where('status_setujuatasan', '0')->get()->all();

        return view('atasan.cekdata_pengaju.index', compact('judul', 'unit', 'datapengaju', 'isEdit', 'isDetail'));
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

        return view('atasan.cekdata_pengaju.show', compact('judul', 'datapengaju', 'itemDatapengaju'));
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
        try {
            $this->validate($request, [
                'status_persetujuanatasan' => 'required',
            ]);

            $getDataPengaju = Datapengaju::findOrFail($id);

            $post = ItemDataPengaju::where('datapengaju_id', $getDataPengaju->id)->get();
            $status = DB::table('item_data_pengajus')
            ->select('item_data_pengajus.*',DB::raw('COUNT(status_persetujuanatasan) as count'))
            ->groupBy('status_persetujuanatasan')
            ->orderBy('count')
            ->get();
            dd($status);
            // dd(count(array_keys($request->status_persetujuanatasan, '1')) == count($request->status_persetujuanatasan));
            $cek_status = [];

            foreach ($post as $key => $value) {
                $value->status_persetujuanatasan = $request->status_persetujuanatasan[$key];
                $value->keterangan = $request->keterangan[$key];
                $value->save();
                array_push($cek_status, $request->status_persetujuanatasan[$key]);
            }

            $getDataPengaju->update([
                'status_setujuatasan' => $request->status_setujuatasan,
                'status_pengajuan' => '1',
            ]);

            return redirect('cekdatapengaju')->with('success', 'Data berhasil diubah!');
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

    public function getDataByStatus($status)
    {
        $judul = [
            'subjudul' => 'Data Pengaju',
            'submenu' => 'Data Pengaju',
        ];

        $isEdit = false;
        $isDetail = false;

        $datapengaju = [];

        if($status == 'ditolak'){
            $data = Datapengaju::where('status_setujuatasan', '4')->get()->all();
            foreach($data as $row){
                $datapengaju[] = $row;
            }
        }else if($status == 'ditangguhkan'){
            $data = Datapengaju::where('status_setujuatasan', '3')->get()->all();
            foreach($data as $row){
                $datapengaju[] = $row;
            }
        }else if($status == 'disetujui'){
            $data = Datapengaju::where('status_setujuatasan', '2')->get()->all();
            foreach($data as $row){
                $datapengaju[] = $row;
            }
        }else if($status == 'diajukan'){
            $data = Datapengaju::where('status_setujuatasan', '1')->get()->all();
            foreach($data as $row){
                $datapengaju[] = $row;
            }
        }

        return view('atasan.cekdata_pengaju.index', compact('datapengaju', 'judul', 'isEdit', 'isDetail'));
    }
}
