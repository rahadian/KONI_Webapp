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
                    <h2>{{ $currentYear->tahun }}</h2>
                    </div>
                </div>

                <div class="row">
                @foreach($monthlyData as $key => $data)
                    <div class="col-sm-3">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $data['name'] }}</h5>
                            <p class="card-text">
                                Total Belanja: Rp {{ number_format($data['total'], 0, ',', '.') }}<br>
                            </p>
                            <a href="{{ route('belanja2.show',[$currentYear->tahun,$key]) }}" class="btn btn-info">
                                Lihat Detail
                            </a>
                            @if(Auth::user()->role == "cabor")
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBudgetModal{{$key}}">
                                <i class="fa fa-plus"></i> Tambah Belanja
                            </button>
                            @endif
                        </div>
                        </div>
                    </div>

                    <!-- Modal for each month -->
                    <div class="modal fade" id="addBudgetModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="addBudgetModalLabel{{$key}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addBudgetModalLabel{{$key}}">Tambah Belanja - {{ $data['name'] }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('belanja.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="hidden" name="month" value="{{$key}}">
                                        <input type="hidden" name="harga_satuan" id="harga_satuan{{$key}}">

                                        <div class="form-group">
                                            <label for="id_perencanaan{{$key}}">Data Barang</label>
                                            <select class="form-control perencanaan-select" id="id_perencanaan{{$key}}" name="id_perencanaan" required data-month="{{$key}}">
                                                <option value="">Pilih Data Barang</option>
                                                @foreach($perencanaan[$key] as $item)
                                                    <option value="{{ $item->id }}" data-harga="{{ $item->harga_satuan }}" data-jumlah="{{ $item->jumlah }}">
                                                        {{ $item->kode_barang }} - {{ $item->nama_barang }} Rp {{ number_format($item->harga_satuan, 0, ',', '.') }} - {{ $item->jumlah }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="tanggal_transaksi{{$key}}">Tanggal Transaksi</label>
                                            <input type="date" class="form-control" id="tanggal_transaksi{{$key}}" name="tanggal_transaksi" required
                                                min="{{ $currentYear->tahun }}-{{ str_pad($key, 2, '0', STR_PAD_LEFT) }}-01"
                                                max="{{ $currentYear->tahun }}-{{ str_pad($key, 2, '0', STR_PAD_LEFT) }}-{{ date('t', strtotime("$currentYear->tahun-$key-01")) }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="jumlah{{$key}}">Jumlah</label>
                                            <input type="number" class="form-control" id="jumlah{{$key}}" name="jumlah" min="1" required>
                                            <small class="text-muted">Maksimal: <span id="max-jumlah{{$key}}">-</span></small>
                                        </div>

                                        <div class="form-group">
                                            <label for="detail{{$key}}">Detail</label>
                                            <textarea class="form-control" id="detail{{$key}}" name="detail" rows="3"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="pajak{{$key}}">Pajak</label>
                                            <select class="form-control" id="pajak{{$key}}" name="pajak" required>
                                                <option value="PPH 21">PPH 21</option>
                                                <option value="PPH 22">PPH 22</option>
                                                <option value="PPH 23">PPH 23</option>
                                                <option value="PPH FINAL">PPH FINAL</option>
                                                <option value="PPN">PPN</option>
                                                <option value="PAJAK DAERAH">PAJAK DAERAH</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.back.footer')

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all perencanaan select elements
    const perencanaanSelects = document.querySelectorAll('.perencanaan-select');

    perencanaanSelects.forEach(select => {
        // Handle change event for each select
        select.addEventListener('change', function() {
            const monthKey = this.getAttribute('data-month');
            const selectedId = this.value;
            const selectedOption = this.options[this.selectedIndex];
            const hargaSatuan = selectedOption.getAttribute('data-harga');

            // Update hidden harga_satuan input
            document.getElementById(`harga_satuan${monthKey}`).value = hargaSatuan || '';

            // Get related elements
            const jumlahInput = document.getElementById(`jumlah${monthKey}`);
            const maxJumlahSpan = document.getElementById(`max-jumlah${monthKey}`);

            // Reset values while loading
            jumlahInput.value = '';
            maxJumlahSpan.textContent = 'Loading...';

            // Fetch remaining stock data
            fetch(`/back/check-jumlah-barang/${selectedId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    console.log('Selected ID:', selectedId);
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        throw new Error(data.error);
                    }

                    if (!data.data || !data.data[0]) {
                        throw new Error('No data received');
                    }

                    const item = data.data[0];
                    const maxJumlah = item.remaining;

                    // Update UI with remaining stock
                    maxJumlahSpan.textContent = maxJumlah;
                    jumlahInput.max = maxJumlah;

                    // Clear input if it exceeds new maximum
                    if (parseInt(jumlahInput.value) > parseInt(maxJumlah)) {
                        jumlahInput.value = '';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    maxJumlahSpan.textContent = 'Error loading data';
                    jumlahInput.value = '';
                    jumlahInput.max = '';
                });
        });

        // Add input validation for jumlah
        const monthKey = select.getAttribute('data-month');
        const jumlahInput = document.getElementById(`jumlah${monthKey}`);

        jumlahInput.addEventListener('input', function() {
            const maxJumlahSpan = document.getElementById(`max-jumlah${monthKey}`);
            const maxJumlah = parseInt(maxJumlahSpan.textContent);
            const currentValue = parseInt(this.value);

            if (!isNaN(maxJumlah) && currentValue > maxJumlah) {
                this.value = maxJumlah;
            }
        });
    });
});
</script>
@endsection
