<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;
use Modules\Initializer\Traits\ControllerTrait;
use Modules\Initializer\Traits\DefaultTrait;

class ProductController extends Controller
{
  Use ControllerTrait, DefaultTrait;

  public $model;

  public function __construct()
  {
    $this->model = new Product;
  }
}
