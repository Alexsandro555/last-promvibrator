<?php

namespace Modules\Initializer\Traits;

trait OldIdTrait {
  protected static function bootOldIdTrait() {
    static::updating(function($model) {
      if(!$model->old_id) {
        $model->old_id = $model->id;
      }
    });
  }
}