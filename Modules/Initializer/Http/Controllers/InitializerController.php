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
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('initializer::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('initializer::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('initializer::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('initializer::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function fields(Builder $builder, ModelService $modelService, $name) {
      $collectionResult = collect([]);
      //if(Cache::has($name)) {
      //  $collectionResult = Cache::get($name);
      //}
      //else
      //{
        $model = $modelService->find($name);
        $collectionResult = $modelService->collectionGenerate($model,$name);
        Cache::add($name,$collectionResult,now()->addSeconds(10000000));
     // }
      return $collectionResult;
    }
}
