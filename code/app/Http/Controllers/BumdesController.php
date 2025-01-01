<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Ikhtisar_bumdes;
use App\Models\Informasi;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Bumdes;
use Validator;
use Auth;
use Session;
use Storage;
use DB;
use Str;

date_default_timezone_set('Asia/Jakarta');
class BumdesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = "BUMDESA";
        $totalberita = Informasi::orderBy('created_at','DESC')
            ->where('status','publish')
            ->where('kategori','Berita')
            ->count();
        $totalpengumuman = Informasi::orderBy('created_at','DESC')
            ->where('status','publish')
            ->where('kategori','Pengumuman')
            ->count();
        $bumdes_type = $request->get('bumdes_type');
        if ($bumdes_type && !in_array($bumdes_type, ['Berbadan Hukum', 'Belum Berbadan Hukum'])) {
            return redirect()->route('home');
        }
        Session::put('bumdes_type', $bumdes_type);
        $kecamatan = Kecamatan::orderBy('kecamatan','ASC')
            ->get();
        $kelurahan = Kelurahan::orderBy('kecamatan','ASC')
            ->get();
        $bumdes = Bumdes::select('bumdes.*','kecamatan.nama as nama_kecamatan')
            ->when($bumdes_type, function ($q) use ($bumdes_type) {
                return $q->where('tipe_bumdes', '=', $bumdes_type);
            })
            ->join('kecamatan','kecamatan.kecamatan','=','bumdes.kecamatan')

            ->orderBy('kecamatan','ASC')
            ->get();
        $ikhtisar = Ikhtisar_bumdes::first();
        return view('front.bumdesa',[
            'page'=>$page,
            'totalberita'=>$totalberita,
            'totalpengumuman'=>$totalpengumuman,
            'kecamatan'=>$kecamatan,
            'kelurahan'=>$kelurahan,
            'bumdes'=>$bumdes,
            'bumdes_type'=>$bumdes_type,
            'ikhtisar'=>$ikhtisar,
        ]);
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
