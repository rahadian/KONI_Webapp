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
         <h2>Pejabat Dinas</h2><br>
        <div class="row">
            <div class="col-sm-4" style="margin-bottom:20px">
                <div class="card card_app text-center" style="height: 300px">
                    <div class="card-body" id="one">
                        <img src="https://siap-bkpsdm.probolinggokab.go.id/foto/197605142003121012/foto_full_197605142003121012.jpeg" class="lazy" style="width:30%">
                        <h5 class="card-title mb-3 mt-2">
                            Dr FATHUR ROZI M.Fil.I.
                        </h5>
                        <p class="card-text" style="font-size: 15px;">Kepala Dinas</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" style="margin-bottom:20px">
                <div class="card card_app text-center" style="height: 300px">
                    <div class="card-body" id="two">
                        <img src="https://siap-bkpsdm.probolinggokab.go.id/foto/197303142003122004/foto_setengah_197303142003122004.jpeg" class="lazy" style="width:30%">
                        <h5 class="card-title mb-3 mt-2">
                            ENDANG RUSTININGSIH, SE,MM
                        </h5>
                        <p class="card-text" style="font-size: 15px;">Sekretaris</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" style="margin-bottom:20px">
                <div class="card card_app text-center" style="height: 300px">
                    <div class="card-body" id="three">
                        <img src="https://siap-bkpsdm.probolinggokab.go.id/foto/196703031992031019/foto_setengah_196703031992031019.jpeg" class="lazy" style="width:30%">
                        <h5 class="card-title mb-3 mt-2">
                            SETIADI AGUS PRAKOSO, SH, M.Hum
                        </h5>
                        <p class="card-text" style="font-size: 15px;">Kepala Bidang Penataan dan Kerjasama Desa</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" style="margin-bottom:20px">
                <div class="card card_app text-center" style="height: 300px">
                    <div class="card-body" id="four">
                        <img src="https://siap-bkpsdm.probolinggokab.go.id/foto/197808262002121004/foto_setengah_197808262002121004.jpeg" class="lazy" style="width:30%">
                        <h5 class="card-title mb-3 mt-2">
                            OFIE AGUSTIN, S.T., M.Si.
                        </h5>
                        <p class="card-text" style="font-size: 15px;">Kepala Bidang Bina Pemerintahan Desa</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" style="margin-bottom:20px">
                <div class="card card_app text-center" style="height: 300px">
                    <div class="card-body" id="five">
                        <img src="https://siap-bkpsdm.probolinggokab.go.id/foto/197604132010011011/foto_setengah_197604132010011011.jpeg" class="lazy" style="width:30%">
                        <h5 class="card-title mb-3 mt-2">
                            FARHAN HIDAYAT, S.T
                        </h5>
                        <p class="card-text" style="font-size: 15px;">Kepala Bidang Pemberdayaan Kemasyarakatan dan Potensi Lembaga Desa</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" style="margin-bottom:20px">
                <div class="card card_app text-center" style="height: 300px">
                    <div class="card-body" id="six">
                        <img src="https://siap-bkpsdm.probolinggokab.go.id/foto/196611021989032003/foto_setengah_196611021989032003.jpeg" class="lazy" style="width:30%">
                        <h5 class="card-title mb-3 mt-2">
                            ENY QURAIZIN, S.Sos
                        </h5>
                        <p class="card-text" style="font-size: 15px;">Kepala Sub Bagian Perencanaan dan Keuangan</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" style="margin-bottom:20px">
                <div class="card card_app text-center" style="height: 300px">
                    <div class="card-body" id="seven">
                        <img src="https://siap-bkpsdm.probolinggokab.go.id/foto/198006082009032003/foto_setengah_198006082009032003.jpeg" class="lazy" style="width:30%">
                        <h5 class="card-title mb-3 mt-2">
                            NURUL MUSARIFAH, SE. MM
                        </h5>
                        <p class="card-text" style="font-size: 15px;">Kepala Sub Bagian Umum dan Kepegawaian</p>
                    </div>
                </div>
            </div>
        </div>
      </div>

