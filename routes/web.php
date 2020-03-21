<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/etablissements', 'EtablissementController@index')->name('etablissements.index');
Route::get('/etablissement/{etablissement}', 'EtablissementController@show')->name('etablissement.show');
Route::get('/user/{user}/service', 'UserServiceController@show')->name('user.services.show');
