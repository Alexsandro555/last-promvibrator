<?php

namespace Modules\Callback\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Callback\Http\Requests\CallbackRequest;
use Modules\Callback\Models\Callback;

class CallbackController extends Controller
{
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
}
