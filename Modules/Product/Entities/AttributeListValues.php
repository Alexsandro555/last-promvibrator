<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Initializer\Traits\SortTrait;

class AttributeListValues extends Model
{
  use SoftDeletes, SortTrait;

  protected $guarded = [];

  protected $table = 'attribute_list_values';

  public function attributes() {
    return $this->bolongsTo(Attribute::class);
  }
}
