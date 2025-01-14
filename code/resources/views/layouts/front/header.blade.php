<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="KONI Kabupaten Probolinggo">
<meta name="keywords" content="KONI, Kabupaten Probolinggo, Probolinggo, Komite Olahraga Nasional Indonesia Kabupaten Probolinggo">
<meta name="author" content="DPMD Kabupaten Probolinggo">
<!-- Open Graph meta tags -->
<meta property="og:title" content="KONI Kabupaten Probolinggo">
<meta property="og:description" content="KONI Kabupaten Probolinggo">
<meta property="og:image" content="{{ asset('img/logo_koni.png') }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website">

<link rel="icon" type="image/png" href="{{ asset('img/logo_koni.png') }}">
@if($page != "KONI Kabupaten Probolinggo")
<title>KONI Kab.Probolinggo - {{ $page }}</title>
@else
<title>{{ $page }}</title>
@endif
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/style.css') }}?ver=2">
</head>

<body>
<div id="loading">
    <div class="spinner"></div>
</div>
  <div id="header_nav" class="header pb-2" style="background-color: #f06236;">
    <div class="container pb-2">
        <div class="row align-items-start">
            <!-- <div class="col-lg-9 fw-bold"><font color="#ffffff" face="arial,helvetica">
              <small><i class="fa fa-phone me-2"></i> +62 335 846665</small>
              <small style="margin-left:20px"><i class="fa fa-envelope me-2"></i> info@dpmd.probolinggokab.go.id</small>
              <small style="margin-left:20px"><i class="fa fa-map-marker-alt me-2"></i> Jl. Raya Panglima Sudirman No. 134 Kraksaan-Probolinggo</small>
              </font>
            </div> -->
            <div class="col-md-12 text-md-right"><font color="#414342" face="arial,helvetica">
              <small><i class="fa fa-calendar me-2"></i> <span id="currentDate"></span></small>
            </font>
            </div>
        </div>
        <!--/row-->
    </div>
    <!--container-->
  </div>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-sm navbar-dark sticky-top" style="height:80px; background-color: #f06236;">
    <div class="container">
      <!-- <div id="currentDate" class="top-bar text-center text-white bg-dark py-2 d-none d-lg-block"></div> -->
      <a class="navbar-brand" href="{{ route('home') }}"><img loading="lazy" src="{{ asset('img/KONILOGO_putih.png') }}" style="height: 65px;"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto p-4 p-lg-0">
          @if($page=="KONI Kabupaten Probolinggo")
          <li class="nav-item active">
          @else
          <li class="nav-item">
          @endif
            <a class="nav-link" href="{{ route('home') }}"><i class="fas fa-home"></i><b> BERANDA</b></a>
          </li>
          @if($page=="SAKIP"||$page=="Struktur Organisasi"||$page=="Dasar Hukum")
          <li class="nav-item dropdown active show-dropdown"> <!-- Add 'dropdown' class to this list item -->
          @else
          <li class="nav-item dropdown show-dropdown">
          @endif
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
              <b>PROFILE</b>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route("struktur") }}">Struktur Organisasi</a>
            </div>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="#">Data</a>
          </li> -->
            @if($page == "Semua Berita"||$page == "Semua Pengumuman")
            <li class="nav-item dropdown active show-dropdown">
            @else
            <li class="nav-item dropdown show-dropdown">
            @endif
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
                    <b>INFORMASI</b>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('berita.show_all') }}">Berita</a>
                    <a class="dropdown-item" href="{{ route('pengumuman.show_all') }}">Pengumuman</a>
                </div>
            </li>

            <a class="nav-link" href="{{ route('kontak') }}"><b>KONTAK KAMI</b></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
<div class="hero-section">
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-12">
                <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#newsCarousel" data-slide-to="1"></li>
                        <li data-target="#newsCarousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('img/endlessprob.jpg') }}" class="d-block w-100" alt="News 1">
                            <div class="carousel-caption d-none d-md-block">
                                <h3>Judul Berita</h3>
                                <p>Brief description of news 1</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('img/news/news2.jpg') }}" class="d-block w-100" alt="News 2">
                            <div class="carousel-caption d-none d-md-block">
                                <h3>Latest News Title 2</h3>
                                <p>Brief description of news 2</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('img/news/news3.jpg') }}" class="d-block w-100" alt="News 3">
                            <div class="carousel-caption d-none d-md-block">
                                <h3>Latest News Title 3</h3>
                                <p>Brief description of news 3</p>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

  @yield('content')

