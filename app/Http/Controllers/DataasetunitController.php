<?php

namespace App\Http\Controllers;

use App\Models\DataAsetUnit;
use App\Models\ItemDataAsetUnit;
use Illuminate\Http\Request;

class DataasetunitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'subjudul' => 'Data Aset Unit',
            'submenu' => 'data aset unit',
        ];

        $dataasetunit = DataAsetUnit::all();

        return view('admin.data_aset_unit.index', compact('data', 'dataasetunit'));
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
            'subjudul' => 'Data Aset Unit',
            'submenu' => 'data aset unit',
        ];

        $dataasetunit = DataAsetUnit::find($id);
        $itemDataasetunit = ItemDataAsetUnit::where('dataasetunit_id', $dataasetunit->id)->get();

        return view('admin.data_aset_unit.show', compact('data', 'dataasetunit', 'itemDataasetunit'));
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
