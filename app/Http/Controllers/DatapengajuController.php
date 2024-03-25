<?php

namespace App\Http\Controllers;

use App\Models\{Databarang, Datapengaju, ItemDataPengaju, JenisBarang};
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

        // $datapengaju = Datapengaju::select("*")->orderBy('created_at', 'DESC')
        //                             ->where('user_id', $user->id)->get();
        return view('pengaju.data_pengaju.index', compact('judul', 'databarang'));
    }

    public function generateCodePengajuan()
    {
        $currentDate = now();
        $formattedDate = $currentDate->format('ymd');

        $lastCode = Datapengaju::orderBy('code_pengajuan', 'desc')->first();

        if ($lastCode) {
            $lastNumber = intval(substr($lastCode->code_pengajuan, -7));
            $newNumber = str_pad($lastNumber + 1, 7, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0000001';
        }

        return $formattedDate . $this->getFormattedNumber($newNumber);
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
        $judul = [
            'subjudul' => 'Data Pengaju',
            'submenu' => 'data pengaju',
        ];

        $datapengaju = Datapengaju::all();

        $databarang = Databarang::all();

        $jenisbarang = JenisBarang::all();

        $codePengajuan = $this->generateCodePengajuan();

        return view('pengaju.data_pengaju.create', compact('judul', 'datapengaju', 'databarang', 'codePengajuan', 'jenisbarang'));
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
            'tgl_pengajuan' => 'required',
        ], [
            'tgl_pengajuan.required' => 'tgl_pengajuan harus diisi',
        ]);

        // DB::beginTransaction();

        $barang_id = $request->barang_id;
        $qty = $request->qty;
        $status_persetujuanatasan = $request->status_persetujuanatasan;

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
                $barang = $barangs->where('id', $value)->first();

                if ($barang->stok > $qty[$key]) {
                    $selisih = 0;
                } elseif ($barang->stok < $qty[$key]) {
                    $selisih = $barang->stok - $qty[$key];
                }

                $data = ItemDataPengaju::insert([
                    'datapengaju_id' => $header,
                    'barang_id' => $value,
                    'qty' => $qty[$key],
                    'selisih' => $selisih,
                    'status_persetujuanatasan' => $status_persetujuanatasan[$key],
                    'created_at' => Carbon::now(),
                ]);
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
                'status_setujuatasan' => '1'
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
                'files' => 'required|file|mimes:pdf',
            ]);

            $datapengaju = Datapengaju::findOrFail($id);
            $files = $request->file('files');

            if ($request->hasFile('files')) {
                $path = $files->store('public/berkas');
                $files->move(public_path('storage/berkas/'), $files->getClientOriginalName());
                // $url = str_replace('public/berkas', 'storage/berkas', $path);

                $datapengaju->update([
                    'upload_dokumen' => $files->getClientOriginalName(),
                    'status_submit' => '0',
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

    public function updateStatus($id)
    {
        $item = Datapengaju::find($id);
        if ($item) {
            $item->status_submit = 1;
            $item->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Data sudah terkirim',
            ]);
        }

        return response()->json(['status' => 'error']);
    }
}
