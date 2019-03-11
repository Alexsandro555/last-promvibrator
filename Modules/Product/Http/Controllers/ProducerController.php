<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Producer;
use Modules\Initializer\Traits\ControllerTrait;
use Modules\Initializer\Traits\DefaultTrait;

class ProducerController extends Controller
{
  use ControllerTrait, DefaultTrait;

  public $model;

  public function __construct()
  {
    $this->model = new Producer();
  }
}
