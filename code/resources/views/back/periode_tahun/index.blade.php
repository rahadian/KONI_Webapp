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
              <h6>List Data Periode Tahun</h6>
              <a href="{{ route("periode_tahun.create") }}"><button type="button" class="btn btn-primary btn-fill" style="float:left;"><i class="fa fa-plus"></i> Tambah Data Periode</button></a>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table table-hover align-items-center mb-0 ">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tahun</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
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
                            <h6 class="mb-0 text-sm">{{ $dt->tahun }}</h6>
                          </div>
                        </div>
                      </td>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    @if($dt->status=='1')
                                    <span class="badge badge-sm bg-gradient-success">Aktif</span>
                                    @else
                                    <span class="badge badge-sm bg-gradient-secondary">Tidak Aktif</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="align-middle text-center">
                            @if($dt->status==0)
                                <form id="form_aktifkan" action="{{ route('periode_tahun.aktifkan', [$dt->id]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-check"></i> Aktifkan</button>
                                </form>
                                {{-- <a class="btn btn-fill btn-info" href="{{ route("limit_nominal.edit",[$dt->id]) }}" title='View Detail'><i class="fa-solid fa-check"></i></a> --}}
                            @endif
                            {{-- <form onsubmit="return confirm('Anda Yakin untuk Menghapus Data Ini ?')" class="d-inline" action="{{ route('limit_nominal.destroy',[$dt->id]) }}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-fill btn-danger"><i class="fa fa-trash" style="font-size: 19px;"></i></button>
                            </form> --}}
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
