<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These::
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['namespace' => 'API'], function () {
  Route::group(['prefix' => 'products'], function() {
    Route::post('/comments', 'ProductController@comment');
    Route::get('/comments/{limit}/{page}', 'ProductController@comments');
    Route::get('/{order}/{limit}/{page}/{userId?}', 'ProductController@index');
  });

  Route::group(['prefix' => 'carts'], function() {
    Route::post('/{productId}/{quantity}/{userId?}', 'CartController@store');
    Route::delete('/{productId}/delete', 'CartController@destroy');
  });
});
