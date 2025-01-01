<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cabor;
use App\Models\Prestasi;
use Validator;
use Auth;
use Session;
use Storage;
use DB;
use Str;

date_default_timezone_set('Asia/Jakarta');
class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'Prestasi Cabor';

        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();
        if($user->role=="cabor"){
            $nama_cabor = $user->cabor;
            $id_cabor = Cabor::select('id')
                            ->where('nama_cabor',$nama_cabor)
                            ->first();
            $data = Prestasi::select('*','prestasi.id as id_prestasi')
                    ->Join('cabor','cabor.id','prestasi.id_cabor')
                    ->where('id_cabor',$id_cabor->id)
                    ->orderBy('created_at','DESC')
                    ->paginate(10);
        }else{
            $data = Prestasi::select('*','prestasi.id as id_prestasi')
                    ->Join('cabor','cabor.id','prestasi.id_cabor')
                    ->orderBy('created_at','DESC')
                    ->paginate(10);
            $nama_cabor = "";
        }

        if($user->role == "admin"||$user->role == "cabor"){
            return view('back.prestasi.index',[
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
        $page = "Tambah Prestasi Cabor";
        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();

        $nama_cabor = $user->cabor;
        $id_cabor = Cabor::where('nama_cabor',$nama_cabor)->first();
        if($user->role == "cabor"){
            return view('back.prestasi.create',[
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
            'nama_kejuaraan' => 'required',
            'tingkat_kejuaraan' => 'required',
            'waktu_kegiatan' => 'required',
            'perolehan_medali' => 'required',
            'foto_kegiatan' => 'required|mimes:jpg,jpeg,png,webp|max:2048',
            'scan_piagam' => 'required|mimes:jpg,jpeg,png,webp|max:2048',
            'scan_hasil_pertandingan' => 'required|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'id_cabor.required' => 'ID Cabor harus diisi',
            'nama_kejuaraan.required' => 'Nama Kejuaraan harus diisi',
            'tingkat_kejuaraan.required' => 'Tingkat Kejuaraan harus diisi',
            'waktu_kegiatan.required' => 'Waktu Kegiatan harus diisi',
            'perolehan_medali.required' => 'Perolehan Medali harus diisi',
            'foto_kegiatan.required' => 'File Foto Kegiatan harus diisi',
            'foto_kegiatan.mimes' => 'Format Foto Kegiatan harus berupa jpg,jpeg,png,webp',
            'foto_kegiatan.max' => 'Ukuran File Foto Kegiatan maksimal 2Mb',
            'scan_piagam.required' => 'File Piagam harus diisi',
            'scan_piagam.mimes' => 'Format File Piagam harus berupa jpg,jpeg,png,webp',
            'scan_piagam.max' => 'Ukuran File Piagam maksimal 2Mb',
            'scan_hasil_pertandingan.required' => 'File Hasil Pertandingan harus diisi',
            'scan_hasil_pertandingan.mimes' => 'Format File Hasil Pertandingan harus berupa jpg,jpeg,png,webp',
            'scan_hasil_pertandingan.max' => 'Ukuran File Hasil Pertandingan maksimal 2Mb',
        ]);

        $id = Auth::id();
        $user = \App\Models\User::where('id', $id)->first();
        $nama_cabor = $user->cabor;

        $new_data = new Prestasi();
        $new_data->id_cabor = $validatedData['id_cabor'];
        $new_data->nama_kejuaraan = $validatedData['nama_kejuaraan'];
        $new_data->tingkat_kejuaraan = $validatedData['tingkat_kejuaraan'];
        $new_data->waktu_kegiatan = $validatedData['waktu_kegiatan'];
        $new_data->perolehan_medali = $validatedData['perolehan_medali'];

        if ($request->hasFile('foto_kegiatan')) {
            $extension = $request->file('foto_kegiatan')->guessExtension();
            $nameberkas = "foto_kegiatan" . $validatedData['id_cabor'] . "_" . $nama_cabor . "_" . date("Ymdhis") . ".$extension";
            $path = $request->file('foto_kegiatan')->storeAs('prestasi_cabor/' . $nama_cabor.'/'.'foto_kegiatan/'.$validatedData['nama_kejuaraan'], $nameberkas, 'public');
            $new_data->foto_kegiatan = $path;
        }

        if ($request->hasFile('scan_piagam')) {
            $extension = $request->file('scan_piagam')->guessExtension();
            $nameberkas = "scan_piagam" . $validatedData['id_cabor'] . "_" . $nama_cabor . "_" . date("Ymdhis") . ".$extension";
            $path = $request->file('scan_piagam')->storeAs('prestasi_cabor/' . $nama_cabor.'/'.'scan_piagam/'.$validatedData['nama_kejuaraan'], $nameberkas, 'public');
            $new_data->scan_piagam = $path;
        }

        if ($request->hasFile('scan_hasil_pertandingan')) {
            $extension = $request->file('scan_hasil_pertandingan')->guessExtension();
            $nameberkas = "scan_hasil_pertandingan" . $validatedData['id_cabor'] . "_" . $nama_cabor . "_" . date("Ymdhis") . ".$extension";
            $path = $request->file('scan_hasil_pertandingan')->storeAs('prestasi_cabor/' . $nama_cabor.'/'.'scan_hasil_pertandingan/'.$validatedData['nama_kejuaraan'], $nameberkas, 'public');
            $new_data->scan_hasil_pertandingan = $path;
        }


        if($user->role == "cabor"){
            $new_data->save();
            return redirect()->route('prestasi_cabor.index')->with('status', 'Data Berhasil Disimpan.');
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
        $page = 'Edit Prestasi Cabor';
        $idz = Auth::id();
        $user =\App\Models\User::where('id',$idz)
                    ->first();
        $nama_cabor = $user->cabor;
        $id_cabor = Cabor::where('nama_cabor',$nama_cabor)->first();
        $data = Prestasi::where('id',$id)
                    ->first();
        if($user->role == "cabor"){
            return view('back.prestasi.edit',[
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
            'nama_kejuaraan' => 'required',
            'tingkat_kejuaraan' => 'required',
            'waktu_kegiatan' => 'required',
            'perolehan_medali' => 'required',
            'foto_kegiatan' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
            'scan_piagam' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
            'scan_hasil_pertandingan' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'id_cabor.required' => 'ID Cabor harus diisi',
            'nama_kejuaraan.required' => 'Nama Kejuaraan harus diisi',
            'tingkat_kejuaraan.required' => 'Tingkat Kejuaraan harus diisi',
            'waktu_kegiatan.required' => 'Waktu Kegiatan harus diisi',
            'perolehan_medali.required' => 'Perolehan Medali harus diisi',
            'foto_kegiatan.mimes' => 'Format Foto Kegiatan harus berupa jpg,jpeg,png,webp',
            'foto_kegiatan.max' => 'Ukuran File Foto Kegiatan maksimal 2Mb',
            'scan_piagam.mimes' => 'Format File Piagam harus berupa jpg,jpeg,png,webp',
            'scan_piagam.max' => 'Ukuran File Piagam maksimal 2Mb',
            'scan_hasil_pertandingan.mimes' => 'Format File Hasil Pertandingan harus berupa jpg,jpeg,png,webp',
            'scan_hasil_pertandingan.max' => 'Ukuran File Hasil Pertandingan maksimal 2Mb',

        ]);

        $idz = Auth::id();
        $user = \App\Models\User::where('id', $idz)->first();
        $nama_cabor = $user->cabor;

        $upd_data = Prestasi::findorFail($id);;
        $upd_data->id_cabor = $validatedData['id_cabor'];
        $upd_data->nama_kejuaraan = $validatedData['nama_kejuaraan'];
        $upd_data->tingkat_kejuaraan = $validatedData['tingkat_kejuaraan'];
        $upd_data->waktu_kegiatan = $validatedData['waktu_kegiatan'];
        $upd_data->perolehan_medali = $validatedData['perolehan_medali'];

        if ($request->hasFile('foto_kegiatan')) {
            $extension = $request->file('foto_kegiatan')->guessExtension();
            $nameberkas = "foto_kegiatan" . $validatedData['id_cabor'] . "_" . $nama_cabor . "_" . date("Ymdhis") . ".$extension";
            $path = $request->file('foto_kegiatan')->storeAs('prestasi_cabor/' . $nama_cabor.'/'.'foto_kegiatan/'.$validatedData['nama_kejuaraan'], $nameberkas, 'public');
            $upd_data->foto_kegiatan = $path;
        }

        if ($request->hasFile('scan_piagam')) {
            $extension = $request->file('scan_piagam')->guessExtension();
            $nameberkas = "scan_piagam" . $validatedData['id_cabor'] . "_" . $nama_cabor . "_" . date("Ymdhis") . ".$extension";
            $path = $request->file('scan_piagam')->storeAs('prestasi_cabor/' . $nama_cabor.'/'.'scan_piagam/'.$validatedData['nama_kejuaraan'], $nameberkas, 'public');
            $upd_data->scan_piagam = $path;
        }

        if ($request->hasFile('scan_hasil_pertandingan')) {
            $extension = $request->file('scan_hasil_pertandingan')->guessExtension();
            $nameberkas = "scan_hasil_pertandingan" . $validatedData['id_cabor'] . "_" . $nama_cabor . "_" . date("Ymdhis") . ".$extension";
            $path = $request->file('scan_hasil_pertandingan')->storeAs('prestasi_cabor/' . $nama_cabor.'/'.'scan_hasil_pertandingan/'.$validatedData['nama_kejuaraan'], $nameberkas, 'public');
            $upd_data->scan_hasil_pertandingan = $path;
        }


        if($user->role == "cabor"){
            $upd_data->save();
            return redirect()->route('prestasi_cabor.index')->with('status', 'Data Berhasil Diupdate.');
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
        $data = Prestasi::findOrFail($id);
        $data->delete();
        return redirect()->route('prestasi_cabor.index')->with('status','Data Berhasil dihapus');
    }
}
