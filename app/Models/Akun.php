<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    use HasFactory;
    protected $table = 'akun';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ['email', 'password', 'role'];

    public function pasien()
    {
        return $this->hasOne(Pasien::class, 'id_akun', 'id');
    }

    public function dokter()
    {
        return $this->hasOne(Dokter::class, 'id_akun', 'id');
    }
}
