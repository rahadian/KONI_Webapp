<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KetBarang extends Model
{
    protected $table = 'ket_barang';
    public $timestamps = false;

    protected $fillable = [
        'kode_ketbarang',
        'ket_barang'
    ];

    // Relationships
    public function rekening()
    {
        return $this->hasMany(Rekening1::class, 'kode_ketbarang', 'kode_ketbarang');
    }
}
