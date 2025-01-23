<?php

namespace App\Http\Controllers;
use App\Models\Cabor;
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
        if($user->role == "admin"){
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

        $cabor = Cabor::get();
        if($user->role == "admin"){
            return view('back.limit_nominal.create',[
                'page'=>$page,
                'user'=>$user,
                'cabor'=>$cabor,
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
            'nominal' => str_replace('.', '', $request->input('nominal')),
            'semester1' => str_replace('.', '', $request->input('semester1')),
            'semester2' => str_replace('.', '', $request->input('semester2'))
        ]);

        \Validator::make($request->all(), [
            'username' => ['required', 'string', 'max:255'],
            'nominal' => ['required','integer','min:0'],
            'cabor' => ['required', 'string', 'max:255'],
            'semester1' => ['required','integer','min:0'],
            'semester2' => ['required','integer','min:0'],
            'tahun' => ['required', 'integer','between:2023,'. now()->year+1],
        ])->validate();

        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();

        $check_exist = LimitNominal::where('tahun',$request->get('tahun'))
                            ->first();
        $new_data = new LimitNominal;
        $new_data->username=$request->get('username');
        $new_data->cabor=$request->get('cabor');
        $new_data->nominal=$request->input('nominal');
        $new_data->tahun=$request->get('tahun');
        $new_data->semester1=$request->get('semester1');
        $new_data->semester2=$request->get('semester2');

        if($user->role == "admin"){
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
        $page = "Ubah Data Nominal";
        $idz = Auth::id();
        $user =\App\Models\User::where('id',$idz)
                    ->first();
        $cabor = Cabor::get();
        $data = LimitNominal::where('id',$id)
            ->first();
        if($user->role == "admin"){
            return view('back.limit_nominal.edit',[
                'page'=>$page,
                'user'=>$user,
                'data'=>$data,
                'cabor'=>$cabor,
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
        $request->merge([
            'nominal' => str_replace('.', '', $request->input('nominal')),
            'semester1' => str_replace('.', '', $request->input('semester1')),
            'semester2' => str_replace('.', '', $request->input('semester2'))
        ]);

        \Validator::make($request->all(), [
            'username' => ['required', 'string', 'max:255'],
            'nominal' => ['required','integer','min:0'],
            'cabor' => ['required', 'string', 'max:255'],
            'semester1' => ['required','integer','min:0'],
            'semester2' => ['required','integer','min:0'],
            'tahun' => ['required', 'integer','between:2023,'. now()->year+1],
        ])->validate();

        $idz = Auth::id();
        $user =\App\Models\User::where('id',$idz)
                    ->first();

        $check_exist = LimitNominal::where('tahun',$request->get('tahun'))
                            ->first();
        // dd($check_exist->id);
        // die();
        $data = LimitNominal::findOrFail($id);
        $data->username=$request->get('username');
        $data->cabor=$request->get('cabor');
        $data->nominal=$request->input('nominal');
        $data->tahun=$request->get('tahun');
        $data->semester1=$request->get('semester1');
        $data->semester2=$request->get('semester2');

        if($user->role == "admin"){
            if ($check_exist){
                if($check_exist->id != $id){
                    return redirect()->route('limit_nominal.index')->with(['error' => 'Data dengan tahun yang sama sudah ada']);
                }else{
                    $data->save();
                    return redirect()->route('limit_nominal.index')->with('status','Data berhasil tersimpan. Terimakasih.');
                }
            }else{
                $data->save();
                return redirect()->route('limit_nominal.index')->with('status','Data berhasil tersimpan. Terimakasih.');
            }
        }else{
            return redirect()->route('limit_nominal.index')->with(['error' => 'Unauthorized Access. User Tidak Diijinkan.']);
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
        $data = LimitNominal::findOrFail($id);
        $data->delete();
        return redirect()->route('limit_nominal.index')->with('status','Data Berhasil dihapus');
    }
}
