<?php
/**
 * Created by PhpStorm.
 * User: alexsandro
 * Date: 05.06.18
 * Time: 10:09
 */

namespace Modules\Initializer\Traits;

use Illuminate\Database\Eloquent\Relations\Relation;
use Whoops\Exception\ErrorException;

trait RelationTrait
{
  public function getRelationships() {
    $model = new static;
    $relationships = [];
    foreach ((new \ReflectionClass($model))->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
      if($method->class != get_class($model) || !empty($method->getParameters()) || $method->getName() == __FUNCTION__) {
        continue;
      }
      try {
        $return = $method->invoke($model);
        if($return instanceof Relation) {
          $relationships[$method->getName()] = [
            'type' => (new \ReflectionClass($return))->getShortName(),
            'table' => $return->getRelated()->getTable(),
            'model' => (new \ReflectionClass($return->getRelated()))->getName()
          ];
        }
      }
      catch (ErrorException $e) {}
    }
    return $relationships;
  }
}