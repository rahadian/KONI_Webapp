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
class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
            'kode_rekening' => 'required|unique:rekening',
            'kode_kegiatan' => 'required',
            'uraian_rekening' => 'required'
        ]);
        $getKodeKegiatan = Kegiatan::where('id',$validated['kode_kegiatan'])->first();
        $rekening = new Rekening();
        $rekening->kode_rekening = $validated['kode_rekening'];
        $rekening->uraian_rekening = $validated['uraian_rekening'];
        $rekening->kode_kegiatan = $getKodeKegiatan->kode_kegiatan;
        $rekening->save();

        return response()->json(['success' => true, 'data' => $rekening]);
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
    public function update(Request $request, Rekening $rekening)
    {
        $validated = $request->validate([
            'kode_rekening' => 'required|unique:rekening,kode_rekening,' . $rekening->id,
            'uraian_rekening' => 'required'
        ]);

        $rekening->update($validated);
        return response()->json(['success' => true, 'data' => $rekening]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rekening $rekening)
    {
        $rekening->delete();
        return response()->json(['success' => true]);
    }
}
