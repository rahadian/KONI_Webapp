@extends('layouts.back.header')
@section('title') @endsection
@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Data Inventaris</h4>
            <button class="btn btn-primary" onclick="showModal('kegiatan')">Tambah Kegiatan</button>
        </div>
        <div class="card-body">
            @foreach($kegiatans as $kegiatan)
            <div class="kegiatan-item mb-3">
                <div class="d-flex align-items-center">
                    <button class="btn btn-link" type="button" onclick="toggleCollapse(this)"
                            data-bs-target="#kegiatan{{ $kegiatan->id }}">
                        <i class="fa fa-chevron-down"></i>
                    </button>
                    <span class="ms-2">{{ $kegiatan->kode_kegiatan }} - {{ $kegiatan->uraian_kegiatan }}</span>
                    <div class="ms-auto">
                        {{-- <button class="btn btn-sm btn-warning" onclick="editKegiatan({{ $kegiatan->id }})">
                            <i class="fa fa-edit"></i>
                        </button> --}}
                        {{-- <button class="btn btn-sm btn-danger" onclick="deleteKegiatan({{ $kegiatan->id }})">
                            <i class="fa fa-trash"></i>
                        </button> --}}
                        <button class="btn btn-sm btn-success" onclick="showModal('rekening', {{ $kegiatan->id }})">
                            Tambah Rekening
                        </button>
                    </div>
                </div>

                <div class="collapse ms-4" id="kegiatan{{ $kegiatan->id }}">
                    @foreach($kegiatan->rekenings as $rekening)
                    <div class="rekening-item mt-2">
                        <div class="d-flex align-items-center">
                            <button class="btn btn-link" type="button" onclick="toggleCollapse(this)"
                                    data-bs-target="#rekening{{ $rekening->id }}">
                                <i class="fa fa-chevron-down"></i>
                            </button>
                            <span class="ms-2">{{ $rekening->kode_rekening }} - {{ $rekening->uraian_rekening }}</span>
                            <div class="ms-auto">
                                <button class="btn btn-sm btn-warning" onclick="editRekening({{ $rekening->id }})">
                                    <i class="fa fa-edit"></i>
                                </button>
                                {{-- <button class="btn btn-sm btn-danger" onclick="deleteRekening({{ $rekening->id }})">
                                    <i class="fa fa-trash"></i>
                                </button> --}}
                                <button class="btn btn-sm btn-success" onclick="showModal('belanja', {{ $rekening->id }})">
                                    Tambah Belanja
                                </button>
                            </div>
                        </div>
                            <div class="collapse ms-4" id="rekening{{ $rekening->id }}">
                                @foreach($rekening->belanjas as $belanja)
                                <div class="rekening-item mt-2">
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-link" type="button" onclick="toggleCollapse(this)"
                                                data-bs-target="#belanja{{ $belanja->id }}">
                                            <i class="fa fa-chevron-down"></i>
                                        </button>
                                        <span class="ms-2">{{ $belanja->kode_belanja }} - {{ $belanja->uraian_belanja }}</span>
                                        <div class="ms-auto">
                                            <button class="btn btn-sm btn-warning" onclick="editBelanja({{ $belanja->id }})">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            {{-- <button class="btn btn-sm btn-danger" onclick="deleteBelanja({{ $belanja->id }})">
                                                <i class="fa fa-trash"></i>
                                            </button> --}}
                                            <button class="btn btn-sm btn-success" onclick="showModal('barang', {{ $belanja->id }})">
                                                Tambah Barang
                                            </button>
                                        </div>
                                    </div>
                                        <div class="collapse ms-4" id="belanja{{ $belanja->id }}">
                                            @foreach($belanja->barangs as $barang)
                                            <div class="rekening-item mt-2">
                                                <div class="d-flex align-items-center">
                                                    <button class="btn btn-link" type="button" onclick="toggleCollapse(this)" data-bs-target="#barang{{ $barang->id }}">
                                                        <i class="fa fa-chevron-down"></i>
                                                    </button>
                                                    <span class="ms-2">{{ $barang->kode_barang }} - {{ $barang->nama_barang }} (Harga Satuan Rp @currency($barang->harga_satuan))</span>
                                                    <div class="ms-auto">
                                                        <button class="btn btn-sm btn-warning" onclick="editBarang({{ $barang->id }})">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        {{-- <button class="btn btn-sm btn-danger" onclick="deleteBarang({{ $barang->id }})">
                                                            <i class="fa fa-trash"></i>
                                                        </button> --}}

                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
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

    if ($(target).hasClass('show')) {
        icon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
    } else {
        icon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
    }

    $(target).collapse('toggle');
}
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
    rekening: `
        <input type="hidden" name="kode_kegiatan" id="kode_kegiatan_input">
        <div class="mb-3">
            <label class="form-label">Kode Rekening</label>
            <input type="text" class="form-control" name="kode_rekening" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Uraian Rekening</label>
            <input type="text" class="form-control" name="uraian_rekening" required>
        </div>
    `,
    belanja: `
        <input type="hidden" name="kode_rekening" id="kode_rekening_input">
        <div class="mb-3">
            <label class="form-label">Kode Belanja</label>
            <input type="text" class="form-control" name="kode_belanja" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Uraian Belanja</label>
            <input type="text" class="form-control" name="uraian_belanja" required>
        </div>
    `,
    barang: `
        <input type="hidden" name="kode_belanja" id="kode_belanja_input">
        <div class="mb-3">
            <label class="form-label">Kode Barang</label>
            <input type="text" class="form-control" name="kode_barang" required>
        </div>
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
                $('#kode_kegiatan_input').val(parentId);
                break;
            case 'belanja':
                $('#kode_rekening_input').val(parentId);
                break;
            case 'barang':
                $('#kode_belanja_input').val(parentId);
                break;
        }
    }

    $('.modal-title').text(`Add ${type.charAt(0).toUpperCase() + type.slice(1)}`);
    $('#formModal').modal('show');

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });

    Toast.fire({
        icon: 'info',
        title: `Menambah ${type}`
    });
}

function editItem(type, id) {
    $.get(`/back/${type}/${id}`, function(response) {
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
    if (confirm('Are you sure you want to delete this item?')) {
        $.ajax({
            url: `/back/${type}/${id}`,
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
    const type = $('#formType').val();
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
