<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class AttributeSkuOption extends Model
{
    protected $guarded = [];

    public function sku() {
      return $this->belongsTo(Sku::class);
    }
}
