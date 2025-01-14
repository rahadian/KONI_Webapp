<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perencanaan extends Model
{
    use HasFactory;
    protected $table = 'perencanaan';
    protected $fillable = [
       'kode_kegiatan','kode_rekening','kode_belanja','kode_barang','harga_satuan','jumlah','satuan','bulan','tahun_anggaran','cabor','status'
    ];
}
