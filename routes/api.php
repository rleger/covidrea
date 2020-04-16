<?php

use Illuminate\Support\Facades\Route;

// Mailgun webhook (feedback from Mailgun)
Route::post('webhook/mailgun', 'WebhookMailgunController@index');

Route::post('invite', 'Api\InviteController@createNewInvite')->name('api.invite.create')->middleware('client');
