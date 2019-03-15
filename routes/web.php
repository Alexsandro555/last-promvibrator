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

Route::get('/admin', ['uses' => '\Modules\Auth\Http\Controllers\AdminController@index', 'as' => 'master']);

Route::get('/find/{text?}', ['uses' => 'FindController@index', 'as' => 'find']);

Route::get('product-images/{id}', ['uses' => 'SiteController@images', 'as' => 'product-images']);

Route::get('/{slug}', ['uses' => 'SiteController@catalogTypes', 'as'=> 'catalog-products']);