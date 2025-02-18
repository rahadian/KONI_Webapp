@extends('layouts.back.header')
@section('title') @endsection
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Tambah Atlit Cabor {{ $nama_cabor }}</h6>
                    @if (session('status'))
                        <div class="alert alert-success"><b><font size="4">{{session('status')}}</font></b></div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <strong><font size="4">{{ $message }}</font></strong>
                        </div>
                    @endif
                </div>

                <div class="card-body pb-0">
                    <form enctype="multipart/form-data" method="POST" action="{{ route('atlit_cabor.store') }}" class="style-form">
                        @csrf
                        <input type="hidden" class="form-control" id="id_cabor" name="id_cabor" value={{ $id_cabor->id }} required>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="jenis">Jenis Atlet</label>
                                    <select id="jenis" name="jenis" class="form-control select border rounded" required>
                                        <option value="">== Pilih Jenis Atlet ==</option>
                                        <option value="Proyeksi PORPROV">Proyeksi PORPROV</option>
                                        <option value="Binaan">Binaan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nik" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select id="jenis_kelamin" name="jenis_kelamin" class="form-control select border rounded" required>
                                        <option value="">== Pilih Jenis Kelamin ==</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" id="ukuran-baju-container">
                                    <label for="ukuran_baju">Ukuran Baju</label>
                                    <input type="text" class="form-control" id="ukuran_baju" name="ukuran_baju" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" id="ukuran-sepatu-container">
                                    <label for="ukuran_sepatu">Ukuran Sepatu</label>
                                    <input type="text" class="form-control" id="ukuran_sepatu" name="ukuran_sepatu" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="kota_lahir">Kota Kelahiran</label>
                                    <input type="text" class="form-control" id="kota_lahir" name="kota_lahir" required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Kelahiran</label>
                                    <input type="text" class="form-control border rounded" id="tanggal_lahir" name="tanggal_lahir" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="npwp">NPWP</label>
                                    <input type="text" class="form-control" id="npwp" name="npwp" required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="foto">Foto Diri</label>
                                    <input type="file" class="form-control-file" id="foto" name="foto" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sertifikat">Sertifikat</label>
                                    <input type="file" class="form-control-file" id="sertifikat" name="sertifikat" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="ktp">KTP</label>
                                    <input type="file" class="form-control-file" id="ktp" name="ktp" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="kk">KK</label>
                                    <input type="file" class="form-control-file" id="kk" name="kk" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('atlit_cabor.index') }}" class="btn btn-danger btn-fill">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.back.footer')
<script>
    document.getElementById('jenis').addEventListener('change', function () {
        const ukuranBajuContainer = document.getElementById('ukuran-baju-container');
        const ukuranSepatuContainer = document.getElementById('ukuran-sepatu-container');
        const ukuranBajuInput = document.getElementById('ukuran_baju');
        const ukuranSepatuInput = document.getElementById('ukuran_sepatu');

        if (this.value === 'Binaan') {
            ukuranBajuContainer.style.display = 'none';
            ukuranSepatuContainer.style.display = 'none';
            ukuranBajuInput.disabled = true;
            ukuranSepatuInput.disabled = true;
        } else {
            ukuranBajuContainer.style.display = 'block';
            ukuranSepatuContainer.style.display = 'block';
            ukuranBajuInput.disabled = false;
            ukuranSepatuInput.disabled = false;
        }
    });
</script>
@endsection
