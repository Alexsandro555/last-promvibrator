<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\AttributeListValues;
use Modules\Initializer\Traits\ControllerTrait;

class AttributeListValueController extends Controller
{

  Use ControllerTrait;

  public $model;

  public function __construct()
  {
    $this->model = new AttributeListValues();
  }
}
