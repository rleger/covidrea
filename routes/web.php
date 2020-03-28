<?php


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// No auth required
Route::get('/home', 'HomeController@index')->name('home');

// Auth
Route::get('/etablissements', 'EtablissementController@index')->name('etablissements.index');
Route::get('/etablissement/{etablissement}', 'EtablissementController@show')->name('etablissement.show');
Route::patch('/service/{service}', 'ServiceController@update')->name('service.update');

Route::get('/user/service', 'UserServiceController@edit')->name('user.services.edit');


// Invites
Route::get('invite/{user:token}', 'InviteController@invite')->name('invite');
Route::post('invite', 'InviteController@process')->name('invite.process');
// {token} is a required parameter that will be exposed to us in the controller method
Route::get('accept/{token}/{etablissement_id}', 'InviteController@accept')->name('invite.accept');
Route::post('finalize', 'InviteController@finalize')->name('invite.finalize');

Route::get('email', function() {
    \Mail::to('romainleger@mac.com')->send(new \App\Mail\OrderShipped());
});

// Gestion des établissements
Route::get('user/etablissement/', 'UserEtablissementController@index')->name('user.etablissement.index');
Route::get('user/etablissement/{etablissement}/edit', 'UserEtablissementController@edit')->name('user.etablissement.edit');
Route::patch('user/etablissement/{etablissement}/update', 'UserEtablissementController@update')->name('user.etablissement.update');

// Interested people
Route::post('interested', 'InterestedController@store')->name('interested.store');
