<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwal_periksa extends Model
{
    use HasFactory;
    protected $table = 'jadwal_periksa';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ['id_dokter', 'hari', 'jam_mulai', 'jam_selesai'];
}
