@extends('layouts.back.header')
@section('title') Detail Data Belanja @endsection
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    @if (session('status'))
                        <div class="alert alert-success">
                            <strong>{{session('status')}}</strong>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            <strong>{{ session('error') }}</strong>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Detail Data Belanja - {{ $nama_cabor }}</h6>
                        <div>
                            {{-- <span class="text-sm">Tahun Anggaran: {{ $currentYear }}</span> --}}
                        </div>
                    </div>
                </div>

                <div class="card-body">

                            <div class="mb-4">
                                <h6 class="text-uppercase">Bulan {{ $months[$month] }}</h6>
                                <div class="table-responsive">
                                    <table class="table table-hover align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga Satuan</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Harga</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Detail</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pajak</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Transaksi</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created at</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $index = 1; @endphp
                                            @foreach($data as $item)
                                                <tr>
                                                    <td class="ps-4"><span class="text-secondary text-xs">{{ $index++ }}</span></td>
                                                    <td><span class="text-secondary text-xs">{{ $item->nama_barang }}</span></td>
                                                    <td><span class="text-secondary text-xs">{{ $item->jumlah }}</span></td>
                                                    <td><span class="text-secondary text-xs">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</span></td>
                                                    <td><span class="text-secondary text-xs">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</span></td>
                                                    <td><span class="text-secondary text-xs">{{ $item->detail }}</span></td>
                                                    <td><span class="text-secondary text-xs">{{ $item->pajak }}</span></td>
                                                    <td><span class="text-secondary text-xs">{{ $item->tanggal_transaksi }}</span></td>
                                                    <td><span class="text-secondary text-xs">{{ $item->created_at->format('d/m/Y') }}</span></td>
                                                    <td>
                                                        @if(Auth::user()->role == "cabor")
                                                            <a class="btn btn-fill btn-info" href="" title='Ubah'><i class="fa fa-pen"></i></a>
                                                            <form onsubmit="return confirm('Anda Yakin untuk Menghapus Data Ini ?')" class="d-inline" action="" method="post">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-fill btn-danger"><i class="fa fa-trash" style="font-size: 19px;"></i></button>
                                                        </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                {{-- <td colspan="4" class="text-end"><strong>Total Belanja {{ $month }}:</strong></td> --}}
                                                {{-- <td colspan="3"><strong>Rp {{ number_format($monthlyData['total'], 0, ',', '.') }}</strong></td> --}}
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                    <a href="{{ route('belanja.index') }}" class="btn btn-danger btn-fill pull-left">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.back.footer')
@endsection
