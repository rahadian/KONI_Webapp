@extends('layouts.front.header')
@section('title') @endsection
@section('content')
<style>
#fullpage {
  display: none;
  position: absolute;
  z-index: 9999;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background-size: contain;
  background-repeat: no-repeat no-repeat;
  background-position: center center;
  background-color: black;
}
</style>
<!-- Main Content -->
  <div class="container my-5">
    <div class="row">
      <div class="col-md-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="#">Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dasar Hukum Pembentukan</li>
            </ol>
        </nav>
      <div class="heading_style3">
      <h1>Dasar Hukum Pembentukan</h1>
      </div>
      <br>
        <ul>
        <li><p>Peraturan Bupati No 73 Thn 2018 tentang Kedudukan, Susunan Organisasi, Tugas dan Fungsi Serta Tata Kerja Dinas Pemberdayaan Masyarakat Dan Desa Kabupaten Probolinggo</p></li>
        <li><p>Peraturan Bupati No 14 Tahun 2022 tentang Kedudukan, Susunan Organisasi, Tugas Dan Fungsi Serta Tata Kerja Perangkat Daerah</p></li>
        </ul>
      </div>

  @include('layouts.front.sidebar')
  @include('layouts.front.footer')
@endsection


