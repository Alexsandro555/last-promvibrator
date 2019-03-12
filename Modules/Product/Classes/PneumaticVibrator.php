<?php
/**
 * Created by PhpStorm.
 * User: alexsandro
 * Date: 13.02.18
 * Time: 10:46
 */

namespace Modules\Product\Classes;

use Illuminate\Database\Eloquent\Model;

class PneumaticVibrator extends Model
{
  protected $connection = 'mysql2';

  protected $table = 'pneumatic_vibrators';
}