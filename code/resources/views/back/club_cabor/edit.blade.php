@extends('layouts.back.header')
@section('title') @endsection
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Edit Club Cabor {{ $nama_cabor }}</h6>
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
                    <form enctype="multipart/form-data" method="POST" action="{{ route('club_cabor.update',[$data->id]) }}" class="style-form">
                        @csrf
                        <input type="hidden" value="PUT" name="_method">
                        <input type="hidden" class="form-control" id="id_cabor" name="id_cabor" value={{ $id_cabor->id }}>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nama_ketua">Nama Ketua</label>
                                    <input type="text" class="form-control" id="nama_ketua" name="nama_ketua" value={{ $data->nama_ketua }}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nama_sekretaris">Nama Sekretaris</label>
                                    <input type="text" class="form-control" id="nama_sekretaris" name="nama_sekretaris" value={{ $data->nama_sekretaris }}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nama_bendahara">Nama Bendahara</label>
                                    <input type="text" class="form-control" id="nama_bendahara" name="nama_bendahara" value={{ $data->nama_bendahara }}>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" value={{ $data->alamat }}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="no_sk">Nomor SK</label>
                                    <input type="text" class="form-control" id="no_sk" name="no_sk" value={{ $data->no_sk }}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tgl_sk">Tanggal SK</label>
                                    <input type="text" class="form-control" id="tgl_sk" name="tgl_sk" value={{ $data->tgl_sk }}>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="file_sk">Scan File SK</label>
                                    @if ($data->file_sk)
                                        <img src="{{ asset('uploads').'/'.$data->file_sk}}" class="img-thumbnail mb-2" style="width:80px">
                                    @endif
                                    <input type="file" class="form-control-file" id="file_sk" name="file_sk">
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
@endsection
