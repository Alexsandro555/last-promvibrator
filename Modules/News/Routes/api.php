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

Route::middleware('auth:api')->prefix('news')->group(function() {
  Route::get('/', 'NewsController@index');
  Route::post('/', 'NewsController@load');
  Route::post('/default', 'NewsController@create');
  Route::patch('/', 'NewsController@save');
});
