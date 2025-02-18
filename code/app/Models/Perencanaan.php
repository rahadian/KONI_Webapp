<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perencanaan extends Model
{
    use HasFactory;
    protected $table = 'perencanaan';
    protected $fillable = [
       'kode_kegiatan','kode_rekening','kode_belanja','kode_ketbarang','id_nama_barang','id_pengajuan_perencanaan','harga_satuan','jumlah','satuan','bulan','tahun_anggaran','cabor','status','keterangan','verified_by'
    ];
}
