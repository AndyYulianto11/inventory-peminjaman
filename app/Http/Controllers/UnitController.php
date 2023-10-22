<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $judul = [
            'subjudul' => 'Unit',
            'submenu' => 'unit',
        ];
        $unit = Unit::select("*")->orderBy('created_at', 'DESC')->get();
        return view('admin.unit.index', compact('judul','unit'));
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
        $validator = Validator::make($request->all(),[
            'kode_unit' => 'required',
            'nama_unit' => 'required',
            'lokasi_unit' => 'required',
            'status_unit' => 'required',
        ],[
            'kode_unit.required' => 'Kode Unit harus diisi',
            'nama_unit.required' => 'Nama harus diisi',
            'lokasi_unit.required' => 'Lokasi harus diisi',
            'status_unit.required' => 'Status harus diisi',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'data'=>$validator->errors(),
            ]);
        }
        else
        {
            $unit = new Unit;
            $unit->kode_unit = $request->input('kode_unit');
            $unit->nama_unit = $request->input('nama_unit');
            $unit->lokasi_unit = $request->input('lokasi_unit');
            $unit->status_unit = $request->input('status_unit');
            $unit->save();
            return response()->json([
                'status'=>200,
                'message'=>'Unit berhasil ditambahkan',
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit = Unit::find($id);
        if ($unit)
        {
            return response()->json([
                'status'=>200,
                'kode_unit'=>$unit,
                'nama_unit'=>$unit,
                'lokasi_unit'=>$unit,
                'status_unit'=>$unit,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Unit Tidak Ditemukan',
            ]);
        }
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
    public function destroy(Request $request)
    {
        $id = explode('data',$request->ids);
        $data = Unit::find($id[1]);
        $data->delete();

        return response()->json([
            'status'=>200,
            'data' => $id[1],
        ]);
    }
}
