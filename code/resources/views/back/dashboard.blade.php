@extends('layouts.back.header')
@section('title') @endsection
@section('content')
{{-- <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Berita (publish)</p>
                    <h5 class="font-weight-bolder">
                      {{ $totalberita }}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="fa fa-newspaper text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Pengumuman (publish)</p>
                    <h5 class="font-weight-bolder">
                      {{ $totalpengumuman }}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                    <i class="fa fa-comment text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Pinned (publish)</p>
                    <h5 class="font-weight-bolder">
                      {{ $totalpinned }}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                    <i class="fa fa-thumbtack text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-4" style="width:100%">
        <div class="col-lg-7 mb-lg-0 mb-4">
          <div class="card ">
            <div class="card-header pb-0 p-3">
              <div class="d-flex justify-content-between">
                <h6 class="mb-2">List Informasi</h6>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center">
                <tbody>
                @foreach($informasi as $inf)
                  <tr>
                    <td class="w-50">
                      <div class="d-flex px-2 py-1 align-items-center">
                        <div class="ms-4" style="margin-right:50px">
                          <h6 class="text-sm">{{ Str::limit(strip_tags($inf->judul), 20, ' ...') }}</h6>
                        </div>
                      </div>
                    </td>

                    <td>
                      <div class="text-center">
                        <p class="text-xs font-weight-bold mb-0">Kategori:</p>
                        <h6 class="text-sm mb-0">{{ $inf->kategori }}</h6>
                      </div>
                    </td>
                    <td class="align-middle text-sm">
                      <div class="col text-center">
                        <p class="text-xs font-weight-bold mb-0">Status:</p>
                        <h6 class="text-sm mb-0">{{ $inf->status }}</h6>
                      </div>
                    </td>
                  </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div> --}}

  @include('layouts.back.footer')
@endsection
