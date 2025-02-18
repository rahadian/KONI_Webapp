<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Cabor;
use App\Models\PengurusCabor;
use App\Models\Perencanaan;
use App\Models\KetBarang;
use App\Models\Rekening1;
use App\Models\Barang1;
use App\Models\Kegiatan;
use App\Models\LimitNominal;
use App\Models\PeriodeTahun;
use Validator;
use Auth;
use Session;
use Storage;
use DB;
use Str;

date_default_timezone_set('Asia/Jakarta');
class KetBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = "Data Inventaris Barang";
        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();
        $dtkegiatan = Kegiatan::orderBy('id','ASC')
                    ->paginate(5);
        $dtbarang = KetBarang::with(['rekening.barang'])->get();
        // dd($dtbarang);
        // die();
        if($user->role == "admin"){
            return view('back.kegiatan_barjas.index2',[
                'page'=>$page,
                'dtkegiatan'=>$dtkegiatan,
                'dtbarang'=>$dtbarang,
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
        return view('ket-barang.create');
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
            'kode_ketbarang' => 'required|unique:ket_barang',
            'ket_barang' => 'required'
        ],[
            'kode_ketbarang.required' => 'Kode Ket Barang wajib diisi.',
            'kode_ketbarang.unique' => 'Kode Barang sudah digunakan.',
            'ket_barang.required' => 'Keterangan Barang wajib diisi.'
        ]);
        $ketBarang = new KetBarang();
        $ketBarang->kode_ketbarang = $validated['kode_ketbarang'];
        $ketBarang->ket_barang = $validated['ket_barang'];
        $ketBarang->save();

        return response()->json(['success' => true, 'data' => $ketBarang]);
        // return redirect()->route('ket_barang.index')
        //     ->with('success', 'Keterangan Barang created successfully.');
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


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KetBarang $ketBarang)
    {
        $validated = $request->validate([
            'kode_ketbarang' => 'required|unique:ket_barang,kode_ketbarang,' . $ketBarang->id,
            'ket_barang' => 'required'
        ]);

        $ketBarang->update($validated);

        return response()->json(['success' => true, 'data' => $ketBarang]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(KetBarang $ketBarang)
    {
        // dd($ketBarang);
        // die();
        if($ketBarang->rekening->isNotEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat menghapus data karena masih memiliki rekening terkait'
            ], 422);
        }
        $ketBarang->delete();

        return response()->json(['success' => true, 'data' => $ketBarang]);
    }
}
