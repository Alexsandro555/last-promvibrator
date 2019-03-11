<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Initializer\Traits\RelationTrait;
use Modules\Initializer\Traits\SortTrait;

class AttributeType extends Model
{
  use SoftDeletes, SortTrait;

  use RelationTrait;

  protected $guarded = [];

  protected $table = 'attribute_types';

  public function attributes() {
    return $this->hasMany(Attribute::class);
  }
}
