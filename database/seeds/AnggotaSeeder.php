<?php

use Illuminate\Database\Seeder;
use App\Anggota;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Anggota::insert([
            'no_ktp' => '3513122707980002',
            'nama_anggota' => 'deddygunawan',
            'jenis_kelamin' => 'laki-laki',
            'alamat' => 'lumajang',
            'kota' => 'lumajang',
            'telepon' => '08236639572',
            'pengurus' => 'pengurus',
        ]);

        Anggota::insert([
            'no_ktp' => '3513122707980001',
            'nama_anggota' => 'M Hafid Masruri',
            'jenis_kelamin' => 'laki-laki',
            'alamat' => 'lumajang',
            'kota' => 'lumajang',
            'telepon' => '08236639572',
            'pengurus' => 'pengurus',
        ]);
    }
}
