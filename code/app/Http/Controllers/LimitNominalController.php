<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LimitNominal;
use Validator;
use Auth;
use Session;
use Storage;
use DB;
use Str;

date_default_timezone_set('Asia/Jakarta');
class LimitNominalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'Limit Nominal Management';
        $data = LimitNominal::orderBy('created_at','DESC')
                    ->paginate(10);
        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();
        if($user->role == "admin"||$user->role == "staff"){
            return view('back.limit_nominal.index',[
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
        $page = "Tambah Data Nominal";
        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();


        if($user->role == "admin"||$user->role == "staff"){
            return view('back.limit_nominal.create',[
                'page'=>$page,
                'user'=>$user
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
        $request->merge([
            'nominal' => str_replace('.', '', $request->input('nominal'))
        ]);

        \Validator::make($request->all(), [
            'username' => ['required', 'string', 'max:255'],
            'nominal' => ['required','integer','min:0'],
            'tahun' => ['required', 'integer','between:2023,'. now()->year],
        ])->validate();

        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();

        $check_exist = LimitNominal::where('tahun',$request->get('tahun'))
                            ->first();
        $new_data = new LimitNominal;
        $new_data->username=$request->get('username');
        $new_data->nominal=$request->input('nominal');
        $new_data->tahun=$request->get('tahun');

        if($user->role == "admin"||$user->role == "staff"){
            if ($check_exist){
                return redirect()->route('limit_nominal.index')->with(['error' => 'Data dengan tahun yang sama sudah ada']);
            }else{
                $new_data->save();
                return redirect()->route('limit_nominal.index')->with('status','Data berhasil tersimpan. Terimakasih.');
            }
        }else{
            return redirect()->route('limit_nominal.index')->with(['error' => 'Unauthorized Access. User Tidak Diijinkan.']);
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
