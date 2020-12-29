<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisSimpanan extends Model
{
    protected $table = 'jenis_simpanan';
    protected $primaryKey = 'id';

    protected $fillable = ['nama_simpanan', 'minimal_simpan'];

    public function simpanan()
    {
        return $this->hasMany(Simpanan::class, 'jenis_simpanan_id', 'id');
    }

    public function count()
    {
        return $this->hasMany(Count::class, 'jenis_simpanan_id', 'id');
    }
}
