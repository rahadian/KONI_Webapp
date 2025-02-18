<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanPerencanaan extends Model
{
    use HasFactory;
    protected $table = 'pengajuan_perencanaan';
    public $timestamps = false;
    protected $fillable = [
       'tahun','cabor','status','catatan','verified_by','verified_at'
    ];
}
