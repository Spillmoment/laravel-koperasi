<?php

use Illuminate\Support\Facades\{Route, Auth};

Route::get('/', 'Auth\LoginController@index');
Auth::routes(['register' => false]);

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('/home', 'HomeController@index')->name('home');
    });

Route::prefix('ketua')
    ->middleware('ketua')
    ->group(function () {
        Route::get('/private', function () {
            return 'Halaman Ketua';
        });
    });
