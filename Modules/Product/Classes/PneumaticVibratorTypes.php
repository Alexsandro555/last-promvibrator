<?php
/**
 * Created by PhpStorm.
 * User: alexsandro
 * Date: 13.02.18
 * Time: 10:42
 */

namespace Modules\Product\Classes;

use Illuminate\Database\Eloquent\Model;

class PneumaticVibratorTypes extends Model
{
  protected $connection = 'mysql2';

  protected $table = 'pneumatic_vibrators_types';

}