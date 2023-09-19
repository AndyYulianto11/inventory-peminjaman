<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SatuanController extends Controller
{
    public function index()
    {
        $judul = [
            'subjudul' => 'Satuan',
            'submenu' => 'satuan',
        ];
        $satuan = Satuan::select("*")->orderBy('created_at', 'DESC')->get();
        return view('admin.satuan.index', compact('judul','satuan'));
    }

    // public function fetchsatuan()
    // {
    //     $satuan = Satuan::all();
    //     return response()->json([
    //         'satuan'=>$satuan,
    //     ]);
    // }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'satuan' => 'required',
            'qty' => 'required',
        ],[
            'satuan.required' => 'Satuan harus diisi',
            'qty.required' => 'Qty harus diisi',
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
            $satuan = new Satuan;
            $satuan->satuan = $request->input('satuan');
            $satuan->qty = $request->input('qty');
            $satuan->save();
            return response()->json([
                'status'=>200,
                'message'=>'Satuan berhasil ditambahkan',
            ]);
        }
    }

    public function edit($id)
    {
        $satuan = Satuan::find($id);
        if ($satuan)
        {
            return response()->json([
                'status'=>200,
                'satuan'=>$satuan,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Satuan Tidak Ditemukan',
            ]);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'satuanedit' => 'required',
            'qtyedit' => 'required',
        ],[
            'satuanedit.required' => 'Satuan harus diisi',
            'qtyedit.required' => 'Qty harus diisi',
        ]);

        if ($validator->fails()) 
        {
            return response()->json([
                'status'=>400,
                'data'=>$validator->errors(),
            ]);
        }else{
            $id = explode('data',$request->id);
            $data = Satuan::find($id[1]);
            $data->update([
                'satuan'=>$request->satuanedit,
                'qty'=>$request->qtyedit,
            ]);
            
    
            $satuan = [
                'satuan' =>$request->satuanedit,
                'qty' =>$request->qtyedit,
            ];
    
            return response()->json([
                'status'=>200,
                "data" => $satuan,
                'message'=>'Satuan berhasil diupdate',
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $id = explode('data',$request->ids);
        $data = Satuan::find($id[1]);
        $data->delete();

        return response()->json([
            'status'=>200,
            'data' => $id[1],
        ]);
    }
}
