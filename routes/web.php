<?php

use Illuminate\Support\Facades\{Route, Auth};

Route::get('/', 'Auth\LoginController@index');
Auth::routes(['register' => false]);

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'Admin\DashboardController@index')->name('dashboard.admin');
        Route::resource('anggota', 'Admin\AnggotaController');
    });

Route::prefix('ketua')
    ->middleware('ketua')
    ->group(function () {
        Route::get('/', 'Ketua\DashboardController@index')->name('dashboard.ketua');
    });

Route::get('/home', 'HomeController@index');
