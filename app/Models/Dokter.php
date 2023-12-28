<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dokter extends Model
{
    use HasFactory;
    protected $table = 'dokter';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ['id_akun', 'id_poli', 'nama', 'alamat', 'no_hp'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_akun', 'id');
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }
}
