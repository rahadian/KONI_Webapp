<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Cabor;
use App\Models\PengurusCabor;
use App\Models\Perencanaan;
use App\Models\KetBarang;
use App\Models\Rekening1;
use App\Models\Barang1;

date_default_timezone_set('Asia/Jakarta');
class Barang1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->merge([
            'harga_satuan' => str_replace('.', '', $request->input('harga_satuan'))
        ]);
        $validated = $request->validate([
            'kode_rekening' => 'required',
            'nama_barang' => 'required',
            'harga_satuan' => 'required|integer|min:0'
        ]);
        $getKodeRekening = Rekening1::where('id',$validated['kode_rekening'])->first();

        $barang = new Barang1();
        $barang->nama_barang = $validated['nama_barang'];
        $barang->harga_satuan = $validated['harga_satuan'];
        $barang->kode_rekening = $getKodeRekening->kode_rekening;
        $barang->save();

        return response()->json(['success' => true, 'data' => $barang]);
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
    public function destroy($id)
    {
        //
    }
}
