@extends('layouts.front.header')
@section('title') @endsection
@section('content')

<!-- Main Content -->
  <div class="container my-5">
    <div class="row">
      <div class="col-md-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="#">Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">SAKIP</li>
            </ol>
        </nav>
      <div class="heading_style3">
      <h1>SAKIP</h1>
      </div>
        <div class="row">
            <div class="col-md-8">
                <ol>
                    <li style="padding-top:10px">
                    <p>Rencana Aksi Kinerja DPMD Tahun 2023</p>
                    <a href="{{ asset('docs/Rencana Aksi Kinerja DPMD Tahun 2023.pdf') }}" target="_blank" class="btn btn-primary">
                     <i class="fas fa-download"></i> Download
                    </a>
                    </li>
                    <li style="padding-top:10px">
                    <p>Renja DPMD 2023 RANWAL</p>
                    <a href="{{ asset('docs/Renja DPMD 2023 RANWAL.pdf') }}" target="_blank" class="btn btn-primary">
                     <i class="fas fa-download"></i> Download
                    </a>
                    </li>
                    <li style="padding-top:10px">
                    <p>Renja DPMD 2023 PERUBAHAN SEPTEMBER</p>
                    <a href="{{ asset('docs/Renja DPMD 2023 PERUBAHAN SEPTEMBER.pdf') }}" target="_blank" class="btn btn-primary">
                     <i class="fas fa-download"></i> Download
                    </a>
                    </li>
                    <li style="padding-top:10px">
                    <p>Renja DPMD 2024 RANWAL</p>
                    <a href="{{ asset('docs/Renja DPMD 2024 RANWAL.pdf') }}" target="_blank" class="btn btn-primary">
                     <i class="fas fa-download"></i> Download
                    </a>
                    </li>
                    <li style="padding-top:10px">
                    <p>RENSTRA 2018-2023 DPMD</p>
                    <a href="{{ asset('docs/RENSTRA 2018 -2023 DPMD Fix (1).pdf') }}" target="_blank" class="btn btn-primary">
                     <i class="fas fa-download"></i> Download
                    </a>
                    </li>
                    <li style="padding-top:10px">
                    <p>RENSTRA DPMD 2024-2026</p>
                    <a href="{{ asset('docs/RENSTRA  DPMD 2024-2026.pdf') }}" target="_blank" class="btn btn-primary">
                     <i class="fas fa-download"></i> Download
                    </a>
                    </li>
                </ol>
            </div>

        </div>
      </div>

@include('layouts.front.sidebar')
@include('layouts.front.footer')
@endsection

