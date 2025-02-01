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
                            <i class="fas fa-map-marker-alt me-2 text-info"></i> Alamat
                        </h4>
                        <p class="card-text"> JL. SUROYO NO. 49 KOTA PROBOLINGGO</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-center" style="height: 155px;">
                    <div class="card-body">
                        <h4 class="card-title mb-3 mt-2">
                            <i class="fa fa-phone me-2 text-info"></i> Telpon
                        </h4>
                        <p class="card-text">085331728955</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-center" style="height: 155px;">
                    <div class="card-body">
                        <h4 class="card-title mb-3 mt-2">
                            <i class="fa fa-envelope me-2 text-info"></i> Email
                        </h4>
                        <p class="card-text">konikabprobolinggo@gmail.com </p>
                    </div>
                </div>
            </div>
            <div class="embed-responsive embed-responsive-16by9" style="margin-top:50px">
           <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.4078342844286!2d113.2132027758418!3d-7.746493092272196!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7adbfe1acd2c9%3A0x972ba97488a1e7c!2sJl.%20Suroyo%20No.49%2C%20Tisnonegaran%2C%20Kec.%20Kanigaran%2C%20Kota%20Probolinggo%2C%20Jawa%20Timur%2067219!5e0!3m2!1sen!2sid!4v1738367048353!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
      </div>

  @include('layouts.front.sidebar')
  @include('layouts.front.footer')
@endsection

