<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/etablissements', 'EtablissementController@index')->name('etablissements.index');
Route::get('/etablissement/{etablissement}', 'EtablissementController@show')->name('etablissement.show');


Route::patch('/service/{service}', 'ServiceController@update')->name('service.update');

Route::get('/user/{user}/service', 'UserServiceController@edit')->name('user.services.edit');
