<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/etablissements', 'EtablissementController@index')->name('etablissements.index');
Route::get('/user/{user}/service', 'UserServiceController@show')->name('user.services.show');
