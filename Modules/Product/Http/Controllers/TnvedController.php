<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Initializer\Traits\ControllerTrait;
use Modules\Product\Entities\Tnved;

class TnvedController extends Controller
{
  use ControllerTrait;

  public $model;

  public function __construct()
  {
    $this->model = new Tnved();
  }
}
