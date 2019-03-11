<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Initializer\Traits\ControllerTrait;
use Modules\Product\Entities\Attributable;
use Modules\Product\Entities\AttributeValue;
use Modules\Product\Entities\LineProduct;
use Modules\Product\Entities\ProductCategory;
use Modules\Product\Entities\TypeProduct;
use MongoDB\BSON\Type;

class AttributablesController extends Controller
{
  use ControllerTrait;

  public $model;

  public function __construct() {
    $this->model = new Attributable;
  }

  public function save(Request $request) {
    if($request->line_product_id) {
      $lineProduct = LineProduct::findOrFail($request->line_product_id);
      $lineProduct->attributes()->attach($request->selectedRemainAttr);
      return Attributable::all();
    }
    if($request->type_product_id) {
      $typeProduct = TypeProduct::findOrFail($request->type_product_id);
      $typeProduct->attributes()->attach($request->selectedRemainAttr);
      return Attributable::all();
    }
    if($request->product_category_id) {
      $productCategory = ProductCategory::findOrFail($request->product_category_id);
      $productCategory->attributes()->attach($request->selectedRemainAttr);
      return Attributable::all();
    }
  }

  public function delete(Request $request) {
    if($request->line_product_id) {
      $lineProduct = LineProduct::findOrFail($request->line_product_id);
      $lineProduct->attributes()->detach($request->attr);
    }
    if($request->type_product_id) {
      $typeProduct = TypeProduct::findOrFail($request->type_product_id);
      $typeProduct->attributes()->detach($request->attr);
    }
    if($request->product_category_id) {
      $productCategory = ProductCategory::findOrFail($request->product_category_id);
      $productCategory->attributes()->detach($request->attr);
    }
    return ['attributable' => Attributable::all(), 'attribute_values' => AttributeValue::all()];
  }
}
