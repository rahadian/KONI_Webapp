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
              <h6>Edit Informasi (Berita dan Pengumuman)</h6>
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
            <form enctype="multipart/form-data" method="POST" action="{{ route('informasi.update',[$data->id]) }}" class="style-form">
                @csrf
                <input type="hidden" value="PUT" name="_method">
                 <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ $data->judul }}" required >
                </div>
                <div class="form-group">
                    <label for="kategori">Pilih Kategori</label>
                    <select id="kategori" name="kategori" class="form-control select border rounded w-10" required>
                        <option value="{{ $data->kategori }}">{{ $data->kategori }}</option>
                        <option value="">==========</option>
                        <option value="Berita">Berita</option>
                        <option value="Pengumuman">Pengumuman</option>
                        <option value="Pinned">Pinned</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Gambar</label><br>
                    @if ($data->image)
                        <img src="{{ asset('uploads/' . $data->image) }}" class="img-thumbnail" style="max-width: 100px;">
                    @endif
                    <input type="file" class="form-control-file" id="image" name="image" value="{{ $data->image }}">

                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content-editor" rows="5" name="content">{{ $data->content }}</textarea>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="text" class="form-control border rounded w-10" id="tanggal" name="tanggal" autocomplete="off" value="{{ $data->tanggal }}" required>
                </div>
                 <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control select border rounded w-10" required>
                        <option value="{{ $data->status }}">{{ $data->status }}</option>
                        <option value="">==========</option>
                        <option value="draft">Draft</option>
                        <option value="publish">Publish</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('informasi.index') }}" class="btn btn-danger btn-fill pull-left">Kembali</a>
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
