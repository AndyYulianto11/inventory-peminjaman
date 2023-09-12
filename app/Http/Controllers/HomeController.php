<?php

namespace App\Http\Controllers;

use App\Models\Databarang;
use App\Models\Jenisbarang;
use App\Models\Satuan;
use App\Models\User;
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
        return view('home', compact('jenis', 'user', 'barang', 'satuan'));
    }

    public function adminHome()
    {
        return view('adminHome');
    }
}
