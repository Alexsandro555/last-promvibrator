<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Initializer\Traits\TableColumnsTrait;
use Modules\Initializer\Traits\RelationTrait;

class Tnved extends Model
{
  use SoftDeletes, TableColumnsTrait, RelationTrait;

  protected $dates = ['deleted_at'];

  protected $table = 'tnveds';

  protected $guarded = [];

  public $form = [
    'id' => [
      'enabled' => true
    ],
    'title' => [
      'enabled' => true,
      'validations' => [
        'required' => true,
        'max' => 255
      ]
    ],
    'active' => [
      'enabled' => true
    ]
  ];

  public function type_products() {
    return $this->hasMany(TypeProduct::class);
  }
}
