<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cabor;
use App\Models\Atlit;
use Validator;
use Auth;
use Session;
use Storage;
use DB;
use Str;

date_default_timezone_set('Asia/Jakarta');
class AtlitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'Atlit Cabor';

        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();
        if($user->role=="cabor"){
            $nama_cabor = $user->cabor;
            $id_cabor = Cabor::select('id')
                            ->where('nama_cabor',$nama_cabor)
                            ->first();
            $data = Atlit::select('*','atlit.id as id_atlit')
                    ->Join('cabor','cabor.id','atlit.id_cabor')
                    ->where('id_cabor',$id_cabor->id)
                    ->orderBy('created_at','DESC')
                    ->paginate(10);
        }else{
            $data = Atlit::select('*','atlit.id as id_atlit')
                    ->Join('cabor','cabor.id','atlit.id_cabor')
                    ->orderBy('created_at','DESC')
                    ->paginate(10);
            $nama_cabor = "";
        }

        if($user->role == "admin"||$user->role == "cabor"){
            return view('back.atlit.index',[
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
        $page = "Tambah Atlit Cabor";
        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();

        $nama_cabor = $user->cabor;
        $id_cabor = Cabor::where('nama_cabor',$nama_cabor)->first();
        if($user->role == "cabor"){
            return view('back.atlit.create',[
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
            'nik' => 'required',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'kota_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'npwp' => 'required',
            'foto' => 'required|mimes:jpg,jpeg,png,webp|max:2048',
            'sertifikat' => 'required|mimes:jpg,jpeg,png,webp|max:2048',
            'ktp' => 'required|mimes:jpg,jpeg,png,webp|max:2048',
            'kk' => 'required|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'id_cabor.required' => 'ID Cabor harus diisi',
            'nik.required' => 'NIK harus diisi',
            'nama_lengkap.required' => 'Nama Lengkap harus diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin harus diisi',
            'kota_lahir.required' => 'Kota Kelahiran harus diisi',
            'tanggal_lahir.required' => 'Tanggal Kelahiran harus diisi',
            'npwp.required' => 'NPWP harus diisi',
            'foto.required' => 'File Foto harus diisi',
            'foto.mimes' => 'Format Foto harus berupa jpg,jpeg,png,webp',
            'foto.max' => 'Ukuran File Foto maksimal 2Mb',
            'sertifikat.required' => 'File Sertifikat harus diisi',
            'sertifikat.mimes' => 'Format File Sertifikat harus berupa jpg,jpeg,png,webp',
            'sertifikat.max' => 'Ukuran File Sertifikat maksimal 2Mb',
            'ktp.required' => 'File KTP harus diisi',
            'ktp.mimes' => 'Format File KTP harus berupa jpg,jpeg,png,webp',
            'ktp.max' => 'Ukuran File KTP maksimal 2Mb',
            'kk.required' => 'File KK harus diisi',
            'kk.mimes' => 'Format File KK harus berupa jpg,jpeg,png,webp',
            'kk.max' => 'Ukuran File KTP maksimal 2Mb',
        ]);

        $id = Auth::id();
        $user = \App\Models\User::where('id', $id)->first();
        $nama_cabor = $user->cabor;

        $new_data = new Atlit();
        $new_data->id_cabor = $validatedData['id_cabor'];
        $new_data->nik = $validatedData['nik'];
        $new_data->nama_lengkap = $validatedData['nama_lengkap'];
        $new_data->jenis_kelamin = $validatedData['jenis_kelamin'];
        $new_data->kota_lahir = $validatedData['kota_lahir'];
        $new_data->tanggal_lahir = $validatedData['tanggal_lahir'];
        $new_data->npwp = $validatedData['npwp'];

        if ($request->hasFile('foto')) {
            $extension = $request->file('foto')->guessExtension();
            $nameberkas = "foto" . $validatedData['id_cabor'] . "_" . $nama_cabor . "_" . date("Ymdhis") . ".$extension";
            $path = $request->file('foto')->storeAs('atlit_cabor/' . $nama_cabor.'/'.'foto_diri/'.$validatedData['nama_lengkap'], $nameberkas, 'public');
            $new_data->foto = $path;
        }

        if ($request->hasFile('sertifikat')) {
            $extension = $request->file('sertifikat')->guessExtension();
            $nameberkas = "sertifikat" . $validatedData['id_cabor'] . "_" . $nama_cabor . "_" . date("Ymdhis") . ".$extension";
            $path = $request->file('sertifikat')->storeAs('atlit_cabor/' . $nama_cabor.'/'.'sertifikat/'.$validatedData['nama_lengkap'], $nameberkas, 'public');
            $new_data->sertifikat = $path;
        }

        if ($request->hasFile('ktp')) {
            $extension = $request->file('ktp')->guessExtension();
            $nameberkas = "ktp" . $validatedData['id_cabor'] . "_" . $nama_cabor . "_" . date("Ymdhis") . ".$extension";
            $path = $request->file('ktp')->storeAs('atlit_cabor/' . $nama_cabor.'/'.'ktp/'.$validatedData['nama_lengkap'], $nameberkas, 'public');
            $new_data->ktp = $path;
        }

        if ($request->hasFile('kk')) {
            $extension = $request->file('kk')->guessExtension();
            $nameberkas = "kk" . $validatedData['id_cabor'] . "_" . $nama_cabor . "_" . date("Ymdhis") . ".$extension";
            $path = $request->file('kk')->storeAs('atlit_cabor/' . $nama_cabor.'/'.'kk/'.$validatedData['nama_lengkap'], $nameberkas, 'public');
            $new_data->kk = $path;
        }


        if($user->role == "cabor"){
            $new_data->save();
            return redirect()->route('atlit_cabor.index')->with('status', 'Data Berhasil Disimpan.');
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
        $page = 'Edit Atlit Cabor';
        $idz = Auth::id();
        $user =\App\Models\User::where('id',$idz)
                    ->first();
        $nama_cabor = $user->cabor;
        $id_cabor = Cabor::where('nama_cabor',$nama_cabor)->first();
        $data = Atlit::where('id',$id)
                    ->first();
        if($user->role == "cabor"){
            return view('back.atlit.edit',[
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
            'nik' => 'required',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'kota_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'npwp' => 'required',
            'foto' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
            'sertifikat' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
            'ktp' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
            'kk' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'id_cabor.required' => 'ID Cabor harus diisi',
            'nik.required' => 'NIK harus diisi',
            'nama_lengkap.required' => 'Nama Lengkap harus diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin harus diisi',
            'kota_lahir.required' => 'Kota Kelahiran harus diisi',
            'tanggal_lahir.required' => 'Tanggal Kelahiran harus diisi',
            'npwp.required' => 'NPWP harus diisi',
            'foto.mimes' => 'Format Foto harus berupa jpg,jpeg,png,webp',
            'foto.max' => 'Ukuran File Foto maksimal 2Mb',
            'sertifikat.mimes' => 'Format File Sertifikat harus berupa jpg,jpeg,png,webp',
            'sertifikat.max' => 'Ukuran File Sertifikat maksimal 2Mb',
            'ktp.mimes' => 'Format File KTP harus berupa jpg,jpeg,png,webp',
            'ktp.max' => 'Ukuran File KTP maksimal 2Mb',
            'kk.mimes' => 'Format File KK harus berupa jpg,jpeg,png,webp',
            'kk.max' => 'Ukuran File KK maksimal 2Mb',

        ]);

        $idz = Auth::id();
        $user = \App\Models\User::where('id', $idz)->first();
        $nama_cabor = $user->cabor;

        $upd_data = Atlit::findorFail($id);;
        $upd_data->id_cabor = $validatedData['id_cabor'];
        $upd_data->nik = $validatedData['nik'];
        $upd_data->nama_lengkap = $validatedData['nama_lengkap'];
        $upd_data->jenis_kelamin = $validatedData['jenis_kelamin'];
        $upd_data->kota_lahir = $validatedData['kota_lahir'];
        $upd_data->tanggal_lahir = $validatedData['tanggal_lahir'];
        $upd_data->npwp = $validatedData['npwp'];


        if ($request->hasFile('foto')) {
            $extension = $request->file('foto')->guessExtension();
            $nameberkas = "foto" . $validatedData['id_cabor'] . "_" . $nama_cabor . "_" . date("Ymdhis") . ".$extension";
            $path = $request->file('foto')->storeAs('atlit_cabor/' . $nama_cabor.'/'.'foto_diri/'.$validatedData['nama_lengkap'], $nameberkas, 'public');
            $upd_data->foto = $path;
        }

        if ($request->hasFile('sertifikat')) {
            $extension = $request->file('sertifikat')->guessExtension();
            $nameberkas = "sertifikat" . $validatedData['id_cabor'] . "_" . $nama_cabor . "_" . date("Ymdhis") . ".$extension";
            $path = $request->file('sertifikat')->storeAs('atlit_cabor/' . $nama_cabor.'/'.'sertifikat/'.$validatedData['nama_lengkap'], $nameberkas, 'public');
            $upd_data->sertifikat = $path;
        }

        if ($request->hasFile('ktp')) {
            $extension = $request->file('ktp')->guessExtension();
            $nameberkas = "ktp" . $validatedData['id_cabor'] . "_" . $nama_cabor . "_" . date("Ymdhis") . ".$extension";
            $path = $request->file('ktp')->storeAs('atlit_cabor/' . $nama_cabor.'/'.'ktp/'.$validatedData['nama_lengkap'], $nameberkas, 'public');
            $upd_data->ktp = $path;
        }

        if ($request->hasFile('kk')) {
            $extension = $request->file('kk')->guessExtension();
            $nameberkas = "kk" . $validatedData['id_cabor'] . "_" . $nama_cabor . "_" . date("Ymdhis") . ".$extension";
            $path = $request->file('kk')->storeAs('atlit_cabor/' . $nama_cabor.'/'.'kk/'.$validatedData['nama_lengkap'], $nameberkas, 'public');
            $upd_data->kk = $path;
        }

        if($user->role == "cabor"){
            $upd_data->save();
            return redirect()->route('atlit_cabor.index')->with('status', 'Data Berhasil Diupdate.');
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
        $data = Atlit::findOrFail($id);
        $data->delete();
        return redirect()->route('atlit_cabor.index')->with('status','Data Berhasil dihapus');
    }
}
