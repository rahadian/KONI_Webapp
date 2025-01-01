<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;
use Validator;
use Auth;
use Session;
use Storage;
use DB;
use Str;

date_default_timezone_set('Asia/Jakarta');
class InformasiFrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function show($slug)
    {
        $data = Informasi::where("slug_judul",$slug)
                        ->first();
        $page = $data->judul;
        $totalberita = Informasi::orderBy('created_at','DESC')
                    ->where('status','publish')
                    ->where('kategori','Berita')
                    ->count();
        $totalpengumuman = Informasi::orderBy('created_at','DESC')
                    ->where('status','publish')
                    ->where('kategori','Pengumuman')
                    ->count();
        $beritalain = Informasi::where('status','publish')
                            ->where('kategori','Berita')
                            ->whereNotIn("slug_judul",[$data->slug_judul])
                            ->orderBy('created_at','DESC')
                            ->limit(3)
                            ->get();
        return view('front.detail_informasi',[
            'page'=>$page,
            'data'=>$data,
            'totalberita'=>$totalberita,
            'totalpengumuman'=>$totalpengumuman,
            'beritalain'=>$beritalain,
        ]);
    }

    public function show_all()
    {
        $page = "Semua Berita";

        $pinned = Informasi::orderBy('created_at','DESC')
                    ->where('kategori','Pinned')
                    ->where('status','publish')
                    ->limit(3)
                    ->get();

        $informasi = Informasi::orderBy('created_at','DESC')
                    ->where('status','publish')
                    ->where('kategori','Berita')
                    ->paginate(8);

        $totalberita = Informasi::orderBy('created_at','DESC')
                    ->where('status','publish')
                    ->where('kategori','Berita')
                    ->count();
        $totalpengumuman = Informasi::orderBy('created_at','DESC')
                    ->where('status','publish')
                    ->where('kategori','Pengumuman')
                    ->count();

        return view('front.all_informasi',[
            'page'=>$page,
            'pinned'=>$pinned,
            'informasi'=>$informasi,
            'totalberita'=>$totalberita,
            'totalpengumuman'=>$totalpengumuman,
        ]);
    }

    public function show_pengumuman($slug)
    {
        $data = Informasi::where("slug_judul",$slug)
                        ->first();
        $page = $data->judul;
        $totalberita = Informasi::orderBy('created_at','DESC')
                    ->where('status','publish')
                    ->where('kategori','Berita')
                    ->count();
        $totalpengumuman = Informasi::orderBy('created_at','DESC')
                    ->where('status','publish')
                    ->where('kategori','Pengumuman')
                    ->count();
        $pengumumanlain = Informasi::where('status','publish')
                            ->where('kategori','Pengumuman')
                            ->whereNotIn("slug_judul",[$data->slug_judul])
                            ->orderBy('created_at','DESC')
                            ->limit(3)
                            ->get();
        return view('front.detail_informasi',[
            'page'=>$page,
            'data'=>$data,
            'totalberita'=>$totalberita,
            'totalpengumuman'=>$totalpengumuman,
            'beritalain'=>$pengumumanlain,
        ]);
    }

    public function show_pengumuman_all()
    {
        $page = "Semua Pengumuman";

        $pinned = Informasi::orderBy('created_at','DESC')
                    ->where('kategori','Pinned')
                    ->where('status','publish')
                    ->limit(3)
                    ->get();

        $informasi = Informasi::orderBy('created_at','DESC')
                    ->where('status','publish')
                    ->where('kategori','Pengumuman')
                    ->paginate(8);

        $totalberita = Informasi::orderBy('created_at','DESC')
                    ->where('status','publish')
                    ->where('kategori','Berita')
                    ->count();
        $totalpengumuman = Informasi::orderBy('created_at','DESC')
                    ->where('status','publish')
                    ->where('kategori','Pengumuman')
                    ->count();

        return view('front.all_informasi',[
            'page'=>$page,
            'pinned'=>$pinned,
            'informasi'=>$informasi,
            'totalberita'=>$totalberita,
            'totalpengumuman'=>$totalpengumuman,
        ]);
    }

    public function show_pinned($slug)
    {
        $data = Informasi::where("slug_judul",$slug)
                        ->first();
        $page = $data->judul;
        $totalberita = Informasi::orderBy('created_at','DESC')
                    ->where('status','publish')
                    ->where('kategori','Berita')
                    ->count();
        $totalpengumuman = Informasi::orderBy('created_at','DESC')
                    ->where('status','publish')
                    ->where('kategori','Pengumuman')
                    ->count();
        $pinnedlain = Informasi::where('status','publish')
                            ->where('kategori','Pinned')
                            ->whereNotIn("slug_judul",[$data->slug_judul])
                            ->orderBy('created_at','DESC')
                            ->limit(3)
                            ->get();
        return view('front.detail_informasi',[
            'page'=>$page,
            'data'=>$data,
            'totalberita'=>$totalberita,
            'totalpengumuman'=>$totalpengumuman,
            'beritalain'=>$pinnedlain,
        ]);
    }

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


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
