<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cabor;
use App\Models\PengurusCabor;
use App\Models\Perencanaan;
use App\Models\BelanjaBarjas;
use App\Models\Kegiatan;
use App\Models\Rekening;
use App\Models\Belanja;
use App\Models\Barang;
use App\Models\LimitNominal;
use App\Models\PeriodeTahun;
use Validator;
use Auth;
use Session;
use Storage;
use DB;
use Str;

date_default_timezone_set('Asia/Jakarta');
class BarangController extends Controller
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
            'kode_barang' => 'required|unique:barang',
            'kode_belanja' => 'required',
            'nama_barang' => 'required',
            'harga_satuan' => 'required|integer|min:0'
        ]);
        $getKodeBelanja = Belanja::where('id',$validated['kode_belanja'])->first();
        $barang = new Barang();
        $barang->kode_barang = $validated['kode_barang'];
        $barang->nama_barang = $validated['nama_barang'];
        $barang->harga_satuan = $validated['harga_satuan'];
        $barang->kode_belanja = $getKodeBelanja->kode_belanja;
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
    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|unique:barang,kode_barang,' . $barang->id,
            'nama_barang' => 'required',
            'harga_satuan' => 'required|integer|min:0'
        ]);

        $barang->update($validated);
        return response()->json(['success' => true, 'data' => $barang]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return response()->json(['success' => true]);
    }
}
