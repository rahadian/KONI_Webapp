<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriProdukHukum extends Model
{
    use HasFactory;
    protected $table = 'kategori_produk_hukum';
    protected $fillable = [
       'nama','created_at','updated_at'
    ];
}
