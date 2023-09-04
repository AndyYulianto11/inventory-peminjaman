<?php

namespace App\Http\Controllers;

use App\Models\Jenisbarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenisbarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $judul = [
            'subjudul' => 'Jenis Barang',
            'submenu' => 'jenis barang',
        ];
        $jenisbarang = Jenisbarang::select("*")->orderBy('created_at', 'DESC')->get();
        return view('admin.jenis_barang.index', compact('judul','jenisbarang'));
    }

    // public function fetchjenisbarang()
    // {
    //     $jenisbarang = Jenisbarang::all();
    //     return response()->json([
    //         'jenisbarang'=>$jenisbarang,
    //     ]);
    // }

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
            'jenisbarang' => 'required',
        ],[
            'jenisbarang.required' => 'Jenis Barang harus diisi',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }
        else
        {
            $jenisbarang = new Jenisbarang;
            $jenisbarang->jenisbarang = $request->input('jenisbarang');
            $jenisbarang->save();
            return response()->json([
                'status'=>200,
                'message'=>'Jenis barang berhasil ditambahkan',
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
        $jenisbarang = Jenisbarang::find($id);
        if ($jenisbarang)
        {
            return response()->json([
                'status'=>200,
                'jenisbarang'=>$jenisbarang,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Jenis barang Tidak Ditemukan',
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
    public function update(Request $request)
    {
        $id = explode('data',$request->id);
        $data = Jenisbarang::find($id[1]);
        $data->update([
            'jenisbarang'=>$request->jenisbarang
        ]);
        

        $jenisbarang = [
            'jenisbarang' =>$request->jenisbarang
        ];

        return response()->json([
            'status'=>200,
            "data" => $jenisbarang,
            'message'=>'Jenis barang berhasil diupdate',
        ]);
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
        $data = Jenisbarang::find($id[1]);
        $data->delete();

        return response()->json([
            'status'=>200,
            'data' => $id[1],
        ]);
    }
}
