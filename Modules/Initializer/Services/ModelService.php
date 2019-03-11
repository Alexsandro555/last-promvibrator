<?php
/**
 * Created by PhpStorm.
 * User: alexsandro
 * Date: 27.06.18
 * Time: 14:06
 */

namespace Modules\Initializer\Services;

use Illuminate\Support\Facades\File;


class ModelService
{
  public function find($name) {
    $model = resolve($name);
    // Если не найден соответствующий провайдер
    if(!$model) {
      $directories = File::directories(base_path().'/Modules');
      foreach ($directories as $directory) {
        $dirModule = substr($directory, strripos($directory, '/') + 1);
        $namespace = "Modules\\".$dirModule."\\Entities\\";
        if(class_exists($namespace.ucfirst($name))) {
          $modelName = $namespace.ucfirst($name);
          $model = new $modelName;
          break;
        }
        else {
          throw new ErrorException("Искомый файл не найден ".$modelName);
        }
      }
    }
    return $model;
  }

  public function collectionGenerate($model,$name) {
    $collectionResult = collect([]);
    $collectionTableColumns = $model->getColumns($name);
    if($model->form && count($model->form)>0) {
      foreach($collectionTableColumns as $key => $item) {
        if(array_key_exists($key,$model->form)) {
          if($model->form[$key]['enabled']) {
            $arrResult[$key] = $collectionTableColumns->get($key);
            $collection = collect([]);
            foreach ($item as $itemKey => $valueItem) {
              $collection->put($itemKey, $valueItem);
              if(array_key_exists('validations',$model->form[$key])) {
                $collection->put('validations', $model->form[$key]['validations']);
              }
            }
            $collectionResult->put($key,$collection);
          }
        }
      }
      $relationships = $model->getRelationships();
      foreach ($relationships as $key => $relationship) {
        $arrKeys = [];
        if($relationship["type"] == 'BelongsTo') {
          $modelRel = new $relationship["model"];
          $collection = collect([]);
          $collection->put('type','selectbox');
          $collection->put('title',$modelRel->name?$modelRel->name:'title');
          $collection->put('label', \DB::select(\DB::raw("SELECT TABLE_COMMENT FROM information_schema.TABLES WHERE TABLE_NAME = '".$relationship["table"]."'"))[0]->TABLE_COMMENT);
          if(array_key_exists('validations',$model->form[$key])) {
            $collection->put('validations', $model->form[$key]['validations']);
          }
          $modelRelationship = new $relationship["model"];
          $subRelationships = $modelRelationship->getRelationships();
          foreach($subRelationships as $keyRel => $subRelationship) {
            if($subRelationship["type"] == 'HasMany' || $subRelationship["type"] == 'BelongsToMany') {
              $arrKeys[] = $keyRel;
            }
          }
          $collection->put('items',$relationship["model"]::with($arrKeys)->get());
          $collection->put('relations',$arrKeys);
          $collectionResult->put($key,$collection);
        }
      }
    }
    return $collectionResult;
  }
}