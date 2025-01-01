@extends('layouts.back.header')
@section('title') @endsection
@section('content')
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
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
              <h6>List Produk Hukum</h6>
              <a href="{{ route("produk_hukum.create") }}"><button type="button" class="btn btn-primary btn-fill" style="float:left;"><i class="fa fa-plus"></i> Tambah Data</button></a>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kategori</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">File</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Updated</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $i=(($data->currentPage()-1)*$data->perPage()+1)-1;
                    @endphp
                    @foreach ($data as $dt)
                    @php
                        $i++;
                    @endphp
                    <tr>
                      <td class="align-middle" style="padding-left:25px">
                        <p>{{ $i }}</p>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ Str::limit(strip_tags($dt->judul), 50, ' ...') }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $dt->nama }}</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                       <a href="{{ asset('uploads/' . $dt->file) }}"><i class="fa fa-file"></i></a>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $dt->created_at }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $dt->updated_at }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <form onsubmit="return confirm('Anda Yakin untuk Menghapus Data Ini ?')" class="d-inline" action="{{ route('produk_hukum.destroy',[$dt->id]) }}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        {{-- <input type="submit" value="&#xf1f8;" class="btn btn-danger btn-sm fa fa-trash" style="text-align: center;"> --}}
                        <button type="submit" class="btn btn-fill btn-danger"><i class="fa fa-trash" style="font-size: 19px;"></i></button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="form no-margin">

                    {{$data->appends(Request::all())->links("pagination::bootstrap-4")}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

  @include('layouts.back.footer')
@endsection
