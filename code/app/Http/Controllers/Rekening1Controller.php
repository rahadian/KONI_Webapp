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
class Rekening1Controller extends Controller
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
            'kode_rekening' => 'required',
            'kode_ketbarang' => 'required',
            'ket_rekening'  => 'required'
        ]);
        $getKodeBarang = KetBarang::where('id',$validated['kode_ketbarang'])->first();

        $rekening = new Rekening1();
        $rekening->kode_rekening = $validated['kode_rekening'];
        $rekening->ket_rekening = $validated['ket_rekening'];
        $rekening->kode_ketbarang = $getKodeBarang->kode_ketbarang;
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
    public function destroy(Rekening1 $rekening1)
    {
        // dd($rekening1);
        // die();
        if($rekening1->barang->isNotEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat menghapus data karena masih memiliki nama barang terkait'
            ], 422);
        }
        $rekening1->delete();
        return response()->json(['success' => true]);
        // return response()->json(['success' => true, 'data' => $rekening1]);
    }
}
