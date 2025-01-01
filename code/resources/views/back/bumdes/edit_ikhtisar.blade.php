@extends('layouts.back.header')
@section('title') @endsection
@section('content')
<style>
 .datepicker table tr td,
    .datepicker table tr th {
        color: black; /* Change font color to black */
    }
</style>
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Edit Ikhtisar</h6>
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
            <form enctype="multipart/form-data" method="POST" action="{{ route('ikhtisar.update',[$data->id]) }}" class="style-form">
                @csrf
                <input type="hidden" value="PUT" name="_method">

                <div class="form-group">
                    <label for="gambar">Gambar</label><br>
                    @if ($data->gambar)
                        <img src="{{ asset('uploads/' . $data->gambar) }}" class="img-thumbnail" style="max-width: 100px;">
                    @endif
                    <input type="file" class="form-control-file" id="gambar" name="gambar" value="{{ $data->gambar }}">

                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="content-editor" rows="5" name="deskripsi">{{ $data->deskripsi }}</textarea>
                </div>


                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('ikhtisar.index') }}" class="btn btn-danger btn-fill pull-left">Kembali</a>
            </form>
            </div>
          </div>
        </div>
      </div>
<script>
ClassicEditor
        .create(document.querySelector('#content-editor'))
        .catch(error => {
           console.error(error);
        });
   // CKEDITOR.replace( 'content' );
</script>
@include('layouts.back.footer')
@endsection
