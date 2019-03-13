<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Initializer\Traits\RelationTrait;
use Modules\Initializer\Traits\SortTrait;
use Modules\Initializer\Traits\TableColumnsTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
  use SoftDeletes, RelationTrait, TableColumnsTrait, SortTrait;

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
    ],
    'sort' => [
      'enabled' => true
    ],
    'attribute_unit' => [
      'enabled' => true
    ],
    'attribute_type' => [
      'enabled' => true,
      'validations' => [
        'required' => true,
      ]
    ],
    'attribute_group' => [
      'enabled' => true,
      'validations' => [
        'required' => true,
      ]
    ]
  ];

  protected $table = 'attributes';

  protected $dates = ['deleted_at'];

  protected $guarded = [];

  public function attribute_unit() {
    return $this->belongsTo(AttributeUnit::class);
  }

  public function attribute_type() {
    return $this->belongsTo(AttributeType::class);
  }

  public function attribute_group() {
    return $this->belongsTo(AttributeGroup::class);
  }

  public function productCategories() {
    return $this->morphedByMany(ProductCategory::class, 'attributable');
  }

  public function typeProducts() {
    return $this->morphedByMany(TypeProduct::class, 'attributable');
  }

  public function lineProducts() {
    return $this->morphedByMany(LineProduct::class, 'attributable');
  }

  public function attributeListValue() {
    return $this->hasMany(AttributeListValues::class);
  }

  public function attributeValue() {
    return $this->hasMany(AttributeValue::class);
  }

  public function products() {
    return $this->belongsToMany(Product::class, 'attribute_values')->withPivot('boolean_value', 'date_value', 'integer_value', 'string_value', 'decimal_value', 'text_value', 'list_value');
  }
}
