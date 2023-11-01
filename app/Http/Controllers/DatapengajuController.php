<?php

namespace App\Http\Controllers;

use App\Models\Databarang;
use App\Models\Datapengaju;
use App\Models\ItemDataPengaju;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DatapengajuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $judul = [
            'subjudul' => 'Data Pengaju',
            'submenu' => 'data pengaju',
        ];

        $databarang = Databarang::all();
        // $datapengaju = Datapengaju::select("*")->orderBy('created_at', 'DESC')->get();

        $user = auth()->user(); // Sesuaikan dengan metode otentikasi Anda

        $datapengaju = Datapengaju::select("*")->orderBy('created_at', 'DESC')
                                    ->where('user_id', $user->id)->get();
        return view('pengaju.data_pengaju.index', compact('judul', 'databarang', 'datapengaju'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $judul = [
            'subjudul' => 'Data Pengaju',
            'submenu' => 'data pengaju',
        ];

        $datapengaju = Datapengaju::all();

        $databarang = Databarang::all();

        return view('pengaju.data_pengaju.create', compact('judul', 'datapengaju', 'databarang'));
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
            'code_pengajuan' => 'required',
            'tgl_pengajuan' => 'required',
        ], [
            'code_pengajuan.required' => 'code_pengajuan harus diisi',
            'tgl_pengajuan.required' => 'tgl_pengajuan harus diisi',
        ]);

        // DB::beginTransaction();

        $barang_id = $request->barang_id;
        $qty = $request->qty;
        $status_persetujuanatasan = $request->status_persetujuanatasan;
        $status_persetujuanadmin = $request->status_persetujuanadmin;

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $header = Datapengaju::insertGetId([
                'code_pengajuan' => $request->code_pengajuan,
                'tgl_pengajuan' => $request->tgl_pengajuan,
                'user_id' => Auth::user()->id,
                'status_setujuatasan' => '1',
                'status_pengajuan' => 0,
                'created_at' => Carbon::now(),
            ]);

            $barangs = Databarang::whereIn('id', $barang_id)->get();

            foreach ($barang_id as $key => $value) {
                $data = ItemDataPengaju::insert([
                    'datapengaju_id' => $header,
                    'barang_id' => $value,
                    'qty' => $qty[$key],
                    'status_persetujuanatasan' => $status_persetujuanatasan[$key],
                    'status_persetujuanadmin' => $status_persetujuanadmin[$key],
                    'created_at' => Carbon::now(),
                ]);

                // Update otomatis stok data barang
                $barang = $barangs->where('id', $value)->first();
                $barang->stok -= $qty[$key];
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
            'subjudul' => 'Pengajuan',
            'submenu' => 'pengajuan',
        ];

        $datapengaju = Datapengaju::find($id);
        $itemDatapengaju = ItemDataPengaju::where('datapengaju_id', $datapengaju->id)->get();

        return view('pengaju.data_pengaju.show', compact('data', 'datapengaju', 'itemDatapengaju'));
    }

    public function cetak($id)
    {
        $data = [
            'subjudul' => 'Pengajuan',
            'submenu' => 'pengajuan',
        ];

        $datapengaju = Datapengaju::find($id);
        $itemDatapengaju = ItemDataPengaju::where('datapengaju_id', $datapengaju->id)->get();

        return view('pengaju.pdf.cetak', compact('data', 'datapengaju', 'itemDatapengaju'));
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
        $databarang = ItemDataPengaju::where('datapengaju_id', $datapengaju->id)->get();

        return view('pengaju.data_pengaju.edit', compact('data', 'datapengaju', 'databarang'));
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
            $getDataPengaju = Datapengaju::findOrFail($id);

            $post = ItemDataPengaju::where('datapengaju_id', $getDataPengaju->id)->get();

            foreach ($post as $key => $value) {
                $value->qty = $request->qty[$key];
                $value->save();
            }

            $getDataPengaju->update([
                'code_pengajuan' => $request->code_pengajuan,
                'tgl_pengajuan' => $request->tgl_pengajuan,
            ]);

            return redirect('datapengaju')->with('success', 'Data berhasil diubah!');
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
        $id = explode('data',$request->ids);
        $data = ItemDataPengaju::find($id[1]);
        $data->delete();

        return response()->json([
            'status'=>200,
            'data' => $id[1],
        ]);
    }

    public function upload($id)
    {
        $data = [
            'subjudul' => 'Pengajuan',
            'submenu' => 'pengajuan',
        ];

        $datapengaju = Datapengaju::findOrFail($id);

        return view('pengaju.upload.upload', compact('data', 'datapengaju'));
    }

    public function updatePdf(Request $request, $id)
    {
        try {
            $request->validate([
                'files' => 'required|file|mimes:pdf|max:500',
            ]);

            $datapengaju = Datapengaju::findOrFail($id);
            $files = $request->file('files');

            if ($request->hasFile('files')) {
                $path = $files->store('public/berkas');
                // $url = str_replace('public/berkas', 'storage/berkas', $path);

                $datapengaju->update([
                    'upload_dokumen' => $path,
                ]);
            }

            return redirect('datapengaju')->with('success', 'Data berhasil diubah!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function dokumen($id)
    {
        $data = [
            'subjudul' => 'Dokumen',
            'submenu' => 'dokumen',
        ];

        $datapengaju = Datapengaju::findOrFail($id);

        return view('pengaju.dokumen.index', compact('data', 'datapengaju'));
    }
}
