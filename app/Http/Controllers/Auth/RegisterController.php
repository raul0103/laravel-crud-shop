<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
  public function __invoke(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:8',
    ]);

    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()], 400);
    }

    $user_data = $validator->validated();

    // Установка роли "admin" для первого пользователя
    if (!User::count()) {
      $role = Role::where('name', 'admin')->first();
    } else {
      $role = Role::where('name', 'user')->first();
    }
    $user_data['role_id'] = $role->id;

    $user_data['password'] = bcrypt($user_data['password']);

    $user = User::create($user_data);

    $token = $user->createToken('token')->plainTextToken;

    return response()->json(['token' => $token], 200);
  }
}
