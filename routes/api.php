<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['namespace' => 'API'], function () {
  Route::post('/products/comments', 'ProductController@comment');
  Route::get('/products/comments/{limit}/{page}', 'ProductController@comments');

  Route::get('/products/{order}/{limit}/{page}', 'ProductController@index');
  Route::get('/likes/{userId}/{productId}', 'UserController@like');

  Route::get('/carts/{productId}/{quantity}/{userId?}', 'CartController@store');
});
