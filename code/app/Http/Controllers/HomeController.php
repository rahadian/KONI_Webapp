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
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $page = "KONI Kabupaten Probolinggo";
        $informasi = Informasi::orderBy('created_at','DESC')
                    ->where('status','publish')
                    ->whereNotIn('kategori',['Pinned'])
                    ->paginate(4);
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
        return view('front.home',[
            'page'=>$page,
            'informasi'=>$informasi,
            'pinned'=>$pinned,
            'totalberita'=>$totalberita,
            'totalpengumuman'=>$totalpengumuman,
        ]);
    }
    public function dasar()
    {
        $page = "Dasar Hukum";
        $totalberita = Informasi::orderBy('created_at','DESC')
            ->where('status','publish')
            ->where('kategori','Berita')
            ->count();
        $totalpengumuman = Informasi::orderBy('created_at','DESC')
            ->where('status','publish')
            ->where('kategori','Pengumuman')
            ->count();
        return view('front.dasarhuk',[
            'page'=>$page,
            'totalberita'=>$totalberita,
            'totalpengumuman'=>$totalpengumuman,
        ]);
    }

    public function aplikasi()
    {
        $page = "Aplikasi";
        $totalberita = Informasi::orderBy('created_at','DESC')
            ->where('status','publish')
            ->where('kategori','Berita')
            ->count();
        $totalpengumuman = Informasi::orderBy('created_at','DESC')
            ->where('status','publish')
            ->where('kategori','Pengumuman')
            ->count();
        return view('front.aplikasi',[
            'page'=>$page,
            'totalberita'=>$totalberita,
            'totalpengumuman'=>$totalpengumuman,
        ]);
    }

    public function bumdes()
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
        return view('front.bumdesa',[
            'page'=>$page,
            'totalberita'=>$totalberita,
            'totalpengumuman'=>$totalpengumuman,
        ]);
    }
}
