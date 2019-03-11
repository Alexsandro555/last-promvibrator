<?php

namespace Modules\Initializer\Traits;

use Illuminate\Support\Facades\Cache;

trait ClearCacheTrait {
  protected static function bootClearCacheTrait() {
    static::creating(function ($model) {
      if(Cache::has(class_basename($model))) {
        Cache::pull(class_basename($model));
      }
    });

    static::updating(function ($model) {
      if(Cache::has(class_basename($model))) {
        Cache::pull(class_basename($model));
      }
    });
  }
}