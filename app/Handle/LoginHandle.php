<?php

namespace App\Handle;

use App\Command\LoginCommand;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class LoginHandle
{

    public function __invoke(LoginCommand $loginCommand): array
    {

        $validator = Validator::make([
            'email'    => $loginCommand->email,
            'password' => $loginCommand->password,
        ], [
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $credentials = [
            'email'    => $loginCommand->email,
            'password' => $loginCommand->password
        ];

        if (!Auth::attempt($credentials)){
            throw new \RuntimeException('Неверный email или пароль.');
        }

        $user = Auth::getUser();
        $tokenResult = $user->createToken($user);
        $plainToken = $tokenResult->plainTextToken;

        return [
            'user'  => $user,
            'token' => $plainToken,
        ];
    }

}
