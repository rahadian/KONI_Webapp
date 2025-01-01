@extends('layouts.back.header')
@section('title') @endsection
@section('content')
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Tambah User</h6>
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
            <form enctype="multipart/form-data" method="POST" action="{{ route('users.store') }}" class="style-form">
                @csrf
                 <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required >
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required >
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required >
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" class="form-control select border rounded w-10" required>
                        <option value="">== Pilih User Role ==</option>
                        <option value="admin">Admin Pusat</option>
                        <option value="staff">Admin Staff</option>
                        <option value="cabor">Admin Cabor</option>
                    </select>
                </div>

                <div class="form-group" id="cabor-container" style="display: none;">
                    <label for="cabor">Cabor</label>
                    <select id="cabor" name="cabor" class="form-control select border rounded w-10">
                        <option value="">== Pilih User Cabor ==</option>
                        @foreach($cabor as $key => $value)
                            <option value="{{ $value->nama_cabor }}">{{ $value->nama_cabor }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" name="password" required type="password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" name="password_confirmation" required type="password" class="form-control">
                </div>



                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('users.index') }}" class="btn btn-danger btn-fill pull-left">Kembali</a>
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
