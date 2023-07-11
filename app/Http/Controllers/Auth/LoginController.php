<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
  public function __invoke(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' =>  ['required', 'email'],
      'password' => ['required'],
    ]);

    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()], 400);
    }

    $credentials = $validator->validated();

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
