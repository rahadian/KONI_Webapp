<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cabor;
use App\Models\PengurusCabor;
use App\Models\Perencanaan;
use App\Models\PengajuanPerencanaan;
use App\Models\Kegiatan;
use App\Models\KetBarang;
use App\Models\Rekening;
use App\Models\Rekening1;
use App\Models\Belanja;
use App\Models\Barang;
use App\Models\Barang1;
use App\Models\LimitNominal;
use App\Models\PeriodeTahun;
use Validator;
use Auth;
use Session;
use Storage;
use DB;
use Str;

date_default_timezone_set('Asia/Jakarta');
class PengajuanPerencanaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'Verifikasi Perencanaan';

        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];
        $currentYear = date('Y');
        $years = range($currentYear, $currentYear + 5);
        $year_periode = PeriodeTahun::where('status',1)
                                    ->first();
        $data = PengajuanPerencanaan::select('pengajuan_perencanaan.id as pengajuan_perencanaan_id','pengajuan_perencanaan.tahun','pengajuan_perencanaan.cabor','pengajuan_perencanaan.status','pengajuan_perencanaan.catatan','pengajuan_perencanaan.verified_by','pengajuan_perencanaan.verified_at','cabor.id as cabor_id')
                ->Join('cabor','cabor.nama_cabor','pengajuan_perencanaan.cabor')
                ->where('tahun',$year_periode->tahun)
                ->paginate(10);

        if($user->role == "admin"){
            return view('back.perencanaan.verifikasi',[
                'page'=>$page,
                'data'=>$data,
                'months'=>$months,
                'years'=>$years,
            ]);
        }else{
            return redirect()->route('cmshome.index')->with(['error' => 'Unauthorized Access. User Tidak Diijinkan.']);
        }
    }

    public function getDetail($id)
    {
        $data = PengajuanPerencanaan::where('id', $id)->first();
        return response()->json($data);
    }

    public function DetailData($id)
    {
        $page = 'Verifikasi Perencanaan';

        $idz = Auth::id();
        $user =\App\Models\User::where('id',$idz)
                    ->first();
        $nama_cabor = $user->cabor;
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];
        $currentYear = date('Y');
        $years = range($currentYear, $currentYear + 5);
        $year_periode = PeriodeTahun::where('status',1)
                                    ->first();

        $data_pengajuan = PengajuanPerencanaan::select('pengajuan_perencanaan.id as pengajuan_perencanaan_id','pengajuan_perencanaan.tahun','pengajuan_perencanaan.cabor','pengajuan_perencanaan.status','pengajuan_perencanaan.catatan','pengajuan_perencanaan.verified_by','pengajuan_perencanaan.verified_at','cabor.id as cabor_id')
                ->Join('cabor','cabor.nama_cabor','pengajuan_perencanaan.cabor')
                ->where('pengajuan_perencanaan.id',$id)
                ->first();
        $datanominal = LimitNominal::where('tahun',$data_pengajuan->tahun)
                                    ->where('cabor',$data_pengajuan->cabor)
                                    ->first();
        $data_rencana = Perencanaan::where('id_pengajuan_perencanaan',$data_pengajuan->pengajuan_perencanaan_id)
                                    ->Join('kegiatan','kegiatan.kode_kegiatan','perencanaan.kode_kegiatan')
                                    ->Join('ket_barang','ket_barang.kode_ketbarang','perencanaan.kode_ketbarang')
                                    ->Join('rekening_1','rekening_1.kode_rekening','perencanaan.kode_rekening')
                                    ->Join('barang_1','barang_1.id','perencanaan.id_nama_barang')
                                    ->get();

        if($user->role == "admin"||$user->role == "cabor"||$user->role == "staff"){
            return view('back.perencanaan.detaildata',[
                'page'=>$page,
                'data_pengajuan'=>$data_pengajuan,
                'datanominal'=>$datanominal,
                'data_rencana'=>$data_rencana,
                'months'=>$months,
                'years'=>$years,
                'nama_cabor'=>$nama_cabor,
            ]);
        }else{
            return redirect()->route('cmshome.index')->with(['error' => 'Unauthorized Access. User Tidak Diijinkan.']);
        }
    }

    public function setuju(Request $request,$id)
    {
        $validated = $request->validate([
            'catatan' => 'nullable|string|max:255',
        ]);
        $user = Auth::user();
        $data = PengajuanPerencanaan::findOrFail($id);

        $data->status = 1;
        $data->catatan = $validated['catatan']?? null;
        $data->verified_by = $user->username;
        $data->verified_at = date('Y-m-d H:i:s');
        $data->save();

        return redirect()->route('verifikasi_perencanaan.index')->with('status', 'Pengajuan Disetujui.');
    }

    public function tolak(Request $request,$id)
    {
        $validated = $request->validate([
            'catatan' => 'nullable|string|max:255',
        ]);
        $user = Auth::user();
        $data = PengajuanPerencanaan::findOrFail($id);
        $id_cabor = Cabor::where('nama_cabor',$data->cabor)
                            ->first();

        $upd = Perencanaan::where('tahun_anggaran', $data->tahun)
                            ->where('cabor',$id_cabor->id)
                            ->where('id_pengajuan_perencanaan',$id)
                            ->update(['id_pengajuan_perencanaan'=> 0]);

        $data->status = 2;
        $data->catatan = $validated['catatan']?? null;
        $data->verified_by = $user->username;
        $data->verified_at = date('Y-m-d H:i:s');
        $data->save();



        return redirect()->route('verifikasi_perencanaan.index')->with('status', 'Pengajuan Direvisi.');
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
