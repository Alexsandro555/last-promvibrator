<?php

namespace Modules\Callback\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Callback\Models\Callback;
use Illuminate\Routing\Controller;
use Modules\Initializer\Traits\ControllerTrait;
use Modules\Initializer\Traits\DefaultTrait;

class CallbacksController extends Controller
{
	Use ControllerTrait, DefaultTrait;

  public $model;
  public function __construct()
  {
      $this->model=new Callback;
  }

}
