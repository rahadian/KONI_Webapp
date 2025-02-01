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
class BelanjaController extends Controller
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
        $validated = $request->validate([
            'kode_belanja' => 'required|unique:belanja',
            'kode_rekening' => 'required',
            'uraian_belanja' => 'required'
        ]);
        $getKodeRekening = Rekening::where('id',$validated['kode_rekening'])->first();
        $belanja = new Belanja();
        $belanja->kode_belanja = $validated['kode_belanja'];
        $belanja->uraian_belanja = $validated['uraian_belanja'];
        $belanja->kode_rekening = $getKodeRekening->kode_rekening;
        $belanja->save();

        return response()->json(['success' => true, 'data' => $belanja]);
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
    public function update(Request $request, Belanja $belanja)
    {
        $validated = $request->validate([
            'kode_belanja' => 'required|unique:belanja,kode_belanja,' . $belanja->id,
            'uraian_belanja' => 'required'
        ]);

        $belanja->update($validated);
        return response()->json(['success' => true, 'data' => $belanja]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Belanja $belanja)
    {
        $belanja->delete();
        return response()->json(['success' => true]);
    }
}
