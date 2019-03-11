<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->prefix('pages')->group(function() {
  Route::get('/', 'PagesController@index');
  Route::post('/', 'PagesController@load');
  Route::post('/default', 'PagesController@create');
  Route::delete('/', 'PagesController@delete');
  Route::patch('/', 'PagesController@save');
});