<?php

namespace Modules\Initializer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Cache;
use Modules\Initializer\Services\ModelService;

class InitializerController extends Controller
{
    public function fields(Builder $builder, ModelService $modelService, $name)
    {
      $collectionResult = collect([]);
      if(Cache::has($name)) {
        $collectionResult = Cache::get($name);
      } else  {
        $model = $modelService->find($name);
        $collectionResult = $modelService->collectionGenerate($model,$name);
        Cache::add($name,$collectionResult,now()->addSeconds(10000000));
      }
      return $collectionResult;
    }
}
