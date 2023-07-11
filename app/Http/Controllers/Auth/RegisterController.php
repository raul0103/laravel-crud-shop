<?php

namespace App\Http\Controllers\Auth;

use App\DTO\RegisterDTO;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
  public function __invoke(Request $request)
  {
    $register_dto = new RegisterDTO($request->all());
    if ($validate =  $register_dto->validate()) {
      return $validate;
    }

    $user_data = $register_dto->toArray();

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
