<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $judul = [
            'subjudul' => 'Supplier',
            'submenu' => 'supplier',
        ];
        $supplier = Supplier::select("*")->orderBy('created_at', 'DESC')->get();
        return view('admin.supplier.index', compact('judul','supplier'));
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
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ],[
            'nama.required' => 'Supplier harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'no_telp.required' => 'No Telepon harus diisi',
        ]);

        if ($validator->fails()) 
        {
            return response()->json([
                'status'=>400,
                'data'=>$validator->errors(),
            ]);
        }
        else
        {
            $supplier = new Supplier();
            $supplier->nama = $request->input('nama');
            $supplier->alamat = $request->input('alamat');
            $supplier->no_telp = $request->input('no_telp');
            $supplier->save();
            return response()->json([
                'status'=>200,
                'message'=>'Supplier berhasil ditambahkan',
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
        $supplier = Supplier::find($id);
        if ($supplier)
        {
            return response()->json([
                'status'=>200,
                'supplier'=>$supplier,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Supplier Tidak Ditemukan',
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
        $data = Supplier::find($id[1]);
        $data->update([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'no_telp'=>$request->no_telp,
        ]);
        

        $supplier = [
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'no_telp'=>$request->no_telp,
        ];

        return response()->json([
            'status'=>200,
            "data" => $supplier,
            'message'=>'Supplier berhasil diupdate',
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
        $data = Supplier::find($id[1]);
        $data->delete();

        return response()->json([
            'status'=>200,
            'data' => $id[1],
        ]);
    }
}
