<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Belanja extends Model
{
    use HasFactory;
    protected $table = 'belanja';
    public $timestamps = false;
    protected $fillable = [
       'kode_belanja','kode_rekening','uraian_belanja'
    ];

    public function rekening()
    {
        return $this->belongsTo(Rekening::class, 'kode_rekening', 'kode_rekening');
    }

    public function barangs()
    {
        return $this->hasMany(Barang::class, 'kode_belanja', 'kode_belanja');
    }
}
