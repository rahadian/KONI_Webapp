<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatih extends Model
{
    use HasFactory;
    protected $table = 'pelatih';
    protected $fillable = [
       'id_cabor','nik', 'nama_lengkap','jenis_kelamin','kota_lahir','tanggal_lahir','npwp','foto','sertifikat','ktp','created_at','updated_at'
    ];
}
