<?php
namespace Modules\Callback\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Initializer\Traits\RelationTrait;
use Modules\Initializer\Traits\TableColumnsTrait;

class Callback extends Model
{
	use SoftDeletes, RelationTrait, TableColumnsTrait;

	protected $guarded=[];

	protected $dates = ['deleted_at','updated_at'];

  public $form = [
    'id' => [
      'enabled' => true
    ],
    'name' => [
      'enabled' => true,
      'validations' => [
        'required' => true,
        'max' => 255
      ]
    ],
    'company_name' => [
      'enabled' => true,
    ],
    'telephone' => [
      'enabled' => true,
      'validations' => [
        'required' => true,
        'max' => 50
      ]
    ],
    'email' => [
      'enabled' => true,
      'validations' => [
        'required' => true,
        'max' => 50
      ]
    ]
  ];
}
