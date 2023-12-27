<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class daftar_poli extends Model
{
    use HasFactory;
    protected $table = 'daftar_poli';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ['id_pasien', 'id_jadwal', 'keluhan', 'no_antrian'];
}
