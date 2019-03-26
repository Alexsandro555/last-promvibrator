<?php

namespace Modules\Product\Traits;

trait ProductCategoryActiveTrait {

  protected static function bootProductCategoryActiveTrait() {

    static::updated(function ($model)
    {
      /*if ($model->old_url) {
        $model->url_key = $model->old_url;
      }*/
      /*$request = request();
      if($request->has('active')) {
        $temp = 'hay';
      }*/
    });

    static::updating(function($model) {
      //temp = "";
    });
  }
}