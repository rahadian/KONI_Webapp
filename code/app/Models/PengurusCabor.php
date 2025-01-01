<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengurusCabor extends Model
{
    use HasFactory;
    protected $table = 'pengurus_cabor';
    protected $fillable = [
       'id_cabor','nik', 'nama_lengkap','jenis_kelamin','kota_lahir','tanggal_lahir','npwp','foto','created_at','updated_at'
    ];
}
