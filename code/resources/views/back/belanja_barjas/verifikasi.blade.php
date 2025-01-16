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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kegiatan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rekening</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Belanja</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Barang</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga Satuan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bulan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tahun</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created at</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Updated at</th>
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
                                    <td><span class="text-secondary text-xs">{{ $dt->nama_cabor }}</span></td>
                                    <td><span class="text-secondary text-xs">{{ $dt->kode_kegiatan }} - {{ $dt->uraian_kegiatan }}</span></td>
                                    <td><span class="text-secondary text-xs">{{ $dt->kode_rekening }} - {{ $dt->uraian_rekening }}</span></td>
                                    <td><span class="text-secondary text-xs">{{ $dt->kode_belanja }} - {{ $dt->uraian_belanja }}</span></td>
                                    <td><span class="text-secondary text-xs">{{ $dt->kode_barang }} - {{ $dt->nama_barang }}</span></td>
                                    <td><span class="text-secondary text-xs">Rp {{ number_format($dt->harga_satuan, 0, ',', '.') }}</span></td>
                                    <td><span class="text-secondary text-xs">{{ $dt->bulan }}</span></td>
                                    <td><span class="text-secondary text-xs">{{ $dt->tahun_anggaran }}</span></td>
                                    <td>
                                         <span class="badge
                                            {{ $dt->status == 1 ? 'bg-success' : ($dt->status == 2 ? 'bg-danger' : 'bg-warning') }}">
                                            {{ $dt->status == 1 ? 'Disetujui' : ($dt->status == 2 ? 'Ditolak' : 'Belum Diverifikasi') }}
                                        </span>
                                    </td>
                                    <td class="text-center"><span class="text-secondary text-xs">{{ $dt->created_at }}</span></td>
                                    <td class="text-center"><span class="text-secondary text-xs">{{ $dt->updated_at }}</span></td>
                                    <td class="text-center">
                                        @if(Auth::user()->role == "admin")
                                             <a class="btn btn-fill btn-info view-detail" href="javascript:void(0)" data-id="{{ $dt->id_perencanaan }}" title='View Detail'><i class="fa fa-eye"></i></a>
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
                        <input type="text" class="form-control" placeholder="tahun anggaran" name="tahun_anggaran" id="tahun_anggaran" readonly="readonly">
                    </div>

                    <div id="main_form_section">
                        <div class="form-group mb-3">
                            <label>Kegiatan</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="kode_kegiatan" id="kode_kegiatan" readonly="readonly">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Rekening Belanja</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="kode_rekening" id="kode_rekening" readonly="readonly">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Belanja</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="kode_belanja" id="kode_belanja" readonly="readonly">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Barang/Jasa</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="kode_barang" id="kode_barang" readonly="readonly">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Harga Satuan</label>
                                <input type="text" class="form-control" id="harga_satuan" name="harga_satuan" readonly>
                            </div>
                            <div class="col-md-6">
                                <label>Jumlah dan Satuan</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" placeholder="Jumlah" name="jumlah" id="jumlah" readonly>
                                    <input type="text" class="form-control" placeholder="Satuan" name="satuan" id="satuan" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Dianggarkan untuk Bulan</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Bulan" name="bulan" id="bulan" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-info" id="budget_info">
                        <strong>Total : <span id="harga_total"> x </span></strong>
                        </div>

                        <div class="text-right">
                             <form id="form_setuju" action="{{ route('perencanaan.setuju', ':id') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">Setuju</button>
                            </form>
                            <form id="form_tolak" action="{{ route('perencanaan.tolak', ':id') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger">Tolak</button>
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
        const formatRupiah = (value) => {
            return 'Rp ' + new Intl.NumberFormat('id-ID', {
                minimumFractionDigits: 0
            }).format(value);
        };

        // Fetch detail data
        $.ajax({
            url: '/back/perencanaan/detail/' + id,  // Add this route
            type: 'GET',
            success: function(response) {
                const monthNames = [
                    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                ];
                const monthNumber = response.bulan; // e.g., 1 for Januari
                const monthName = monthNames[monthNumber - 1]; // Array index starts at 0
                // Fill modal with data
                $('#tahun_anggaran').val(response.tahun_anggaran);
                $('#kode_kegiatan').val(response.kode_kegiatan + ' - ' + response.uraian_kegiatan);
                $('#kode_rekening').val(response.kode_rekening + ' - ' + response.uraian_rekening);
                $('#kode_belanja').val(response.kode_belanja + ' - ' + response.uraian_belanja);
                $('#kode_barang').val(response.kode_barang + ' - ' + response.nama_barang);
                $('#harga_satuan').val(formatRupiah(response.harga_satuan));
                $('#jumlah').val(response.jumlah);
                $('#satuan').val(response.satuan);
                $('#bulan').val(monthName);
                $('#harga_total').text(formatRupiah(response.harga_satuan * response.jumlah));
                $('#form_setuju').attr('action', '/back/perencanaan/setuju/' + id);
                $('#form_tolak').attr('action', '/back/perencanaan/tolak/' + id);

                // Show the modal
                $('#DetailModal').modal('show');
            },
            error: function(xhr) {
                console.log('Error:', xhr);
            }
        });
    });
});

</script>

@endsection
