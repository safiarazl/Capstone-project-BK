<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\detail_periksa;
class periksa extends Model
{
    use HasFactory;
    protected $table = 'periksa';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ['id_daftar_poli', 'tgl_periksa', 'catatan', 'biaya_periksa'];

    public function detail_periksa()
    {
        return $this->hasMany(detail_periksa::class, 'id_periksa');
    }
}
