<?php

namespace Modules\Callback\Http\Controllers;

use Modules\Callback\Http\Requests\CallbackRequest;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use PhpParser\Builder\Class_;
use Modules\Callback\Entities\Callback;

class CallbackController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return Callback::all();
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('callback::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CallbackRequest $request)
    {
      return Callback::create([
        'name' => $request->fio,
        'company_name' => $request->company_name,
        'telephone' => $request->telephone,
        'email' => $request->email,
        'comment' => $request->comment
      ]);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('callback::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('callback::edit');
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
}
