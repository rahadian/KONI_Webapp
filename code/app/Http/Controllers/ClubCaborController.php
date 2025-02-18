<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cabor;
use App\Models\ClubCabor;
use Validator;
use Auth;
use Session;
use Storage;
use DB;
use Str;

date_default_timezone_set('Asia/Jakarta');
class ClubCaborController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'Club Cabor';

        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();
        if($user->role=="cabor"){
            $nama_cabor = $user->cabor;
            $id_cabor = Cabor::select('id')
                            ->where('nama_cabor',$nama_cabor)
                            ->first();
            $data = ClubCabor::select('*','club_cabor.id as id_club_cabor')
                    ->Join('cabor','cabor.id','club_cabor.id_cabor')
                    ->where('id_cabor',$id_cabor->id)
                    ->orderBy('created_at','DESC')
                    ->paginate(10);
        }else{
            $data = ClubCabor::select('*','club_cabor.id as id_club_cabor')
                    ->Join('cabor','cabor.id','club_cabor.id_cabor')
                    ->orderBy('created_at','DESC')
                    ->paginate(10);
            $nama_cabor = "";
        }

        if($user->role == "admin"||$user->role == "staff"||$user->role == "cabor"){

            return view('back.club_cabor.index',[
                'page'=>$page,
                'data'=>$data,
                'nama_cabor'=>$nama_cabor,
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
        $page = "Tambah Club Cabor";
        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();

        $nama_cabor = $user->cabor;
        $id_cabor = Cabor::where('nama_cabor',$nama_cabor)->first();
        if($user->role == "cabor"){
            return view('back.club_cabor.create',[
                'page'=>$page,
                'nama_cabor'=>$nama_cabor,
                'id_cabor'=>$id_cabor,
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
            'id_cabor' => 'required',
            'nama_ketua' => 'required',
            'nama_sekretaris' => 'required',
            'nama_bendahara' => 'required',
            'alamat' => 'required',
            'no_sk' => 'required',
            'tgl_sk' => 'required',
            'file_sk' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'id_cabor.required' => 'ID Cabor harus diisi',
            'nama_ketua.required' => 'Nama Ketua harus diisi',
            'nama_sekretaris.required' => 'Nama Sekretaris harus diisi',
            'nama_bendahara.required' => 'Nama Bendahara harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'no_sk.required' => 'Nomor SK harus diisi',
            'tgl_sk.required' => 'Tanggal SK harus diisi',
            'file_sk.mimes' => 'Format File SK harus berupa jpg,jpeg,png,webp',
            'file_sk.max' => 'Ukuran File SK maksimal 2Mb'
        ]);

        $id = Auth::id();
        $user = \App\Models\User::where('id', $id)->first();
        $nama_cabor = $user->cabor;

        $new_data = new ClubCabor();
        $new_data->id_cabor = $validatedData['id_cabor'];
        $new_data->nama_ketua = $validatedData['nama_ketua'];
        $new_data->nama_sekretaris = $validatedData['nama_sekretaris'];
        $new_data->nama_bendahara = $validatedData['nama_bendahara'];
        $new_data->alamat = $validatedData['alamat'];
        $new_data->no_sk = $validatedData['no_sk'];
        $new_data->tgl_sk = $validatedData['tgl_sk'];

        if ($request->hasFile('file_sk')) {
            $extension = $request->file('file_sk')->guessExtension();
            $nameberkas = "file_sk_club" . $validatedData['id_cabor'] . "_" . $nama_cabor . "_" . date("Ymdhis") . ".$extension";
            $path = $request->file('file_sk')->storeAs('club_cabor/' . $nama_cabor.'/'.'sk/', $nameberkas, 'public');
            $new_data->file_sk = $path;
        }

        if($user->role == "cabor"){
            $new_data->save();
            return redirect()->route('club_cabor.index')->with('status', 'Data Berhasil Disimpan.');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = 'Edit Club Cabor';
        $idz = Auth::id();
        $user =\App\Models\User::where('id',$idz)
                    ->first();
        $nama_cabor = $user->cabor;
        $id_cabor = Cabor::where('nama_cabor',$nama_cabor)->first();
        $data = ClubCabor::where('id',$id)
                    ->first();
        if($user->role == "cabor"){
            return view('back.club_cabor.edit',[
                'page'=>$page,
                'data'=>$data,
                'nama_cabor'=>$nama_cabor,
                'id_cabor'=>$id_cabor,
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
            'id_cabor' => 'required',
            'nama_ketua' => 'required',
            'nama_sekretaris' => 'required',
            'nama_bendahara' => 'required',
            'alamat' => 'required',
            'no_sk' => 'required',
            'tgl_sk' => 'required',
            'file_sk' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'id_cabor.required' => 'ID Cabor harus diisi',
            'nama_ketua.required' => 'Nama Ketua harus diisi',
            'nama_sekretaris.required' => 'Nama Sekretaris harus diisi',
            'nama_bendahara.required' => 'Nama Bendahara harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'no_sk.required' => 'Nomor SK harus diisi',
            'tgl_sk.required' => 'Tanggal SK harus diisi',
            'file_sk.mimes' => 'Format File SK harus berupa jpg,jpeg,png,webp',
            'file_sk.max' => 'Ukuran File SK maksimal 2Mb'
        ]);

        $idz = Auth::id();
        $user = \App\Models\User::where('id', $idz)->first();
        $nama_cabor = $user->cabor;

        $upd_data = ClubCabor::findorFail($id);
        $upd_data->id_cabor = $validatedData['id_cabor'];
        $upd_data->nama_ketua = $validatedData['nama_ketua'];
        $upd_data->nama_sekretaris = $validatedData['nama_sekretaris'];
        $upd_data->nama_bendahara = $validatedData['nama_bendahara'];
        $upd_data->alamat = $validatedData['alamat'];
        $upd_data->no_sk = $validatedData['no_sk'];
        $upd_data->tgl_sk = $validatedData['tgl_sk'];

        if ($request->hasFile('file_sk')) {
            $extension = $request->file('file_sk')->guessExtension();
            $nameberkas = "file_sk_club" . $validatedData['id_cabor'] . "_" . $nama_cabor . "_" . date("Ymdhis") . ".$extension";
            $path = $request->file('file_sk')->storeAs('club_cabor/' . $nama_cabor.'/'.'sk/', $nameberkas, 'public');
            $upd_data->file_sk = $path;
        }

        if($user->role == "cabor"){
            $upd_data->save();
            return redirect()->route('club_cabor.index')->with('status', 'Data Berhasil Disimpan.');
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
        $data = ClubCabor::findOrFail($id);
        $data->delete();
        return redirect()->route('club_cabor.index')->with('status','Data Berhasil dihapus');
    }
}
