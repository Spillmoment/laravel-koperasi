<?php

use Illuminate\Database\Seeder;
use App\User;

class create_users_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'deddy',
            'email' => 'deddygunawan98@gmail.com',
            'password' => bcrypt('akudewe123'),
            'roles' => 'admin'
        ]);

        User::insert([
            'name' => 'hafid',
            'email' => 'hafid@gmail.com',
            'password' => bcrypt('akudewe123'),
            'roles' => 'ketua'
        ]);
    }
}
