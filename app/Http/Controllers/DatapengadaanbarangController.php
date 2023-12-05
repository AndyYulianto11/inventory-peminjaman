<?php

namespace App\Http\Controllers;

use App\Models\Databarang;
use App\Models\ItemDataPengadaanBarang;
use App\Models\ItemTransaksiPengadaanBarang;
use App\Models\TransaksiPengadaanBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DatapengadaanbarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'subjudul' => 'Data Pengadaan Barang',
            'submenu' => 'data pengadaan barang',
        ];

        $datapengadaanbarang = TransaksiPengadaanBarang::all();

        return view('admin.data_pengadaan_barang.index', compact('data', 'datapengadaanbarang'));
    }

    public function generateCodePengajuan()
    {
        $currentDate = now();
        $formattedDate = $currentDate->format('ymd');

        $lastCode = TransaksiPengadaanBarang::orderBy('kode_transaksi', 'desc')->first();

        if ($lastCode) {
            $lastNumber = intval(substr($lastCode->kode_transaksi, -7));
            $newNumber = str_pad($lastNumber + 1, 7, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0000001';
        }

        return 'TRPB' . $formattedDate . $this->getFormattedNumber($newNumber);
    }

    protected function getFormattedNumber($number)
    {
        $length = strlen($number);

        switch ($length) {
            case 1:
                return '000000' . $number;
            case 2:
                return '00000' . $number;
            case 3:
                return '0000' . $number;
            case 4:
                return '000' . $number;
            case 5:
                return '00' . $number;
            case 6:
                return '0' . $number;
            default:
                return $number;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'subjudul' => 'Transaksi Pengadaan Barang',
            'submenu' => 'transaksi pengadaan barang',
        ];

        $currentDateTime = Carbon::now();
        $kodeTransaksi = $this->generateCodePengajuan();

        return view('admin.data_pengadaan_barang.create', compact('data', 'currentDateTime', 'kodeTransaksi'));
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
            'nama_transaksi' => 'required',
            'tgl_transaksi' => 'required'
        ], [
            'nama_transaksi.required' => 'nama_transaksi harus diisi',
            'tgl_transaksi.required' => 'tgl_transaksi harus diisi'
        ]);

        $barang_id = $request->barang_id;
        $code_barang = $request->code_barang;
        $nama_barang = $request->nama_barang;
        $satuan = $request->satuan;
        $harga = $request->harga;
        $qty = $request->qty;

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $header = TransaksiPengadaanBarang::insertGetId([
                'kode_transaksi' => $request->kode_transaksi,
                'nama_transaksi' => $request->nama_transaksi,
                'tgl_transaksi' => $request->tgl_transaksi,
                'user_id' => Auth::user()->id,
                'status_transaksi' => $request->status_transaksi,
                'created_at' => Carbon::now(),
            ]);

            $getData = ItemDataPengadaanBarang::whereIn('barang_id', $barang_id)->get();

            foreach ($barang_id as $key => $value) {
                $data = ItemTransaksiPengadaanBarang::insert([
                    'transaksipengadaanbarang_id' => $header,
                    'barang_id' => $value,
                    'code_barang' => $code_barang[$key],
                    'nama_barang' => $nama_barang[$key],
                    'satuan' => $satuan[$key],
                    'harga' => $harga[$key],
                    'qty' => $qty[$key],
                    'created_at' => Carbon::now(),
                ]);

                $barang = $getData->where('barang_id', $value)->first();
                $barang->status = 0;
                $barang->save();
            }

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
            'subjudul' => 'Data Pengadaan Barang',
            'submenu' => 'data pengadaan barang',
        ];

        $datapengadaanbarang = TransaksiPengadaanBarang::find($id);
        $itemDatapengadaanbarang = ItemTransaksiPengadaanBarang::where('transaksipengadaanbarang_id', $datapengadaanbarang->id)->get();

        // dd($itemDatapengadaanbarang);
        return view('admin.data_pengadaan_barang.show', compact('data', 'datapengadaanbarang', 'itemDatapengadaanbarang'));
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
            'subjudul' => 'Data Pengadaan Barang',
            'submenu' => 'data pengadaan barang',
        ];

        $datapengadaanbarang = TransaksiPengadaanBarang::find($id);
        $itemDatapengadaanbarang = ItemTransaksiPengadaanBarang::where('transaksipengadaanbarang_id', $datapengadaanbarang->id)->get();
        // dd($itemDatapengadaanbarang);

        return view('admin.data_pengadaan_barang.edit', compact('data', 'datapengadaanbarang', 'itemDatapengadaanbarang'));
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
        // dd($request);
        $barang_id = $request->barang_id;
        $code_barang = $request->code_barang;
        $nama_barang = $request->nama_barang;
        $satuan = $request->satuan;
        $harga = $request->harga;
        $qty = $request->qty;
        try {
            // Update TransaksiPengadaanBarang model
            $transaksi = TransaksiPengadaanBarang::findOrFail($id);
            $transaksi->update([
                'nama_transaksi' => $request->input('nama_transaksi'),
                'status_transaksi' => $request->input('status_transaksi'),
            ]);

            // Update or delete ItemTransaksiPengadaanBarang items
            foreach ($barang_id as $key => $value) {
                $data = ItemTransaksiPengadaanBarang::insert([
                    'transaksipengadaanbarang_id' => $id,
                    'barang_id' => $value,
                    'code_barang' => $code_barang[$key],
                    'nama_barang' => $nama_barang[$key],
                    'satuan' => $satuan[$key],
                    'harga' => $harga[$key],
                    'qty' => $qty[$key],
                    'created_at' => Carbon::now(),
                ]);
                // $getData = ItemDataPengadaanBarang::whereIn('barang_id', $barang_id)->get();
                $barang = ItemDataPengadaanBarang::where('barang_id', $value)->first();
                $barang->status = 0;
                $barang->save();
                // if (isset($item['id'])) {
                //     // If the item has an ID, update it
                //     $itemModel = ItemTransaksiPengadaanBarang::findOrFail($item['id']);
                //     $itemModel->update($item);
                // } else {
                //     // If the item doesn't have an ID, create a new one
                //     $transaksi->items()->create($item);
                // }
            }

            return redirect()->back()->with('success', 'Data transaksi berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. ' . $e->getMessage());
        }
    }

    public function deleteItem($id)
    {
        try {
            // Find the item by ID and delete it
            $item = ItemTransaksiPengadaanBarang::findOrFail($id);
            $item->delete();

            $relatedItem = ItemDataPengadaanBarang::where('barang_id', $item->barang_id)->first();

            if ($relatedItem) {
                $relatedItem->status = 1;
                $relatedItem->save();
            }

            // Return a success response (you can customize the response as needed)
            return response()->json(['success' => true, 'message' => 'Item deleted successfully']);
        } catch (\Exception $e) {
            // Return an error response (you can customize the response as needed)
            return response()->json(['success' => false, 'message' => 'Error deleting item']);
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

    public function cetak($id)
    {
        $data = [
            'subjudul' => 'Data Pengadaan Barang',
            'submenu' => 'data pengadaan barang',
        ];

        $datapengadaanbarang = TransaksiPengadaanBarang::find($id);
        $itemDatapengadaanbarang = ItemTransaksiPengadaanBarang::where('transaksipengadaanbarang_id', $datapengadaanbarang->id)->get();

        return view('admin.data_pengadaan_barang.cetak', compact('data', 'datapengadaanbarang', 'itemDatapengadaanbarang'));
    }

    public function dataitem(Request $request)
    {
        $itemdatapengadaanbarang = ItemDataPengadaanBarang::with('barang.satuan')->where('status', 1)->get();

        return response()->json(['item_data' => $itemdatapengadaanbarang]);
    }

    public function getDataByDate(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // Query untuk mengambil data berdasarkan filter tanggal
        $filteredData = ItemDataPengadaanBarang::with('barang.satuan')
            ->where('status', 1)
            ->whereBetween('created_at', [$start_date, $end_date])
            ->get();

        return response()->json(['filteredData' => $filteredData]);
    }
}
