<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cabor;
use App\Models\PengurusCabor;
use App\Models\Perencanaan;
use App\Models\Kegiatan;
use App\Models\KetBarang;
use App\Models\Rekening;
use App\Models\Rekening1;
use App\Models\Belanja;
use App\Models\Barang;
use App\Models\Barang1;
use App\Models\LimitNominal;
use App\Models\PeriodeTahun;
use App\Models\PengajuanPerencanaan;
use Validator;
use Auth;
use Session;
use Storage;
use DB;
use Str;

date_default_timezone_set('Asia/Jakarta');
class PerencanaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'Perencanaan';

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
        // $years = range($currentYear, $currentYear + 5);
        $year_periode = PeriodeTahun::where('status',1)
                                    ->first();
        $years = $year_periode->tahun;
        if($user->role=="cabor"||$user->role=="staff"){

            $nama_cabor = $user->cabor;

            $check_pengajuan = PengajuanPerencanaan::where('cabor',$nama_cabor)
                                                    ->where('tahun',$year_periode->tahun)
                                                    ->first();
            if($user->role=="cabor"){
                $id_cabor = Cabor::select('id')
                            ->where('nama_cabor',$nama_cabor)
                            ->first();
            }else if($user->role=="staff"){
                $id_cabor = Cabor::select('id')
                            ->where('nama_cabor',"KESEKRETARIATAN")
                            ->first();
            }

            $data = Perencanaan::select('perencanaan.id as id_perencanaan','cabor.nama_cabor','perencanaan.kode_kegiatan','kegiatan.uraian_kegiatan','perencanaan.kode_rekening','rekening_1.ket_rekening','perencanaan.kode_ketbarang','ket_barang.kode_ketbarang','ket_barang.ket_barang','barang_1.nama_barang','barang_1.harga_satuan','bulan','tahun_anggaran','status','keterangan','created_at','created_by','updated_at')
                    ->Join('cabor','cabor.id','perencanaan.cabor')
                    ->Join('kegiatan','kegiatan.kode_kegiatan','perencanaan.kode_kegiatan')
                    ->Join('ket_barang','ket_barang.kode_ketbarang','perencanaan.kode_ketbarang')
                    ->Join('rekening_1','rekening_1.kode_rekening','perencanaan.kode_rekening')
                    ->Join('barang_1','barang_1.id','perencanaan.id_nama_barang')
                    ->where('cabor',$id_cabor->id)
                    ->where('tahun_anggaran',$year_periode->tahun)
                    ->orderBy('created_at','DESC')
                    ->paginate(10);

        if($user->role == "cabor"||$user->role=="staff"){
            return view('back.perencanaan.index',[
                'page'=>$page,
                'data'=>$data,
                'nama_cabor'=>$nama_cabor,
                'id_cabor'=>$id_cabor,
                'months'=>$months,
                'years'=>$years,
                'year_periode'=>$year_periode,
                'check_pengajuan'=>$check_pengajuan,
            ]);
        }else{
            return redirect()->route('cmshome.index')->with(['error' => 'Unauthorized Access. User Tidak Diijinkan.']);
        }
        }
    }

    public function verifikasi()
    {
        $page = 'Verifikasi Perencanaan old';

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

        $data = Perencanaan::select('perencanaan.id as id_perencanaan','cabor.nama_cabor','perencanaan.kode_kegiatan','kegiatan.uraian_kegiatan','perencanaan.kode_rekening','rekening.uraian_rekening','perencanaan.kode_belanja','belanja.uraian_belanja','perencanaan.kode_barang','barang.nama_barang','barang.harga_satuan','bulan','tahun_anggaran','status','keterangan','created_at','created_by','updated_at')
                ->Join('cabor','cabor.id','perencanaan.cabor')
                ->Join('kegiatan','kegiatan.kode_kegiatan','perencanaan.kode_kegiatan')
                ->Join('rekening','rekening.kode_rekening','perencanaan.kode_rekening')
                ->Join('belanja','belanja.kode_belanja','perencanaan.kode_belanja')
                ->Join('barang','barang.kode_barang','perencanaan.kode_barang')
                ->orderBy('created_at','DESC')
                ->paginate(10);

        if($user->role == "admin"){
            return view('back.perencanaan.verifikasi_old',[
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
        $detail = Perencanaan::select(
            'perencanaan.*',
            'cabor.nama_cabor',
            'kegiatan.uraian_kegiatan',
            'rekening.uraian_rekening',
            'belanja.uraian_belanja',
            'barang.nama_barang',
            'barang.harga_satuan'
        )
        ->join('cabor', 'cabor.id', 'perencanaan.cabor')
        ->join('kegiatan', 'kegiatan.kode_kegiatan', 'perencanaan.kode_kegiatan')
        ->join('rekening', 'rekening.kode_rekening', 'perencanaan.kode_rekening')
        ->join('belanja', 'belanja.kode_belanja', 'perencanaan.kode_belanja')
        ->join('barang', 'barang.kode_barang', 'perencanaan.kode_barang')
        ->where('perencanaan.id', $id)
        ->first();

        return response()->json($detail);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $request->merge([
    //         'harga_satuan' => str_replace('.', '', $request->input('harga_satuan'))

    //     ]);
    //     $validated = $request->validate([
    //         'id_cabor'      => 'required',
    //         'kode_kegiatan' => 'required|string|max:255',
    //         'kode_rekening' => 'required|string|max:255',
    //         'kode_belanja'  => 'required|string|max:255',
    //         'kode_barang'   => 'nullable|string|max:255',
    //         'jumlah'        => 'required|numeric',
    //         'satuan'        => 'required|string|max:100',
    //         'harga_satuan'  => 'nullable|numeric',
    //         'bulan'         => 'required|integer|between:1,12',
    //         'tahun_anggaran'=> 'required|integer|min:1900|max:'.(date('Y')+1),
    //     ]);
    //     $id = Auth::id();
    //     $user = \App\Models\User::where('id', $id)->first();
    //     $nama_cabor = $user->cabor;
    //     $new_data = new Perencanaan();
    //     $new_data->kode_kegiatan = $validated['kode_kegiatan'];
    //     $new_data->kode_rekening = $validated['kode_rekening'];
    //     $new_data->kode_belanja  = $validated['kode_belanja'];
    //     $new_data->jumlah        = $validated['jumlah'];
    //     $new_data->satuan        = $validated['satuan'];
    //     $new_data->kode_barang   = $validated['kode_barang'] ?? null;
    //     $new_data->harga_satuan  = $validated['harga_satuan'] ?? null;
    //     $new_data->bulan         = $validated['bulan'];
    //     $new_data->tahun_anggaran = $validated['tahun_anggaran'];
    //     $new_data->cabor         = $validated['id_cabor'] ?? null;
    //     $new_data->status        = 0;
    //     $new_data->created_by = $user->username;
    //     if($user->role == "cabor"){
    //         $new_data->save();
    //         return redirect()->route('perencanaan.index')->with('status', 'Data Berhasil Disimpan.');
    //     }else{
    //         return redirect()->route('cmshome.index')->with(['error' => 'Unauthorized Access. User Tidak Diijinkan.']);
    //     }

    // }


    public function store(Request $request)
    {
        $request->merge([
            'harga_satuan' => str_replace('.', '', $request->input('harga_satuan'))

        ]);
        $validated = $request->validate([
            'id_cabor'      => 'required',
            'kode_kegiatan' => 'required|string|max:255',
            'kode_rekening' => 'required|string|max:255',
            'kode_ketbarang'=> 'required|string|max:255',
            'id_nama_barang'=> 'required|string|max:255',
            'jumlah'        => 'required|numeric',
            'satuan'        => 'required|string|max:100',
            'harga_satuan'  => 'nullable|numeric',
            'bulan'         => 'required|integer|between:1,12',
            'tahun_anggaran'=> 'required|integer|min:1900|max:'.(date('Y')+1),
        ]);
        $id = Auth::id();
        $user = \App\Models\User::where('id', $id)->first();
        $nama_cabor = $user->cabor;
        $new_data = new Perencanaan();
        $new_data->kode_kegiatan = $validated['kode_kegiatan'];
        $new_data->kode_rekening = $validated['kode_rekening'];
        $new_data->jumlah        = $validated['jumlah'];
        $new_data->satuan        = $validated['satuan'];
        $new_data->kode_ketbarang= $validated['kode_ketbarang'];
        $new_data->id_nama_barang= $validated['id_nama_barang'];
        $new_data->harga_satuan  = $validated['harga_satuan'];
        $new_data->bulan         = $validated['bulan'];
        $new_data->tahun_anggaran= $validated['tahun_anggaran'];
        $new_data->cabor         = $validated['id_cabor'];
        $new_data->status        = 1;
        $new_data->created_by = $user->username;

        $limitnominal = Limitnominal::where('tahun',$validated['tahun_anggaran'])
                        ->where('cabor',$user->cabor)
                        ->first();
        $harga_total = $validated['harga_satuan']*$validated['jumlah'];

        //semester 1
        if($validated['bulan'] >= 1 && $validated['bulan'] <= 6){
            $limitnominal->terpakai_semester1 = $harga_total+$limitnominal->terpakai_semester1;
            $limitnominal->sisa_semester1 -= $harga_total;
        }
        //semester 2
        if($validated['bulan'] >= 7 && $validated['bulan'] <= 12){
            $limitnominal->terpakai_semester2 = $harga_total+$limitnominal->terpakai_semester2;
            $limitnominal->sisa_semester2 -= $harga_total;
        }

        $limitnominal->nominal_terpakai = $limitnominal->terpakai_semester1 + $limitnominal->terpakai_semester2 ;

        $limitnominal->nominal_sisa = $limitnominal->nominal - $limitnominal->nominal_terpakai ;

        // $limitnominal->nominal_terpakai = $limitnominal->nominal - ($limitnominal->semester1 + $limitnominal->semester2 + $limitnominal->terpakai );
        // $limitnominal->nominal_sisa = $limitnominal->nominal - ($limitnominal->nominal - ($limitnominal->semester1 + $limitnominal->semester2 + $limitnominal->terpakai ));

        if($user->role == "cabor"||$user->role == "staff"){
            $new_data->save();
            $limitnominal->update();
            return redirect()->route('perencanaan.index')->with('status', 'Data Berhasil Disimpan.');
        }else{
            return redirect()->route('cmshome.index')->with(['error' => 'Unauthorized Access. User Tidak Diijinkan.']);
        }

    }

    public function ajukan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required|integer',
            'cabor' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }
        // try {
            // Create new perencanaan
            $check_dt = PengajuanPerencanaan::where('tahun',$request->input('tahun'))
                                            ->where('cabor',$request->input('cabor'))
                                            ->first();

            $caborid = Cabor::where('nama_cabor',$request->input('cabor'))
                                            ->first();

            if(!$check_dt){
                $dt = new PengajuanPerencanaan();
                // Fill the model with validated data
                $dt->fill($validator->validated());
                // Set additional default values
                $dt->status = 0; // Pending status
                $dt->verified_by = null;
                $dt->verified_at = null;
                // Save the model

                $dt->save();
                $id_pengajuan_perencanaan = $dt->id;

                // dd($id_pengajuan_perencanaan);
                // die();
                // $dt->where('tahun','!=',$request->input('tahun'))
                //     ->where('cabor','!=',$request->input('cabor'))
                //     ->save();

                $upd = Perencanaan::where('tahun_anggaran', $request->input('tahun'))
                                            ->where('cabor',$caborid->id)
                                            ->update(['id_pengajuan_perencanaan'=> $id_pengajuan_perencanaan]);


            }else{
                $id_pengajuan_perencanaan = $check_dt->id;
                $dtupd = PengajuanPerencanaan::where('tahun',$request->input('tahun'))
                                             ->where('cabor',$request->input('cabor'))
                                             ->update(['status'=>0]);
                                            // ->first();

                $upd = Perencanaan::where('tahun_anggaran', $request->input('tahun'))
                                            ->where('cabor',$caborid->id)
                                            // ->where('id_pengajuan_perencanaan','!=',null)
                                            ->update(['id_pengajuan_perencanaan'=> $id_pengajuan_perencanaan]);

            }



            return response()->json([
                'status' => 'success',
                'message' => 'Pengajuan perencanaan berhasil disimpan',
                // 'data' => $dt
            ], 201);
        // } catch (\Exception $e) {
        //     // Log the error for debugging
        //     \Log::error('Pengajuan Perencanaan Error: ' . $e->getMessage());

        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Gagal menyimpan pengajuan perencanaan',
        //         'error' => $e->getMessage()
        //     ], 500);
        // }

    }

    public function setuju(Request $request,$id)
    {
        $validated = $request->validate([
            'keterangansetuju' => 'nullable|string|max:255',
            'harga_total2'  => 'numeric',
            'jumlah2'       => 'numeric',
            'satuan2'       => 'string',
        ]);
        $user = Auth::user();
        $hargasetujui = $validated['harga_total2'];
        $perencanaan = Perencanaan::findOrFail($id);
        $limitnominal = Limitnominal::where('tahun',$perencanaan->tahun_anggaran)
                        ->first();
        $bulan_perencanaan = $perencanaan->bulan;
        if($bulan_perencanaan >= 1 && $bulan_perencanaan <= 6){
            $limitnominal->semester1 -= $hargasetujui;
        }
        if($bulan_perencanaan >= 7 && $bulan_perencanaan <= 12){
            $limitnominal->semester2 -= $hargasetujui;
        }
        $limitnominal->nominal_terpakai = $limitnominal->nominal - ($limitnominal->semester1 + $limitnominal->semester2 + $limitnominal->terpakai );
        $limitnominal->nominal_sisa = $limitnominal->nominal - ($limitnominal->nominal - ($limitnominal->semester1 + $limitnominal->semester2 + $limitnominal->terpakai ));
        $limitnominal->update();

        $perencanaan->status = 1;
        $perencanaan->keterangan = $validated['keterangansetuju']?? null;
        $perencanaan->verified_by = $user->username;
        $perencanaan->jumlah = $validated['jumlah2'];
        $perencanaan->satuan = $validated['satuan2'];
        $perencanaan->save();

        return redirect()->route('perencanaan.verifikasi')->with('status', 'Pengajuan Disetujui.');
    }

    public function tolak(Request $request,$id)
    {
        $validated = $request->validate([
            'keterangantolak' => 'string|max:255',
        ]);
        $idz = Auth::id();
        $user = \App\Models\User::where('id', $idz)->first();
        $perencanaan = Perencanaan::findOrFail($id);

        // Update status to 2 (Tolak)
        $perencanaan->status = 2;
        $perencanaan->keterangan = $validated['keterangantolak']?? null;
        $perencanaan->verified_by = $user->username;
        $perencanaan->save();
        // $perencanaan->save();

        return redirect()->route('perencanaan.verifikasi')->with('status', 'Pengajuan Ditolak.');
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
        $data = Perencanaan::findOrFail($id);
        $nama_cabor = Cabor::where('id', $data->cabor)
                            ->first();
        $limitnominal = Limitnominal::where('tahun',$data->tahun_anggaran)
                        ->where('cabor',$nama_cabor->nama_cabor)
                        ->first();
        $harga_total = $data->harga_satuan*$data->jumlah;



        if($data->bulan >= 1 && $data->bulan <= 6){
            $limitnominal->terpakai_semester1 = $limitnominal->terpakai_semester1-$harga_total;
            $limitnominal->sisa_semester1 += $harga_total;
            $limitnominal->nominal_terpakai = $limitnominal->nominal_terpakai - $harga_total ;
            $limitnominal->nominal_sisa = $limitnominal->nominal_sisa + $harga_total ;
            // dd('terpakai_semester1:'.$limitnominal->terpakai_semester1,'sisa_semester1:'.$limitnominal->sisa_semester1,'harga_satuan:'.$data->harga_satuan,'jumlah:'.$data->jumlah);
        }
        if($data->bulan >= 7 && $data->bulan <= 12){
            $limitnominal->terpakai_semester2 = $limitnominal->terpakai_semester2-$harga_total;
            $limitnominal->sisa_semester2 += $harga_total;
            $limitnominal->nominal_terpakai = $limitnominal->nominal_terpakai - $harga_total ;
            $limitnominal->nominal_sisa = $limitnominal->nominal_sisa + $harga_total ;
        }

        // dd('nominal_terpakai:'.$limitnominal->nominal_terpakai,'terpakai_semester1:'.$limitnominal->terpakai_semester1,'terpakai_semester2:'.$limitnominal->terpakai_semester2);

        // die();
        $limitnominal->update();
        $data->delete();
        return redirect()->route('perencanaan.index')->with('status','Data Berhasil dihapus');
    }

    public function getBudgetLimit($year)
    {
        $id = Auth::id();
        $user =\App\Models\User::where('id',$id)
                    ->first();

        $limit = LimitNominal::where('tahun', $year)
            ->where('cabor',$user->cabor)
            ->select('*')
            ->first();

        if (!$limit) {
            return response()->json(['error' => 'Budget limit not found'], 404);
        }

        return response()->json(['data' => $limit]);
    }

    public function getKegiatan()
    {
        return Kegiatan::get();
    }

    public function getKetBarang()
    {
        return KetBarang::get();
    }

    public function getRekening($kode_kegiatan)
    {
        return Rekening::where('kode_kegiatan', $kode_kegiatan)
            ->get();
    }

    public function getRekening1($kode_ketbarang)
    {
        return Rekening1::where('kode_ketbarang', $kode_ketbarang)
            ->get();
    }

    public function getBelanja($kode_rekening)
    {
        return Belanja::where('kode_rekening', $kode_rekening)
            ->get();
    }

    public function getBarang($kode_belanja)
    {
        return Barang::where('kode_belanja', $kode_belanja)
            ->get();
    }

    public function getBarang1($kode_rekening)
    {
        return Barang1::where('kode_rekening', $kode_rekening)
            ->get();
    }

    public function getHarga($kode_barang)
    {
        return Barang::where('kode_barang', $kode_barang)
            ->select('harga_satuan')
            ->first();
    }

    public function getHarga1($id)
    {
        return Barang1::where('id', $id)
            ->select('harga_satuan')
            ->first();
    }
}
