<?php

namespace Modules\News\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Initializer\Traits\ControllerTrait;
use Modules\News\Entities\News;
use Modules\Initializer\Traits\DefaultTrait;

class NewsController extends Controller
{
  use ControllerTrait, DefaultTrait;

  public $model;

  public function __construct()
  {
    $this->model = new News;
  }

  public function list() {
    $news = News::with('files')->get();
    return view('news::index', compact('news'));
  }

  public function show($slug) {
    $news = News::where('url_key', $slug)->firstOrFail();
    return view('news::show', compact('news'));
  }
}
