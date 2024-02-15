<?php

namespace App\Http\Controllers;

use App\Models\{Satuan, User, Jenisbarang, Databarang, ItemBarangMasuk};
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jenis = Jenisbarang::count();
        $user = User::count();
        $barang = Databarang::count();
        $satuan = Satuan::count();
        $from = ItemBarangMasuk::first();
        $to = ItemBarangMasuk::latest();
        return view('home', compact('jenis', 'user', 'barang', 'satuan', 'from', 'to'));
    }

    public function adminHome()
    {
        return view('adminHome');
    }
}
