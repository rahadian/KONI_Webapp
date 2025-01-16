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
use App\Models\LimitNominal;
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
        $currentYear = date('Y');
        $years = range($currentYear, $currentYear + 5);
        if($user->role=="cabor"){
            $nama_cabor = $user->cabor;
            $id_cabor = Cabor::select('id')
                            ->where('nama_cabor',$nama_cabor)
                            ->first();
            foreach($months as $key => $month){
                $monthNumber = str_pad($key, 2, '0', STR_PAD_LEFT);
                $perencanaan[$key] = Perencanaan::select('perencanaan.*','barang.nama_barang','barang.harga_satuan','barang.kode_barang')
                                    ->Join('barang','barang.kode_barang','perencanaan.kode_barang')
                                    ->where('cabor', $id_cabor->id)
                                    ->where('bulan', $key)
                                    ->where('tahun_anggaran',$currentYear)
                                    ->where('status', 1)
                                    ->get();
                $monthData = BelanjaBarjas::select('belanja_barjas.*','perencanaan.kode_barang','perencanaan.cabor as cabor','barang.nama_barang','barang.harga_satuan','barang.kode_barang')
                        ->Join('perencanaan','perencanaan.id','belanja_barjas.id_perencanaan')
                        ->Join('barang','barang.kode_barang','perencanaan.kode_barang')
                        ->where('tanggal_transaksi','LIKE',"$currentYear-$monthNumber%")
                        ->where('cabor',$id_cabor->id)
                        ->where('status',1)
                        ->orderBy('created_at','DESC')
                        ->get();

                $monthlyData[$key] = [
                    'name' => $month,
                    'total' => $monthData->sum('total_harga'),
                    'count' => $monthData->count()
                ];
            }
        if($user->role == "cabor"){
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
            $currentYear = date('Y');
            $years = range($currentYear, $currentYear + 5);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($year, $month)
    {
        $page = 'Detail Belanja Barang Jasa';
        $user = Auth::user();

        if ($user->role != "cabor") {
            return redirect()->route('cmshome.index')
                ->with(['error' => 'Unauthorized Access. User Tidak Diijinkan.']);
        }

        // Validate year and month
        $currentYear = date('Y');
        if ($year < 2020 || $year > $currentYear + 5 || $month < 1 || $month > 12) {
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

        // Get Perencanaan Data for specific month and year
        // $perencanaan = Perencanaan::select(
        //         'perencanaan.*',
        //         'barang.nama_barang',
        //         'barang.harga_satuan',
        //         'barang.kode_barang'
        //     )
        //     ->join('barang', 'barang.kode_barang', 'perencanaan.kode_barang')
        //     ->where('cabor', $id_cabor->id)
        //     ->where('bulan', $month)
        //     ->where('tahun_anggaran', $year)
        //     ->where('status', 1)
        //     ->get();
        $data = BelanjaBarjas::select(
            'belanja_barjas.*',
            'perencanaan.kode_barang',
            'perencanaan.cabor',
            'barang.nama_barang',
            'barang.harga_satuan'
        )
        ->join('perencanaan', 'perencanaan.id', 'belanja_barjas.id_perencanaan')
        ->join('barang', 'barang.kode_barang', 'perencanaan.kode_barang')
        ->where('tanggal_transaksi', 'LIKE', "$currentYear-$monthNumber%")
        ->where('perencanaan.cabor', $id_cabor->id)
        ->orderBy('belanja_barjas.created_at', 'DESC')
        ->paginate(10);


        return view('back.belanja_barjas.detail', compact(
            'page',
            'nama_cabor',
            'id_cabor',
            'months',
            'month',
            'year',
            'data'
        ));
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
