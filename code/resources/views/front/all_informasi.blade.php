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
                <li class="breadcrumb-item"><a href="#">Informasi</a></li>
                @if($page == 'Semua Berita')
                    <li class="breadcrumb-item active" aria-current="page">Berita</li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">Pengumuman</li>
                @endif
            </ol>
        </nav>
        <!-- Other Articles -->
        <div class="heading_style2">
          @if($page=='Semua Berita')
            <h1>Semua Berita</h1>
          @else
          <h1>Semua Pengumuman</h1>
          @endif
        </div>
        <br>
        <div class="row">
          @foreach($informasi as $inf)
          <div class="col-md-6">
            <div class="card mb-4">
              <img class="card-img-top" src="{{ asset('uploads/'.$inf->image) }}" loading="lazy" style="height:300px" alt="Article Image">
              <div class="card-body">
                {{-- <h5 class="card-title">{{ Str::limit($inf->judul,60) }}</h5> --}}
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
                @if($inf->kategori=='Berita')
                <a href="{{ route('berita.show',[$inf->slug_judul]) }}" class="btn btn-primary">Selengkapnya</a>
                @else
                <a href="{{ route('pengumuman.show',[$inf->slug_judul]) }}" class="btn btn-primary">Selengkapnya</a>
                @endif
              </div>
            </div>
          </div>
          @endforeach
        </div>


        <!-- Pagination -->
        <nav aria-label="Page navigation">
          <div class="form no-margin">
                {{$informasi->appends(Request::all())->links("pagination::bootstrap-4")}}
            </div>
        </nav>
        <div class="section-heading">
        <span class="section-title">
            <b>Sosial Media <i class="fab fa-instagram"></i></b>
        </span>
        </div>
        <div id="instagram-widget" class="instagram-widget"></div>
        <div class="pagination-ig">
        <button id="prev-page" class="pagination-btn">Previous<span class="loading-spinner"></span></button>
        <button id="next-page" class="pagination-btn">Next<span class="loading-spinner"></span></button>
        </div><br>
        <script src={{ asset('js/igwidget.js') }}></script>

        {{-- <!-- Place <div> tag where you want the feed to appear -->
        <div id="curator-feed-default-feed-layout"><a href="https://curator.io" target="_blank" class="crt-logo crt-tag">Powered by Curator.io</a></div>

        <!-- The Javascript can be moved to the end of the html page before the </body> tag -->
        <script type="text/javascript">
        /* curator-feed-default-feed-layout */
        (function(){
        var i,e,d=document,s="script";i=d.createElement("script");i.async=1;i.charset="UTF-8";
        i.src="https://cdn.curator.io/published/9109a210-a33a-45e5-979b-61c3dca2f14a.js";
        e=d.getElementsByTagName(s)[0];e.parentNode.insertBefore(i, e);
        })();
        </script> --}}

      </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
  const embedInstagramFeed = document.querySelector('embed-instagram-feed');

  if (embedInstagramFeed && embedInstagramFeed.shadowRoot) {
    const titleElement = embedInstagramFeed.shadowRoot.querySelector('div.nc-title');
    if (titleElement) {
      titleElement.remove();
    }
    const subtitleElement = embedInstagramFeed.shadowRoot.querySelector('p.nc-subtitle');
    if (subtitleElement){
        subtitleElement.remove();
    }
  }
});
    </script>
  @include('layouts.front.sidebar')
  @include('layouts.front.footer')
@endsection

