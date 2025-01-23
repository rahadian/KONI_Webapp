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
              <h6>List Data</h6>
              <a href="{{ route("limit_nominal.create") }}"><button type="button" class="btn btn-primary btn-fill" style="float:left;"><i class="fa fa-plus"></i> Tambah Data</button></a>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table table-hover align-items-center mb-0 ">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tahun</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nominal</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Cabor</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Semester1</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Semester2</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
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
                            <h6 class="mb-0 text-sm">{{ $dt->tahun }}</h6>
                          </div>
                        </div>
                      </td>
                    <td>
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Rp {{ number_format($dt->nominal, 0, ',', '.') }}</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $dt->cabor }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Rp {{ number_format($dt->semester1, 0, ',', '.') }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                            <h6 class="mb-0 text-sm">Rp {{ number_format($dt->semester2, 0, ',', '.') }}</h6>
                        </div>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $dt->username }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $dt->created_at }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $dt->updated_at }}</span>
                      </td>
                      <td class="align-middle text-center">
                        {{-- <a class="btn btn-fill btn-info" href="{{ route("limit_nominal.edit",[$dt->id]) }}" title='View Detail'><i class="fa fa-eye"></i></a> --}}
                        <form onsubmit="return confirm('Anda Yakin untuk Menghapus Data Ini ?')" class="d-inline" action="{{ route('limit_nominal.destroy',[$dt->id]) }}" method="post">
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
