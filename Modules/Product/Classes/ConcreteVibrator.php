<?php

namespace Modules\Product\Classes;

use Illuminate\Database\Eloquent\Model;

class ConcreteVibrator extends Model
{
  protected $connection = 'mysql2';

  protected $table = 'concrete_vibrators';
}
