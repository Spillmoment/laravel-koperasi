<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Simpanan extends Model
{
    protected $table = 'simpanan';
    protected $primaryKey = 'id';
    protected $fillable = ['anggota_id', 'jenis_simpanan', 'nominal', 'keterangan'];

    use SoftDeletes;

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }
}