<!--modal-->
<!-- Modal -->
    <div class="modal fade" id="infoModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row">Nama</th>
                                <td>Dr FATHUR ROZI M.Fil.I.</td>
                            </tr>
                            <tr>
                                <th scope="row">NIP</th>
                                <td>197605142003121012</td>
                            </tr>
                            <tr>
                                <th scope="row">Pangkat Terakhir</th>
                                <td>IV/b - Pembina Tk. I</td>
                            </tr>
                            <tr>
                                <th scope="row">Histori Jabatan</th>
                                <td>
                                    <ul>
                                    <li>Kepala Dinas Pemberdayaan Masyarakat dan Desa Kabupaten Probolinggo</li>
                                    <li>Kepala Dinas Pendidikan dan Kebudayaan Kabupaten Probolinggo</li>
                                    <li>Sekretaris Dinas Pendidikan dan Kebudayaan Kabupaten Probolinggo</li>
                                    <li>Kepala Bidang Pembinaan Sekolah Dasar (SD) Dinas Pendidikan dan Kebudayaan Kabupaten Probolinggo</li>
                                    <li>Kepala Bidang Pendidikan Menengah Dinas Pendidikan dan Kebudayaan Kabupaten Probolinggo</li>
                                    <li>Kepala Bidang Perdagangan pada Dinas Perindustrian dan Perdagangan Kabupaten Probolinggo</li>
                                    <li>KASUBBAG. Pembinaan Mental dan Keagamaan pada Bagian Kesejahteraan Rakyat SETDA Kabupaten Probolinggo</li>
                                    <li>PJ. KASUBBAG. Kesejahteraan Sosial pada Bagian Kesejahteraan Rakyat SETDA. Kabupaten Probolinggo</li>
                                    </ul>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="infoModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row">Nama</th>
                                <td>ENDANG RUSTININGSIH, SE,MM</td>
                            </tr>
                            <tr>
                                <th scope="row">NIP</th>
                                <td>197303142003122004</td>
                            </tr>
                            <tr>
                                <th scope="row">Pangkat Terakhir</th>
                                <td>IV/b - Pembina Tk. I</td>
                            </tr>
                            <tr>
                                <th scope="row">Histori Jabatan</th>
                                <td>
                                    <ul>
                                    <li>Sekretaris Dinas Pemberdayaan Masyarakat dan Desa Kabupaten Probolinggo</li>
                                    <li>Kepala Bidang Perdagangan Dinas Koperasi, Usaha Mikro, Perdagangan dan Perindustrian Kabupaten Probolinggo</li>
                                    <li>Kepala Sub Bagian Umum dan Kepegawaian BKPSDM Kabupaten Probolinggo</li>
                                    <li>Staff BKPSDM Kabupaten Probolinggo</li>
                                    </ul>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="infoModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row">Nama</th>
                                <td>SETIADI AGUS PRAKOSO, SH, M.Hum</td>
                            </tr>
                            <tr>
                                <th scope="row">NIP</th>
                                <td>196703031992031019</td>
                            </tr>
                            <tr>
                                <th scope="row">Pangkat Terakhir</th>
                                <td>IV/a - Pembina</td>
                            </tr>
                            <tr>
                                <th scope="row">Histori Jabatan</th>
                                <td>
                                    <ul>
                                    <li>Kepala Bidang Penataan dan Kerjasama Desa Dinas Pemberdayaan Masyarakat dan Desa Kabupaten Probolinggo</li>
                                    <li>Kepala Bidang Pemberdayaan Kelembagaan Masyarakat Dinas Pemberdayaan Masyarakat dan Desa Kabupaten Probolinggo</li>
                                    <li>Kepala Bidang Kelembagaan Koperasi dan Sumberdaya Manusia Dinas Koperasi, Usaha Mikro, Perdagangan dan Perindustrian Kabupaten Probolinggo</li>
                                    <li>Kepala Bidang Permodalan dan Pengendalian Dinas Koperasi, Usaha Mikro, Perdagangan dan Perindustrian Kabupaten Probolinggo</li>
                                    <li>Kasi Hukum, Peraturan Perundang-undangan dan Pengendalian Dinas Koperasi, Usaha Mikro, Perdagangan dan Perindustrian Kabupaten Probolinggo</li>
                                    </ul>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="infoModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row">Nama</th>
                                <td>OFIE AGUSTIN, S.T., M.Si.</td>
                            </tr>
                            <tr>
                                <th scope="row">NIP</th>
                                <td>197808262002121004</td>
                            </tr>
                            <tr>
                                <th scope="row">Pangkat Terakhir</th>
                                <td>IV/a - Pembina</td>
                            </tr>
                            <tr>
                                <th scope="row">Histori Jabatan</th>
                                <td>
                                    <ul>
                                    <li>Kepala Bidang Bina Pemerintahan Desa Dinas Pemberdayaan Masyarakat dan Desa Kabupaten Probolinggo</li>
                                    <li>Kepala Bidang Pendapatan Badan Pengelolaan Pendapatan, Keuangan dan Aset Daerah Kabupaten Probolinggo</li>
                                    <li>Kepala Bidang Perlindungan dan Jaminan Sosial Dinas Sosial Kabupaten Probolinggo</li>
                                    <li>Kepala Bidang Informasi dan Komunikasi Publik  Dinas Komunikasi, Informatika, Statistik dan Persandian Kabupaten Probolinggo</li>
                                    <li>Kepala Seksi Pengelolaan Komunikasi Publik  Dinas Komunikasi, Informatika, Statistik dan Persandian Kabupaten Probolinggo</li>
                                    <li>Kasi. Pengembangan Aplikasi pada Bidang Aplikasi dan Infrastruktur TIK Dinas Komunikasi, Informatika, Statistik dan Persandian Kabupaten Probolinggo</li>
                                    <li>Kasi. Pembangunan pada Kecamatan Kuripan Kabupaten Probolinggo</li>
                                    </ul>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="infoModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row">Nama</th>
                                <td>FARHAN HIDAYAT, S.T</td>
                            </tr>
                            <tr>
                                <th scope="row">NIP</th>
                                <td>197604132010011011</td>
                            </tr>
                            <tr>
                                <th scope="row">Pangkat Terakhir</th>
                                <td>III/d - Penata Tk. I</td>
                            </tr>
                            <tr>
                                <th scope="row">Histori Jabatan</th>
                                <td>
                                    <ul>
                                    <li>Kepala Bidang Pemberdayaan Kemasyarakatan dan Potensi Lembaga Desa Dinas Pemberdayaan Masyarakat dan Desa Kabupaten Probolinggo</li>
                                    <li>JF Penggerak Swadaya Masyarakat Muda Dinas Pemberdayaan Masyarakat dan Desa Kabupaten Probolinggo</li>
                                    <li>Penggerak Swadaya Masyarakat Ahli Muda Dinas Pemberdayaan Masyarakat dan Desa Kabupaten Probolinggo</li>
                                    <li>Kepala Seksi Perencanaan dan Evaluasi Desa Dinas Pemberdayaan Masyarakat dan Desa Kabupaten Probolinggo</li>
                                    <li>Staff Dinas Pemberdayaan Masyarakat dan Desa Kabupaten Probolinggo</li>
                                    </ul>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="infoModal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row">Nama</th>
                                <td>ENY QURAIZIN, S.Sos</td>
                            </tr>
                            <tr>
                                <th scope="row">NIP</th>
                                <td>196611021989032003</td>
                            </tr>
                            <tr>
                                <th scope="row">Pangkat Terakhir</th>
                                <td>III/d - Penata Tk. I</td>
                            </tr>
                            <tr>
                                <th scope="row">Histori Jabatan</th>
                                <td>
                                    <ul>
                                    <li>Kepala Sub Bagian Perencanaan dan Keuangan Dinas Pemberdayaan Masyarakat dan Desa Kabupaten Probolinggo</li>
                                    <li>Kasubbag. Perencanaan dan Keuangan pada Sekretariat Dinas Pemberdayaan Masyarakat dan Desa Kabupaten Probolinggo</li>
                                    <li>Kepala Seksi Perekonomian Kecamatan Besuk Kabupaten Probolinggo</li>
                                    <li>Kasubbag. Keuangan Kecamatan Kraksaan Dinas Pemberdayaan Masyarakat dan Desa Kabupaten Probolinggo</li>
                                    </ul>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="infoModal7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row">Nama</th>
                                <td>NURUL MUSARIFAH, SE. MM</td>
                            </tr>
                            <tr>
                                <th scope="row">NIP</th>
                                <td>198006082009032003</td>
                            </tr>
                            <tr>
                                <th scope="row">Pangkat Terakhir</th>
                                <td>III/d - Penata Tk. I</td>
                            </tr>
                            <tr>
                                <th scope="row">Histori Jabatan</th>
                                <td>
                                    <ul>
                                    <li>Kepala Sub Bagian Umum dan Kepegawaian Dinas Pemberdayaan Masyarakat dan Desa Kabupaten Probolinggo</li>
                                    <li>JF Perencana Muda BAPELITBANGDA Kabupaten Probolinggo</li>
                                    <li>Perencana Ahli Muda BAPELITBANGDA Kabupaten Probolinggo</li>
                                    <li>Sekretaris Kelurahan Sidomukti Kecamatan Kraksaan Kabupaten Probolinggo</li>
                                    <li>Staf pada Dinas P.U. Pengairan Kabupaten Probolinggo</li>
                                    </ul>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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


