<?php

namespace App\Http\Controllers;

use App\Models\Databarang;
use Illuminate\Http\Request;

class DashboardpengajuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pengaju');
    }

    public function cekdata()
    {
        $judul = [
            'subjudul' => 'Data Barang',
            'submenu' => 'data barang',
        ];
        $databarang = Databarang::select("*")->orderBy('created_at', 'DESC')->get();
        return view('pengaju.cekdatabarang.index', compact('judul', 'databarang'));
    }
}
