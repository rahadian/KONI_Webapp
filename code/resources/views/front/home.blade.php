@extends('layouts.front.header')
@section('title') @endsection
@section('content')

<!-- Main Content -->
<div class="container my-5">
    <div class="row">
        <div class="col-md-8">


            <!-- Latest News Section -->
            <div class="heading_style2">
                <h2>
                    Berita Terbaru
                </h2>
            </div>
            <div class="row">
                @foreach($informasi as $inf)
                @if($inf->kategori == 'Berita')
                <div class="col-md-6">
                    <div class="card mb-4">
                        <img class="card-img-top" src="{{ asset('uploads/'.$inf->image) }}" loading="lazy" alt="Article Image" style="height:300px">
                        <div class="card-body">
                            <h5 class="card-title">{{ Str::limit($inf->judul,35) }}</h5>
                            <div class="mb-3">
                                @if($inf->tanggal)
                                <span class="text-muted">Dipost: {{ $inf->tanggal }}</span>
                                @else
                                <span class="text-muted">Dipost: {{ $inf->created_at->format('Y-m-d') }}</span>
                                @endif
                                <span class="ml-3 badge badge-sm">{{ $inf->kategori }}</span>
                            </div>
                            <p class="card-text">{!! Str::limit(strip_tags($inf->content), 55, ' ...') !!}</p>
                            <a href="{{ route('berita.show',[$inf->slug_judul]) }}" class="btn btn-primary">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            <hr>
            <!-- Latest Announcements Section -->
            {{-- <div class="heading_style2">
                <h2>
                    Pengumuman Terbaru
                </h2>
            </div>
            <div class="row">
                @foreach($informasi as $inf)
                @if($inf->kategori == 'Pengumuman')
                <div class="col-md-6">
                    <div class="card mb-4">
                        <img class="card-img-top" src="{{ asset('uploads/'.$inf->image) }}" loading="lazy" alt="Article Image" style="height:300px">
                        <div class="card-body">
                            <h5 class="card-title">{{ Str::limit($inf->judul,35) }}</h5>
                            <div class="mb-3">
                                @if($inf->tanggal)
                                <span class="text-muted">Dipost: {{ $inf->tanggal }}</span>
                                @else
                                <span class="text-muted">Dipost: {{ $inf->created_at->format('Y-m-d') }}</span>
                                @endif
                                <span class="ml-3 badge badge-sm">{{ $inf->kategori }}</span>
                            </div>
                            <p class="card-text">{!! Str::limit(strip_tags($inf->content), 55, ' ...') !!}</p>
                            <a href="{{ route('pengumuman.show',[$inf->slug_judul]) }}" class="btn btn-primary">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div> --}}

            <!-- Pagination -->
            <nav aria-label="Page navigation">
                <div class="form no-margin">
                    {{$informasi->appends(Request::all())->links("pagination::bootstrap-4")}}
                </div>
            </nav>
        </div>

        @include('layouts.front.sidebar')
    </div>
</div>

@include('layouts.front.footer')
@endsection
