<?php

Route::group(['middleware' => 'web', 'prefix' => 'callback', 'namespace' => 'Modules\Callback\Http\Controllers'], function()
{
    Route::get('/', 'CallbackController@index');
    Route::post('/', 'CallbackController@store');
});
