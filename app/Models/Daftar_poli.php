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
    protected $fillable = ['id_pasien', 'id_jadwal', 'keluhan', 'no_antrian', 'status'];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    public function jadwal_periksa()
    {
        return $this->belongsTo(Jadwal_periksa::class, 'id_jadwal');
    }
    public function periksa()
{
    return $this->hasOne(Periksa::class, 'id_daftar_poli');
}
}
