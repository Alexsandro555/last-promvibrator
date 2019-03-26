<?php

namespace Modules\Initializer\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ClearCacheObserver {
  public function creating(Model $model)
  {
    $this->clearCache($model);
  }

  public function saving(Model $model)
  {
    //$this->clearCache($model);
  }

  private function clearCache($model)
  {
    if(Cache::has(class_basename($model))) {
      Cache::pull(class_basename($model));
    }
  }
}