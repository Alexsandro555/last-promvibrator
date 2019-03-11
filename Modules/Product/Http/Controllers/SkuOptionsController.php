<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Initializer\Traits\ControllerTrait;
use Modules\Product\Entities\AttributeSkuOption;

class SkuOptionsController extends Controller
{
  use ControllerTrait;

  public $model;

  public function __construct() {
    $this->model = new AttributeSkuOption;
  }

  public function save(Request $request) {
    $options = $this->model->where('sku_id', $request->id)->get();
    foreach($options as $option) {
      $option->delete();
    }
    foreach($request->options as $option) {
      $this->model::create($option);
    }
    return $this->model->all();
  }
}
