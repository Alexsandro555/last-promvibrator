<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\AttributeUnit;
use Modules\Initializer\Traits\ControllerTrait;
use Modules\Initializer\Traits\DefaultTrait;

class AttributeUnitController extends Controller
{
  Use ControllerTrait, DefaultTrait;

  public $model;

  public function __construct()
  {
    $this->model = new AttributeUnit();
  }
}
