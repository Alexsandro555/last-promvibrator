<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Page\Models\Page;
use Illuminate\Routing\Controller;
use Modules\Initializer\Traits\ControllerTrait;
use Modules\Initializer\Traits\DefaultTrait;

class PagesController extends Controller
{
	Use ControllerTrait, DefaultTrait;

  public $model;

  public function __construct()
  {
      $this->model=new Page;
  }

  public function show($slug) {
    $page = Page::where('url_key', $slug)->firstOrFail();
    return view('page::show', compact('page'));
  }
}
