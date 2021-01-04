<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BayarPinjaman extends Model
{
    protected $table = 'bayar_pinjaman';
    protected $primaryKey = 'id';

    protected $fillable = ['pinjaman_id', 'jatuh_tempo', 'tanggal_bayar', 'nominal', 'denda', 'keterangan'];

    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class, 'pinjaman_id');
    }
}
