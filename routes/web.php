<?php

use Illuminate\Support\Facades\{Route, Auth};

Route::get('/', 'Auth\LoginController@index');
Auth::routes(['register' => false]);

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {

        Route::get('/', 'Admin\DashboardController@index')->name('dashboard.admin');
        Route::resource('anggota', 'Admin\AnggotaController');
        Route::get('profile', 'Admin\DashboardController@profile')->name('admin.profile');
        Route::put('update-profile/{user}', 'Admin\DashboardController@update_profile')->name('admin.update-profile');
        Route::get('pengaturan', 'Admin\DashboardController@pengaturan')->name('admin.pengaturan');
        Route::put('update-pengaturan/{user}', 'Admin\DashboardController@update_pengaturan')->name('admin.update-pengaturan');
        Route::resource('simpanan', 'SimpananController');
    });

Route::prefix('ketua')
    ->middleware('ketua')
    ->group(function () {
        Route::get('/', 'Ketua\DashboardController@index')->name('dashboard.ketua');
        Route::resource('jenis-simpanan', 'Ketua\JenisSimpananController');
        Route::resource('admin', 'Ketua\AdminController');
        Route::resource('simpanan', 'Ketua\SimpananController');
    });
