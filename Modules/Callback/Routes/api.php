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

Route::middleware('auth:api')->prefix('callbacks')->group(function() {
  Route::get('/', 'CallbacksController@index');
  Route::post('/', 'CallbacksController@load');
  Route::post('/default', 'CallbacksController@create');
  Route::patch('/', 'CallbacksController@save');
});