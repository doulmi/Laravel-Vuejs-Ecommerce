<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/{provider}/redirect', 'SocialAuthController@redirect')->name('redirect');
Route::get('/{provider}/callback', 'SocialAuthController@callback')->name('callback');

Route::get('/', function () {
    return view('welcome');
});
