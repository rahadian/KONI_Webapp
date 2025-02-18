<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atlit extends Model
{
    use HasFactory;
    protected $table = 'atlit';
    protected $fillable = [
       'id_cabor','jenis','nik', 'nama_lengkap','jenis_kelamin','ukuran_baju','ukuran_sepatu','kota_lahir','tanggal_lahir','npwp','foto','sertifikat','ktp','kk','created_at','updated_at'
    ];
}
