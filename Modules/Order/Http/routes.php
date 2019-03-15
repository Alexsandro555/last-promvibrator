<?php

Route::group(['middleware' => 'web', 'prefix' => 'order.php', 'namespace' => 'Modules\Order\Http\Controllers'], function()
{
    Route::get('/', 'OrderController@index');
    Route::post('/', 'OrderController@store');
    Route::get('/items', 'OrderController@items');
});
