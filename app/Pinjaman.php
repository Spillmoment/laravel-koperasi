<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pinjaman extends Model
{
    protected $table = 'pinjaman';
    protected $primaryKey = 'id';

    protected $fillable = ['anggota_id', 'nominal', 'bagi_hasil', 'jangka_waktu', 'bayar_pokok', 'hasil_bagi', 'bayar_perbulan', 'total', 'keterangan', 'status'];

    use SoftDeletes;

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function bayar_pinjaman()
    {
        return $this->hasMany(BayarPinjaman::class, 'pinjaman_id', 'id');
    }
}
