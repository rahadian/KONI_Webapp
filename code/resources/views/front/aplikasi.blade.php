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
}
</style>
<!-- Main Content -->
  <div class="container my-5">
    <div class="row">
      <div class="col-md-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Aplikasi</li>
            </ol>
        </nav>
      <div class="heading_style">
      <h1>Aplikasi Terkait</h1>
      </div>
      <hr>
        <div class="row">
            <div class="col-sm-4" style="margin-bottom:20px">
                <div class="card card_app text-center" style="height: 155px;">
                    <div class="card-body">
                        <a href="https://idm.kemendesa.go.id/" target="_blank"><img src="https://idm.kemendesa.go.id/assets/images/LogoKemendesa110x110.png" class="lazy" style="width:20%"><h4 class="card-title mb-3 mt-2">
                            IDM
                        </h4>
                        <p class="card-text" style="font-size: 11px;">Indeks Desa Membangun</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" style="margin-bottom:20px">
                <div class="card card_app text-center" style="height: 155px;">
                    <div class="card-body">
                        <a href="https://sid.kemendesa.go.id/" target="_blank"><img src="https://sid.kemendesa.go.id/website/icon.png" class="lazy" style="width:20%"><h4 class="card-title mb-3 mt-2">
                            SID
                        </h4>
                        <p class="card-text" style="font-size: 11px;">Sistem Informasi Desa</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" style="margin-bottom:20px">
                <div class="card card_app text-center" style="height: 155px;">
                    <div class="card-body">
                        <a href="https://datadesacenter.dpmd.jatimprov.go.id/" target="_blank"><img src="https://datadesacenter.dpmd.jatimprov.go.id/favicon.ico" class="lazy" style="width:20%"><h4 class="card-title mb-3 mt-2">
                            DDC-SAPADesa
                        </h4>
                        <p class="card-text" style="font-size: 11px;">Sistem Aplikasi Pendataan Desa - Data Desa Center</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" style="margin-bottom:20px">
                <div class="card card_app text-center" style="height: 155px">
                    <div class="card-body">
                        <a href="https://sppd.probolinggokab.go.id" target="_blank"><img src="https://sppd.probolinggokab.go.id/favicon2.ico" class="lazy" style="width:10%"><h4 class="card-title mb-3 mt-2">
                            E-SPPD
                        </h4>
                        <p class="card-text" style="font-size: 12px;">Sistem Informasi Perjalanan Dinas</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" style="margin-bottom:20px">
                <div class="card card_app text-center" style="height: 155px;">
                    <div class="card-body">
                        <a href="" target="_blank"><img src="https://sppd.probolinggokab.go.id/favicon2.ico" class="lazy" style="width:10%"><h4 class="card-title mb-3 mt-2">
                            SISKEUDES
                        </h4>
                        <p class="card-text" style="font-size: 12px;">Sistem Keuangan Desa</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" style="margin-bottom:20px">
                <div class="card card_app text-center" style="height: 155px;">
                    <div class="card-body">
                        <a href="https://sirup.lkpp.go.id/" target="_blank"><img src="https://sirup.lkpp.go.id/sirup/public/images/web/favicon.ico" class="lazy" style="width:10%"><h4 class="card-title mb-3 mt-2">
                            SIRUP
                        </h4>
                        <p class="card-text" style="font-size: 11px;">Sistem Informasi Rencana Umum Pengadaan</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" style="margin-bottom:20px">
                <div class="card card_app text-center" style="height: 155px;">
                    <div class="card-body">
                        <a href="https://e-katalog.lkpp.go.id/" target="_blank"><img src="https://e-katalog.lkpp.go.id/public/images/favicon.png" class="lazy" style="width:10%"><h4 class="card-title mb-3 mt-2">
                            E-KATALOG
                        </h4>
                        <p class="card-text" style="font-size: 11px;">Layanan Daftar Barang Belanja Online</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" style="margin-bottom:20px">
                <div class="card card_app text-center" style="height: 155px;">
                    <div class="card-body">
                        <a href="https://eproc.lkpp.go.id/" target="_blank"><img src="http://eproc.lkpp.go.id/assets/favicon.png" class="lazy" style="width:10%"><h4 class="card-title mb-3 mt-2">
                            E-PROC
                        </h4>
                        <p class="card-text" style="font-size: 11px;">Layanan Portal Eproc LKPP</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" style="margin-bottom:20px">
                <div class="card card_app text-center" style="height: 155px;">
                    <div class="card-body">
                        <a href="https://lpse.probolinggokab.go.id/" target="_blank"><img src="https://lpse.probolinggokab.go.id/eproc4/public/images/4.3.icon.png" class="lazy" style="width:10%"><h4 class="card-title mb-3 mt-2">
                            LPSE
                        </h4>
                        <p class="card-text" style="font-size: 11px;">Lembaga Pengadaan Secara Elektronik</p>
                        </a>
                    </div>
                </div>
            </div>


        </div>
      </div>

  @include('layouts.front.sidebar')
  @include('layouts.front.footer')
@endsection

