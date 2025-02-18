@extends('layouts.back.header')
@section('title') Verifikasi Data Perencanaan @endsection
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    @if (session('status'))
                        <div class="alert alert-success">
                            <strong>{{session('status')}}</strong>
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
                    @if (session('error'))
                        <div class="alert alert-danger">
                            <strong>{{ session('error') }}</strong>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Verifikasi Data Perencanaan</h6>
                    </div>
                </div>

                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table table-hover align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Cabor</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tahun</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Catatan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Verified by</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Verified at</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $dt)
                                <tr>
                                    <td class="ps-4">
                                        <span class="text-secondary text-xs">
                                            {{ ($data->currentPage() - 1) * $data->perPage() + $index + 1 }}
                                        </span>
                                    </td>
                                    <td><span class="text-secondary text-xs">{{ $dt->cabor }}</span></td>
                                    <td><span class="text-secondary text-xs">{{ $dt->tahun }}</span></td>
                                    <td>
                                         <span class="badge
                                            {{ $dt->status == 1 ? 'bg-success' : ($dt->status == 2 ? 'bg-danger' : 'bg-warning') }}">
                                            {{ $dt->status == 1 ? 'Disetujui' : ($dt->status == 2 ? 'Revisi' : 'Belum Diverifikasi') }}
                                        </span>
                                    </td>
                                    <td><span class="text-secondary text-xs">{{ $dt->catatan }}</span></td>
                                    <td class="text-center"><span class="text-secondary text-xs">{{ $dt->verified_by }}</span></td>
                                    <td class="text-center"><span class="text-secondary text-xs">{{ $dt->verified_at }}</span></td>
                                    <td class="text-center">
                                        @if(Auth::user()->role == "admin")
                                             <a class="btn btn-fill btn-info view-detail" href="javascript:void(0)" data-id="{{ $dt->pengajuan_perencanaan_id }}" title='View Detail'><i class="fa fa-eye"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-4 py-3">
                            {{ $data->appends(Request::all())->links("pagination::bootstrap-4") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="DetailModal" tabindex="-1" role="dialog" aria-labelledby="budgetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="budgetModalLabel">Isi Detail Anggaran Kegiatan</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                    <div class="form-group mb-3">
                        <label for="tahun_anggaran">Tahun Anggaran</label>
                        <input type="text" class="form-control" placeholder="tahun anggaran" name="tahun_anggaran" id="tahun_anggaran"  readonly="readonly">
                    </div>


                    <div class="form-group mb-3">
                        <label>Nama Cabor</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="cabor" id="cabor" readonly="readonly">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <div class="input-group">
                            <button id="detail-button" class="btn btn-primary">RINCIAN KERTAS KERJA</button>
                        </div>
                    </div>


                    <div class="row mb-3">

                        <div class="col-md-6">
                            <label>Catatan</label>
                            <input type="text" class="form-control" placeholder="Catatan" name="catatan" id="catatan">
                        </div>

                    </div>


                    <div class="text-right">
                            <form id="form_setuju" action="" method="POST" style="display: inline;">
                            @csrf

                            <button type="submit" class="btn btn-success">Setuju</button>
                        </form>
                        <form id="form_tolak" action="" method="POST" style="display: inline;">
                            @csrf
                            <input type="hidden" class="form-control" placeholder="Keterangan" name="keterangantolak" id="keterangantolak">
                            <button type="submit" class="btn btn-danger">Revisi</button>
                        </form>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('layouts.back.footer')
<script>
$(document).ready(function() {
    $('.view-detail').click(function() {
        var id = $(this).data('id');
        const buttonElement = document.getElementById("detail-button");
        buttonElement.addEventListener("click", function () {
            const url = "/back/verifikasi-perencanaan/detaildata/" + id;
            window.open(url, "_blank"); // Opens the URL in a new tab
        });

        // Clear previous values
        $('#tahun_anggaran').val('');
        $('#cabor').val('');
        $('#keterangan').val('');

        // Get data via AJAX
        $.ajax({
            url: '/back/get-perencanaan-detail/' + id,
            type: 'GET',
            success: function(response) {
                $('#tahun_anggaran').val(response.tahun);
                $('#cabor').val(response.cabor);
                $('#form_setuju').attr('action', '/back/verifikasi-perencanaan/setuju/' + id);
                $('#form_tolak').attr('action', '/back/verifikasi-perencanaan/tolak/' + id);
                $('#DetailModal').modal('show');
            },
            error: function(xhr) {
                //console.log(xhr.responseText);
            }
        });
    });

    // Handle keterangan value before form submission
    $('#form_setuju').submit(function(){
        var catatan = $('#catatan').val();
        if (!$('#form_setuju input[name="catatan"]').length) {
            $(this).append('<input type="hidden" name="catatan" value="' + catatan + '">');
        }
    });
    $('#form_tolak').submit(function() {
        var catatan = $('#catatan').val();
        if (!$('#form_setuju input[name="catatan"]').length) {
            $(this).append('<input type="hidden" name="catatan" value="' + catatan + '">');
        }
    });
});
</script>
@endsection
