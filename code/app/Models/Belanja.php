<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Belanja extends Model
{
    use HasFactory;
    protected $table = 'belanja';
    protected $fillable = [
       'kode_belanja','kode_rekening','uraian_belanja'
    ];
}
