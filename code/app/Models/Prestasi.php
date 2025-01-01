<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;
    protected $table = 'prestasi';
    protected $fillable = [
       'id_cabor','nama_kejuaraan', 'tingkat_kejuaraan','waktu_kegiatan','perolehan_medali','foto_kegiatan','scan_piagam','scan_hasil_pertandingan','created_at','updated_at'
    ];
}
