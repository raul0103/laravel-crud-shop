<?php

namespace App\DTO;

use Illuminate\Support\Facades\Validator;

class LoginDTO
{

    private $email;
    private $password;

    public function __construct($request)
    {
        $this->email = $request['email'] ?? null;
        $this->password = $request['password'] ?? null;
    }

    public function toArray()
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }

    public function validate()
    {
        $validator = Validator::make($this->toArray(), [
            'email' =>  ['required', 'email'],
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    }
}
