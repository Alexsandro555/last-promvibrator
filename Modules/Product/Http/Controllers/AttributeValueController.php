<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Initializer\Traits\ControllerTrait;
use Modules\Product\Entities\AttributeValue;

class AttributeValueController extends Controller
{
  use ControllerTrait;

  public $model;

  public function __construct()
  {
    $this->model = new AttributeValue();
  }

  public function save(Request $request) {
    $request = $request->all();
    foreach($request['attributes'] as $attribute) {
      $f=$this->model->firstOrNew(['id' => $attribute['id'], 'product_id' => $attribute['product_id'], 'attribute_id' => $attribute['attribute_id']]);
      $f->fill($attribute);
      $f->save();
    }
    return $this->model->all();
  }
}
