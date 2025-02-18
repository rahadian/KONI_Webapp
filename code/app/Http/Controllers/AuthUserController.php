<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cabor;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use Session;
use DB;

date_default_timezone_set('Asia/Jakarta');
class AuthUserController extends Controller
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
        $page = 'Users Management';
        $data = User::select('users.*','users.id as user_id')
                    ->orderBy('created_at','DESC')
                    ->paginate(10);

        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();
        if($user->role == "admin"){
            return view('back.users.index',[
                'page'=>$page,
                'data'=>$data
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
        $page = "Tambah Users";
        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();

        $cabor = Cabor::get();
        if($user->role == "admin"){
            return view('back.users.create',[
                'page'=>$page,
                'cabor'=>$cabor,
            ]);
        }else{
            return redirect()->route('users.index')->with(['error' => 'Unauthorized Access. User Tidak Diijinkan.']);
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
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'role' => ['required'],
            // 'cabor' => ['string','max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ])->validate();

        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();

        $check_exist = User::where('username',$request->get('username'))
                            ->first();
        $new_data = new \App\Models\User;
        $new_data->name=$request->get('name');
        $new_data->username=$request->get('username');
        $new_data->role=$request->get('role');
        if($request->get('role')=="staff"){
            $new_data->cabor="KESEKRETARIATAN";
        }else{
            $new_data->cabor=$request->get('cabor');
        }

        $new_data->email=$request->get('email');
        $new_data->password = Hash::make($request->get('password'));

        if($user->role == "admin"){
            if ($check_exist){
                return redirect()->route('users.index')->with(['error' => 'Username sudah terdaftar, Anda tidak dapat mendaftarkan lagi.']);
            }else{
                $new_data->save();
                return redirect()->route('users.index')->with('status','User berhasil terdaftar. Terimakasih.');
            }
        }else{
            return redirect()->route('users.index')->with(['error' => 'Unauthorized Access. User Tidak Diijinkan.']);
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
        $page = 'Edit User';
        $users = User::select('users.*','users.id as user_id')
                    ->where('users.id','=',$id)
                    ->first();
        $cabor = Cabor::get();
        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();
        if($user->role == "admin"){
            return view('back.users.edit',[
                'page'=>$page,
                'users'=>$users,
                'cabor'=>$cabor,
            ]);
        }else{
            return redirect()->route('users.index')->with(['error' => 'Unauthorized Access. User Tidak Diijinkan.']);
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
        \Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'role' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255'],

        ])->validate();

        $id_user = Auth::id();
        $user =\App\Models\User::where('id',$id_user);

        $users = User::findOrFail($id);
        $users->name = $request->get('name');
        $users->email = $request->get('email');
        $users->username = $request->get('username');
        $users->cabor = $request->get('cabor');
        $check_exist = User::where('username',$request->get('username'))
                            ->first();

        if(!empty($request->get('role'))){
            $users->role = $request->get('role');
        }

        if(!empty($request->get('password'))){
            $users->password = Hash::make($request->get('password'));
        }


        $users->save();
        return redirect()->route('users.index')->with('status','User berhasil diupdate. Terimakasih.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();
        return redirect()->route('users.index')->with('status','User Berhasil dihapus');
    }
}
