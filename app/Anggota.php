<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anggota extends Model
{
    protected $table = 'anggota';
    protected $primaryKey = 'id';

    protected $fillable = ['no_ktp', 'nama_anggota', 'jenis_kelamin', 'alamat', 'kota', 'telepon', 'pengurus'];
    use SoftDeletes;

    public function simpanan()
    {
        return $this->hasMany(Simpanan::class, 'anggota_id', 'id');
    }

    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'anggota_id', 'id');
    }

    public function count()
    {
        return $this->hasMany(Count::class, 'anggota_id', 'id');
    }
}
