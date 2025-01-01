<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukHukum extends Model
{
    use HasFactory;
    protected $table = 'produk_hukum';
    protected $fillable = [
       'judul','kategori','file','created_at','updated_at'
    ];
}
