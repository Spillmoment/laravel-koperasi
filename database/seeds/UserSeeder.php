<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::insert([
            'name' => 'deddy gunawan',
            'email' => 'deddygunawan98@gmail.com',
            'image' => 'deddy.jpg',
            'password' => bcrypt('akudewe123'),
            'roles' => 'admin'
        ]);

        User::insert([
            'name' => 'hafidz masruri',
            'email' => 'do.crazy192@gmail.com',
            'image' => 'hafid.jpg',
            'password' => bcrypt('akudewe123'),
            'roles' => 'ketua'
        ]);
    }
}
