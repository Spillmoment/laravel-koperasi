<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Auth\LoginController@index');
Auth::routes(['register' => false]);

Route::middleware('auth')
    ->group(function () {
        Route::get('/home', 'HomeController@index')->name('home');
    });

Route::middleware('ketua')
    ->group(function () {
        Route::get('/private', function () {
            return 'Halaman Ketua';
        });
    });
