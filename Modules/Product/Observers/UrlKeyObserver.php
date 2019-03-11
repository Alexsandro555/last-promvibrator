<?php

namespace Modules\Product\Observers;

use Illuminate\Database\Eloquent\Model;
//use Modules\Product\Entities\ProductCategory;

class UrlKeyObserver {
  public function updating(Model $myModel) {
    $normTitle = str_replace("/"," ",$myModel->title);
    $myModel->url_key = \Slug::make($normTitle);
  }
}