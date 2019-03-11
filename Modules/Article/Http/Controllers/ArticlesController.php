<?php

namespace Modules\Article\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Article\Models\Article;
use Illuminate\Routing\Controller;
use Modules\Initializer\Traits\ControllerTrait;
use Modules\Initializer\Traits\DefaultTrait;

class ArticlesController extends Controller
{
	Use ControllerTrait, DefaultTrait;

  public $model;

  public function __construct()
  {
      $this->model=new Article;
  }
}
