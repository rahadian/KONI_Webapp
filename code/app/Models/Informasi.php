<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;
    protected $table = 'informasi';
    protected $fillable = [
       'judul','slug_judul', 'kategori','content','author','image','status','tanggal','created_at','updated_at'
    ];
}
