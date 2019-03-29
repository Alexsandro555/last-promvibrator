<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Initializer\Traits\ControllerTrait;
use Modules\Product\Entities\AttributeSkuOption;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\Sku;

class SkuController extends Controller
{
  use ControllerTrait;

  public $model;

  public function __construct()
  {
    $this->model = new Sku;
  }

  public function update(Request $request) {
    $options = collect($request->options)->map(function($option) {
      return collect($option)->only(['attribute_id', 'attribute_list_value_id'])->all();
    })->all();
    $databaseOptions = AttributeSkuOption::whereHas('sku.product', function($query) use(&$request) {
      $query->where('id', $request->product_id);
    })->get()->groupBy('sku_id');
    foreach ($databaseOptions as $databaseOption) {
      $arrDatabaseOption = $databaseOption->map(function($dbOpt) {
        return collect($dbOpt->toArray())->only(['attribute_id', 'attribute_list_value_id'])->all();
      })->toArray();
      if($arrDatabaseOption == $options) {
        return response()->json(['message'=>'Торговые предложения должны быть уникальными'], 500);
      }
    }
    $this->model = Sku::find($request->sku['id']);
    $this->model->price = $request->sku['price'];
    $this->model->save();
    $this->model->attr()->sync($options);
    return ['sku' => $this->model, 'attribute_sku_options' => $this->model->attributes];
  }
}
