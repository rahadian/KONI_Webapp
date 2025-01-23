<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeTahun extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'periode_tahun';
    protected $fillable = [
       'tahun','status'
    ];
}
