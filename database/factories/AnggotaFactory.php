<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Anggota;
use Faker\Generator as Faker;

$factory->define(Anggota::class, function (Faker $faker) {
    return [
        'no_ktp' => $faker->randomDigit,
        'nama_anggota' => $faker->name,
        'jenis_kelamin' => $faker->randomElement(['laki-laki', 'perempuan']),
        'alamat' => $faker->address,
        'kota' => $faker->city,
        'telepon' => $faker->randomElement(['085236639572', '081331289350']),
        'pengurus' => $faker->randomElement(['pengurus', 'bukan_pengurus'])
    ];
});
