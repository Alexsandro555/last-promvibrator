<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Initializer\Traits\RelationTrait;
use Modules\Initializer\Traits\TableColumnsTrait;
use Modules\Initializer\Traits\UuidTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sku extends Model
{
  use RelationTrait, TableColumnsTrait, UuidTrait;

  protected $table = 'skus';

  protected $guarded = [];

  private $uuids = ['sku'];

  public $form = [
    'id' => [
      'enabled' => true
    ],
    'sku' => [
      'enabled' => true,
      'validations' => [
        'required' => true,
        'max' => 255
      ]
    ],
    'price' => [
      'enabled' => true
    ],
    'product_id' => [
      'enabled' => true
    ]
  ];

  public function attr() {
    return $this->belongsToMany(Attribute::class, 'attribute_sku_options', 'sku_id', 'attribute_id')->withPivot('attribute_list_value_id');
  }

  public function attributes() {
    return $this->hasMany(AttributeSkuOption::class);
  }
}
