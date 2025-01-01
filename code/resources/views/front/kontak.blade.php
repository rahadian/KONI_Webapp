@extends('layouts.front.header')
@section('title') @endsection
@section('content')
<style>
.map-container {
    margin-top: 50px;
    margin-left: 55px;
}

.responsive-iframe-container {
    position: relative;
    width: 100%;
    padding-top: 75%; /* 4:3 Aspect Ratio */
}

.responsive-iframe-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
}
</style>

<!-- Main Content -->
  <div class="container my-5">
    <div class="row" style="padding-bottom:100px">
      <div class="col-md-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kontak Kami</li>
            </ol>
        </nav>
      <div class="heading_style">
      <h1>Kontak Kami</h1>
      </div>
      <hr>
        <div class="row">
            <div class="col-sm-4">
                <div class="card text-center" style="height: 155px;">
                    <div class="card-body">
                        <h4 class="card-title mb-3 mt-2">
                            <i class="fa fa-map-marker-alt me-2 text-info"></i> Alamat
                        </h4>
                        <p class="card-text" style="font-size: 12px;">JL.RAYA PANGLIMA SUDIRMAN NO.134 KRAKSAAN</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-center" style="height: 155px;">
                    <div class="card-body">
                        <h4 class="card-title mb-3 mt-2">
                            <i class="fa fa-phone me-2 text-info"></i> Telpon
                        </h4>
                        <p class="card-text" style="font-size: 15px;">+62 335 846665 </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-center" style="height: 155px;">
                    <div class="card-body">
                        <h4 class="card-title mb-3 mt-2">
                            <i class="fa fa-envelope me-2 text-info"></i> Email
                        </h4>
                        <p class="card-text" style="font-size: 12px;">info@dpmd.probolinggokab.go.id </p>
                    </div>
                </div>
            </div>
            <div class="embed-responsive embed-responsive-16by9" style="margin-top:50px">
            <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1976.6310223767814!2d113.415962!3d-7.76201!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7005af3181627%3A0x4b033c7ae3a4880e!2sKantor%20Bupati%20Probolinggo!5e0!3m2!1sid!2sid!4v1715666739957!5m2!1sid!2sid" allowfullscreen></iframe>
            </div>
        </div>
      </div>

  @include('layouts.front.sidebar')
  @include('layouts.front.footer')
@endsection

