<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    protected $table = 'kegiatan';
    public $timestamps = false;
    protected $fillable = [
       'kode_kegiatan','uraian_kegiatan'
    ];
    public function rekenings()
    {
        return $this->hasMany(Rekening::class, 'kode_kegiatan', 'kode_kegiatan');
    }
}
