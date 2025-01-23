@extends('layouts.back.header')
@section('title') @endsection
@section('content')
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Tambah Data</h6>
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
            </div>

            <div class="card-body pb-0">
            <form enctype="multipart/form-data" method="POST" action="{{ route('limit_nominal.store') }}" class="style-form">
                @csrf

                <input type="hidden" class="form-control" id="username" name="username" value="{{ $user->username }}" required >

                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <select name="tahun" id="year" class="form-control w-10" required>
                        @for ($year = now()->year +1; $year >= 2023; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group" id="cabor-container">
                    <label for="cabor">Cabor</label>
                    <select id="cabor" name="cabor" class="form-control select border rounded w-10" required>
                        <option value="">Pilih Jenis Cabor</option>
                        @foreach($cabor as $key => $value)
                            <option value="{{ $value->nama_cabor }}">{{ $value->nama_cabor }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="form-group">
                    <label for="nominal">Nominal</label>
                    <input type="number" class="form-control" id="nominal" name="nominal" min="0" required>
                </div> --}}
                <div class="form-group">
                    <label for="nominal">Nominal</label>
                    <input type="text" class="form-control w-10" id="nominal" name="nominal" required>
                </div>
                <div class="form-group" id="smt1">
                    <label for="smt1">Semester 1</label>
                    <input type="text" class="form-control w-10" id="semester1" name="semester1" required>
                </div>
                <div class="form-group" id="smt2">
                    <label for="smt2">Semester 2</label>
                    <input type="text" class="form-control w-10" id="semester2" name="semester2" required>
                </div>

                <button type="submit" class="btn btn-primary" id='buttonsubmit'>Simpan</button>
                <a href="{{ route('limit_nominal.index') }}" class="btn btn-danger btn-fill pull-left">Kembali</a>
            </form>
            </div>
          </div>
        </div>
      </div>

@include('layouts.back.footer')
<script>
   const nominalInput = document.getElementById('nominal');
    const smst1Input = document.getElementById('semester1');
    const smst2Input = document.getElementById('semester2');
    const form = document.querySelector('form');
    const submitButton = document.getElementById('buttonsubmit');

    // Helper function to parse formatted number string
    function parseFormattedNumber(str) {
        return parseInt(str.replace(/\D/g, '')) || 0;
    }

    // Helper function to format number
    function formatNumber(num) {
        return new Intl.NumberFormat('id-ID').format(num);
    }

    // Helper function to validate semester values
    function validateSemesters() {
        const nominal = parseFormattedNumber(nominalInput.value);
        const sem1 = parseFormattedNumber(smst1Input.value);
        const sem2 = parseFormattedNumber(smst2Input.value);

        const isValid = (sem1 + sem2) === nominal;

        // Visual feedback
        const errorClass = 'border-danger';
        [smst1Input, smst2Input].forEach(input => {
            if (!isValid) {
                input.classList.add(errorClass);
            } else {
                input.classList.remove(errorClass);
            }
        });

        // Show/hide error message
        let errorDiv = document.getElementById('semester-error');
        if (!errorDiv) {
            errorDiv = document.createElement('div');
            errorDiv.id = 'semester-error';
            errorDiv.className = 'alert alert-danger mt-2';
            errorDiv.style.display = 'none';
            smst2Input.parentNode.appendChild(errorDiv);
        }

        errorDiv.textContent = 'Nilai total semester harus sama dengan nilai nominal';
        errorDiv.style.display = isValid ? 'none' : 'block';
        errorDiv.style.color = isValid ? 'black' : 'white';

        // Show/hide submit button based on validation
        submitButton.style.display = isValid ? 'inline-block' : 'none';

        return isValid;
    }

    // Handle nominal input
    nominalInput.addEventListener('input', () => {
        let value = parseFormattedNumber(nominalInput.value);
        nominalInput.value = formatNumber(value);

        // Auto-fill semesters with half the nominal value
        if (value > 0) {
            const halfValue = Math.floor(value / 2);
            const remainder = value % 2;
            smst1Input.value = formatNumber(halfValue + remainder); // Add remainder to first semester
            smst2Input.value = formatNumber(halfValue);
        } else {
            smst1Input.value = '';
            smst2Input.value = '';
        }

        validateSemesters();
    });

    // Handle semester inputs
    [smst1Input, smst2Input].forEach(input => {
        input.addEventListener('input', () => {
            let value = parseFormattedNumber(input.value);
            input.value = formatNumber(value);
            validateSemesters();
        });
    });

    // Form submission validation
    form.addEventListener('submit', (e) => {
        if (!validateSemesters()) {
            e.preventDefault();
        }
    });

    // Initial validation on page load
    validateSemesters();
</script>
@endsection
