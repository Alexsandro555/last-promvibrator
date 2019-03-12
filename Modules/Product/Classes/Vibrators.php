<?php

namespace Modules\Product\Classes;

use Modules\Product\Entities\LineProduct;
use Modules\Product\Entities\TypeProduct;
use Modules\Product\Entities\Product;

class Vibrators
{
  public function make()
  {
    $pneumaticVibratorTypes = PneumaticVibratorTypes::All();
    $typeProduct = new TypeProduct;
    $arrPneumaticVibratorTypes = [];
    foreach ($pneumaticVibratorTypes as $pneumaticVibratorType) {
      $result = $typeProduct->where('title',$pneumaticVibratorType->name)->first();
      $item["old_id"] = $pneumaticVibratorType->id;
      $item["name"] = $pneumaticVibratorType->name;
      $item['id'] = $result->id;
      $arrPneumaticVibratorTypes[] = $item;
    }

    // Пневматические вибраторы
    $pneumaticVibrator = new PneumaticVibrator;
    foreach ($arrPneumaticVibratorTypes as $arrPneumaticVibratorType) {
      $pneumaticVibrators = $pneumaticVibrator->where('typeid', $arrPneumaticVibratorType["old_id"])->get();
      foreach ($pneumaticVibrators as $pneumaticVibrator) {
        $product = new Product;
        $product->title = $pneumaticVibrator->name;
        $product->url_key = \Slug::make($pneumaticVibrator->name);
        $product->price = $pneumaticVibrator->price;
        $product->active = 1;
        $product->product_category_id = $pneumaticVibrator->id>50?3:2;
        $product->type_product_id = $arrPneumaticVibratorType["id"];
        $product->old_id = $pneumaticVibrator->id;
        $product->qty = $pneumaticVibrator->onstock;
        $product->save();
      }
    }


    $vibratorParentTypes = VibratorParentType::All();
    $arrVibratorsTypes = [];
    foreach ($vibratorParentTypes as $vibratorParentType) {
      $result = $typeProduct->where('title',$vibratorParentType->name)->first();
      $vibratorTypes = VibratorType::where('typeid',$vibratorParentType->id)->get();
      foreach ($vibratorTypes as $vibratorType) {
        $item["old_id"] = $vibratorType->id;
        $item["name"] = $vibratorParentType->name;
        $item["parent_id"] = $result->id;
        $item['id'] = $vibratorType->id;
        $arrVibratorsTypes[] = $item;
      }
    }



    // Площадочные вибраторы
    $vibrator = new Vibrator;
    foreach ($arrVibratorsTypes as $arrVibratorsType) {
      $Vibrators = $vibrator->where('typeid', $arrVibratorsType["old_id"])->get();
      foreach ($Vibrators as $Vibrator) {
        $product = new Product;
        $product->title = $Vibrator->name;
        $product->url_key = \Slug::make($Vibrator->name);
        $product->price = $Vibrator->price;
        $product->active = 1;
        $product->product_category_id = 1;
        $product->type_product_id = $arrVibratorsType["parent_id"];
        $product->line_product_id = $arrVibratorsType["id"];
        $product->old_id = $Vibrator->id;
        $product->qty = $Vibrator->onstock;
        $product->save();
      }
    }

    $concreteVibratorTypes = ConcreteVibratorType::All();
    $arrConcreteVibratorTypes = [];
    foreach ($concreteVibratorTypes as $concreteVibratorType) {
      $result = $typeProduct->where('title',$concreteVibratorType->name)->first();
      $item["old_id"] = $concreteVibratorType->id;
      $item["name"] = $concreteVibratorType->name;
      $item['id'] = $result->id;
      $arrConcreteVibratorTypes[] = $item;
    }

    // Глубинные вибраторы
    $concreteVibrator = new ConcreteVibrator;
    foreach ($arrConcreteVibratorTypes as $arrConcreteVibratorType) {
      $concreteVibrators = $concreteVibrator->where('typeid', $arrConcreteVibratorType["old_id"])->get();
      foreach ($concreteVibrators as $concreteVibrator) {
        $product = new Product;
        $product->title = $concreteVibrator->name;
        $product->url_key = \Slug::make($concreteVibrator->name);
        $product->price = $concreteVibrator->price;
        $product->active = $concreteVibrator->disabled ? 0 : 1;
        $product->product_category_id = 4;
        $product->type_product_id = $arrConcreteVibratorType["id"];
        $product->old_id = $concreteVibrator->id;

        $product->qty = $concreteVibrator->onstock;
        $product->save();
      }
    }
  }
}