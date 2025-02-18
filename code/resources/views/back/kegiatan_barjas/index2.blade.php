@extends('layouts.back.header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title') @endsection
@section('content')
<div class="container mt-5">
    <div class="card">
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
              <h6>Data Kegiatan</h6>
              <button class="btn btn-primary" onclick="showModal('kegiatan')" style="float:right"><i class="fa fa-plus"></i> Tambah Kegiatan</button>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table table-hover align-items-center mb-0 ">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kode Kegiatan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Uraian Kegiatan</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $i=(($dtkegiatan->currentPage()-1)*$dtkegiatan->perPage()+1)-1;
                    @endphp
                    @foreach ($dtkegiatan as $dt)
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
                            <h6 class="mb-0 text-sm">{{ $dt->kode_kegiatan }}</h6>
                          </div>
                        </div>
                      </td>
                    <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $dt->uraian_kegiatan }}</h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center">
                        {{-- <a class="btn btn-fill btn-info" href="{{ route("limit_nominal.edit",[$dt->id]) }}" title='View Detail'><i class="fa fa-eye"></i></a> --}}
                        <form onsubmit="return confirm('Anda Yakin untuk Menghapus Data Ini ?')" class="d-inline" action="{{ route('kegiatan.destroy',[$dt->id]) }}" method="post">
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

                    {{$dtkegiatan->appends(Request::all())->links("pagination::bootstrap-4")}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6>Data Inventaris Barang</h6>
            <button class="btn btn-primary" onclick="showModal('ket_barang')"><i class="fa fa-plus"></i> Tambah Barang</button>
        </div>
        <div class="card-body">
            @foreach($dtbarang as $dt)
            <div class="ket_barang-item mb-3">
                <div class="d-flex align-items-center">
                    <button class="btn btn-link" type="button" onclick="toggleCollapse(this)"
                            data-bs-target="#barang{{ $dt->id }}">
                        <i class="fa fa-chevron-right"></i>
                    </button>
                    <span class="ms-2">{{ $dt->kode_ketbarang }} - {{ $dt->ket_barang }}</span>
                    <div class="ms-auto">
                    @if($dt->rekening->isEmpty())
                        <button class="btn btn-sm btn-danger" onclick="deleteKetBarang({{ $dt->id }})">
                            <i class="fa fa-trash"></i>
                        </button>
                    @endif
                        <button class="btn btn-sm btn-success" onclick="showModal('rekening', {{ $dt->id }})">
                            Tambah Rekening
                        </button>
                    </div>
                </div>

                <div class="collapse ms-4" id="barang{{ $dt->id }}">
                    @foreach($dt->rekening as $rek)
                    <div class="rekening-item mt-2">
                        <div class="d-flex align-items-center">
                            <button class="btn btn-link" type="button" onclick="toggleCollapse(this)"
                                    data-bs-target="#rekening{{ $rek->id }}">
                                <i class="fa fa-chevron-right"></i>
                            </button>
                            <span class="ms-2">{{ $rek->kode_rekening }} - {{ $rek->ket_rekening }}</span>
                            <div class="ms-auto">
                                @if($rek->barang->isEmpty())
                                {{-- <button class="btn btn-sm btn-warning" onclick="editRekening({{ $rek->id }})">
                                    <i class="fa fa-edit"></i>
                                </button>--}}

                                <button class="btn btn-sm btn-danger" onclick="deleteRekening({{ $rek->id }})">
                                    <i class="fa fa-trash"></i>
                                </button>
                                @endif
                                <button class="btn btn-sm btn-success" onclick="showModal('barang', {{ $rek->id }})">
                                    Tambah Nama Barang
                                </button>
                            </div>
                        </div>
                            <div class="collapse ms-4" id="rekening{{ $rek->id }}">
                                @foreach($rek->barang as $brg)
                                <div class="barang-item mt-2">
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-link" type="button" onclick="toggleCollapse(this)"
                                                data-bs-target="#barang{{ $brg->id }}">
                                            <i class="fa fa-chevron-right"></i>
                                        </button>
                                        <span class="ms-2">{{ $brg->kode_rekening }} - {{ $brg->nama_barang }} (Harga Satuan Rp @currency($brg->harga_satuan))</span>
                                        <div class="ms-auto">
                                            {{-- <button class="btn btn-sm btn-warning" onclick="editBarang({{ $brg->id }})">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="deleteBarang({{ $brg->id }})">
                                                <i class="fa fa-trash"></i>
                                            </button> --}}

                                        </div>
                                    </div>


                                    <!-- Similar structure for barang -->
                                </div>
                                @endforeach
                            </div>

                        <!-- Similar structure for belanja and barang -->
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Modal for all forms -->
<div class="modal fade" id="formModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="dataForm">
                    @csrf
                    <input type="hidden" id="formId">
                    <input type="hidden" id="formType">
                    <input type="hidden" id="parentId">
                    <div id="formFields">
                        <!-- Dynamic form fields will be inserted here -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveData()">Save</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
// Add this function to toggle the collapse state
function toggleCollapse(button) {
    const target = $(button).data('bs-target');
    const icon = $(button).find('.fa');

    // Toggle the collapse
    $(target).collapse('toggle');
}

// Add these event listeners when document is ready
$(document).ready(function() {
    // Handle collapse show event
    $('.collapse').on('show.bs.collapse', function() {
        const buttonIcon = $(`[data-bs-target="#${$(this).attr('id')}"]`).find('.fa');
        buttonIcon.removeClass('fa-chevron-right').addClass('fa-chevron-down');
    });

    // Handle collapse hide event
    $('.collapse').on('hide.bs.collapse', function() {
        const buttonIcon = $(`[data-bs-target="#${$(this).attr('id')}"]`).find('.fa');
        buttonIcon.removeClass('fa-chevron-down').addClass('fa-chevron-right');
    });
});

function formatCurrency(number) {
    return new Intl.NumberFormat('id-ID').format(number);
}
const formFields = {
     kegiatan: `
        <div class="mb-3">
            <label class="form-label">Kode Kegiatan</label>
            <input type="text" class="form-control" name="kode_kegiatan" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Uraian Kegiatan</label>
            <input type="text" class="form-control" name="uraian_kegiatan" required>
        </div>
    `,
    ket_barang: `
        <div class="mb-3">
            <label class="form-label">Kode Barang</label>
            <input type="text" class="form-control" name="kode_ketbarang" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Keterangan Barang</label>
            <input type="text" class="form-control" name="ket_barang" required>
        </div>
    `,
    rekening: `
        <input type="hidden" name="kode_ketbarang" id="kode_ketbarang_input">
        <div class="mb-3">
            <label class="form-label">Kode Rekening</label>
            <input type="text" class="form-control" name="kode_rekening" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Keterangan Rekening</label>
            <input type="text" class="form-control" name="ket_rekening" required>
        </div>
    `,
    barang: `
        <input type="hidden" name="kode_rekening" id="kode_rekening_input">
        <div class="mb-3">
            <label class="form-label">Nama Barang</label>
            <input type="text" class="form-control" name="nama_barang" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Harga Satuan</label>
            <input type="text" class="form-control" name="harga_satuan" required
                   onkeyup="formatHargaSatuan(this)"
                   onchange="formatHargaSatuan(this)">
        </div>
    `
};

function showLoading(message = 'Processing...') {
    Swal.fire({
        title: message,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
}

function showSuccess(message) {
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: message,
        timer: 1500
    });
}

function showError(message) {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: message
    });
}

