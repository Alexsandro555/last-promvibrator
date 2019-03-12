<?php

namespace Modules\Product\Classes;

use Illuminate\Database\Eloquent\Model;

class VibratorParentType extends Model
{
  protected $connection = 'mysql2';

  protected $table = 'vibrators_types_types';

  public function lineProducts() {
    return $this->hasMany(VibratorType::class, 'typeid');
  }
}
