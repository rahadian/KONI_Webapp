<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bumdes extends Model
{
    use HasFactory;
    protected $table = 'bumdes';
    protected $fillable = [
       'tipe_bumdes','kecamatan', 'kelurahan_desa','nama_bumdes','status_bumdes','status_bumdes','keikutsertaan_desa','bisnis_sosial','jasa_penyewaan','perdagangan','keuangan','perantara','usaha','pariwisata','tahun_pendirian','total_pekerja','nama_ketua_pelaksana','nama_ketua_bumdes','nama_sekretaris','nama_bendahara','jumlah_anggota_bumdes','email_bumdes'
    ];
}
