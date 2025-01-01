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
              <h6>Data Prestasi Cabor {{ $nama_cabor }}</h6>
              @if(Auth::user()->role=="cabor")
              <a href="{{ route("prestasi_cabor.create") }}"><button type="button" class="btn btn-primary btn-fill" style="float:left;"><i class="fa fa-plus"></i> Tambah Prestasi</button></a>
              @endif
            </div>

            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table table-hover align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cabor</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Kejuaraan</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tingkatan Kerjuaraan</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu Kegiatan</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Perolehan Medali</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Foto Kegiatan/th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Scan Piagam</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Scan Hasil Pertandingan</th>
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
                            <h6 class="mb-0 text-sm">{{ $dt->nama_cabor }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $dt->nama_kejuaraan }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $dt->tingkat_kejuaraan }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $dt->waktu_kegiatan }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $dt->perolehan_medali }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <img src="{{ asset('uploads').'/'.$dt->foto_kegiatan}}" style="width:30px">
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <img src="{{ asset('uploads').'/'.$dt->scan_piagam}}" style="width:30px">
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <img src="{{ asset('uploads').'/'.$dt->scan_hasil_pertandingan}}" style="width:30px">
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $dt->created_at }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $dt->updated_at }}</span>
                      </td>
                      <td class="align-middle text-center">

                      @if(Auth::user()->role=="cabor")
                        <a class="btn btn-fill btn-info" href="{{ route("prestasi_cabor.edit",[$dt->id_prestasi]) }}" title='View Detail'><i class="fa fa-eye"></i></a>

                        <form onsubmit="return confirm('Anda Yakin untuk Menghapus Data Ini ?')" class="d-inline" action="{{ route('prestasi_cabor.destroy',[$dt->id_prestasi]) }}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        {{-- <input type="submit" value="&#xf1f8;" class="btn btn-danger btn-sm fa fa-trash" style="text-align: center;"> --}}
                        <button type="submit" class="btn btn-fill btn-danger"><i class="fa fa-trash" style="font-size: 19px;"></i></button>
                        </form>
                        @endif
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
