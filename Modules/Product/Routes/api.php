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

Route::middleware('auth:api')->prefix('product_categories')->group(function() {
  Route::get('/', 'ProductCategoryController@index');
  Route::post('/', 'ProductCategoryController@load');
  Route::post('/default', 'ProductCategoryController@create');
  Route::patch('/', 'ProductCategoryController@save');
});

Route::middleware('auth:api')->prefix('tnveds')->group(function() {
  Route::get('/', 'TnvedController@index');
  Route::post('/', 'TnvedController@load');
  Route::patch('/', 'TnvedController@save');
});

Route::middleware('auth:api')->prefix('type_products')->group(function() {
  Route::get('/', 'TypeProductController@index');
  Route::post('/', 'TypeProductController@load');
  Route::post('/default', 'TypeProductController@create');
  Route::patch('/', 'TypeProductController@save');
});

Route::middleware('auth:api')->prefix('line_products')->group(function() {
  Route::get('/', 'LineProductController@index');
  Route::post('/', 'LineProductController@load');
  Route::post('/default', 'LineProductController@create');
  Route::patch('/', 'LineProductController@save');
});

Route::middleware('auth:api')->prefix('producers')->group(function() {
  Route::get('/', 'ProducerController@index');
  Route::post('/', 'ProducerController@load');
  Route::post('/default', 'ProducerController@create');
  Route::patch('/', 'ProducerController@save');
});

Route::middleware('auth:api')->prefix('attribute_units')->group(function() {
  Route::get('/', 'AttributeUnitController@index');
  Route::post('/', 'AttributeUnitController@load');
  Route::post('/default', 'AttributeUnitController@create');
  Route::patch('/', 'AttributeUnitController@save');
});

Route::middleware('auth:api')->prefix('attribute_groups')->group(function() {
  Route::get('/', 'AttributeGroupController@index');
  Route::post('/', 'AttributeGroupController@load');
  Route::post('/default', 'AttributeGroupController@create');
  Route::patch('/', 'AttributeGroupController@save');
});

Route::middleware('auth:api')->prefix('attributes')->group(function() {
  Route::get('/', 'AttributeController@index');
  Route::post('/', 'AttributeController@load');
  Route::post('/default', 'AttributeController@create');
  Route::get('/bindings', 'AttributeController@binding');
  Route::patch('/bindings', 'AttributeController@saveBindings');
  Route::get('/{id}', 'AttributeController@attributes');
  Route::post('/save', 'AttributeController@store');
  Route::patch('/', 'AttributeController@save');
  Route::patch('/remove-bind-attributes', 'AttributeController@removeBindAttributes');
});

Route::middleware('auth:api')->prefix('attribute_types')->group(function() {
  Route::get('/', 'AttributeTypeController@index');
  Route::post('/', 'AttributeTypeController@load');
});

Route::middleware('auth:api')->prefix('products')->group(function() {
  Route::get('/', 'ProductController@index');
  Route::post('/', 'ProductController@load');
  Route::post('/default', 'ProductController@create');
  Route::patch('/', 'ProductController@save');
});

Route::middleware('auth:api')->prefix('attributables')->group(function() {
  Route::get('/', 'AttributablesController@index');
  Route::post('/', 'AttributablesController@load');
  Route::patch('/', 'AttributablesController@save');
  Route::post('/delete', 'AttributablesController@delete');
});

Route::middleware('auth:api')->prefix('attribute_values')->group(function() {
  Route::get('/', 'AttributeValueController@index');
  Route::post('/', 'AttributeValueController@load');
  Route::patch('/', 'AttributeValueController@save');
});

Route::middleware('auth:api')->prefix('attribute_list_values')->group(function() {
  Route::get('/', 'AttributeListValueController@index');
  Route::patch('/', 'AttributeListValueController@save');
  Route::delete('/', 'AttributeListValueController@delete');
});

Route::middleware('auth:api')->prefix('category')->group(function() {
  Route::get('/{parentId?}', 'CategoryController@index');
  Route::post('/', 'CategoryController@create');
  Route::patch('/', 'CategoryController@store');
});

Route::middleware('auth:api')->prefix('skus')->group(function() {
  Route::get('/', 'SkuController@index');
  Route::post('/default', 'SkuController@save');
  Route::patch('/', 'SkuController@update');
});

Route::middleware('auth:api')->prefix('attribute_sku_options')->group(function() {
  Route::get('/', 'SkuOptionsController@index');
});

