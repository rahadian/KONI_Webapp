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
                                    {{-- Jumlah Item: {{ $data['count'] }} --}}
                            </p>
                            <a href="{{ route("belanja2.show",[$currentYear,$key]) }}" class="btn btn-info">
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
                                        <input type="hidden" name="harga_satuan" id="harga_satuan">

                                        <div class="form-group">
                                            <label for="id_perencanaan">Data Barang</label>
                                            <select class="form-control" id="id_perencanaan" name="id_perencanaan" required>
                                                <option value="">Pilih Data Barang</option>
                                                @foreach($perencanaan[$key] as $item)
                                                    <option value="{{ $item->id }}" data-harga="{{ $item->harga_satuan }}">{{ $item->kode_barang }} - {{ $item->nama_barang }} Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="tanggal">Tanggal Transaksi</label>
                                            <input type="date" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi" required min="{{ $currentYear }}-{{ str_pad($key, 2, '0', STR_PAD_LEFT) }}-01"max="{{ $currentYear }}-{{ str_pad($key, 2, '0', STR_PAD_LEFT) }}-{{ date('t', strtotime("$currentYear-$key-01")) }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="jumlah">Jumlah</label>
                                            <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="detail">Detail</label>
                                            <textarea class="form-control" id="detail" name="detail" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="pajak">Pajak</label>
                                            <select class="form-control" id="pajak" name="pajak" required>
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
    document.getElementById('id_perencanaan').addEventListener('change', function () {
        // Get the selected option
        const selectedOption = this.options[this.selectedIndex];
        // Get the data-harga attribute value
        const hargaSatuan = selectedOption.getAttribute('data-harga');
        // Set the value of the hidden input field
        document.getElementById('harga_satuan').value = hargaSatuan || '';
    });
</script>
@endsection
