<?php

namespace App\Http\Controllers;

use App\Models\Datapengaju;
use Illuminate\Http\Request;

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

        $pengaju = Datapengaju::all();

        return view('admin.cek_pengaju.index', compact('data' ,'pengaju'));
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
    public function show(Request $request)
    {
        $showpengajuanbarang = Datapengaju::leftJoin('jenisbarang','jenisbarang.id','databarangs.jenis_id')
                                    ->leftJoin('satuans','satuans.id','databarangs.satuan_id')
                                    ->where('databarangs.id',$request->id)
                                    ->select('databarangs.*','satuans.satuan','jenisbarang.jenisbarang')->first();
        // dd($showdatabarang);
        return response()->json([
            'status'=>200,
            'data' => $showpengajuanbarang,
        ]);
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
