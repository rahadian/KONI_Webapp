<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ikhtisar_bumdes;
use Validator;
use Auth;
use Session;
use Storage;
use DB;
use Str;

date_default_timezone_set('Asia/Jakarta');
class IkhtisarBumdesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = "Ikhtisar BUMDES";
        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();
        $data = Ikhtisar_bumdes::orderBy('created_at','DESC')
                    ->paginate(10);


        if($user->role == "admin"){
            return view('back.bumdes.ikhtisar',[
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
    public function edit($id_artikel)
    {
        $page = "Edit Ikhtisar BUMDES";
        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();
        $data = Ikhtisar_bumdes::findorFail($id_artikel);


        if($user->role == "admin"){
            return view('back.bumdes.edit_ikhtisar',[
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
            'deskripsi' => 'required',
            'gambar' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'deskripsi.required' => 'Content informasi harus diisi',
            'gambar.mimes' => 'Format File harus berupa jpg,jpeg,png,webp',
            'gambar.max' => 'Ukuran file gambar harus maksimal 2Mb',
        ]);

        $id_user = Auth::id();
        $user = \App\Models\User::where('id', $id_user)->first();

        $upt_data = Ikhtisar_bumdes::findorFail($id);
        $upt_data->deskripsi = $validatedData['deskripsi'];

        if ($request->hasFile('gambar')) {
            $extension = $request->file('gambar')->guessExtension();
            $nameberkas = "gambar_" ."ikhtisar_bumdes". date("Ymdhis") . ".$extension";
            $path = $request->file('gambar')->storeAs('ikhtisar_bumdes', $nameberkas, 'public');
            $upt_data->gambar = $path;
        }

        if($user->role == "admin"){
            $upt_data->save();
            return redirect()->route('ikhtisar.index')->with('status', 'Data Berhasil Diupdate.');
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
        //
    }
}
