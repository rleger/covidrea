<?php


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

// No auth required
Route::get('/home', 'HomeController@index')->name('home');

// Auth
Route::get('/etablissements', 'EtablissementController@index')->name('etablissements.index');
Route::get('/etablissement/{etablissement}', 'EtablissementController@show')->name('etablissement.show');
Route::get('/service/{service}', 'ServiceController@edit')->name('service.edit');
Route::patch('/service/{service}', 'ServiceController@update')->name('service.update');
Route::delete('/service/{service}', 'ServiceController@delete')->name('service.delete');

Route::get('/user/service', 'UserServiceController@edit')->name('user.services.edit');
Route::post('/user/service', 'UserServiceController@store')->name('user.services.store');
Route::patch('user/service/{service}', 'UserServiceController@update')->name('user.services.update');


Route::post('/etablissement/service', 'EtablissementServiceController@store')->name('etablissement.services.store');

// Invites
Route::get('invite/{user:token}', 'InviteController@invite')->name('invite');
Route::post('invite', 'InviteController@process')->name('invite.process');
// {token} is a required parameter that will be exposed to us in the controller method
Route::get('accept/{token}/{etablissement_id}', 'InviteController@accept')->name('invite.accept');
Route::post('finalize', 'InviteController@finalize')->name('invite.finalize');

// Gestion des établissements
Route::get('user/etablissement/', 'UserEtablissementController@index')->name('user.etablissement.index');
Route::get('user/etablissement/{etablissement}/edit', 'UserEtablissementController@edit')->name('user.etablissement.edit');
Route::patch('user/etablissement/{etablissement}/update', 'UserEtablissementController@update')->name('user.etablissement.update');

// Interested people
Route::post('interested', 'InterestedController@store')->name('interested.store');


/** DEV ONLY */

// Email Preview Route
Route::get('/emailpreview', function () {
    $invite = new \App\Invite();
    $invite->id = 1;
    $invite->email = 'samantha.halfon@gmail.com';
    $invite->token = 'aaa';
    $invite->etablissement_id = 1;
    return new App\Mail\InviteCreated($invite);
});