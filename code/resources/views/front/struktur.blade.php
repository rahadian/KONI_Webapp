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

.card_app {
  transition: all 0.3s ease; /* Add transition for smooth animation */
}

.card_app:hover {
  transform: scale(1.05); /* Increase the scale on hover */
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Add a box-shadow on hover */
  cursor: pointer;
}
.card-body img {
      width: 100px; /* Set a fixed width for uniform size */
      height: 100px; /* Set a fixed height for uniform size */
      border-radius: 50%; /* Make the image rounded */
      object-fit: cover; /* Ensure the image covers the element */
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
        <div>
            <img data-enlargeable width="100" style="cursor: zoom-in" id="struktur_organisasi" src="{{ asset('img/struktur.jpeg') }}">

        </div>
         <h2>Pengurus KONI Kabupaten Probolinggo</h2><br>
        <div class="row">
            <div class="col-sm-4" style="margin-bottom:20px">
                <div class="card card_app text-center" style="height: 300px">
                    <div class="card-body" id="one">
                        <img src="" class="lazy" style="width:30%">
                        <h5 class="card-title mb-3 mt-2">
                            Nama Ketua
                        </h5>
                        <p class="card-text" style="font-size: 15px;">Ketua</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" style="margin-bottom:20px">
                <div class="card card_app text-center" style="height: 300px">
                    <div class="card-body" id="two">
                        <img src="" class="lazy" style="width:30%">
                        <h5 class="card-title mb-3 mt-2">
                            Nama Wakil Ketua
                        </h5>
                        <p class="card-text" style="font-size: 15px;">Wakil Ketua</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" style="margin-bottom:20px">
                <div class="card card_app text-center" style="height: 300px">
                    <div class="card-body" id="three">
                        <img src="" class="lazy" style="width:30%">
                        <h5 class="card-title mb-3 mt-2">
                            Nama Sekretaris
                        </h5>
                        <p class="card-text" style="font-size: 15px;">Sekretaris</p>
                    </div>
                </div>
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
<script>
    document.getElementById('one').addEventListener('click', function() {
        $('#infoModal1').modal('show');
    });
    document.getElementById('two').addEventListener('click', function() {
        $('#infoModal2').modal('show');
    });
    document.getElementById('three').addEventListener('click', function() {
        $('#infoModal3').modal('show');
    });
    document.getElementById('four').addEventListener('click', function() {
        $('#infoModal4').modal('show');
    });
    document.getElementById('five').addEventListener('click', function() {
        $('#infoModal5').modal('show');
    });
    document.getElementById('six').addEventListener('click', function() {
        $('#infoModal6').modal('show');
    });
    document.getElementById('seven').addEventListener('click', function() {
        $('#infoModal7').modal('show');
    });
</script>
  @include('layouts.front.sidebar')
  @include('layouts.front.footer')
@endsection


