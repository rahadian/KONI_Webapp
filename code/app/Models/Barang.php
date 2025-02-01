<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    public $timestamps = false;
    protected $fillable = [
       'kode_barang','kode_belanja','nama_barang','harga_satuan'
    ];
    public function belanja()
    {
        return $this->belongsTo(Belanja::class, 'kode_belanja', 'kode_belanja');
    }
}
