<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cabor;
use App\Models\LimitNominal;
use App\Models\PeriodeTahun;
use Validator;
use Auth;
use Session;
use Storage;
use DB;
use Str;

date_default_timezone_set('Asia/Jakarta');
class PeriodeTahunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'Periode Tahun';
        $data = PeriodeTahun::orderBy('tahun','DESC')
                    ->paginate(10);
        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();
        if($user->role == "admin"){
            return view('back.periode_tahun.index',[
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
        $page = "Tambah Data Periode";
        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();

        if($user->role == "admin"){
            return view('back.periode_tahun.create',[
                'page'=>$page,
                'user'=>$user,
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

        \Validator::make($request->all(), [
            'tahun' => ['required','digits:4','integer'],
            'status' => ['required','integer']
        ])->validate();

        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();

        $dtperiode = PeriodeTahun::where('status',1)
                                ->first();
        if($dtperiode && $request->get('status')==1){
            $dtperiode->status = 0;
            $dtperiode->update();
        }
        $check_exist = PeriodeTahun::where('tahun',$request->get('tahun'))
                            ->first();

        $new_data = new PeriodeTahun;
        $new_data->tahun=$request->get('tahun');
        $new_data->status=$request->get('status');


        if($user->role == "admin"){
            if ($check_exist){
                return redirect()->route('periode_tahun.index')->with(['error' => 'Data periode tahun yang sama sudah ada']);
            }else{
                $new_data->save();
                return redirect()->route('periode_tahun.index')->with('status','Data berhasil tersimpan. Terimakasih.');
            }
        }else{
            return redirect()->route('periode_tahun.index')->with(['error' => 'Unauthorized Access. User Tidak Diijinkan.']);
        }
    }

    public function aktifkan($id)
    {
        $idz = Auth::id();
        $user = \App\Models\User::where('id', $idz)->first();
        $dtperiode = PeriodeTahun::where('status',1)
                    ->where('id','!=',$id)
                    ->first();
        $dtperiode->status = 0;

        $ubahperiode = PeriodeTahun::findOrFail($id);
        $ubahperiode->status = 1;

        if($user->role == "admin"){
            $dtperiode->update();
            $ubahperiode->save();
            return redirect()->route('periode_tahun.index')->with('status', 'Periode diaktifkan');
        }else{
            return redirect()->route('periode_tahun.index')->with(['error' => 'Unauthorized Access. User Tidak Diijinkan.']);
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
        //
    }
}
