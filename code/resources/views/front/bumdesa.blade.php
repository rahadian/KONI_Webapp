@extends('layouts.front.header')
@section('title') @endsection
@section('content')
<style>
.card_app {
  transition: all 0.3s ease; /* Add transition for smooth animation */
}

.card_app:hover {
  transform: scale(1.05); /* Increase the scale on hover */
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Add a box-shadow on hover */
  cursor: pointer;
}
</style>
<!-- Main Content -->
  <div class="container my-5">
    <div class="row">
      <div class="col-md-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">BUMDesa</li>
            </ol>
        </nav>
        <!-- IG -->
        <div class="heading_style" style="margin-bottom:30px">
        <h1>BUMDESA</h1>
        </div>

        <div class="row" style="background-color:#F7F7F7">
            <div class="col-md-6">
                <div class="card mb-4">
                    <img class="card-img-top" src="{{ asset('uploads/'.$ikhtisar->gambar) }}" loading="lazy">

                </div>
            </div>
            <div class="col-md-6">
                <p>{!! $ikhtisar->deskripsi !!}</p>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-center align-items-center">
            <div>
                <center><h4>Data BUMDESA</h4></center>
                <form class="form-inline" role="form" action="{{ route('bumdesa') }}" method="GET" class="form-horizontal style-form">
                    <button id="bumdes_hukum" name="bumdes_type" type="submit" class="btn btn-success m-2" value="Berbadan Hukum">Berbadan Hukum</button>
                    <button id="bumdes_nonhukum" name="bumdes_type" type="submit" class="btn btn-primary m-2" value="Belum Berbadan Hukum">Belum Berbadan Hukum</button>
                </form>
            </div>
        </div>

        <div class="col-md-12" style="padding-top:50px">
        @if($bumdes_type)
        <h4>BUMDESA {{ $bumdes_type }}</h4>

                <div id="accordion">
                    @foreach($kecamatan as $kec)
                        @php
                            $filteredData = $bumdes->where('kecamatan', $kec->kecamatan);
                            $tot_data = $filteredData->count();
                        @endphp
                        <div class="card p-1" style="border-radius: 0rem">
                            <div class="card-header p-3" id="heading11">
                            <h6 class="m-0 font-14">
                                <a href="#collapse{{ $kec->kecamatan }}" class="text-dark" data-toggle="collapse" aria-expanded="true" aria-controls="collapse{{ $kec->kecamatan }}">
                                    <i class="fa fa-building"></i> {{ $kec->nama }} <span class="badge badge-sm">{{ $tot_data }}</span></a>
                            </h6>
                            </div>
                            <div id="collapse{{ $kec->kecamatan }}" class="collapse showx" aria-labelledby="heading{{ $kec->kecamatan }}" data-parent="#accordion">
                                <div class="card-body" style='background-color:#f4f4f4; border-color:#e3e3e3;'>
                                    <div class="row">
                                        @foreach($filteredData as $dt)
                                        @php
                                         $kel = $kelurahan->where('kode',$dt->kelurahan_desa)
                                                         ->where('kecamatan',$dt->kecamatan)
                                                         ->first();

                                        @endphp
                                        <div class="col-sm-4" style="margin-bottom:20px">
                                            <div class="card card_app text-center" style="height: 155px;">
                                                <div class="card-body" id="{{ $dt->id }}">
                                                    <img src={{ asset('img/BUMDESA.JPG') }} class="lazy" style="width:50px;height:50px">
                                                    <h5 class="card-title mb-3 mt-2">
                                                        {{ $dt->nama_bumdes }}
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="infoModal{{ $dt->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Detail BUMDESA</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="row">Nama BUMDESA</th>
                                                                    <td>{{ $dt->nama_bumdes }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Kelurahan/Desa</th>
                                                                    <td>{{ $kel->nama }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Status</th>
                                                                    <td>{{ $dt->status_bumdes }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Keikutsertaan Desa Terhadap BUMDesa Bersama</th>
                                                                    <td>{{ $dt->keikutsertaan_desa }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">BUMDesa Bisnis Sosial</th>
                                                                    <td>{{ $dt->bisnis_sosial }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">BUMDesa Jasa Penyewaan</th>
                                                                    <td>{{ $dt->jasa_penyewaan }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">BUMDesa Perdagangan</th>
                                                                    <td>{{ $dt->perdagangan }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">BUMDesa Keuangan</th>
                                                                    <td>{{ $dt->keuangan }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">BUMDesa Perantara (Layanan)</th>
                                                                    <td>{{ $dt->perantara }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">BUMDesa Usaha</th>
                                                                    <td>{{ $dt->usaha }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">BUMDesa Pariwisata</th>
                                                                    <td>{{ $dt->pariwisata }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Tahun Pendirian Bumdesa</th>
                                                                    <td>{{ $dt->tahun_pendirian }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Total Tenaga Kerja Bumdesa</th>
                                                                    <td>{{ $dt->total_pekerja }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Nama Ketua Pelaksana Bidang Unit Usaha</th>
                                                                    <td>{{ $dt->nama_ketua_pelaksana }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Nama Ketua Bumdesa</th>
                                                                    <td>{{ $dt->nama_ketua_bumdes }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Nama Sekretaris</th>
                                                                    <td>{{ $dt->nama_sekretaris }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Nama Bendahara</th>
                                                                    <td>{{ $dt->nama_bendahara }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Jumlah Anggota Bumdesa</th>
                                                                    <td>{{ $dt->jumlah_anggota_bumdes }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Alamat Email Bumdesa</th>
                                                                    <td>{{ $dt->email_bumdes }}</td>
                                                                </tr>


                                                            </tbody>
                                                        </table>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            document.getElementById('{{ $dt->id }}').addEventListener('click', function() {
                                                $('#infoModal{{ $dt->id }}').modal('show');
                                            });
                                        </script>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            @endif
            </div>
        <br>

      </div>

  @include('layouts.front.sidebar')
  @include('layouts.front.footer')
@endsection

