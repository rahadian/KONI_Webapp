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
                <li class="breadcrumb-item active" aria-current="page">Struktur Organisasi</li>
            </ol>
        </nav>
      <div class="heading_style3">
      <h1>Struktur Organisasi</h1>
      </div>
      <br>
        <div class="row">
            <div class="col-md-4">
                <img data-enlargeable width="100" style="cursor: zoom-in" id="struktur_organisasi" src="{{ asset('img/struktur.jpeg') }}">
                {{-- <img data-enlargeable width="100" style="cursor: zoom-in" src="https://upload.wikimedia.org/wikipedia/commons/3/39/Lichtenstein_img_processing_test.png" /> --}}
            </div>
        </div>
      </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
$('img[data-enlargeable]').addClass('img-enlargeable').click(function() {
  var src = $(this).attr('src');
  var modal;

  function removeModal() {
    modal.remove();
    $('body').off('keyup.modal-close');
  }
  modal = $('<div>').css({
    background: 'RGBA(0,0,0,.5) url(' + src + ') no-repeat center',
    backgroundSize: 'contain',
    width: '100%',
    height: '100%',
    position: 'fixed',
    zIndex: '10000',
    top: '0',
    left: '0',
    cursor: 'zoom-out'
  }).click(function() {
    removeModal();
  }).appendTo('body');
  //handling ESC
  $('body').on('keyup.modal-close', function(e) {
    if (e.key === 'Escape') {
      removeModal();
    }
  });
});
</script>
  @include('layouts.front.sidebar')
  @include('layouts.front.footer')
@endsection


