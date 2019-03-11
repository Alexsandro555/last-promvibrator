<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  /**
   * @return array|\Illuminate\Http\JsonResponse
   */
  public function login(Request $request) {
    if(Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
      $user = Auth::user();
      if(!$user->admin) {
        return response()->json(['error' => 'Отсутствуют права доступа'], 401);
      }
      $success['token'] = $user->createToken('MyApp')->accessToken;
      $success['name'] = $user->name;
      return ['success' => $success];
    }
    else {
      return response()->json(['error'=>'Пользователя с заданным логином и паролем не существует'], 401);
    }
  }

  public function getDetails() {
    return ['success' => Auth::user()];
  }
}
