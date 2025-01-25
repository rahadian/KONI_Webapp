@extends('layouts.back.header')
@section('title') Detail Data Belanja @endsection
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
                       <h6 class="mb-0">Detail Data Belanja - {{ $nama_cabor }}</h6>
                   </div>
               </div>

               <div class="card-body">
                   <div class="mb-4">
                       <h6 class="text-uppercase">Bulan {{ $months[$month] }} {{ $year }}</h6>
                       <div class="table-responsive">
                           <table class="table table-hover align-items-center mb-0" data-toggle="table">
                               <thead>
                                   <tr>
                                       <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                       <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                                       <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah</th>
                                       <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga Satuan</th>
                                       <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Harga</th>
                                       <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Detail</th>
                                       <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pajak</th>
                                       <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Transaksi</th>
                                       <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created at</th>
                                       <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                   </tr>
                               </thead>
                               <tbody>
                                   @php $index = 1; @endphp
                                   @foreach($data as $item)
                                       <tr data-item-id="{{ $item->id }}">
                                           <td class="ps-4"><span class="text-secondary text-xs">{{ $index++ }}</span></td>
                                           <td><span class="text-secondary text-xs">{{ $item->nama_barang }}</span></td>
                                           <td><span class="text-secondary text-xs">{{ $item->jumlah }}</span></td>
                                           <td><span class="text-secondary text-xs">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</span></td>
                                           <td><span class="text-secondary text-xs">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</span></td>
                                           <td><span class="text-secondary text-xs">{{ $item->detail }}</span></td>
                                           <td><span class="text-secondary text-xs">{{ $item->pajak }}</span></td>
                                           <td><span class="text-secondary text-xs">{{ $item->tanggal_transaksi }}</span></td>
                                           <td><span class="text-secondary text-xs">{{ $item->created_at->format('d/m/Y') }}</span></td>
                                           <td>
                                               @if(Auth::user()->role == "cabor")
                                                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editBudgetModal{{ $item->id }}"><i class="fa fa-pen"></i></button>
                                                   <form onsubmit="return confirm('Anda Yakin untuk Menghapus Data Ini ?')" class="d-inline" action="{{ route('belanja.destroy', $item->id) }}" method="post">
                                                       @csrf
                                                       @method('DELETE')
                                                       <button type="submit" class="btn btn-danger"><i class="fa fa-trash" style="font-size: 19px;"></i></button>
                                                   </form>
                                               @endif
                                           </td>
                                       </tr>

                                       <div class="modal fade" id="editBudgetModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editBudgetModalLabel{{ $item->id }}" aria-hidden="true">
                                           <div class="modal-dialog" role="document">
                                               <div class="modal-content">
                                                   <div class="modal-header">
                                                       <h5 class="modal-title" id="editBudgetModalLabel{{ $item->id }}">Ubah Belanja</h5>
                                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                           <span aria-hidden="true">&times;</span>
                                                       </button>
                                                   </div>
                                                   <form action="{{ route('belanja.update', $item->id) }}" method="POST">
                                                       @csrf
                                                       @method('PUT')
                                                       <div class="modal-body">
                                                           <input type="hidden" name="month" value="{{ $month }}">
                                                           <input type="hidden" name="item_id" id="item_id" value="{{ $item->id }}">
                                                           <input type="hidden" name="harga_satuan" id="harga_satuan{{ $item->id }}">

                                                           <div class="form-group">
                                                               <label for="id_perencanaan">Data Barang</label>
                                                               <select class="form-control perencanaan-select" id="id_perencanaan" name="id_perencanaan" data-item-id="{{ $item->id }}">
                                                                   <option value="">Pilih Data Barang</option>
                                                                   <hr>
                                                                   @foreach($perencanaan as $pr)
                                                                       <option value="{{ $pr->id }}" data-harga="{{ $pr->harga_satuan }}" data-jumlah="{{ $pr->jumlah }}">
                                                                           {{ $pr->kode_barang }} - {{ $pr->nama_barang }} Rp {{ number_format($pr->harga_satuan, 0, ',', '.') }} - {{ $pr->jumlah }}
                                                                       </option>
                                                                   @endforeach
                                                               </select>
                                                           </div>

                                                           <div class="form-group">
                                                               <label for="tanggal_transaksi">Tanggal Transaksi</label>
                                                               <input type="date" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi" value="{{ $item->tanggal_transaksi }}" min="{{ $year }}-{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}-01" max="{{ $year }}-{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}-{{ date('t', strtotime("$year-$month-01")) }}">
                                                           </div>

                                                           <input type="hidden" class="form-control" id="jumlahsaatini{{ $item->id }}" name="jumlahsaatini" value="{{ $item->jumlah }}">
                                                           <div class="form-group">
                                                               <label for="jumlah">Jumlah</label>
                                                               <input type="number" class="form-control" id="jumlah{{ $item->id }}" name="jumlah" min="1" value="{{ $item->jumlah }}">
                                                               <small class="text-muted">Saat ini : {{ $item->jumlah }} | Maksimal: <span id="max-jumlah{{ $item->id }}">-</span></small>
                                                           </div>

                                                           <div class="form-group">
                                                               <label for="detail">Detail</label>
                                                               <textarea class="form-control" id="detail" name="detail" rows="3">{{ $item->detail }}</textarea>
                                                           </div>

                                                           <div class="form-group">
                                                               <label for="pajak">Pajak</label>
                                                               <select class="form-control" id="pajak" name="pajak">
                                                                   <option value="{{ $item->pajak }}">{{ $item->pajak }}</option>
                                                                   <hr>
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
                               </tbody>
                               <tfoot>
                                   <tr>
                                       {{-- <td colspan="4" class="text-end"><strong>Total Belanja {{ $month }}:</strong></td> --}}
                                       {{-- <td colspan="3"><strong>Rp {{ number_format($monthlyData['total'], 0, ',', '.') }}</strong></td> --}}
                                   </tr>
                               </tfoot>
                           </table>
                       </div>
                   </div>
                   <a href="{{ route('belanja.index') }}" class="btn btn-danger btn-fill pull-left">Kembali</a>
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

    // Attach event listeners to each select element
    perencanaanSelects.forEach(select => {
        select.addEventListener('change', function(event) {
            const itemKey = event.target.dataset.itemId;
            const hargaInput = document.getElementById(`harga_satuan${itemKey}`);
            const jumlahInput = document.getElementById(`jumlah${itemKey}`);
            const maxJumlahSpan = document.getElementById(`max-jumlah${itemKey}`);
            const jumlahSaatIniInput = document.getElementById(`jumlahsaatini${itemKey}`);

            const selectedOption = this.options[this.selectedIndex];
            const hargaSatuan = selectedOption.dataset.harga || 0;
            const jumlah = selectedOption.dataset.jumlah || 0;

            // Set harga satuan and update jumlah input
            hargaInput.value = hargaSatuan;
            jumlahInput.value = '';
            maxJumlahSpan.textContent = 'Loading...';

            // Fetch remaining stock for the selected item
            fetch(`/back/check-jumlah-barang/${this.value}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
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
                    const maxJumlah = item.remaining + parseInt(jumlahSaatIniInput.value);

                    // Update UI with the remaining stock
                    maxJumlahSpan.textContent = maxJumlah;
                    jumlahInput.max = maxJumlah;

                    // Validate jumlah input in real-time
                    jumlahInput.addEventListener('input', function() {
                        if (parseInt(this.value) > maxJumlah) {
                            alert('Jumlah tidak boleh melebihi nilai maksimal.');
                            this.value = maxJumlah;
                        }
                    });
                })
                .catch(error => {
                    console.error('Error fetching remaining stock:', error);
                    maxJumlahSpan.textContent = 'Error';
                });
        });
    });
});
</script>
@endsection
