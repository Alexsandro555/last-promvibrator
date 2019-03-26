<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Initializer\Traits\ControllerTrait;
use Modules\Product\Entities\ProductCategory;
use Modules\Initializer\Traits\DefaultTrait;

class ProductCategoryController extends Controller
{
  Use ControllerTrait, DefaultTrait;

  public $model;

  public function __construct()
  {
    $this->model = new ProductCategory;
  }

  /*public function index(Request $request)
  {
    $formFields = collect($this->model->fields);
    $fields = $this->model
      ->getColumns(class_basename($this->model))
      ->filter(function($value, $key) use (&$formFields) {
        return $formFields->contains($key);
      });
    $model = $this->model->all();
    $rules = $this->model->getRules();
    return [
      'fields' => $fields,
      'model' => $model,
      'rules' => $rules
    ];
  }*/
}
