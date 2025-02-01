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
class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = "Data Inventaris";
        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();
        $kegiatans = Kegiatan::with(['rekenings.belanjas.barangs'])->get();
        // dd($kegiatans);
        // die();
        if($user->role == "admin"){
            return view('back.kegiatan_barjas.index',[
                'page'=>$page,
                'kegiatans'=>$kegiatans,
            ]);
        }else{
            return redirect()->route('cmshome.index')->with(['error' => 'Unauthorized Access. User Tidak Diijinkan.']);
        }
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
            'kode_kegiatan' => 'required|unique:kegiatan',
            'uraian_kegiatan' => 'required'
        ]);

        // $kegiatan = Kegiatan::create($validated);
        $kegiatan = new Kegiatan();
        $kegiatan->kode_kegiatan = $validated['kode_kegiatan'];
        $kegiatan->uraian_kegiatan = $validated['uraian_kegiatan'];
        $kegiatan->save();
        return response()->json(['success' => true, 'data' => $kegiatan]);
        // return response()->json($kegiatan);
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
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validated = $request->validate([
            'kode_kegiatan' => 'required|unique:kegiatan,kode_kegiatan,' . $kegiatan->id,
            'uraian_kegiatan' => 'required'
        ]);

        $kegiatan->update($validated);
        // return response()->json($kegiatan);
        return response()->json(['success' => true, 'data' => $kegiatan]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();
        return response()->json(['success' => true]);
    }
}
