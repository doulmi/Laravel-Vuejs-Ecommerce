<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/{provider}/redirect', 'SocialAuthController@redirect')->name('redirect');
Route::get('/{provider}/callback', 'SocialAuthController@callback')->name('callback');

Route::get('/', 'PostController@index')->name('index');

Route::get('lang/{lang}', 'LanguageController@switchLang')->name('lang.switch');

Route::get('/explore/latest', 'PostController@latest')->name('index.latest');
Route::get('/explore/popular', 'PostController@popular')->name('index.popular');
Route::get('/products/{slug}', 'ProductController@show')->name('products.show');
Route::get('/cart', 'CartController@index')->name('cart');

Route::get('/stripedemo', function () {
  return view('stripedemo');
});

Route::post('pay', 'PaymentController@charge');

Route::get('/shop', function () {
  return 'shop';
})->name('shop');

Route::get('/{userId}/profile', 'UserController@profile')->name('profile');
Route::get('/{userId}/likes', 'UserController@likes')->name('likes');
Route::get('/{userId}/collections', 'UserController@collects')->name('collections');

Route::group(['middleware' => 'auth'], function () {
  Route::post('/likes/{productId}', 'UserController@like')->name('actions.like');
  Route::get('/cart', 'CartController@index')->name('carts.index');
  Route::put('/cart', 'CartController@update')->name('carts.update');
});

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
//  Route::get('/', 'AdminController@dashboard');
//  Route::get('/dashboard', 'AdminController@dashboard');

  CRUD::resource('language', 'LanguageCrudController');
  CRUD::resource('currency', 'CurrencyCrudController');
  CRUD::resource('user', 'UserCrudController');
  CRUD::resource('category', 'CategoryCrudController');
  CRUD::resource('product', 'ProductCrudController');
  CRUD::resource('address', 'AddressCrudController');
  CRUD::resource('cart', 'CartCrudController');
  CRUD::resource('collect', 'CollectCrudController');
  CRUD::resource('comment', 'CommentCrudController');
  CRUD::resource('gift', 'GiftCrudController');
  CRUD::resource('giftProduct', 'GiftProductCrudController');
  CRUD::resource('like', 'LikeCrudController');
  CRUD::resource('order', 'OrderCrudController');
  CRUD::resource('promoCode', 'PromoCodeCrudController');
  CRUD::resource('reservation', 'ReservationCrudController');
});
