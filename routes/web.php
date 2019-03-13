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

Route::get('/', 'SiteController@index')->name('main');

Route::get('/catalog/detail/{slug}',['uses' => 'SiteController@detail', 'as' => 'catalog.detail']);
Route::get('/catalog/{slugTypeProduct}/{slugLineProduct}', ['uses' => 'SiteController@lineProduct', 'as'=>'catalog.line-product']);

Route::get('/admin', ['uses' => '\Modules\Auth\Http\Controllers\AdminController@index', 'as' => 'master']);

Route::get('/find/{text?}', ['uses' => 'FindController@index', 'as' => 'find']);

//Route::get('/news/{slug}', '\Modules\News\Http\Controllers\NewsController@show');
//Route::get('/{slug}', '\Modules\Page\Http\Controllers\PageController@show');

//Auth::routes();
//Route::post('/register', 'Auth\RegisterController@create');

Route::get('/test', function() {
  $result = \Modules\Product\Classes\VibratorParentType::with('lineProducts')->get();
  dd($result);
});

Route::get('product-images/{id}', ['uses' => 'SiteController@images', 'as' => 'product-images']);

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/{slug}', ['uses' => 'SiteController@catalogTypes', 'as'=> 'catalog-products']);