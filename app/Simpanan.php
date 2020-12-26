<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Simpanan extends Model
{
    protected $table = 'simpanan';
    protected $primaryKey = 'id';
    protected $fillable = ['anggota_id', 'jenis_simpanan_id', 'nominal', 'keterangan'];

    use SoftDeletes;

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function jenis_simpanan()
    {
        return $this->belongsTo(JenisSimpanan::class, 'jenis_simpanan_id');
    }
}
