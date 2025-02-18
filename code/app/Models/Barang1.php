<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang1 extends Model
{
    use HasFactory;
    protected $table = 'barang_1';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
       'kode_rekening','nama_barang','harga_satuan'
    ];
    public function rekening()
    {
        return $this->belongsTo(Rekening::class, 'kode_rekening', 'kode_rekening');
    }
}
