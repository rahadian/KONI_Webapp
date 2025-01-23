@extends('layouts.back.header')
@section('title') @endsection
@section('content')
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Tambah Data Periode</h6>
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
            <form enctype="multipart/form-data" method="POST" action="{{ route('periode_tahun.store') }}" class="style-form">
                @csrf

                <input type="hidden" class="form-control" id="username" name="username" value="{{ $user->username }}" required >

                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <select name="tahun" id="year" class="form-control w-10" required>
                        @for ($year = now()->year +1; $year >= 2023; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group" id="status-container">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control select border rounded w-10" required>
                        <option value="">Pilih Status</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>
                {{-- <div class="form-group">
                    <label for="nominal">Nominal</label>
                    <input type="number" class="form-control" id="nominal" name="nominal" min="0" required>
                </div> --}}

                <button type="submit" class="btn btn-primary" id='buttonsubmit'>Simpan</button>
                <a href="{{ route('periode_tahun.index') }}" class="btn btn-danger btn-fill pull-left">Kembali</a>
            </form>
            </div>
          </div>
        </div>
      </div>

@include('layouts.back.footer')

@endsection