// Add function to format harga_satuan input
function formatHargaSatuan(input) {
    // Remove non-digits and convert to number
    let value = parseInt(input.value.replace(/\D/g, '')) || 0;

    if(value > 1000000000){
        showError('Harga terlalu besar');
        value = 0;
    }
    // Format the number with thousand separator
    input.value = formatCurrency(value);
}

function showModal(type, parentId = null) {
    $('#formType').val(type);
    $('#parentId').val(parentId);
    $('#formId').val('');
    $('#formFields').html(formFields[type]);

    // Set parent ID in hidden input
    if (parentId) {
        switch(type) {
            case 'rekening':
                $('#kode_ketbarang_input').val(parentId);
                break;
            case 'barang':
                $('#kode_rekening_input').val(parentId);
                break;
        }
    }
    if(type=="ket_barang"){
        $('.modal-title').text(`Tambah Barang`);
    }else{
        $('.modal-title').text(`Tambah ${type.charAt(0).toUpperCase() + type.slice(1)}`);
    }

    $('#formModal').modal('show');

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });

    //Toast.fire({
    //    icon: 'info',
    //    title: `Menambah ${type}`
    //  });
}

function editKetBarang(id) {
    editItem('ket_barang', id);
}

function deleteKetBarang(id) {
    deleteItem('ket_barang', id);
}

function deleteRekening(id) {
    deleteItem('rekening', id);
}

function editItem(type, id) {
    $.get(`/back/${type}/${id}`, function(response) {
        if (!response || !response.data || typeof response.data !== 'object') {
            console.log(response);
            return;
        }
        $('#formType').val(type);
        $('#formId').val(id);
        $('#formFields').html(formFields[type]);

        // Fill form with data
        Object.keys(response.data).forEach(key => {
           if (key === 'harga_satuan') {
                // Format harga_satuan with currency format
                $(`[name="${key}"]`).val(formatCurrency(response.data[key]));
            } else {
                $(`[name="${key}"]`).val(response.data[key]);
            }
        });

        $('.modal-title').text(`Edit ${type.charAt(0).toUpperCase() + type.slice(1)}`);
        $('#formModal').modal('show');
    });
}

function deleteItem(type, id) {
    let modifiedType = type !== 'ket_barang' ? type + '1' : type;

    if (confirm('Are you sure you want to delete this item?')) {
        $.ajax({
            url: `/back/${modifiedType}/${id}`,
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    showSuccess('Berhasil dihapus.');
                    setTimeout(()=>{
                        location.reload();
                    },1500);

                }
            },
            error: function(xhr){
                showError('Failed to delete item');
            }

        });
    }
}

function saveData() {
    let type = $('#formType').val();
    if (type !== 'ket_barang' && type !== 'kegiatan') {
        type = type + '1'; // Append '1' to the string
    }
    const id = $('#formId').val();
    const url = id ? `/back/${type}/${id}` : `/back/${type}`;
    const method = id ? 'PUT' : 'POST';

    let formData = new FormData($('#dataForm')[0]);

    if (type === 'barang') {
        let hargaSatuan = parseInt(formData.get('harga_satuan').replace(/\D/g, '')) || 0;
        formData.set('harga_satuan', hargaSatuan);
    }

    let data = {};
    formData.forEach((value, key) => {
        data[key] = value;
    });

    showLoading('Proses...');

    $.ajax({
        url: url,
        method: method,
        //data: $('#dataForm').serialize(),
        data: data,
        success: function(response) {
            if (response.success) {

                $('#formModal').modal('hide');
                showSuccess(id ? 'Berhasil diupdate' : 'Berhasil disimpan');
                location.reload();
            }
        },
        error: function(xhr) {
            //console.log('url:',url);
            const errors = xhr.responseJSON.errors;
            let errorMessage = 'Validation errors:\n';
            Object.keys(errors).forEach(key => {
                errorMessage += `${errors[key]}\n`;
            });
            showError(errorMessage);
        }
    });
}
</script>
@include('layouts.back.footer')
@endsection
