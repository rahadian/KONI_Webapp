@extends('layouts.back.header')
@section('title') @endsection
@section('content')
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Tambah Data Produk Hukum</h6>
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
            <form enctype="multipart/form-data" method="POST" action="{{ route('produk_hukum.store') }}" class="style-form">
                @csrf
                <div class="form-group">
                    <label for="kategori">Pilih Kategori</label>
                    <select id="kategori" name="kategori" class="form-control select border rounded w-10" required>
                        @foreach($kategori as $k)
                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>
                    <hr>
                    <button type="button" class="btn btn-danger" id="deleteKategoriBtn"><i class="fa fa-trash"></i> Hapus Kategori</button>
                    <button type="button" class="btn btn-primary btn-fill" data-toggle="modal" data-target="#kategoriModal"><i class="fa fa-plus"></i> Tambah Kategori</button>
                </div>
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" required >
                </div>
                <div class="form-group">
                    <label for="file">File PDF</label><br>
                    <input type="file" class="form-control-file" id="file" name="file" required>
                </div>
                <a href="{{ route('informasi.index') }}" class="btn btn-danger btn-fill pull-left">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>

            </form>
            </div>
          </div>
        </div>
      </div>

<!-- Modal -->
<div class="modal fade" id="kategoriModal" tabindex="-1" role="dialog" aria-labelledby="kategoriModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="kategoriModalLabel">Tambah Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="kategoriForm">
          <div class="form-group">
            <label for="nama_kategori">Nama Kategori</label>
            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
          </div>
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('#kategoriForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        var nama = $('#nama_kategori').val();
        $.ajax({
            url: '/api/post_kategori_hukum',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ nama: nama }),
            success: function(response) {
                // Add the new option to the select dropdown
                $('#kategori').append('<option value="' + response.data.nama + '">' + response.data.nama + '</option>');

                // Reset the form
                $('#nama_kategori').val('');

                // Hide the modal
                $('#kategoriModal').modal('hide');

                // Refresh the page
                location.reload();
            },
            error: function(xhr, status, error) {
                // Handle errors here
                console.error(error);
                alert('Error adding kategori');
            }
        });
    });

    // Handle delete category
    $('#deleteKategoriBtn').on('click', function() {
        var selectedOption = $('#kategori option:selected');
        var categoryId = selectedOption.val();

        if (categoryId) {
            if (confirm('Are you sure you want to delete this category?')) {
                $.ajax({
                    url: '/api/del_kategori_hukum/' + categoryId,
                    method: 'DELETE',
                    success: function(response) {
                        // Remove the option from the select dropdown
                        selectedOption.remove();

                        alert('Category deleted successfully');
                    },
                    error: function(xhr, status, error) {
                        // Handle errors here
                        console.error(error);
                        alert('Error deleting category');
                    }
                });
            }
        } else {
            alert('Please select a category to delete');
        }
    });
});
</script>
@include('layouts.back.footer')
@endsection
