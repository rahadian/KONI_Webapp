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
class InformasiController extends Controller
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
        $page = "Informasi";
        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();
        $data = Informasi::orderBy('created_at','DESC')
                    ->paginate(10);
        $totalberita = Informasi::orderBy('created_at','DESC')
                    ->where('status','publish')
                    ->where('kategori','Berita')
                    ->count();
        $totalpengumuman = Informasi::orderBy('created_at','DESC')
                    ->where('status','publish')
                    ->where('kategori','Pengumuman')
                    ->count();

        if($user->role == "admin"||$user->role == "media"){
            return view('back.informasi.index',[
                'page'=>$page,
                'data'=>$data,
                'totalberita'=>$totalberita,
                'totalpengumuman'=>$totalpengumuman,
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
        $page = "Tambah Informasi";
        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();


        if($user->role == "admin"||$user->role == "media"){
            return view('back.informasi.create',[
                'page'=>$page,

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
            'content' => 'required',
            'status' => 'required',
            'tanggal' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'judul.required' => 'Judul Informasi harus diisi',
            'kategori.required' => 'Kategori informasi harus diisi',
            'content.required' => 'Content informasi harus diisi',
            'status.required' => 'Status informasi harus diisi',
            'tanggal.required' => 'Tanggal informasi harus diisi',
            'image.required' => 'File gambar harus diisi',
            'image.mimes' => 'Format File harus berupa jpg,jpeg,png,webp',
            'image.max' => 'Ukuran file gambar harus maksimal 2Mb',
        ]);

        $id = Auth::id();
        $user = \App\Models\User::where('id', $id)->first();
        $slug = Str::slug($validatedData['judul'], '-');
        $author = $user->name;

        $new_data = new Informasi();
        $new_data->judul = $validatedData['judul'];
        $new_data->slug_judul = $slug;
        $new_data->kategori = $validatedData['kategori'];
        $new_data->content = $validatedData['content'];
        $new_data->author = $author;
        $new_data->tanggal = $validatedData['tanggal'];
        $new_data->status = $validatedData['status'];


        if ($request->hasFile('image')) {
            $extension = $request->file('image')->guessExtension();
            $nameberkas = "gambar_" . $validatedData['kategori'] . "_" . $slug . "_" . date("Ymdhis") . ".$extension";
            $path = $request->file('image')->storeAs('informasi/' . $validatedData['kategori'], $nameberkas, 'public');
            $new_data->image = $path;
        }
        if($user->role == "admin"||$user->role == "media"){
            $new_data->save();
            return redirect()->route('informasi.index')->with('status', 'Data Berhasil Disimpan.');
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


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_artikel)
    {
        $page = "Edit Informasi";
        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();
        $data = Informasi::findorFail($id_artikel);


        if($user->role == "admin"||$user->role == "media"){
            return view('back.informasi.edit',[
                'page'=>$page,
                'data'=>$data

            ]);
        }else{
            return redirect()->route('cmshome.index')->with(['error' => 'Unauthorized Access. User Tidak Diijinkan.']);
        }
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
        $validatedData = $request->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'content' => 'required',
            'status' => 'required',
            'tanggal' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'judul.required' => 'Judul Informasi harus diisi',
            'kategori.required' => 'Kategori informasi harus diisi',
            'content.required' => 'Content informasi harus diisi',
            'status.required' => 'Status informasi harus diisi',
            'tanggal.required' => 'Tanggal informasi harus diisi',
            'image.mimes' => 'Format File harus berupa jpg,jpeg,png,webp',
            'image.max' => 'Ukuran file gambar harus maksimal 2Mb',
        ]);

        $id_user = Auth::id();
        $user = \App\Models\User::where('id', $id_user)->first();
        $slug = Str::slug($validatedData['judul'], '-');
        $author = $user->name;

        $upt_data = Informasi::findorFail($id);
        $upt_data->judul = $validatedData['judul'];
        $upt_data->slug_judul = $slug;
        $upt_data->kategori = $validatedData['kategori'];
        $upt_data->content = $validatedData['content'];
        $upt_data->author = $author;
        $upt_data->tanggal = $validatedData['tanggal'];
        $upt_data->status = $validatedData['status'];


        if ($request->hasFile('image')) {
            $extension = $request->file('image')->guessExtension();
            $nameberkas = "gambar_" . $validatedData['kategori'] . "_" . $slug . "_" . date("Ymdhis") . ".$extension";
            $path = $request->file('image')->storeAs('informasi/' . $validatedData['kategori'], $nameberkas, 'public');
            $upt_data->image = $path;
        }

        if($user->role == "admin"||$user->role == "media"){
            $upt_data->save();
            return redirect()->route('informasi.index')->with('status', 'Data Berhasil Diupdate.');
        }else{
            return redirect()->route('cmshome.index')->with(['error' => 'Unauthorized Access. User Tidak Diijinkan.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Informasi::findOrFail($id);
        if($user->role == "admin"||$user->role == "media"){
            $data->delete();
            return redirect()->route('informasi.index')->with('status','Data Berhasil dihapus');
        }else{
            return redirect()->route('cmshome.index')->with(['error' => 'Unauthorized Access. User Tidak Diijinkan.']);
        }
    }
}
