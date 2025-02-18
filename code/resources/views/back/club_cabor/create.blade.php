@extends('layouts.back.header')
@section('title') @endsection
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Tambah Club Cabor {{ $nama_cabor }}</h6>
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
                    <form enctype="multipart/form-data" method="POST" action="{{ route('club_cabor.store') }}" class="style-form">
                        @csrf
                        <input type="hidden" class="form-control" id="id_cabor" name="id_cabor" value={{ $id_cabor->id }} required>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nama_ketua">Nama Ketua</label>
                                    <input type="text" class="form-control" id="nama_ketua" name="nama_ketua" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nama_sekretaris">Nama Sekretaris</label>
                                    <input type="text" class="form-control" id="nama_sekretaris" name="nama_sekretaris" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nama_bendahara">Nama Bendahara</label>
                                    <input type="text" class="form-control" id="nama_bendahara" name="nama_bendahara" required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="no_sk">Nomor SK</label>
                                    <input type="text" class="form-control" id="no_sk" name="no_sk" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tgl_sk">Tanggal SK</label>
                                    <input type="text" class="form-control border rounded" id="tgl_sk" name="tgl_sk" autocomplete="off" required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="file_sk">Scan File SK</label>
                                    <input type="file" class="form-control-file" id="file_sk" name="file_sk" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('club_cabor.index') }}" class="btn btn-danger btn-fill">Kembali</a>
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
