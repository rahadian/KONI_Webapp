<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Informasi;

date_default_timezone_set('Asia/Jakarta');
class StrukturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = "Struktur Organisasi";
        $pinned = Informasi::orderBy('created_at','DESC')
                    ->where('kategori','Pinned')
                    ->where('status','publish')
                    ->limit(3)
                    ->get();
        $totalberita = Informasi::orderBy('created_at','DESC')
                    ->where('status','publish')
                    ->where('kategori','Berita')
                    ->count();
        $totalpengumuman = Informasi::orderBy('created_at','DESC')
                    ->where('status','publish')
                    ->where('kategori','Pengumuman')
                    ->count();
        return view('front.struktur',[
            'page'=>$page,
            'pinned'=>$pinned,
            'totalberita'=>$totalberita,
            'totalpengumuman'=>$totalpengumuman,
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
