<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Initializer\Traits\ControllerTrait;
use Modules\Product\Entities\AttributeSkuOption;
use Modules\Product\Entities\Sku;

class SkuController extends Controller
{
  use ControllerTrait;

  public $model;

  public function __construct()
  {
    $this->model = new Sku;
  }

  public function save(Request $request) {
    $tt = collect($request->options)->pluck(['attribute_id'])->toArray();
    $tab = AttributeSkuOption::where('sku_id', $request->sku_id)->pluck('attribute_id')->toArray();
    $res = array_diff($tab, $tt);
    $result = AttributeSkuOption::where('sku_id', $request->sku_id)->pluck('attribute_id')->diff(collect($request->options)->pluck(['attribute_id']));
    if($result->count()>0) {
      $temp = 0;
    }
    $temp = 'mas';
  }
}
