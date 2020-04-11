<?php

use Illuminate\Support\Facades\Route;

// Welcome page
Route::view('/', 'welcome')->name('welcome');

// Press page
Route::view('/presse', 'presse');

// Register routes without the baked in register fonctionnalities
Auth::routes(['register' => false]);

// No auth required
Route::get('/home', 'HomeController@index')->name('home');

// Auth
Route::get('/etablissements', 'EtablissementController@index')->name('etablissements.index');
Route::get('/etablissement/{etablissement}', 'EtablissementController@show')->name('etablissement.show');

// Service
Route::get('/service/{service}', 'ServiceController@edit')->name('service.edit');
Route::patch('/service/{service}', 'ServiceController@update')->name('service.update');
Route::delete('/service/{service}', 'ServiceController@delete')->name('service.delete');

// User, service
Route::get('/user/service', 'UserServiceController@edit')->name('user.services.edit');
Route::post('/user/service', 'UserServiceController@store')->name('user.services.store');
Route::patch('user/service/{service}', 'UserServiceController@update')->name('user.services.update');

// Etablissment, service
Route::post('/etablissement/service', 'EtablissementServiceController@store')->name('etablissement.services.store');

// Gestion des établissements
Route::get('user/etablissement/', 'UserEtablissementController@index')->name('user.etablissement.index');
Route::get('user/etablissement/{etablissement}/edit', 'UserEtablissementController@edit')->name('user.etablissement.edit');
Route::patch('user/etablissement/{etablissement}/update', 'UserEtablissementController@update')->name('user.etablissement.update');

// Interested people
Route::post('interested', 'InterestedController@store')->name('interested.store');

// Invites
Route::get('invite', 'InviteController@invite')->name('invite');
Route::post('invite', 'InviteController@process')->name('invite.process');
Route::get('accept/{token}/{etablissement_id}', 'InviteController@accept')->name('invite.accept');
Route::post('finalize', 'InviteController@finalize')->name('invite.finalize');

// Register prospects
Route::get('register/{prospect}', 'RegisterController@register')->name('register')->middleware('signed');
Route::post('register', 'RegisterController@process')->name('register.process');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::redirect('/', '/admin/etablissement')->name('admin.index');
    Route::get('etablissement', 'AdminEtablissementController@index')->name('admin.etablissement.index');
    Route::get('etablissement/create', 'AdminEtablissementController@create')->name('admin.etablissement.create');
    Route::get('etablissement/edit/{etablissement}', 'AdminEtablissementController@edit')->name('admin.etablissement.edit');
    Route::post('etablissement/store', 'AdminEtablissementController@store')->name('admin.etablissement.store');
    Route::get('etablissement/{etablissement}/invite', 'AdminEtablissementController@invite')->name('admin.etablissement.invite');
});
