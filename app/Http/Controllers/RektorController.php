<?php

namespace App\Http\Controllers;

use App\Models\Databarang;
use App\Models\Jenisbarang;
use App\Models\Satuan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ItemDataPengadaanBarang;
use App\Models\ItemTransaksiPengadaanBarang;
use App\Models\TransaksiPengadaanBarang;
use Exception;
use Dotenv\Validator;

class RektorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $judul = [
            'subjudul' => 'Rektor',
            'submenu' => 'rektor',
        ];

        $jenis = Jenisbarang::count();
        $user = User::count();
        $barang = Databarang::count();
        $satuan = Satuan::count();
        return view('rektor', compact('jenis', 'user', 'barang', 'satuan'));
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
            'subjudul' => 'Data Pengadaan Barang',
            'submenu' => 'data pengadaan barang',
        ];

        $datapengadaanbarang = TransaksiPengadaanBarang::find($id);
        $itemDatapengadaanbarang = ItemTransaksiPengadaanBarang::where('pengadaan_barang_id', $datapengadaanbarang->id)->get();

        // dd($itemDatapengadaanbarang);
        return view('rektorat.data_pengadaan_barang.show', compact('data', 'datapengadaanbarang', 'itemDatapengadaanbarang'));
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

    public function detailPengadaanbarang()
    {
        $datapengadaanbarang = TransaksiPengadaanBarang::where('status_setujurektorat', '0')->get()->all();

        return view('rektorat.data_pengadaan_barang.index', compact('datapengadaanbarang'));
    }

    public function detailPengadaanbarangByStatus($status)
    {
        $isEdit = false;
        $isDetail = false;

        $datapengadaanbarang = [];
        if($status == 'ditolak')
        {
            $data = TransaksiPengadaanBarang::where('status_setujurektorat', '4')->get()->all();
            foreach($data as $row)
            {
                $datapengadaanbarang[] = $row;
            }
        }else if($status == 'ditangguhkan')
        {
            $data = TransaksiPengadaanBarang::where('status_setujurektorat', '3')->get()->all();
            foreach($data as $row)
            {
                $datapengadaanbarang[] = $row;
            }
        }else if($status == 'disetujui')
        {
            $data = TransaksiPengadaanBarang::where('status_setujurektorat', '2')->get()->all();
            foreach($data as $row)
            {
                $datapengadaanbarang[] = $row;
            }
        }else if($status == 'diajukan')
        {
            $data = TransaksiPengadaanBarang::where('status_setujurektorat', '1')->get()->all();
            foreach($data as $row)
            {
                $datapengadaanbarang[] = $row;
            }
        }

        return view('rektorat.data_pengadaan_barang.index', compact('datapengadaanbarang'));
    }

    public function pengadaanBarangStore(Request $request)
    {
        try{
            $this->validate($request, [
                'status_setujurektorat' => 'required',
            ]);
            TransaksiPengadaanBarang::where('id', $request->id)->update(['status_setujurektorat' => $request->status_setujurektorat, 'komentar' => $request->komentar]);
            return redirect()->route('detail-datapengadaanbarang')->with('success', 'Data berhasil diupdate');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
