<?php

use App\JenisSimpanan;
use Illuminate\Database\Seeder;

class JenisSimpananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = (new JenisSimpanan())->getTable();
        truncate($table);

        JenisSimpanan::insert([
            ['nama_simpanan' => 'pokok', 'minimal_simpan' => 100000],
            ['nama_simpanan' => 'wajib', 'minimal_simpan' => 20000],
            ['nama_simpanan' => 'sukarela', 'minimal_simpan' => 0],
        ]);
    }
}
