<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .school-info {
            margin-bottom: 30px;
        }

        .info-row {
            display: flex;
            margin-bottom: 8px;
        }

        .label {
            width: 120px;
            font-weight: normal;
        }

        .colon {
            margin: 0 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .amount {
            text-align: right;
        }

        .section-title {
            font-weight: bold;
            margin: 20px 0 10px;
        }

        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
            text-align: center;
        }

        .signature-box {
            width: 200px;
        }

        .signature-line {
            border-bottom: 1px solid #000;
            margin: 50px 0 10px;
        }

        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>RINCIAN KERTAS KERJA</h2>
        <h3>TAHUN ANGGARAN: {{ $data_pengajuan->tahun }}</h3>
    </div>

    <div class="school-info">
        <div class="info-row">
            <span class="label">Nama Lembaga</span>
            <span class="colon">:</span>
            <span>KONI Kabupaten Probolinggo - {{ $data_pengajuan->cabor }}</span>
        </div>
        <div class="info-row">
            <span class="label">Alamat</span>
            <span class="colon">:</span>
            <span>Jl. Suroyo No. 49 Kota Pobolinggo</span>
        </div>

    </div>

    <div class="section-title">A. PENERIMAAN</div>
    <table>
        <thead>
            <tr>
                <th>No. Kode</th>
                <th>Penerimaan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td>Semester 1</td>
                <td class="amount">{{ number_format($datanominal->semester1, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Semester 2</td>
                <td class="amount">{{ number_format($datanominal->semester2, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Total Penerimaan</strong></td>
                <td class="amount"><strong>{{ number_format($datanominal->nominal, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">B. BELANJA</div>
    <table>
        <thead>
            <tr>
                <th>No. Urut</th>
                <th>Kode Kegiatan</th>
                <th>Nama Kegiatan</th>
                <th>Kode Kode Rekening</th>
                <th>Nama Barang</th>
                <th>Volume</th>
                <th>Satuan</th>
                <th>Tarif Harga</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @php
                $prevKodeKegiatan = '';
                $prevNamaKegiatan = '';
            @endphp
            @foreach ($data_rencana as $dt)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $dt->kode_kegiatan !== $prevKodeKegiatan ? $dt->kode_kegiatan : '' }}</td>
                <td>{{ $dt->uraian_kegiatan !== $prevNamaKegiatan ? $dt->uraian_kegiatan : '' }}</td>
                <td>{{ $dt->kode_rekening }}</td>
                <td>{{ $dt->nama_barang }}</td>
                <td>{{ $dt->jumlah }}</td>
                <td>{{ $dt->satuan }}</td>
                <td class="amount">{{ number_format($dt->harga_satuan, 0, ',', '.') }}</td>
                <td class="amount">{{ number_format($dt->harga_satuan * $dt->jumlah, 0, ',', '.') }}</td>
            </tr>
             @php
                $prevKodeKegiatan = $dt->kode_kegiatan;
                $prevNamaKegiatan = $dt->uraian_kegiatan;
            @endphp
            @endforeach
            <tr>
                <td colspan="8" style="text-align: right;"><strong>Total</strong></td>
                <td class="amount"><strong>{{ number_format($data_rencana->sum(function($item) {
                    return $item->harga_satuan * $item->jumlah;
                }), 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div style="text-align: right; margin: 20px 50px;">
        <p>Probolinggo, {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}</p>
    </div>


    <div class="signatures">
        <div class="signature-box">
            <div>Sekretaris</div>
            <div class="signature-line"></div>
            <div>Nama Sekretaris</div>
        </div>
        <div class="signature-box">
            <div>Ketua</div>
            <div class="signature-line"></div>
            <div>Nama Ketua</div>
            <div></div>
        </div>
        <div class="signature-box">
            <div>Bendahara</div>
            <div class="signature-line"></div>
            <div>Nama Bendahara</div>
            <div></div>
        </div>
    </div>

    {{-- <div class="footer">
        <div>Kertas Kerja perBulan - NPSN: 20546848, Nama Sekolah: SMP NEGERI 2 GENDING</div>
        <div>Halaman 1 dari 5</div>
    </div> --}}
</body>
</html>
