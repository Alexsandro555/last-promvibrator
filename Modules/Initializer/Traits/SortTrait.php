<?php

namespace Modules\Initializer\Traits;

trait SortTrait {
  protected static function bootSortTrait() {
    static::creating(function($model) {
      $data = $model::orderBy('sort','desc')->first();
      if($data) {
        $model->sort = $data->sort+1;
      } else {
        $model->sort = 1;
      }
    });
  }
}