<?php

namespace App\Handle;

use App\Command\RegisterCommand;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RegisterHandle
{

    public function __construct(User $user)
    {
    }

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
//            return [
//                'Переданы не валидные данные',
//                $validator->errors(),
//            ];
            throw new ValidationException($validator);
        }

        $createUser = User::create([
           'name' => $registerCommand->name,
           'email' => $registerCommand->email,
           'password' => Hash::make($registerCommand->password),
        ]);

        if (! $createUser) {
            throw new \RuntimeException('Ошибка при создании пользователя');
        }

        return $createUser;
    }
}
