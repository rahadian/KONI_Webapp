<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubCabor extends Model
{
    use HasFactory;
    protected $table = 'club_cabor';
    protected $fillable = [
       'id_cabor','nama_ketua','nama_sekretaris','nama_bendahara','alamat','no_sk','tgl_sk'
    ];
}
