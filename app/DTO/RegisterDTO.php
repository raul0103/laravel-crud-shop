<?php

namespace App\DTO;

use Illuminate\Support\Facades\Validator;

class RegisterDTO
{

    private $name;
    private $email;
    private $password;

    public function __construct($request)
    {
        $this->name = $request['name'] ?? null;
        $this->email = $request['email'] ?? null;
        $this->password = $request['password'] ?? null;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }

    public function validate()
    {
        $validator = Validator::make($this->toArray(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    }
}
