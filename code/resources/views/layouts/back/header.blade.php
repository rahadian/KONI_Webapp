<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset("img/logo_koni.png") }}">
  <link rel="icon" type="image/png" href="{{ asset("img/logo_koni.png") }}">
  <title>
   Dashboard KONI Kabupaten Probolinggo Web
  </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('cms/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('cms/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  {{-- <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js" integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="{{ asset('cms/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('cms/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker3.min.css" integrity="sha512-aQb0/doxDGrw/OC7drNaJQkIKFu6eSWnVMAwPN64p6sZKeJ4QCDYL42Rumw2ZtL8DB9f66q4CnLIUnAw28dEbg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
{{-- <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script> --}}
  <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.14/dist/sweetalert2.all.min.js"></script>

</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <div class="navbar-brand m-0">
        <img src="{{ asset("img/logo_koni.png") }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">KONI Web Dashboard</span>
      </div>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
        @if($page=='Dashboard')
          <a class="nav-link active" href="{{route('cmshome.index')}}">
        @else
         <a class="nav-link" href="{{route('cmshome.index')}}">
        @endif
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-secondary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <!-- Cabor Submenu -->
        <li class="nav-item">
          @if(in_array($page, ['Pengurus Cabor', 'Pelatih Cabor', 'Atlit Cabor', 'Prestasi Cabor']))
            <a class="nav-link active" data-bs-toggle="collapse" href="#caborSubmenu" role="button" aria-expanded="true" aria-controls="caborSubmenu">
          @else
            <a class="nav-link" data-bs-toggle="collapse" href="#caborSubmenu" role="button" aria-expanded="false" aria-controls="caborSubmenu">
          @endif
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-baseball text-warning text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Cabor</span>

            </a>
            <div class="collapse @if(in_array($page, ['Pengurus Cabor', 'Pelatih Cabor', 'Atlit Cabor', 'Prestasi Cabor'])) show @endif" id="caborSubmenu">
              <ul class="nav ms-4">
                <li class="nav-item">
                  @if($page=='Pengurus Cabor')
                    <a class="nav-link active" href="{{ route('pengurus_cabor.index') }}">
                  @else
                    <a class="nav-link" href="{{ route('pengurus_cabor.index') }}">
                  @endif
                    <span class="nav-link-text">Pengurus Cabor</span>
                  </a>
                </li>
                <li class="nav-item">
                  @if($page=='Pelatih Cabor')
                    <a class="nav-link active" href="{{ route('pelatih_cabor.index') }}">
                  @else
                    <a class="nav-link" href="{{ route('pelatih_cabor.index') }}">
                  @endif
                    <span class="nav-link-text">Pelatih Cabor</span>
                  </a>
                </li>
                <li class="nav-item">
                  @if($page=='Atlit Cabor')
                    <a class="nav-link active" href="{{ route('atlit_cabor.index') }}">
                  @else
                    <a class="nav-link" href="{{ route('atlit_cabor.index') }}">
                  @endif
                    <span class="nav-link-text">Atlit Cabor</span>
                  </a>
                </li>
                <li class="nav-item">
                  @if($page=='Prestasi Cabor')
                    <a class="nav-link active" href="{{ route('prestasi_cabor.index') }}">
                  @else
                    <a class="nav-link" href="{{ route('prestasi_cabor.index') }}">
                  @endif
                    <span class="nav-link-text">Prestasi Cabor</span>
                  </a>
                </li>
                {{-- @if(Auth::user()->role=="cabor")
                <li class="nav-item">
                  @if($page=='Perencanaan')
                    <a class="nav-link active" href="{{ route('perencanaan.index') }}">
                  @else
                    <a class="nav-link" href="{{ route('perencanaan.index') }}">
                  @endif
                    <span class="nav-link-text">Perencanaan</span>
                  </a>
                </li>
                @endif --}}
              </ul>
            </div>
        </li>

        <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#keuanganSubmenu" role="button" aria-expanded="false" aria-controls="keuanganSubmenu">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-money-bill-transfer text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Keuangan</span>
        </a>
        <div class="collapse" id="keuanganSubmenu">
            <ul class="nav ms-4">
            <li class="nav-item">
                @if(Auth::user()->role=="cabor")
                    @if($page=='Perencanaan')
                    <a class="nav-link active" href="{{ route('perencanaan.index') }}">
                    @else
                    <a class="nav-link" href="{{ route('perencanaan.index') }}">
                    @endif
                    <span class="nav-link-text ms-1">Perencanaan</span>
                    </a>
                    @if($page=='Belanja Barang Jasa')
                    <a class="nav-link active" href="{{ route('belanja.index') }}">
                    @else
                    <a class="nav-link" href="{{ route('belanja.index') }}">
                    @endif
                    <span class="nav-link-text ms-1">Belanja</span>
                    </a>
                 @endif
                  @if(Auth::user()->role=="admin")
                    @if($page=='Verifikasi Perencanaan')
                    <a class="nav-link active" href="{{ route('perencanaan.verifikasi') }}">
                    @else
                    <a class="nav-link" href="{{ route('perencanaan.verifikasi') }}">
                    @endif
                    <span class="nav-link-text ms-1">Verifikasi Perencanaan</span>
                    </a>
                 @endif
            </li>
            </ul>
        </div>
        </li>

        @if(Auth::user()->role=="admin")
        <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#informasiSubmenu" role="button" aria-expanded="false" aria-controls="informasiSubmenu">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-file text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Informasi</span>
        </a>
        <div class="collapse" id="informasiSubmenu">
            <ul class="nav ms-4">
            <li class="nav-item">
                @if($page=='Informasi')
                <a class="nav-link active" href="{{ route('informasi.index') }}">
                @else
                <a class="nav-link" href="{{ route('informasi.index') }}">
                @endif
                <span class="nav-link-text ms-1">Berita/Pengumuman</span>
                </a>
            </li>
            </ul>
        </div>
        </li>
        @endif

        @if(Auth::user()->role=="admin")
        <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#managementSubmenu" role="button" aria-expanded="false" aria-controls="managementSubmenu">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-settings text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Management</span>
        </a>
        <div class="collapse" id="managementSubmenu">
            <ul class="nav ms-4">
            <li class="nav-item">
                @if($page=='Users Management')
                <a class="nav-link active" href="{{ route('users.index') }}">
                @else
                <a class="nav-link" href="{{ route('users.index') }}">
                @endif
                <span class="nav-link-text ms-1">Users</span>
                </a>
            </li>
            <li class="nav-item">
                @if($page=='Limit Nominal Management')
                <a class="nav-link active" href="{{ route('limit_nominal.index') }}">
                @else
                <a class="nav-link" href="{{ route('limit_nominal.index') }}">
                @endif
                <span class="nav-link-text ms-1">Limit Nominal</span>
                </a>
            </li>
            </ul>
        </div>
        </li>
        @endif
        <hr style="border-top: 1px solid grey;">
        <li class="nav-item">
         <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-door-open text-danger text-md opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1"> Log Out</span></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
            </form>
          </a>
        </li>
      </ul>
    </div>

  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">{{ $page }}</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">{{ $page }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
            <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <span class="d-sm-inline d-none" style='color:#ffff'><i class="fa fa-user me-sm-1"></i> {{ Auth::user()->username }}</span>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex">
                <span class="d-sm-inline d-none" style='color:#ffff'>/</span>
            </li>
            <li class="nav-item d-flex align-items-center">
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <span class="d-sm-inline d-none" style='color:#ffff'><i class="fa-solid fa-door-open"></i> Log Out</span></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
                </form>
              {{-- <a href="javascript:;" class="nav-link text-white p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a> --}}
            </li>
          </ul>
            </div>
          </div>

        </div>
      </div>
    </nav>
    <!-- End Navbar -->
@yield('content')
