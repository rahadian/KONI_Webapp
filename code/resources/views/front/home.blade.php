@extends('layouts.front.header')
@section('title') @endsection
@section('content')
<!-- Main Content -->
  <div class="container my-5">
    <div class="row">
      <div class="col-md-8">
        <!-- Featured Article Carousel -->
        <div id="carouselExampleControls" class="carousel slide mb-4" data-ride="carousel">
          <div class="carousel-inner">
            @foreach($pinned as $pin)
            <div class="carousel-item @if($loop->first) active @endif">
                <img class="d-block w-100 pinned-image" src="{{ asset('uploads/'.$pin->image) }}" loading="lazy" alt="{{ $pin->judul }}">
                <div class="carousel-caption">
                <a href="{{ route('pinned.show',[$pin->slug_judul]) }}" style="color:#ffff">
                    <h5>{{ $pin->judul }}</h5>
                    {{-- <p>{!! Str::limit(strip_tags($pin->content), 100, ' ...') !!}</p> --}}
                    {{-- <a href="{{ route('pinned.show',[$pin->slug_judul]) }}" class="btn btn-primary">Selengkapnya</a> --}}
                    <div class="mb-3">
                        @if($pin->tanggal)
                        <span>Dipost: {{ $pin->tanggal }}</span>
                        @else
                        <span>Dipost: {{ $pin->created_at->format('Y-m-d') }}</span>
                        @endif
                    </div>
                </a>
                </div>
            </div>
            @endforeach
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        <!-- Other Articles -->
        <div class="section-heading">
          <span class="section-title">
            <b>Terbaru</b>
          </span>
        </div>
        <div class="row">
          @foreach($informasi as $inf)
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

        <div class="section-heading">
        {{-- <span class="section-title">
            <b>Youtube <i class="fab fa-youtube"></i></b>
        </span> --}}
        </div>
        {{-- <div>
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/videoseries?si=fw4x8fcfDmR9W4rW&amp;list=PL0UnsBaOx6gu53-WGNerzQMVRk69HWTCh" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div> --}}
        <hr>
        <br>

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

