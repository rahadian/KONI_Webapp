@extends('layouts.back.header')
@section('title') Data Perencanaan @endsection
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
                        <h6 class="mb-0">Data Perencanaan</h6>
                        @if(Auth::user()->role == "cabor")
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBudgetModal">
                                <i class="fa fa-plus"></i> Tambah Data
                            </button>
                        @endif
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
                                        @if(Auth::user()->role == "cabor")
                                             <a class="btn btn-fill btn-info" href="" title='View Detail'><i class="fa fa-eye"></i></a>
                                             <form onsubmit="return confirm('Anda Yakin untuk Menghapus Data Ini ?')" class="d-inline" action="" method="post">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-fill btn-danger"><i class="fa fa-trash" style="font-size: 19px;"></i></button>
                                        </form>
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
<div class="modal fade" id="addBudgetModal" tabindex="-1" role="dialog" aria-labelledby="budgetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="budgetModalLabel">Isi Detail Anggaran Kegiatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('perencanaan.store') }}" method="POST" id="budgetForm">
                    @csrf
                    <input type="hidden" name="id_cabor" value="{{ $id_cabor->id }}">

                    <div class="form-group mb-3">
                        <label for="tahun_anggaran">Tahun Anggaran</label>
                        <select class="form-control" id="tahun_anggaran" name="tahun_anggaran" required>
                            <option value="">Pilih Tahun Anggaran</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="alert alert-info" id="budget_info" style="display: none;">
                        <strong>Total Anggaran : <span id="total_limit">Rp 0</span></strong><br>
                        <strong>Total Anggaran Tersedia: <span id="sisa_anggaran">Rp 0</span></strong>
                    </div>

                    <div id="main_form_section" style="display: none;">
                        <div class="form-group mb-3">
                            <label>Kegiatan</label>
                            <div class="input-group">
                                <select class="form-control" id="kode_kegiatan" name="kode_kegiatan" required>
                                    <option value="">Pilih Kegiatan</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Rekening Belanja</label>
                            <div class="input-group">
                                <select class="form-control" id="kode_rekening" name="kode_rekening" required disabled>
                                    <option value="">Pilih Rekening Belanja</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Belanja</label>
                            <div class="input-group">
                                <select class="form-control" id="kode_belanja" name="kode_belanja" required disabled>
                                    <option value="">Pilih Belanja</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Barang/Jasa</label>
                            <div class="input-group">
                                <select class="form-control" id="kode_barang" name="kode_barang" required disabled>
                                    <option value="">Pilih Barang/Jasa</option>
                                </select>
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
                                    <input type="number" class="form-control" placeholder="Jumlah" name="jumlah" id="jumlah">
                                    <input type="text" class="form-control" placeholder="Satuan" name="satuan">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Dianggarkan untuk Bulan</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <select class="form-control" name="bulan" id="bulan" required>
                                        <option value="">Pilih Bulan</option>
                                        @foreach($months as $key => $month)
                                            <option value="{{ $key }}">{{ $month }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-dark" id="submit_btn">Masukkan ke Anggaran</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let budgetLimit = 0;
    const form = document.getElementById('budgetForm');
    const yearSelect = document.getElementById('tahun_anggaran');

    yearSelect.addEventListener('change', async function() {
        const selectedYear = this.value;
        if (!selectedYear) {
            resetForm();
            return;
        }

        try {
            const response = await fetch(`{{ url('back/get-budget-limit') }}/${selectedYear}`);
            const data = await response.json();

            if (response.ok ) {
                budgetLimit = data['data']['nominal'];
                sisaAnggaran = data['data']['nominal_sisa'];
                document.getElementById('total_limit').textContent =
                    `Rp ${new Intl.NumberFormat('id-ID').format(budgetLimit)}`;
                document.getElementById('sisa_anggaran').textContent =
                    `Rp ${new Intl.NumberFormat('id-ID').format(sisaAnggaran)}`;
                document.getElementById('budget_info').style.display = 'block';
                document.getElementById('main_form_section').style.display = 'block';
                loadKegiatanData();
            } else {
                throw new Error('Failed to fetch budget limit');
            }
        } catch (error) {
            alert('Error: Could not fetch budget limit');
            resetForm();
        }
    });

    async function loadKegiatanData() {
        try {
            const response = await fetch('{{ route("get.kegiatan") }}');
            const data = await response.json();

            if (response.ok) {
                const options = data.map(item =>
                    `<option value="${item.kode_kegiatan}">${item.kode_kegiatan} - ${item.uraian_kegiatan}</option>`
                );
                document.getElementById('kode_kegiatan').innerHTML =
                    '<option value="">Pilih Kegiatan</option>' + options.join('');
            } else {
                throw new Error('Failed to fetch kegiatan data');
            }
        } catch (error) {
            alert('Error: Could not load kegiatan data');
        }
    }

    function resetForm() {
        document.getElementById('main_form_section').style.display = 'none';
        document.getElementById('budget_info').style.display = 'none';
        budgetLimit = 0;
        form.reset();
        // Reset and disable dropdowns
        ['kode_rekening', 'kode_belanja', 'kode_barang'].forEach(id => {
            const element = document.getElementById(id);
            element.disabled = true;
            element.innerHTML = `<option value="">Pilih ${id.split('_')[1].charAt(0).toUpperCase() + id.split('_')[1].slice(1)}</option>`;
        });
    }
     $('#kode_kegiatan').change(function() {
        const kodeKegiatan = $(this).val();
        if(kodeKegiatan) {
            $('#kode_rekening').prop('disabled', false);
            $.ajax({
                url: `{{ url('back/get-rekening') }}/${kodeKegiatan}`,
                type: 'GET',
                success: function(data) {
                    let options = '<option value="">Pilih Rekening Belanja</option>';
                    data.forEach(function(item) {
                        options += `<option value="${item.kode_rekening}">${item.kode_rekening} - ${item.uraian_rekening}</option>`;
                    });
                    $('#kode_rekening').html(options);
                }
            });
        } else {
            $('#kode_rekening').prop('disabled', true).html('<option value="">Pilih Rekening Belanja</option>');
            $('#kode_belanja').prop('disabled', true).html('<option value="">Pilih Belanja</option>');
            $('#kode_barang').prop('disabled', true).html('<option value="">Pilih Barang/Jasa</option>');
        }
    });

    // When rekening is selected
    $('#kode_rekening').change(function() {
        const kodeRekening = $(this).val();
        if(kodeRekening) {
            $('#kode_belanja').prop('disabled', false);
            $.ajax({
                url: `{{ url('back/get-belanja') }}/${kodeRekening}`,
                type: 'GET',
                success: function(data) {
                    let options = '<option value="">Pilih Belanja</option>';
                    data.forEach(function(item) {
                        options += `<option value="${item.kode_belanja}">${item.kode_belanja} - ${item.uraian_belanja}</option>`;
                    });
                    $('#kode_belanja').html(options);
                }
            });
        } else {
            $('#kode_belanja').prop('disabled', true).html('<option value="">Pilih Belanja</option>');
            $('#kode_barang').prop('disabled', true).html('<option value="">Pilih Barang/Jasa</option>');
        }
    });

    // When belanja is selected
    $('#kode_belanja').change(function() {
        const kodeBelanja = $(this).val();
        if(kodeBelanja) {
            $('#kode_barang').prop('disabled', false);
            $.ajax({
                url: `{{ url('back/get-barang') }}/${kodeBelanja}`,
                type: 'GET',
                success: function(data) {
                    let options = '<option value="">Pilih Barang/Jasa</option>';
                    data.forEach(function(item) {
                        options += `<option value="${item.kode_barang}">${item.kode_barang} - ${item.nama_barang}</option>`;
                    });
                    $('#kode_barang').html(options);
                }
            });
        } else {
            $('#kode_barang').prop('disabled', true).html('<option value="">Pilih Barang/Jasa</option>');
        }
    });

    // When barang is selected
    $('#kode_barang').change(function() {
        const kodeBarang = $(this).val();
        if(kodeBarang) {
            $.ajax({
                url: `{{ url('back/get-harga') }}/${kodeBarang}`,
                type: 'GET',
                success: function(data) {
                    $('#harga_satuan').val(data.harga_satuan);
                }
            });
        } else {
            $('#harga_satuan').val('');
        }
    });

    // Add validation for budget limit
    $('#jumlah').on('input', function() {
        const jumlah = $(this).val();
        const hargaSatuan = $('#harga_satuan').val().replace(/[^0-9]/g, '');
        const totalCost = jumlah * hargaSatuan;

        if(totalCost > budgetLimit) {
            alert('Total melebihi anggaran yang tersedia!');
            $(this).val('');
        }
    });

});
</script>
@include('layouts.back.footer')
@endsection
