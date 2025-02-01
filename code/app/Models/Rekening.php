<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;
    protected $table = 'rekening';
    public $timestamps = false;
    protected $fillable = [
       'kode_rekening','kode_kegiatan','uraian_rekening'
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kode_kegiatan', 'kode_kegiatan');
    }
    public function belanjas()
    {
        return $this->hasMany(Belanja::class, 'kode_rekening', 'kode_rekening');
    }
}
