<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ikhtisar_bumdes extends Model
{
    use HasFactory;
    protected $table = 'ikhtisar_bumdes';
    protected $fillable = [
       'deskripsi','gambar'
    ];
}
