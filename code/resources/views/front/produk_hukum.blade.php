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
                <li class="breadcrumb-item active" aria-current="page">Produk Hukum</li>
            </ol>
        </nav>
      <div class="heading_style">
      <h1>Produk Hukum</h1>
      </div>
      <hr>
        <div class="row">
            <div class="col-md-12">
                <div id="accordion">
                @if($kategori)
                    @foreach($kategori as $kt)
                    @php
                        $filteredData = $data->where('kategori', $kt->id);
                        $tot_data = $filteredData->count();

                    @endphp
                        <div class="card p-1" style="border-radius: 0rem">
                            <div class="card-header p-3" id="heading11">
                            <h6 class="m-0 font-14">
                                <a href="#collapse{{ $kt->id }}" class="text-dark" data-toggle="collapse" aria-expanded="true" aria-controls="collapse{{ $kt->id }}">
                                    <i class="fa fa-balance-scale"></i> {{ $kt->nama }} <span class="badge badge-sm">{{ $tot_data }}</span></a>
                            </h6>
                            </div>
                            <div id="collapse{{ $kt->id }}" class="collapse showx" aria-labelledby="heading{{ $kt->id }}" data-parent="#accordion">
                                <div class="card-body" style='background-color:#f4f4f4; border-color:#e3e3e3;'>
                                        <ul style="list-style:none;">
                                        @foreach($filteredData as $dt)
                                            <li>
                                                <a href="{{ asset('uploads/'.$dt->file) }}" title="Download file" target="_blank"><i class="fas fa-file-alt text-primary pointer font-16"></i> {{ $dt->judul }}</a>
                                            </li>
                                        @endforeach
                                        </ul>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                @endif
                </div>
            </div>

        </div>
      </div>

@include('layouts.front.sidebar')
@include('layouts.front.footer')
@endsection

