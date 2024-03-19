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
        
        $pengaju = Datapengaju::whereHas('user', function ($query) {
            return $query->where('user_id', '=', auth()->user()->id);
        })->get();

        return view('atasan.cekdata_pengaju.index', compact('judul', 'unit', 'pengaju'));
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

            foreach ($post as $key => $value) {
                $value->status_persetujuanatasan = $request->status_persetujuanatasan[$key];
                $value->keterangan = $request->keterangan[$key];
                $value->save();
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
}
