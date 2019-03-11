<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Initializer\Traits\RelationTrait;
use Modules\Initializer\Traits\SortTrait;
use Modules\Initializer\Traits\TableColumnsTrait;

class AttributeGroup extends Model
{
  use SoftDeletes, RelationTrait, TableColumnsTrait, SortTrait;

  protected $table = 'attribute_groups';

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

  protected $guarded = [];

  public function attributes() {
    return $this->hasMany(Attribute::class);
  }
}
