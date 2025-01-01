@extends('layouts.back.header')
@section('title') @endsection
@section('content')
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Edit Pengurus Cabor {{ $nama_cabor }}</h6>
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

            <form enctype="multipart/form-data" method="POST" action="{{ route('pengurus_cabor.update',[$data->id]) }}" class="style-form">
                @csrf
                <input type="hidden" value="PUT" name="_method">
                <input type="hidden" class="form-control" id="id_cabor" name="id_cabor" value={{ $id_cabor->id }}>
                 <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" value={{ $data->nik }} >
                </div>
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value={{ $data->nama_lengkap }} >
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" class="form-control select border rounded w-15">
                        @if($data->jenis_kelamin=='L')
                        <option value="{{ $data->jenis_kelamin }}">Laki-laki</option>
                        @else
                        <option value="{{ $data->jenis_kelamin }}">Perempuan</option>
                        @endif
                        <hr>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kota_lahir">Kota Kelahiran</label>
                    <input type="text" class="form-control" id="kota_lahir" name="kota_lahir" value={{ $data->kota_lahir }} >
                </div>
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Kelahiran</label>
                    <input type="text" class="form-control border rounded w-10" id="tanggal_lahir" name="tanggal_lahir" autocomplete="off" value={{ $data->tanggal_lahir }}>
                </div>
                <div class="form-group">
                    <label for="npwp">NPWP</label>
                    <input type="text" class="form-control" id="npwp" name="npwp" value={{ $data->npwp }} >
                </div>
                <div class="form-group">
                    <label for="image">Foto</label><br>
                    @if ($data->foto)
                        <img src="{{ asset('uploads').'/'.$data->foto}}" class="img-thumbnail" style="width:80px">
                    @endif
                    <input type="file" class="form-control-file" id="foto" name="foto" value="{{ $data->foto }}">
                </div>

                <div class="form-group">
                    <label for="level">Jabatan</label>
                    <select id="level" name="level" class="form-control select border rounded w-15" required>
                        <option value="{{ $data->level }}">{{ $data->level }}</option>
                        <hr>
                        <option value="KETUA">KETUA</option>
                        <option value="WAKIL KETUA">WAKIL KETUA</option>
                        <option value="SEKRETARIS">SEKRETARIS</option>
                        <option value="BENDAHARA">BENDAHARA</option>
                        <option value="ANGGOTA">ANGGOTA</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('pengurus_cabor.index') }}" class="btn btn-danger btn-fill pull-left">Kembali</a>
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
