<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening1 extends Model
{
    protected $table = 'rekening_1';
    public $timestamps = false;

    protected $fillable = [
        'kode_rekening',
        'kode_ketbarang',
        'ket_rekening'
    ];

    // Relationships
    public function ketBarang()
    {
        return $this->belongsTo(KetBarang::class, 'kode_ketbarang', 'kode_ketbarang');
    }

    public function barang()
    {
        return $this->hasMany(Barang1::class, 'kode_rekening', 'kode_rekening');
    }
}
