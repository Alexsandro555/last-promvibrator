<?php

namespace Modules\Product\Traits;

use Fico7489\Laravel\Pivot\Traits\PivotEventTrait;
use Modules\Product\Entities\AttributeValue;

trait AttributeValueDeleteTrait {
  use PivotEventTrait;

  protected static function bootAttributeValueDeleteTrait() {
    static::pivotDetaching(function ($model, $relationName, $pivotIds) {
      if($relationName == 'attributes') {
        foreach($pivotIds as $attribute_id) {
          $attributeValues = AttributeValue::where('attribute_id', $attribute_id)->whereIn('product_id',$model->products->pluck('id'))->get();
          foreach ($attributeValues as $attributeValue) {
            $attributeValue->delete();
          }
        }
      }
    });
  }
}