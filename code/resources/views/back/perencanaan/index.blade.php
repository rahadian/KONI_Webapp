@extends('layouts.back.header')
@section('title') Data Perencanaan @endsection
<meta name="csrf-token" content="{{ csrf_token() }}">
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
                        <div>
                        <h6 class="mb-0">Data Perencanaan</h6>
                        @if($check_pengajuan)
                            <span class="badge
                                {{ $check_pengajuan->status == 1 ? 'bg-success' : ($check_pengajuan->status == 2 ? 'bg-danger' : 'bg-warning') }}">
                                {{ $check_pengajuan->status == 1 ? 'Pengajuan Disetujui' : ($check_pengajuan->status == 2 ? 'Pengajuan Direvisi: '. $check_pengajuan->catatan :'Pengajuan Belum Diverifikasi') }}
                            </span>
                        @endif
                        </div>
                        @if(Auth::user()->role == "cabor"||Auth::user()->role == "staff")
                            <div>
                            @if(!$check_pengajuan || ($check_pengajuan->status ?? null) == 2)
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBudgetModal">
                                <i class="fa fa-plus"></i> Tambah Data
                            </button>
                            <button type="button" id="ajukanPerencanaanBtn" class="btn btn-warning" data-tahun="{{ $year_periode->tahun }}" data-cabor="{{ $nama_cabor }}">Ajukan Perencanaan</button>
                            @elseif($check_pengajuan->status==1)
                            <button id="detail-button" class="btn btn-primary">RINCIAN KERTAS KERJA</button>
                            @endif
                            </div>
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Barang</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rekening</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga Satuan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bulan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tahun</th>
                                    {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th> --}}
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
                                    <td><span class="text-secondary text-xs">{{ $dt->kode_ketbarang }} - {{ $dt->ket_barang }}</span></td>
                                    <td><span class="text-secondary text-xs">{{ $dt->kode_rekening }} - {{ $dt->ket_rekening }}</span></td>
                                    <td><span class="text-secondary text-xs">{{ $dt->nama_barang }}</span></td>
                                    <td><span class="text-secondary text-xs">Rp {{ number_format($dt->harga_satuan, 0, ',', '.') }}</span></td>
                                    <td><span class="text-secondary text-xs">{{ $dt->bulan }}</span></td>
                                    <td><span class="text-secondary text-xs">{{ $dt->tahun_anggaran }}</span></td>
                                    {{-- <td>
                                        <span class="badge
                                            {{ $dt->status == 1 ? 'bg-success' : ($dt->status == 2 ? 'bg-danger' : 'bg-warning') }}">
                                            {{ $dt->status == 1 ? 'Disetujui' : ($dt->status == 2 ? 'Ditolak' : 'Belum Diverifikasi') }}
                                        </span>
                                    </td> --}}
                                    <td class="text-center"><span class="text-secondary text-xs">{{ $dt->created_at }}</span></td>
                                    <td class="text-center"><span class="text-secondary text-xs">{{ $dt->updated_at }}</span></td>

                                    <td class="text-center">
                                        @if(Auth::user()->role == "cabor"||Auth::user()->role == "staff")
                                            @if(!$check_pengajuan || ($check_pengajuan->status ?? null) == 2)
                                            {{-- @if($dt->status != 1) --}}
                                             {{-- <a class="btn btn-fill btn-info" href="" title='View Detail'><i class="fa fa-eye"></i></a> --}}
                                             <form onsubmit="return confirm('Anda Yakin untuk Menghapus Data Ini ?')" class="d-inline" action="{{ route('perencanaan.destroy',[$dt->id_perencanaan]) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-fill btn-danger"><i class="fa fa-trash" style="font-size: 19px;"></i></button>
                                            </form>
                                            {{-- @endif --}}
                                            @endif
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
                            {{-- @foreach($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach --}}
                            <option value="{{ $years }}">{{ $years }}</option>
                        </select>
                    </div>

                    <div class="alert alert-info" id="budget_info" style="display: none;">
                        <strong>Total Anggaran : <span id="total_limit">Rp 0</span></strong><br>
                        <strong>Total Anggaran Tersedia: <span id="sisa_anggaran">Rp 0</span></strong><br>
                        <strong>Total Anggaran Semester 1 Tersedia: <span id="sisa_anggaran_semester1">Rp 0</span></strong><br>
                        <strong>Total Anggaran Semester 2 Tersedia: <span id="sisa_anggaran_semester2">Rp 0</span></strong>
                    </div>

                    <div id="main_form_section" style="display: none;">
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
                        <div class="form-group mb-3">
                            <label>Kegiatan</label>
                            <div class="input-group">
                                <select class="form-control" id="kode_kegiatan" name="kode_kegiatan" required>
                                    <option value="">Pilih Kegiatan</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Jenis Barang</label>
                            <div class="input-group">
                                <select class="form-control" id="kode_ketbarang" name="kode_ketbarang" required>
                                    <option value="">Pilih Kode Barang</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Rekening</label>
                            <div class="input-group">
                                <select class="form-control" id="kode_rekening" name="kode_rekening" required disabled>
                                    <option value="">Pilih Rekening</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Nama Barang</label>
                            <div class="input-group">
                                <select class="form-control" id="id_nama_barang" name="id_nama_barang" required disabled>
                                    <option value="">Pilih Nama Barang</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Harga Satuan</label>
                                <input type="text" class="form-control" id="harga_satuan" name="harga_satuan">
                            </div>
                            <div class="col-md-6">
                                <label>Jumlah dan Satuan</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" placeholder="Jumlah" name="jumlah" id="jumlah" min="0">
                                    <input type="text" class="form-control" placeholder="Satuan" name="satuan">
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

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
const checkPengajuan = @json($check_pengajuan);
if (checkPengajuan?.id) {
    const buttonElement = document.getElementById("detail-button");
    if (buttonElement) {
        buttonElement.addEventListener("click", function () {
            const url = "/back/verifikasi-perencanaan/detaildata/" + checkPengajuan.id;
            window.open(url, "_blank"); // Opens the URL in a new tab
        });
    }
}

$('#ajukanPerencanaanBtn').click(function() {
    // Get values from data attributes
    const tahun = $(this).data('tahun');
    const namacabor = $(this).data('cabor');

    // Prepare the data to be sent
    const data = {
        tahun: tahun,
        cabor: namacabor,
        status: 0
    };

    Swal.fire({
        title: 'Apakah anda yakin?',
        text: 'Apakah anda yakin untuk mengajukan perencanaan?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Ajukan!',
        cancelButtonText: 'Batal'
    }).then((result)=>{
        if(result.isConfirmed){
                $.ajax({
                url: '/back/perencanaan/ajukan',
                type: 'POST',
                data: JSON.stringify(data),
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Perencanaan berhasil diajukan!'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: xhr.responseJSON?.message || 'Terjadi kesalahan saat mengajukan perencanaan'
                    });
                }
            });
        }
    })


});
document.addEventListener('DOMContentLoaded', function() {
    let budgetLimit = 0;
    let sisaAnggaranSemester1 = 0; // Declare in higher scope
    let sisaAnggaranSemester2 = 0; // Declare in higher scope
    const form = document.getElementById('budgetForm');
    const yearSelect = document.getElementById('tahun_anggaran');
    const hargaSatuanInput = document.getElementById('harga_satuan');

    hargaSatuanInput.addEventListener('input', function(e) {
        // Only process if the field is not readonly
        if (!this.readOnly) {
            // Remove non-numeric characters
            let value = this.value.replace(/[^\d]/g, '');

            // Format the number
            if (value) {
                value = parseInt(value, 10);
                this.value = numberFormat(value);
            }
        }
    });

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
                sisaAnggaranSemester1 = data['data']['sisa_semester1'];
                sisaAnggaranSemester2 = data['data']['sisa_semester2'];
                document.getElementById('total_limit').textContent =
                    `Rp ${new Intl.NumberFormat('id-ID').format(budgetLimit)}`;
                document.getElementById('sisa_anggaran').textContent =
                    `Rp ${new Intl.NumberFormat('id-ID').format(sisaAnggaran)}`;
                document.getElementById('sisa_anggaran_semester1').textContent =
                    `Rp ${new Intl.NumberFormat('id-ID').format(sisaAnggaranSemester1)}`;
                document.getElementById('sisa_anggaran_semester2').textContent =
                    `Rp ${new Intl.NumberFormat('id-ID').format(sisaAnggaranSemester2)}`;
                document.getElementById('budget_info').style.display = 'block';
                document.getElementById('main_form_section').style.display = 'block';
                loadKegiatanData();
                loadKetBarangData();
            } else {
                throw new Error('Failed to fetch budget limit');
            }
        } catch (error) {
            //alert('Error: Could not fetch budget limit');
            error.preventDefault && error.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Belum Ada Data Nominal untuk Tahun yang Dipilih.'
            });
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

    async function loadKetBarangData() {
        try {
            const response = await fetch('{{ route("get.ketbarang") }}');
            const data = await response.json();

            if (response.ok) {
                const options = data.map(item =>
                    `<option value="${item.kode_ketbarang}">${item.kode_ketbarang} - ${item.ket_barang}</option>`
                );
                document.getElementById('kode_ketbarang').innerHTML =
                    '<option value="">Pilih Kode Barang</option>' + options.join('');
            } else {
                throw new Error('Failed to fetch kode barang data');
            }
        } catch (error) {
            alert('Error: Could not load kode barang data');
        }
    }

    function resetForm() {
        document.getElementById('main_form_section').style.display = 'none';
        document.getElementById('budget_info').style.display = 'none';
        //budgetLimit = 0;
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

        // When ket barang is selected
    $('#kode_ketbarang').change(function() {
        const kodeKetBarang = $(this).val();
        //console.log(kodeKetBarang);
        if(kodeKetBarang) {
            $('#kode_rekening').prop('disabled', false);
            $.ajax({
                url: `{{ url('back/get-rekening1') }}/${kodeKetBarang}`,
                type: 'GET',
                success: function(data) {
                    let options = '<option value="">Pilih Rekening</option>';
                    data.forEach(function(item) {
                        options += `<option value="${item.kode_rekening}">${item.kode_rekening} - ${item.ket_rekening}</option>`;
                    });
                    $('#kode_rekening').html(options);
                }
            });
        } else {
            $('#kode_rekening').prop('disabled', true).html('<option value="">Pilih Rekening</option>');
            $('#kode_namabarang').prop('disabled', true).html('<option value="">Pilih Nama Barang</option>');
        }
    });

    // When rekening is selected
    $('#kode_rekening').change(function() {
        const kodeRekening = $(this).val();
        if(kodeRekening) {
            $('#id_nama_barang').prop('disabled', false);
            $.ajax({
                url: `{{ url('back/get-barang1') }}/${kodeRekening}`,
                type: 'GET',
                success: function(data) {
                    let options = '<option value="">Pilih Nama Barang</option>';
                    data.forEach(function(item) {
                        options += `<option value="${item.id}">${item.kode_rekening} - ${item.nama_barang}</option>`;
                    });
                    $('#id_nama_barang').html(options);
                }
            });
        } else {
            $('#id_nama_barang').prop('disabled', true).html('<option value="">Pilih Nama Barang</option>');
        }
    });



    function numberFormat(number, decimals = 0, decPoint = ',', thousandsSep = '.') {
        const fixedNumber = number.toFixed(decimals); // Ensure the number has the correct decimal places
        const parts = fixedNumber.split('.'); // Split the integer and decimal parts

        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSep); // Add thousands separator

        return parts.join(decPoint); // Join integer and decimal parts with the specified decimal point
    }

    // When nama barang is selected
    $('#id_nama_barang').change(function() {
        const idBarang = $(this).val();
        if(idBarang) {
            $.ajax({
                url: `{{ url('back/get-harga1') }}/${idBarang}`,
                type: 'GET',
                success: function(data) {
                    const hargaSatuanField = $('#harga_satuan');
                    if (data.harga_satuan && data.harga_satuan > 0) {
                        // If there's a valid price from server, set it and make readonly
                        hargaSatuanField.val(numberFormat(data.harga_satuan));
                        hargaSatuanField.prop('readonly', true);
                        //console.log(data.harga_satuan);
                    } else {
                        // If no valid price, clear field and make editable
                        hargaSatuanField.val('');
                        hargaSatuanField.prop('readonly', false);
                        //console.log(kodeBarang);
                    }
                },
                error: function() {
                    const hargaSatuanField = $('#harga_satuan');
                    hargaSatuanField.val('');
                    hargaSatuanField.prop('readonly', false);
                }
            });
        } else {
            //$('#harga_satuan').val('').prop('readonly', false);
            const hargaSatuanField = $('#harga_satuan');
            hargaSatuanField.val('');
            hargaSatuanField.prop('readonly', false);

        }
    });

    function isFirstSemester(month) {
        // Convert month string to number and check if it's in first semester (1-6)
        const monthNumber = parseInt(month);
        return monthNumber >= 1 && monthNumber <= 6;
    }

    // Add validation for budget limit
    $('#harga_satuan, #jumlah, #bulan').on('input', function() {
        const jumlah = $(this).val();
        const hargaSatuan = $('#harga_satuan').val().replace(/[^0-9]/g, '');
        const selectedMonth = $('#bulan').val();
        //const totalCost = jumlah * hargaSatuan;

        if (jumlah && hargaSatuan && selectedMonth) {
            const totalCost = jumlah * parseInt(hargaSatuan, 10);
            const isFirstSem = isFirstSemester(selectedMonth);
            const relevantBudget = isFirstSem ? sisaAnggaranSemester1 : sisaAnggaranSemester2;
            if(totalCost > relevantBudget) {
                console.log('totalCost:',totalCost);
                console.log('sisaAnggaranSemester1:',sisaAnggaranSemester1);
                console.log('relevantBudget:',relevantBudget);
                alert(`Total melebihi anggaran ${isFirstSem ? 'semester 1' : 'semester 2'} yang tersedia!`);
                if (this.id === 'jumlah') {
                    $('#jumlah').val('');
                } else if (this.id === 'harga_satuan') {
                    $('#harga_satuan').val('');
                }
            }
        }
    });

        $('#bulan').change(function() {
        // Trigger the validation when month changes
        $('#harga_satuan').trigger('input');
    });

});
</script>
@include('layouts.back.footer')
@endsection
