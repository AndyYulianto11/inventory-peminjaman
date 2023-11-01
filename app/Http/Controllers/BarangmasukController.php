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
                'supplier_id' => $request->supplier_id,
                'created_at' => Carbon::now(),
            ]);

            $barangs = Databarang::whereIn('id', $barang_id)->get();

            foreach ($barang_id as $key => $value) {
                $data = ItemBarangMasuk::insert([
                    'barangmasuk_id' => $header,
                    'user_id' => Auth::user()->id,
                    'barang_id' => $value,
                    'qty' => $qty[$key],
                    'harga' => $harga[$key],
                    'jumlah' => $jumlah[$key],
                    'created_at' => Carbon::now(),
                ]);

                // Update otomatis stok data barang
                $barang = $barangs->where('id', $value)->first();
                $barang->stok += $qty[$key];
                $barang->save();
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
        $data = [
            'subjudul' => 'Barang Masuk',
            'submenu' => 'barang masuk',
        ];

        $barangmasuk = Barangmasuk::find($id);
        $itemBarangmasuk = ItemBarangMasuk::where('barangmasuk_id', $barangmasuk->id)->get();

        return view('admin.barang_masuk.detail', compact('data', 'barangmasuk', 'itemBarangmasuk'));
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
            'subjudul' => 'Barang Masuk',
            'submenu' => 'barang masuk',
        ];

        $barangmasuk = Barangmasuk::find($id);
        $itemBarangmasuk = ItemBarangMasuk::where('barangmasuk_id', $barangmasuk->id)->get();
        $supplier = Supplier::all();

        return view('admin.barang_masuk.edit', compact('data', 'barangmasuk', 'itemBarangmasuk', 'supplier'));
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
                'kode_nota' => 'required',
                'tanggal_pembelian' => 'required',
                'supplier_id' => 'required',
            ]);

            $post = Barangmasuk::findOrFail($id);

            $post->update([
                'kode_nota' => $request->kode_nota,
                'tanggal_pembelian' => $request->tanggal_pembelian,
                'supplier_id' => $request->supplier_id,
            ]);

            return redirect('barangmasuk')->with('success', 'Data berhasil diubah!');
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

    public function laporan_barang_masuk(Request $request)
    {
        $data = [
            'subjudul' => 'Laporan Barang Masuk',
            'submenu' => 'laporan barang masuk',
        ];

        return view('admin.laporan.laporan_barang_masuk', compact('data'));
    }

    public function view_laporan_barang_masuk($tglawal, $tglakhir)
    {
        // $cetaklaporan = ItemBarangMasuk::with('barangmasuk_id')->whereBetween('tanggal_pembelian', [$tglawal, $tglakhir])->get();

        $cetaklaporan = DB::table('barangmasuks')
                            ->join('item_barang_masuks', 'barangmasuks.id', '=', 'item_barang_masuks.barangmasuk_id')
                            ->select('barangmasuks.*', 'item_barang_masuks.*')
                            ->whereBetween('barangmasuks.tanggal_pembelian', [$tglawal, $tglakhir])
                            ->get();

        return view('admin.laporan.v_print_barang_masuk', compact('cetaklaporan'));

    }
}
