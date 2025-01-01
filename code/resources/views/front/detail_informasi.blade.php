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
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Informasi</a></li>
                @if($data->kategori=='Berita')
                <li class="breadcrumb-item"><a href="{{ route('berita.show_all') }}">{{ $data->kategori }}</a></li>
                @elseif($data->kategori=='Pengumuman')
                <li class="breadcrumb-item"><a href="{{ route('pengumuman.show_all') }}">{{ $data->kategori }}</a></li>
                @else
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $data->kategori }}</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($data->judul,30) }}</li>
            </ol>
        </nav>
        <article>
        <h1 class="text-center mb-4">{{ $data->judul }}</h1>
        <div class="text-center mb-3">
            @if($data->tanggal)
            <span class="text-muted">Dipost: {{ $data->tanggal }}</span>
            @else
            <span class="text-muted">Dipost: {{ $data->created_at->format('Y-m-d') }}</span>
            @endif
            <span class="text-muted ml-3">Kategori: {{ $data->kategori}}</span>
        </div>
        <div class="text-center mb-4">
            <img src="{{ asset('uploads/'.$data->image) }}" class="img-fluid" alt="{{ $data->judul }}">
        </div>
        <p>{!! $data->content !!}</p>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            const oembeds = document.querySelectorAll("oembed[url]");
            oembeds.forEach(oembed => {
                const url = oembed.getAttribute("url");
                const iframe = document.createElement("iframe");

                iframe.setAttribute("width", "100%");
                iframe.setAttribute("height", "315");
                iframe.setAttribute("src", url.replace("watch?v=", "embed/"));
                iframe.setAttribute("frameborder", "0");
                iframe.setAttribute("allow", "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture");
                iframe.setAttribute("allowfullscreen", true);

                oembed.parentNode.replaceChild(iframe, oembed);
            });
        });
        </script>
        </article>
        <!-- Other Articles Carousel -->
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="section-heading">
                <span class="section-title">
                    @if($data->kategori=='Berita')
                    <b>Berita Lainnya</b>
                    @elseif($data->kategori=='Pengumuman')
                    <b>Pengumuman Lainnya</b>
                    @else
                    <b>Lainnya</b>
                    @endif
                </span>
                </div>
                <div class="row">
                    @foreach($beritalain as $article)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <img src="{{ asset('uploads/' . $article->image) }}" class="card-img-top" alt="{{ $article->judul }}" style="height: 261px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ Str::limit($article->judul,60) }}</h5>
                                    <div class="mb-3">
                                    @if($data->tanggal)
                                    <span>Dipost: {{ $data->tanggal }}</span>
                                    @else
                                    <span>Dipost: {{ $data->created_at->format('Y-m-d') }}</span>
                                    @endif
                                    </div>
                                    <p class="card-text">{!! Str::limit($article->content, 100) !!}</p>
                                    @if($data->kategori=='Berita')
                                    <a href="{{ route('berita.show',[$article->slug_judul]) }}" class="btn btn-primary">Selengkapnya</a>
                                    @elseif($data->kategori=='Pengumuman')
                                    <a href="{{ route('pengumuman.show',[$article->slug_judul]) }}" class="btn btn-primary">Selengkapnya</a>
                                    @else
                                    <a href="{{ route('pinned.show',[$article->slug_judul]) }}" class="btn btn-primary">Selengkapnya</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
      </div>

@include('layouts.front.sidebar')
@include('layouts.front.footer')
@endsection
