<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BelanjaBarjas extends Model
{
    use HasFactory;
    protected $table = 'belanja_barjas';
    protected $fillable = [
       'id_perencanaan','pajak','tanggal_transaksi','jumlah','detail','total_harga','created_by'
    ];
}
