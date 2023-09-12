<?php

namespace App\Http\Controllers;

use App\Models\Barangmasuk;
use App\Models\Databarang;
use App\Models\ItemBarangMasuk;
use App\Models\Supplier;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BarangmasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'subjudul' => 'Barang Masuk',
            'submenu' => 'barang masuk',
        ];

        $barangmasuk = Barangmasuk::all();

        return view('admin.barang_masuk.index', compact('data', 'barangmasuk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'subjudul' => 'Barang Masuk',
            'submenu' => 'barang masuk',
        ];

        $databarang = Databarang::all();
        $supplier = Supplier::all();

        return view('admin.barang_masuk.create', compact('data', 'databarang', 'supplier'));
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
            'kode_nota' => 'required',
            'tanggal_pembelian' => 'required',
            'supplier_id' => 'required',
            'barang_id' => 'required',
            'qty' => 'required',
            'harga' => 'required',
            'jumlah' => 'required',
        ], [
            'kode_nota.required' => 'kode_nota harus diisi',
            'tanggal_pembelian.required' => 'tanggal_pembelian harus diisi',
            'supplier_id.required' => 'supplier_id harus diisi',
            'barang_id.required' => 'barang_id harus diisi',
            'qty.required' => 'qty harus diisi',
            'harga.required' => 'harga harus diisi',
            'jumlah.required' => 'jumlah harus diisi',
        ]);

        // DB::beginTransaction();

        $supplier_id = $request->supplier_id;
        $barang_id = $request->barang_id;
        $qty = $request->qty;
        $harga = $request->harga;
        $jumlah = $request->jumlah;

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $header = Barangmasuk::insertGetId([
                'kode_nota' => $request->kode_nota,
                'tanggal_pembelian' => $request->tanggal_pembelian,
                'total_bayar' => 0,
                'created_at' => Carbon::now(),
            ]);

            foreach ($barang_id as $key => $value) {
                $data = ItemBarangMasuk::insert([
                    'barangmasuk_id' => $header,
                    'supplier_id' => $supplier_id[$key],
                    'user_id' => Auth::user()->id,
                    'barang_id' => $value,
                    'qty' => $qty[$key],
                    'harga' => $harga[$key],
                    'jumlah' => $jumlah[$key],
                    'created_at' => Carbon::now(),
                ]);
            }

            $updateHarga = Barangmasuk::where('id', $header)->first();

            $updateHarga->update([
                'total_bayar' => $request->total_bayar_input,
                'ppn_angka' => $request->ppn_angka,
                'ppn_persen' => $request->ppn_persen,
                'diskon_angka' => $request->diskon_angka,
                'diskon_persen' => $request->diskon_persen
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Barang masuk berhasil ditambahkan',
                'data' => $data
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
    public function destroy(Request $request)
    {
        $id = explode('data', $request->ids);
        $data = Barangmasuk::find($id[1]);
        $data->delete();

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Data berhasil dihapus!',
            'data' => $id[1],
        ]);
    }
}
