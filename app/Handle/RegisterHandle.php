<?php

namespace App\Handle;

use App\Command\RegisterCommand;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RegisterHandle
{
    public function __invoke(RegisterCommand $registerCommand)
    {
        $validator = Validator::make([
            'name'     => $registerCommand->name,
            'email'    => $registerCommand->email,
            'password' => $registerCommand->password,
        ], [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator;
    }
}
