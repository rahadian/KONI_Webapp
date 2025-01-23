<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LimitNominal extends Model
{
    use HasFactory;
    protected $table = 'limit_nominal';
    protected $casts = [
        'nominal' => 'integer',
    ];
    protected $fillable = [
       'username','tahun', 'nominal','nominal_sisa','nominal_terpakai','cabor','semester1','semester2','created_at','updated_at'
    ];
}
