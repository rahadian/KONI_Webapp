@extends('layouts.back.header')
@section('title') @endsection
@section('content')
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Tambah Data</h6>
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
            <form enctype="multipart/form-data" method="POST" action="{{ route('limit_nominal.store') }}" class="style-form">
                @csrf

                <input type="hidden" class="form-control" id="username" name="username" value="{{ $user->username }}" required >

                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <select name="tahun" id="year" class="form-control" required>
                        @for ($year = now()->year; $year >= 2023; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                {{-- <div class="form-group">
                    <label for="nominal">Nominal</label>
                    <input type="number" class="form-control" id="nominal" name="nominal" min="0" required>
                </div> --}}
                <div class="form-group">
                    <label for="nominal">Nominal</label>
                    <input type="text" class="form-control" id="nominal" name="nominal" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('limit_nominal.index') }}" class="btn btn-danger btn-fill pull-left">Kembali</a>
            </form>
            </div>
          </div>
        </div>
      </div>

@include('layouts.back.footer')
<script>
    const nominalInput = document.getElementById('nominal');
    nominalInput.addEventListener('input', () => {
        let value = nominalInput.value.replace(/\D/g, ''); // Remove non-numeric characters
        nominalInput.value = new Intl.NumberFormat('id-ID').format(value); // Format in Indonesian style
    });
</script>
@endsection
