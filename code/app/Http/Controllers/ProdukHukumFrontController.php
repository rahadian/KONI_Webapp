<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;
use App\Models\ProdukHukum;
use App\Models\KategoriProdukHukum;
use Validator;
use Auth;
use Session;
use Storage;
use DB;
use Str;

date_default_timezone_set('Asia/Jakarta');
class ProdukHukumFrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = "Produk Hukum";

        $kategori = KategoriProdukHukum::orderBy('created_at','DESC')
                    ->get();

        if($kategori != null){
            $data = ProdukHukum::select("produk_hukum.id","produk_hukum.judul","produk_hukum.file","produk_hukum.kategori","produk_hukum.created_at","produk_hukum.updated_at","kategori_produk_hukum.nama")
                    ->join('kategori_produk_hukum','kategori_produk_hukum.id','=','produk_hukum.kategori')
                    ->orderBy('created_at','DESC')
                    ->get();
        }else{
            $data = ProdukHukum::select("*")
                    ->orderBy('created_at','DESC')
                    ->get();
        }

        $totalberita = Informasi::orderBy('created_at','DESC')
                    ->where('status','publish')
                    ->where('kategori','Berita')
                    ->count();
        $totalpengumuman = Informasi::orderBy('created_at','DESC')
                    ->where('status','publish')
                    ->where('kategori','Pengumuman')
                    ->count();


        return view('front.produk_hukum',[
            'page'=>$page,
            'data'=>$data,
            'kategori'=>$kategori,
            'totalberita'=>$totalberita,
            'totalpengumuman'=>$totalpengumuman

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
