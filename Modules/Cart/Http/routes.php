<?php

Route::group(['middleware' => 'web', 'prefix' => 'cart', 'namespace' => 'Modules\Cart\Http\Controllers'], function()
{
    Route::get('/', 'CartController@show');
    Route::get('/widget', 'CartController@index');
    Route::patch('/', 'CartController@store');
    Route::get('/set-qty/{id}/{qty}', 'CartController@setQty');
    Route::delete('/{rowId}', 'CartController@destroy');

    Route::get('/current', 'CartController@current');
    Route::post('/add',
      [
        'before' => 'csrf',
        'uses' => 'CartController@store'
      ]);



});
