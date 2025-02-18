<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cabor;
use App\Models\PengurusCabor;
use App\Models\Perencanaan;
use App\Models\BelanjaBarjas;
use App\Models\Kegiatan;
use App\Models\Rekening;
use App\Models\Belanja;
use App\Models\Barang;
use App\Models\PengajuanPerencanaan;
use App\Models\KetBarang;
use App\Models\Rekening1;
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
class BelanjaBarjasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $page = 'Belanja Barang Jasa';

    //     $id = Auth::id();
    //     $user =\App\Models\User::where('id',$id)
    //                 ->first();
    //     $months = [
    //         1 => 'Januari',
    //         2 => 'Februari',
    //         3 => 'Maret',
    //         4 => 'April',
    //         5 => 'Mei',
    //         6 => 'Juni',
    //         7 => 'Juli',
    //         8 => 'Agustus',
    //         9 => 'September',
    //         10 => 'Oktober',
    //         11 => 'November',
    //         12 => 'Desember'
    //     ];
    //     $currentYear = PeriodeTahun::select('tahun')
    //                     ->where('status','=',1)
    //                     ->first();
    //     // $currentYear = date('Y')+1;
    //     $years = range($currentYear->tahun, $currentYear->tahun + 5);
    //     if($user->role=="cabor"){
    //         $nama_cabor = $user->cabor;
    //         $id_cabor = Cabor::select('id')
    //                         ->where('nama_cabor',$nama_cabor)
    //                         ->first();
    //         foreach($months as $key => $month){
    //             $monthNumber = str_pad($key, 2, '0', STR_PAD_LEFT);
    //             $perencanaan[$key] = Perencanaan::select('perencanaan.*','barang.nama_barang','barang.harga_satuan','barang.kode_barang')
    //                                 ->Join('barang','barang.kode_barang','perencanaan.kode_barang')
    //                                 ->where('cabor', $id_cabor->id)
    //                                 ->where('bulan', $key)
    //                                 ->where('tahun_anggaran',$currentYear->tahun)
    //                                 ->where('status', 1)
    //                                 ->get();
    //             $monthData = BelanjaBarjas::select('belanja_barjas.*','perencanaan.kode_barang','perencanaan.cabor as cabor','barang.nama_barang','barang.harga_satuan','barang.kode_barang')
    //                     ->Join('perencanaan','perencanaan.id','belanja_barjas.id_perencanaan')
    //                     ->Join('barang','barang.kode_barang','perencanaan.kode_barang')
    //                     ->where('tanggal_transaksi','LIKE',"$currentYear->tahun-$monthNumber%")
    //                     ->where('cabor',$id_cabor->id)
    //                     ->where('status',1)
    //                     ->orderBy('created_at','DESC')
    //                     ->get();

    //             $monthlyData[$key] = [
    //                 'name' => $month,
    //                 'total' => $monthData->sum('total_harga'),
    //                 'count' => $monthData->count()
    //             ];
    //         }
    //     if($user->role == "cabor"){
    //         return view('back.belanja_barjas.index',[
    //             'page'=>$page,
    //             'nama_cabor'=>$nama_cabor,
    //             'id_cabor'=>$id_cabor,
    //             'months'=>$months,
    //             'years'=>$years,
    //             'monthlyData' => $monthlyData,
    //             'currentYear' => $currentYear,
    //             'perencanaan' => $perencanaan,
    //         ]);
    //     }else{
    //         return redirect()->route('cmshome.index')->with(['error' => 'Unauthorized Access. User Tidak Diijinkan.']);
    //     }
    //     }
    // }

    public function index()
    {
        $page = 'Belanja Barang Jasa';

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
        $currentYear = PeriodeTahun::select('tahun')
                        ->where('status','=',1)
                        ->first();
        // $currentYear = date('Y')+1;
        $years = range($currentYear->tahun, $currentYear->tahun + 5);
        if($user->role=="cabor"||$user->role=="staff"){
            $nama_cabor = $user->cabor;
            $id_cabor = Cabor::select('id')
                            ->where('nama_cabor',$nama_cabor)
                            ->first();
            foreach($months as $key => $month){
                $pengajuan_perencanaan_setuju = PengajuanPerencanaan::where('cabor',$nama_cabor)
                                                                    ->where('tahun',$currentYear->tahun)
                                                                    ->where('status',1)
                                                                    ->first();
                if($pengajuan_perencanaan_setuju){
                    $monthNumber = str_pad($key, 2, '0', STR_PAD_LEFT);
                    $perencanaan[$key] = Perencanaan::select('perencanaan.*','barang_1.nama_barang','barang_1.harga_satuan','barang_1.kode_rekening')
                                        ->Join('barang_1','barang_1.id','perencanaan.id_nama_barang')
                                        ->where('cabor', $id_cabor->id)
                                        ->where('bulan', $key)
                                        ->where('tahun_anggaran',$currentYear->tahun)
                                        ->where('id_pengajuan_perencanaan', $pengajuan_perencanaan_setuju->id)
                                        ->get();
                    $monthData = BelanjaBarjas::select('belanja_barjas.*','perencanaan.kode_ketbarang','perencanaan.cabor as cabor','barang_1.nama_barang','barang_1.harga_satuan','barang_1.kode_rekening')
                            ->Join('perencanaan','perencanaan.id','belanja_barjas.id_perencanaan')
                            ->Join('barang_1','barang_1.id','perencanaan.id_nama_barang')
                            ->where('tanggal_transaksi','LIKE',"$currentYear->tahun-$monthNumber%")
                            ->where('cabor',$id_cabor->id)
                            ->where('status',1)
                            ->orderBy('created_at','DESC')
                            ->get();

                    $monthlyData[$key] = [
                        'name' => $month,
                        'total' => $monthData->sum('total_harga'),
                        'count' => $monthData->count()
                    ];
                }else{
                    return redirect()->route('cmshome.index')->with(['error' => 'Pengajuan perencanaan tahun '.$currentYear->tahun.' masih belum disetujui']);
                }

            }
        if($user->role == "cabor"||$user->role == "staff"){
            return view('back.belanja_barjas.index',[
                'page'=>$page,
                'nama_cabor'=>$nama_cabor,
                'id_cabor'=>$id_cabor,
                'months'=>$months,
                'years'=>$years,
                'monthlyData' => $monthlyData,
                'currentYear' => $currentYear,
                'perencanaan' => $perencanaan,
            ]);
        }else{
            return redirect()->route('cmshome.index')->with(['error' => 'Unauthorized Access. User Tidak Diijinkan.']);
        }
        }
    }

    // private function getPerencanaanData($cabor_id, $requestKey)
    //     {
    //         return Perencanaan::select(
    //             'perencanaan.jumlah',
    //             'barang.nama_barang',
    //             'barang.harga_satuan',
    //             'barang.kode_barang',
    //             DB::raw('SUM(belanja_barjas.jumlah) as jumlah_belanja')
    //         )
    //         ->join('barang', 'barang.kode_barang', '=', 'perencanaan.kode_barang')
    //         ->leftJoin('belanja_barjas', 'belanja_barjas.id_perencanaan', '=', 'perencanaan.id')
    //         ->where('cabor', $cabor_id)
    //         ->where('perencanaan.id', $requestKey)
    //         ->where('tahun_anggaran', date('Y')+1)
    //         ->where('status', 1)
    //         ->groupBy(
    //             'perencanaan.jumlah',
    //             'barang.nama_barang',
    //             'barang.harga_satuan',
    //             'barang.kode_barang'
    //         )
    //         ->get();
    //     }

    private function getPerencanaanData($cabor_id, $requestKey)
        {
            return Perencanaan::select(
                'perencanaan.jumlah',
                'barang_1.nama_barang',
                'barang_1.harga_satuan',
                'barang_1.kode_rekening',
                DB::raw('SUM(belanja_barjas.jumlah) as jumlah_belanja')
            )
            ->join('barang_1', 'barang_1.id', '=', 'perencanaan.id_nama_barang')
            ->leftJoin('belanja_barjas', 'belanja_barjas.id_perencanaan', '=', 'perencanaan.id')
            ->where('cabor', $cabor_id)
            ->where('perencanaan.id', $requestKey)
            ->where('tahun_anggaran', date('Y')+1)
            ->where('id_pengajuan_perencanaan', '!=',null)
            ->groupBy(
                'perencanaan.jumlah',
                'barang_1.nama_barang',
                'barang_1.harga_satuan',
                'barang_1.kode_rekening'
            )
            ->get();
        }

    public function check_jumlah_barang($requestKey)
    {
        $id = Auth::id();
        $user = \App\Models\User::find($id); // Using find() is more efficient than where()->first()

        // dd($user);
        // die();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if (!$user->cabor) {
            return response()->json(['error' => 'User has no associated cabor'], 404);
        }

        $id_cabor = Cabor::where('nama_cabor', $user->cabor)->first();

        if (!$id_cabor) {
            return response()->json(['error' => 'Cabor not found'], 404);
        }

        $perencanaan = $this->getPerencanaanData($id_cabor->id, $requestKey);

        if ($perencanaan->isEmpty()) {
            return response()->json(['error' => 'No planning data found'], 404);
        }

        $data = $perencanaan->map(function ($item) {
            $jumlah_belanja = $item->jumlah_belanja ?? 0;
            $remaining = $item->jumlah - $jumlah_belanja;

            return [
                'nama_barang' => $item->nama_barang,
                'kode_rekening' => $item->kode_rekening,
                'harga_satuan' => $item->harga_satuan,
                'jumlah' => $item->jumlah,
                'jumlah_belanja' => $jumlah_belanja,
                'remaining' => $remaining
            ];
        });

        return response()->json(['data' => $data]);
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
        $request->validate([
            'id_perencanaan' => 'required|exists:perencanaan,id',
            'tanggal_transaksi' => 'required|date',
            'jumlah' => 'required|numeric|min:1',
            'detail' => 'required|string',
            'pajak' => 'required|string',
        ]);

        try {
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
            $currentYear = PeriodeTahun::select('tahun')
                        ->where('status','=',1)
                        ->first();
            // $currentYear = date('Y');
            // $years = range($currentYear, $currentYear + 5);
            $years = range($currentYear->tahun, $currentYear->tahun + 5);
            // Get user and cabor info
            $idz = Auth::id();
            $user = \App\Models\User::where('id', $idz)->first();
            $id_cabor = Cabor::select('id')
                            ->where('nama_cabor', $user->cabor)
                            ->first();
                // dd($check_harga);
                // die();
                // Create new BelanjaBarjas record
            BelanjaBarjas::create([
                'id_perencanaan' => $request->id_perencanaan,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'jumlah' => $request->jumlah,
                'total_harga' => $request->jumlah * $request->harga_satuan,
                'detail' => $request->detail,
                'pajak' => $request->pajak,
                'created_by' => $user->username
            ]);

            return redirect()->back()->with('status', 'Data belanja berhasil ditambahkan');

        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                            ->withInput();
        }
    }


    public function show($year, $month)
    {
        $page = 'Detail Belanja Barang Jasa';
        $user = Auth::user();

        if ($user->role != "cabor" && $user->role != "staff") {
            return redirect()->route('cmshome.index')
                ->with(['error' => 'Unauthorized Access. User Tidak Diijinkan.']);
        }

        // Validate year and month
        $currentYear = PeriodeTahun::select('tahun')
                        ->where('status','=',1)
                        ->first();
        // $currentYear = date('Y');
        // if ($year < 2020 || $year > $currentYear + 5 || $month < 1 || $month > 12) {
        if ($year < 2020 || $year > $currentYear->tahun + 5 || $month < 1 || $month > 12) {
            return redirect()->route('cmshome.index')
                ->with(['error' => 'Invalid date parameters']);
        }

        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        // Get Cabor ID
        $nama_cabor = $user->cabor;
        $id_cabor = Cabor::select('id')
            ->where('nama_cabor', $nama_cabor)
            ->firstOrFail();

        $monthNumber = str_pad($month, 2, '0', STR_PAD_LEFT);

        $data = BelanjaBarjas::select(
            'belanja_barjas.*',
            'perencanaan.id as  ',
            'perencanaan.kode_ketbarang',
            'perencanaan.cabor',
            'perencanaan.jumlah as jumlah_perencanaan',
            'barang_1.nama_barang',
            'barang_1.harga_satuan'
        )
        ->join('perencanaan', 'perencanaan.id', 'belanja_barjas.id_perencanaan')
        ->join('barang_1', 'barang_1.id', 'perencanaan.id_nama_barang')
        ->where('tanggal_transaksi', 'LIKE', "$currentYear->tahun-$monthNumber%")
        ->where('perencanaan.cabor', $id_cabor->id)
        ->orderBy('belanja_barjas.created_at', 'DESC')
        ->paginate(10);

        $perencanaan = Perencanaan::select('perencanaan.*','barang_1.nama_barang','barang_1.harga_satuan','barang_1.kode_rekening')
                                    ->Join('barang_1','barang_1.id','perencanaan.id_nama_barang')
                                    ->where('cabor', $id_cabor->id)
                                    ->where('bulan', $month)
                                    ->where('tahun_anggaran',$currentYear->tahun)
                                    ->where('id_pengajuan_perencanaan', '!=',null)
                                    ->get();


        return view('back.belanja_barjas.detail', compact(
            'page',
            'nama_cabor',
            'id_cabor',
            'months',
            'month',
            'year',
            'data',
            'perencanaan',
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($year, $month)
    // {
    //     $page = 'Detail Belanja Barang Jasa';
    //     $user = Auth::user();

    //     if ($user->role != "cabor") {
    //         return redirect()->route('cmshome.index')
    //             ->with(['error' => 'Unauthorized Access. User Tidak Diijinkan.']);
    //     }

    //     // Validate year and month
    //     $currentYear = PeriodeTahun::select('tahun')
    //                     ->where('status','=',1)
    //                     ->first();
    //     // $currentYear = date('Y');
    //     // if ($year < 2020 || $year > $currentYear + 5 || $month < 1 || $month > 12) {
    //     if ($year < 2020 || $year > $currentYear->tahun + 5 || $month < 1 || $month > 12) {
    //         return redirect()->route('cmshome.index')
    //             ->with(['error' => 'Invalid date parameters']);
    //     }

    //     $months = [
    //         1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
    //         4 => 'April', 5 => 'Mei', 6 => 'Juni',
    //         7 => 'Juli', 8 => 'Agustus', 9 => 'September',
    //         10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    //     ];

    //     // Get Cabor ID
    //     $nama_cabor = $user->cabor;
    //     $id_cabor = Cabor::select('id')
    //         ->where('nama_cabor', $nama_cabor)
    //         ->firstOrFail();

    //     $monthNumber = str_pad($month, 2, '0', STR_PAD_LEFT);

    //     // Get Perencanaan Data for specific month and year
    //     // $perencanaan = Perencanaan::select(
    //     //         'perencanaan.*',
    //     //         'barang.nama_barang',
    //     //         'barang.harga_satuan',
    //     //         'barang.kode_barang'
    //     //     )
    //     //     ->join('barang', 'barang.kode_barang', 'perencanaan.kode_barang')
    //     //     ->where('cabor', $id_cabor->id)
    //     //     ->where('bulan', $month)
    //     //     ->where('tahun_anggaran', $year)
    //     //     ->where('status', 1)
    //     //     ->get();
    //     $data = BelanjaBarjas::select(
    //         'belanja_barjas.*',
    //         'perencanaan.id as  ',
    //         'perencanaan.kode_barang',
    //         'perencanaan.cabor',
    //         'perencanaan.jumlah as jumlah_perencanaan',
    //         'barang.nama_barang',
    //         'barang.harga_satuan'
    //     )
    //     ->join('perencanaan', 'perencanaan.id', 'belanja_barjas.id_perencanaan')
    //     ->join('barang', 'barang.kode_barang', 'perencanaan.kode_barang')
    //     ->where('tanggal_transaksi', 'LIKE', "$currentYear->tahun-$monthNumber%")
    //     ->where('perencanaan.cabor', $id_cabor->id)
    //     ->orderBy('belanja_barjas.created_at', 'DESC')
    //     ->paginate(10);

    //     $perencanaan = Perencanaan::select('perencanaan.*','barang.nama_barang','barang.harga_satuan','barang.kode_barang')
    //                                 ->Join('barang','barang.kode_barang','perencanaan.kode_barang')
    //                                 ->where('cabor', $id_cabor->id)
    //                                 ->where('bulan', $month)
    //                                 ->where('tahun_anggaran',$currentYear->tahun)
    //                                 ->where('status', 1)
    //                                 ->get();


    //     return view('back.belanja_barjas.detail', compact(
    //         'page',
    //         'nama_cabor',
    //         'id_cabor',
    //         'months',
    //         'month',
    //         'year',
    //         'data',
    //         'perencanaan',
    //     ));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = 'Ubah Belanja Barang Jasa';

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
        $currentYear = PeriodeTahun::select('tahun')
                        ->where('status','=',1)
                        ->first();

        $data =  Perencanaan::select('perencanaan.*','barang.nama_barang','barang.harga_satuan','barang.kode_barang')
                                    ->Join('barang','barang.kode_barang','perencanaan.kode_barang')
                                    ->where('cabor', $id_cabor->id)
                                    ->where('bulan', $key)
                                    ->where('tahun_anggaran',$currentYear->tahun)
                                    ->where('status', 1)
                                    ->get();
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
        $request->validate([
            'id_perencanaan' => 'required|exists:perencanaan,id',
            'tanggal_transaksi' => 'required|date',
            'jumlah' => 'required|numeric|min:1',
            'detail' => 'required|string',
            'pajak' => 'required|string',
        ]);

        try {
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
            $currentYear = PeriodeTahun::select('tahun')
                        ->where('status','=',1)
                        ->first();
            // $currentYear = date('Y');
            // $years = range($currentYear, $currentYear + 5);
            $years = range($currentYear->tahun, $currentYear->tahun + 5);
            // Get user and cabor info
            $idz = Auth::id();
            $user = \App\Models\User::where('id', $idz)->first();
            $id_cabor = Cabor::select('id')
                            ->where('nama_cabor', $user->cabor)
                            ->first();

            $dt = BelanjaBarjas::where('id',$id)
                            ->where('id_perencanaan',$request->id_perencanaan)
                            ->first();
            $dt->tanggal_transaksi = $request->tanggal_transaksi;
            $dt->jumlah = $request->jumlah;
            $dt->total_harga = $request->jumlah * $request->harga_satuan;
            $dt->detail = $request->detail;
            $dt->pajak = $request->pajak;
            $dt->updated_by = $user->username;
            $dt->update();
            return redirect()->back()->with('status', 'Data belanja berhasil diubah');

        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                            ->withInput();
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
        $dt = BelanjaBarjas::findOrFail($id);
        $dt->delete();
        return redirect()->back()->with('status','Data Berhasil dihapus');
    }
}
