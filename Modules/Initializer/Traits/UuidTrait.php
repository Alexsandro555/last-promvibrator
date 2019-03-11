<?php

namespace Modules\Initializer\Traits;

use Webpatser\Uuid\Uuid;

trait UuidTrait {
  protected static function bootUuidTrait()
  {
    static::creating(function ($model)
    {
      if (is_array($model->uuids))
      {
        foreach ($model->uuids as $key=>$value)
        {
          $model->{$value} = self::generateUuidToken();
        }
      }
    });
  }
  public static function generateUuidToken()
  {
    return Uuid::generate()->string;
  }
}