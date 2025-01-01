<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukHukum;
use App\Models\KategoriProdukHukum;
use Validator;
use Auth;
use Session;
use Storage;
use DB;
use Str;

date_default_timezone_set('Asia/Jakarta');
class ProdukHukumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $page = "Produk Hukum";
        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();
        $data = ProdukHukum::select("produk_hukum.id","produk_hukum.judul","produk_hukum.file","produk_hukum.created_at","produk_hukum.updated_at","kategori_produk_hukum.nama")
                    ->join('kategori_produk_hukum','kategori_produk_hukum.id','=','produk_hukum.kategori')
                    ->orderBy('created_at','DESC')
                    ->paginate(10);

        if($user->role == "admin"){
            return view('back.produk_hukum.index',[
                'page'=>$page,
                'data'=>$data,
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
        $page = "Tambah Data Produk Hukum";
        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();

        $kategori = KategoriProdukHukum::get();

        if($user->role == "admin"){
            return view('back.produk_hukum.create',[
                'page'=>$page,
                'kategori'=>$kategori,

            ]);
        }else{
            return redirect()->route('cmshome.index')->with(['error' => 'Unauthorized Access. User Tidak Diijinkan.']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
        ], [
            'judul.required' => 'Judul harus diisi',
            'kategori.required' => 'Kategori harus diisi',
            'file.required' => 'File harus diisi',
            'file.mimes' => 'Format File harus berupa .pdf',
            'file.max' => 'Ukuran file gambar harus maksimal 2Mb',
        ]);

        $id = Auth::id();
        $user = \App\Models\User::where('id', $id)->first();


        $new_data = new ProdukHukum();
        $new_data->judul = $validatedData['judul'];
        $new_data->kategori = $validatedData['kategori'];

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->guessExtension();
            $nameberkas = "file_produk_hukum" . $validatedData['kategori'] . "_" . date("Ymdhis") . ".$extension";
            $path = $request->file('file')->storeAs('produk_hukum/' . $validatedData['kategori'], $nameberkas, 'public');
            $new_data->file = $path;
        }
        if($user->role == "admin"){
            $new_data->save();
            return redirect()->route('produk_hukum.index')->with('status', 'Data Berhasil Disimpan.');
        }else{
            return redirect()->route('cmshome.index')->with(['error' => 'Unauthorized Access. User Tidak Diijinkan.']);
        }
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
        $data = ProdukHukum::findOrFail($id);
        $data->delete();
        return redirect()->route('produk_hukum.index')->with('status','Data Berhasil dihapus');
    }
}
