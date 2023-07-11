<?php

namespace App\Http\Controllers\Auth;

use App\DTO\LoginDTO;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
  public function __invoke(Request $request)
  {
    $login_dto = new LoginDTO($request->all());
    if ($validate = $login_dto->validate()) {
      return $validate;
    }

    $credentials = $login_dto->toArray();

    if (auth()->attempt($credentials)) {
      $user = auth()->user();

      // Удаляем все существующие токены доступа пользователя
      // $user->tokens()->delete();

      $token = $user->createToken('token')->plainTextToken;

      return response()->json(['token' => $token], 200);
    } else {
      return response()->json(['error' => 'Ошибка авторизации'], 401);
    }
  }
}
