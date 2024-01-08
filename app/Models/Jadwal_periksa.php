<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal_periksa extends Model
{
    use HasFactory;
    protected $table = 'jadwal_periksa';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ['id_dokter', 'hari', 'jam_mulai', 'jam_selesai', 'aktif'];

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }

    public function daftar_poli()
    {
        return $this->hasMany(Daftar_poli::class, 'id_jadwal');
    }
}
