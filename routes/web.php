<?php

use Illuminate\Support\Facades\{Route, Auth};

Route::get('/', 'Auth\LoginController@index');
Auth::routes(['register' => false]);

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('anggota', 'AnggotaController');

    });

Route::prefix('ketua')
    ->middleware('ketua')
    ->group(function () {
        Route::get('/private', function () {
            return 'Halaman Ketua';
        });
    });



