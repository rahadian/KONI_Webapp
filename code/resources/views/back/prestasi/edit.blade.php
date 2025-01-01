@extends('layouts.back.header')
@section('title') @endsection
@section('content')
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Edit Prestasi Cabor {{ $nama_cabor }}</h6>
              @if (session('status'))
                <div class="alert alert-success">
                    <b><font size="4">{{session('status')}}</font></b>
                </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <strong><font size="4">{{ $message }}</font></strong>
                    </div>
                @endif
            </div>

            <div class="card-body pb-0">

            <form enctype="multipart/form-data" method="POST" action="{{ route('prestasi_cabor.update',[$data->id]) }}" class="style-form">
                @csrf
                <input type="hidden" value="PUT" name="_method">
                <input type="hidden" class="form-control" id="id_cabor" name="id_cabor" value={{ $id_cabor->id }}>
                 <div class="form-group">
                    <label for="nama_kejuaraan">Nama Kejuaraan</label>
                    <input type="text" class="form-control" id="nama_kejuaraan" name="nama_kejuaraan" value={{ $data->nama_kejuaraan }} >
                </div>
                <div class="form-group">
                    <label for="tingkat_kejuaraan">Tingkatan Kejuaraan</label>
                    <input type="text" class="form-control" id="tingkat_kejuaraan" name="tingkat_kejuaraan" value={{ $data->tingkat_kejuaraan }} >
                </div>
                <div class="form-group">
                    <label for="waktu_kegiatan">Waktu Kegiatan</label>
                    <input type="text" class="form-control border rounded w-10" id="waktu_kegiatan" name="waktu_kegiatan" autocomplete="off" value={{ $data->waktu_kegiatan }}>
                </div>
                <div class="form-group">
                    <label for="perolehan_medali">Perolehan Medali</label>
                    <input type="text" class="form-control" id="perolehan_medali" name="perolehan_medali" value={{ $data->perolehan_medali }} >
                </div>

                <div class="form-group">
                    <label for="foto_kegiatan">Foto Kegiatan</label><br>
                    @if ($data->foto_kegiatan)
                        <img src="{{ asset('uploads').'/'.$data->foto_kegiatan}}" class="img-thumbnail" style="width:80px">
                    @endif
                    <input type="file" class="form-control-file" id="foto_kegiatan" name="foto_kegiatan" value="{{ $data->foto_kegiatan }}">
                </div>

                <div class="form-group">
                    <label for="scan_piagam">Scan Piagam</label><br>
                    @if ($data->scan_piagam)
                        <img src="{{ asset('uploads').'/'.$data->scan_piagam}}" class="img-thumbnail" style="width:80px">
                    @endif
                    <input type="file" class="form-control-file" id="scan_piagam" name="scan_piagam" value="{{ $data->scan_piagam }}">
                </div>

                <div class="form-group">
                    <label for="scan_hasil_pertandingan">Scan Hasil Pertandingan</label><br>
                    @if ($data->scan_hasil_pertandingan)
                        <img src="{{ asset('uploads').'/'.$data->scan_hasil_pertandingan}}" class="img-thumbnail" style="width:80px">
                    @endif
                    <input type="file" class="form-control-file" id="scan_hasil_pertandingan" name="scan_hasil_pertandingan" value="{{ $data->scan_hasil_pertandingan }}">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('prestasi_cabor.index') }}" class="btn btn-danger btn-fill pull-left">Kembali</a>
            </form>
            </div>
          </div>
        </div>
      </div>

@include('layouts.back.footer')
<script>
    document.getElementById('role').addEventListener('change', function () {
        const caborContainer = document.getElementById('cabor-container');
        if (this.value === 'cabor') {
            caborContainer.style.display = 'block'; // Show the "Cabor" dropdown
        } else {
            caborContainer.style.display = 'none'; // Hide the "Cabor" dropdown
        }
    });
</script>
@endsection
