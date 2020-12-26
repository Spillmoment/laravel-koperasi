<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pinjaman extends Model
{
    protected $table = 'pinjaman';
    protected $primaryKey = 'id';

    protected $fillable = ['anggota_id', 'nominal', 'jangka_waktu', 'bagi_hasil', 'bayar_perbulan', 'keterangan', 'status'];

    use SoftDeletes;

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }
}
