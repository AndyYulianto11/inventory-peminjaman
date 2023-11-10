<?php

namespace App\Http\Controllers;

use App\Models\Datapengaju;
use App\Models\ItemDataPengaju;
use Exception;
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

        $pengaju = Datapengaju::where('status_submit', 1)->get();

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

            $post = ItemDataPengaju::where('datapengaju_id', $getDataPengaju->id)->get();

            foreach ($post as $key => $value) {
                $value->status_persetujuanadmin = $request->status_persetujuanadmin[$key];
                $value->save();
            }

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
}
