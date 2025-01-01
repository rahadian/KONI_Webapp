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
class HomeCMSController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $page = "Dashboard";
        $informasi = Informasi::orderBy('created_at','DESC')
                    ->paginate(10);
        $totalberita = Informasi::orderBy('created_at','DESC')
                    ->where('status','publish')
                    ->where('kategori','Berita')
                    ->count();
        $totalpengumuman = Informasi::orderBy('created_at','DESC')
                    ->where('status','publish')
                    ->where('kategori','Pengumuman')
                    ->count();
        $totalpinned = Informasi::orderBy('created_at','DESC')
                    ->where('status','publish')
                    ->where('kategori','Pinned')
                    ->count();

        return view('back.dashboard',[
            'page'=>$page,
            'informasi'=>$informasi,
            'totalberita'=>$totalberita,
            'totalpengumuman'=>$totalpengumuman,
            'totalpinned'=>$totalpinned,
        ]);
    }
}
