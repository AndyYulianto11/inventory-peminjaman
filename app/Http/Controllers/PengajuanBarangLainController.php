<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Databarang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class PengajuanBarangLainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'code_barang' => 'required',
            'nama_barang' => 'required',
            'jenis_id' => 'required'
        ],[
            'code_barang.required' => 'Kode barang harap di isi',
            'nama_barang.required' => 'Nama barang harap di isi',
            'jenis_id.required' => 'Silahkan pilih jenis barang',
        ]
        );

        if($validator->fails()){
            Alert::error('Gagal menambahkan', 'Silahkan periksa kembali inputan anda!');
            return redirect('/create-datapengaju');
        }else{

            $data = Databarang::where(['code_barang' => $request->code_barang, 'nama_barang' => $request->nama_barang])->get()->all();

            if($data)
            {
                Alert::error('Gagal Menambahkan', 'Kode barang atau Nama barang sudah ada!');
                return redirect('/create-datapengaju');
            }else{
                Databarang::create([
                    'code_barang' => $request->code_barang,
                    'nama_barang' => $request->nama_barang,
                    'jenis_id' => $request->jenis_id,
                    'slug' => Str::slug($request->nama_barang)
                ]);
                Alert::success('Berhasil Menambahkan', 'Silahkan lanjutkan pengajuan anda!');
                return redirect('/create-datapengaju');
            }

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
