<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Initializer\Traits\ControllerTrait;
use Modules\Product\Entities\AttributeGroup;
use Modules\Initializer\Traits\DefaultTrait;

class AttributeGroupController extends Controller
{
  Use ControllerTrait, DefaultTrait;

  public $model;

  public function __construct()
  {
    $this->model = new AttributeGroup();
  }
}
