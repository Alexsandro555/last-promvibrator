<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Initializer\Traits\SortTrait;
use Modules\Initializer\Traits\TableColumnsTrait;
use Modules\Initializer\Traits\RelationTrait;

class AttributeUnit extends Model
{
  use SoftDeletes, TableColumnsTrait, RelationTrait, SortTrait;

  protected $guarded = [];

  protected $table = 'attribute_units';

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
    ]
  ];


  public function attributes() {
    return $this->hasMany(Attribute::class);
  }
}
